<?php

namespace Tests\Requests;

use Helldar\Cashier\Http\Request;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\GetQR;
use Helldar\Contracts\Cashier\Http\Request as RequestContract;
use Helldar\Contracts\Http\Builder;
use Tests\TestCase;

class GetQRTest extends TestCase
{
    public function testInstance()
    {
        $request = $this->request(GetQR::class);

        $this->assertInstanceOf(GetQR::class, $request);
        $this->assertInstanceOf(Request::class, $request);
        $this->assertInstanceOf(RequestContract::class, $request);
    }

    public function testUri()
    {
        $request = $this->request(GetQR::class);

        $this->assertInstanceOf(Builder::class, $request->uri());

        $this->assertSame('https://securepay.tinkoff.ru/v2/GetQr', $request->uri()->toUrl());
    }

    public function testHeaders()
    {
        $request = $this->request(GetQR::class);

        $this->assertIsArray($request->headers());

        $this->assertSame([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ], $request->headers());
    }

    public function testGetRawHeaders()
    {
        $request = $this->request(GetQR::class);

        $this->assertIsArray($request->getRawHeaders());

        $this->assertSame([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ], $request->getRawHeaders());
    }

    public function testBody()
    {
        $request = $this->request(GetQR::class);

        $this->assertIsArray($request->body());

        $this->assertSame([
            'PaymentId'   => self::PAYMENT_EXTERNAL_ID,
            'TerminalKey' => self::TERMINAL_KEY,
            'Token'       => '436227a440ff1e46688aa41b35a1261dbc8035c8db8bc6585612c7ae3ee734f5',
        ], $request->body());
    }

    public function testGetRawBody()
    {
        $request = $this->request(GetQR::class);

        $this->assertIsArray($request->getRawBody());

        $this->assertSame([
            'PaymentId' => self::PAYMENT_EXTERNAL_ID,
        ], $request->getRawBody());
    }
}
