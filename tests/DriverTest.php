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

use Helldar\Cashier\Http\Response;
use Helldar\CashierDriver\Tinkoff\QrCode\Driver as QD;
use Helldar\Contracts\Cashier\Driver as DriverContract;
use Helldar\Contracts\Cashier\Http\Response as ResponseContract;
use Tests\Fixtures\Models\ReadyPayment;
use Tests\Fixtures\Models\RequestPayment;

class DriverTest extends TestCase
{
    protected $model = RequestPayment::class;

    public function testStart()
    {
        $response = $this->driver()->start();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(ResponseContract::class, $response);
    }

    public function testCheck()
    {
        $response = $this->driver()->check();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(ResponseContract::class, $response);
    }

    public function testRefund()
    {
        $response = $this->driver()->refund();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(ResponseContract::class, $response);
    }

    protected function driver(): DriverContract
    {
        $model = $this->payment();

        $config = $this->config();

        return QD::make($config, $model);
    }

    protected function payment(): ReadyPayment
    {
        return new ReadyPayment();
    }
}
