<?php

namespace Tests;

use Helldar\Cashier\Constants\Driver as DriverConstant;
use Helldar\Cashier\Models\CashierDetail;
use Helldar\Cashier\Providers\ObserverServiceProvider;
use Helldar\Cashier\Providers\ServiceProvider;
use Helldar\CashierDriver\Tinkoff\QrCode\Driver;
use Helldar\Contracts\Cashier\Http\Request;
use Helldar\Contracts\Cashier\Resources\Details;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Tests\Fixtures\Models\Payment;
use Tests\Fixtures\Resources\Model;

abstract class TestCase extends BaseTestCase
{
    public const TERMINAL_KEY = '123456';

    public const TERMINAL_SECRET = '1q2w3e4r5t';

    public const PAYMENT_EXTERNAL_ID = '456789';

    public const PAYMENT_ID = '1234567890';

    public const PAYMENT_SUM = 12.34;

    public const PAYMENT_SUM_FORMATTED = 1234;

    public const CURRENCY = 643;

    public const CURRENCY_FORMATTED = '643';

    public const PAYMENT_DATE = '2021-07-23 17:33:27';

    public const PAYMENT_DATE_FORMATTED = '2021-07-23T17:33:27Z';

    public const STATUS = 'NEW';

    public const URL = 'https://example.com';

    public const MODEL_TYPE_ID = 123;

    public const MODEL_STATUS_ID = 0;

    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
            ObserverServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        /** @var \Illuminate\Config\Repository $config */
        $config = $app['config'];

        $config->set('cashier.payment.model', Payment::class);

        $config->set('cashier.payment.map', [
            self::MODEL_TYPE_ID => 'tinkoff_qr',
        ]);

        $config->set('cashier.drivers.tinkoff_qr', [
            DriverConstant::DRIVER  => Driver::class,
            DriverConstant::DETAILS => Model::class,
        ]);
    }

    protected function model(Details $details = null): Payment
    {
        $payment = new Payment();

        return $payment->setRelation('cashier', $this->detailsRelation($payment, $details));
    }

    protected function detailsRelation(EloquentModel $model, ?Details $details): CashierDetail
    {
        $details = new CashierDetail([
            'item_type'   => Payment::class,
            'item_id'     => self::PAYMENT_ID,
            'external_id' => self::PAYMENT_EXTERNAL_ID,
            'details'     => $details,
        ]);

        return $details->setRelation('parent', $model);
    }

    /**
     * @param  \Helldar\CashierDriver\Tinkoff\QrCode\Requests\BaseRequest|string  $request
     *
     * @return \Helldar\Contracts\Cashier\Http\Request
     */
    protected function request(string $request): Request
    {
        $model = $this->modelRequest();

        return $request::make($model);
    }

    protected function modelRequest(): Model
    {
        return Model::make($this->model());
    }
}
