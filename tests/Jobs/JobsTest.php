<?php

namespace Tests\Jobs;

use Helldar\Cashier\Constants\Status;
use Helldar\Cashier\Facades\Config\Payment as PaymentConfig;
use Helldar\Cashier\Services\Jobs;
use Helldar\Support\Facades\Http\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\Factories\Payment;
use Tests\Fixtures\Models\RequestPayment;
use Tests\TestCase;

class JobsTest extends TestCase
{
    use RefreshDatabase;

    protected $model = RequestPayment::class;

    public function testStart()
    {
        $this->assertDatabaseCount('payments', 0);
        $this->assertDatabaseCount('cashier_details', 0);

        $payment = $this->payment();

        Jobs::make($payment)->start();

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

    public function testCheck()
    {
        $this->assertDatabaseCount('payments', 0);
        $this->assertDatabaseCount('cashier_details', 0);

        $payment = $this->payment();

        Jobs::make($payment)->start();
        Jobs::make($payment)->check(true);

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

    public function testRefund()
    {
        $this->assertDatabaseCount('payments', 0);
        $this->assertDatabaseCount('cashier_details', 0);

        $payment = $this->payment();

        $this->assertSame(
            PaymentConfig::getStatuses()->getStatus(Status::NEW),
            $payment->status_id
        );

        Jobs::make($payment)->start();
        Jobs::make($payment)->refund();

        $payment->refresh();

        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseCount('cashier_details', 1);

        $this->assertIsString($payment->cashier->external_id);
        $this->assertMatchesRegularExpression('/^(\d+)$/', $payment->cashier->external_id);

        $this->assertSame('CANCELED', $payment->cashier->details->getStatus());

        $this->assertSame(
            PaymentConfig::getStatuses()->getStatus(Status::REFUND),
            $payment->status_id
        );
    }

    protected function payment(): RequestPayment
    {
        return Payment::create();
    }
}
