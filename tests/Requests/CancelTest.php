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

namespace Tests\Requests;

use Helldar\Cashier\Http\Request;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\Cancel;
use Helldar\Contracts\Cashier\Http\Request as RequestContract;
use Helldar\Contracts\Http\Builder;
use Tests\TestCase;

class CancelTest extends TestCase
{
    public function testInstance()
    {
        $request = $this->request(Cancel::class);

        $this->assertInstanceOf(Cancel::class, $request);
        $this->assertInstanceOf(Request::class, $request);
        $this->assertInstanceOf(RequestContract::class, $request);
    }

    public function testUri()
    {
        $request = $this->request(Cancel::class);

        $this->assertInstanceOf(Builder::class, $request->uri());

        $this->assertSame('https://securepay.tinkoff.ru/v2/Cancel', $request->uri()->toUrl());
    }

    public function testHeaders()
    {
        $request = $this->request(Cancel::class);

        $this->assertIsArray($request->headers());

        $this->assertSame([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ], $request->headers());
    }

    public function testGetRawHeaders()
    {
        $request = $this->request(Cancel::class);

        $this->assertIsArray($request->getRawHeaders());

        $this->assertSame([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ], $request->getRawHeaders());
    }

    public function testBody()
    {
        $request = $this->request(Cancel::class);

        $this->assertIsArray($request->body());

        $this->assertSame([
            'PaymentId' => self::PAYMENT_EXTERNAL_ID,
            'Amount'    => self::PAYMENT_SUM_FORMATTED,
            'Currency'  => self::CURRENCY_FORMATTED,

            'TerminalKey' => $this->getTerminalKey(),

            'Token' => '668f52d9fb6f6ff75b4a319b7bc34552cf39c82cc0cf2e7a2146f54b8977cb01',
        ], $request->body());
    }

    public function testGetRawBody()
    {
        $request = $this->request(Cancel::class);

        $this->assertIsArray($request->getRawBody());

        $this->assertSame([
            'PaymentId' => self::PAYMENT_EXTERNAL_ID,
            'Amount'    => self::PAYMENT_SUM_FORMATTED,
            'Currency'  => self::CURRENCY_FORMATTED,
        ], $request->getRawBody());
    }
}
