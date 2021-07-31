<?php

namespace Tests\Responses;

use Helldar\CashierDriver\Tinkoff\QrCode\Responses\QrCode;
use Helldar\Contracts\Cashier\Http\Response;
use Tests\TestCase;

class QrCodeTest extends TestCase
{
    public function testInstance()
    {
        $response = $this->response();

        $this->assertInstanceOf(QrCode::class, $response);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetExternalId()
    {
        $response = $this->response();

        $this->assertSame(self::PAYMENT_EXTERNAL_ID, $response->getExternalId());
    }

    public function testGetStatus()
    {
        $response = $this->response();

        $response->put('Status', self::STATUS);

        $this->assertSame(self::STATUS, $response->getStatus());
    }

    public function testGetUrl()
    {
        $response = $this->response();

        $this->assertSame(self::URL, $response->getUrl());
    }

    public function testToArray()
    {
        $response = $this->response();

        $response->put('Status', self::STATUS);

        $this->assertSame([
            QrCode::KEY_URL    => self::URL,
            QrCode::KEY_STATUS => self::STATUS,
        ], $response->toArray());
    }

    /**
     * @return \Helldar\Contracts\Cashier\Http\Response|\Helldar\CashierDriver\Tinkoff\QrCode\Responses\QrCode
     */
    protected function response(): Response
    {
        return QrCode::make([
            'TerminalKey' => self::TERMINAL_KEY,
            'OrderId'     => self::PAYMENT_ID,
            'Success'     => true,
            'Data'        => self::URL,
            'PaymentId'   => self::PAYMENT_EXTERNAL_ID,
            'ErrorCode'   => 0,
        ]);
    }
}
