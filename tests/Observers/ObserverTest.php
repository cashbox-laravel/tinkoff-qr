<?php

namespace Tests\Observers;

use Helldar\Cashier\Constants\Status;
use Helldar\Cashier\Facades\Config\Payment as PaymentConfig;
use Helldar\Cashier\Providers\ObserverServiceProvider;
use Helldar\Cashier\Providers\ServiceProvider;
use Helldar\Support\Facades\Http\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\Factories\Payment;
use Tests\Fixtures\Models\RequestPayment;
use Tests\TestCase;

class ObserverTest extends TestCase
{
    use RefreshDatabase;

    protected $model = RequestPayment::class;

    public function testCreate(): RequestPayment
    {
        $this->assertDatabaseCount('payments', 0);
        $this->assertDatabaseCount('cashier_details', 0);

        $payment = $this->payment();

        $payment->refresh();

        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseCount('cashier_details', 1);

        $this->assertIsString($payment->cashier->external_id);
        $this->assertMatchesRegularExpression('/^(\d+)$/', $payment->cashier->external_id);

        $this->assertTrue(Url::is($payment->cashier->details->getUrl()));

        $this->assertSame('NEW', $payment->cashier->details->getStatus());

        $this->assertSame(
            PaymentConfig::getStatuses()->getStatus(Status::NEW),
            $payment->status_id
        );

        return $payment;
    }

    public function testUpdate()
    {
        $payment = $this->testCreate();

        $payment->update([
            'sum' => 34.56,
        ]);

        $payment->refresh();

        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseCount('cashier_details', 1);

        $this->assertIsString($payment->cashier->external_id);
        $this->assertMatchesRegularExpression('/^(\d+)$/', $payment->cashier->external_id);

        $this->assertTrue(Url::is($payment->cashier->details->getUrl()));

        $this->assertSame('NEW', $payment->cashier->details->getStatus());

        $this->assertSame(
            PaymentConfig::getStatuses()->getStatus(Status::NEW),
            $payment->status_id
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
            ObserverServiceProvider::class,
        ];
    }

    protected function payment(): RequestPayment
    {
        return Payment::create()->refresh();
    }
}
