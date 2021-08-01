<?php

/*
 * This file is part of the "andrey-helldar/cashier-tinkoff-qr" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 *
 * @copyright 2021 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/andrey-helldar/cashier-tinkoff-qr
 */

namespace Tests;

use Helldar\Cashier\Config\Driver as DriverConfig;
use Helldar\Cashier\Constants\Driver as DriverConstant;
use Helldar\Cashier\Facades\Config\Payment as PaymentConfig;
use Helldar\Cashier\Models\CashierDetail;
use Helldar\Cashier\Providers\ServiceProvider;
use Helldar\CashierDriver\Tinkoff\QrCode\Driver;
use Helldar\Contracts\Cashier\Http\Request;
use Helldar\Contracts\Cashier\Resources\Details;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Tests\Fixtures\Models\Payment;
use Tests\Fixtures\Resources\Model;

abstract class TestCase extends BaseTestCase
{
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

    protected $loadEnvironmentVariables = true;

    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function getEnvironmentSetup($app)
    {
        $app->useEnvironmentPath(__DIR__ . '/../');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        /** @var \Illuminate\Config\Repository $config */
        $config = $app['config'];

        $config->set('cashier.payment.model', Payment::class);

        $config->set('cashier.payment.map', [
            self::MODEL_TYPE_ID => 'tinkoff_qr',
        ]);

        $config->set('cashier.drivers.tinkoff_qr', [
            DriverConstant::DRIVER  => Driver::class,
            DriverConstant::DETAILS => Model::class,

            DriverConstant::CLIENT_ID     => env('CASHIER_TINKOFF_CLIENT_ID'),
            DriverConstant::CLIENT_SECRET => env('CASHIER_TINKOFF_CLIENT_SECRET'),
        ]);
    }

    protected function model(Details $details = null): Payment
    {
        $model = PaymentConfig::getModel();

        $payment = new $model();

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
        return Model::make($this->model(), $this->config());
    }

    protected function config(): DriverConfig
    {
        $config = config('cashier.drivers.tinkoff_qr');

        return DriverConfig::make($config);
    }

    protected function getTerminalKey(): string
    {
        return config('cashier.drivers.tinkoff_qr.client_id');
    }

    protected function getTerminalSecret(): string
    {
        return config('cashier.drivers.tinkoff_qr.client_secret');
    }
}
