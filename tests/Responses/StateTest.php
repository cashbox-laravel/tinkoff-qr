<?php

namespace Tests\Responses;

use Helldar\Cashier\Http\Response as BaseResponse;
use Helldar\CashierDriver\Tinkoff\QrCode\Responses\State;
use Helldar\Contracts\Cashier\Http\Response;
use Tests\TestCase;

class StateTest extends TestCase
{
    public function testInstance()
    {
        $response = $this->response();

        $this->assertInstanceOf(State::class, $response);
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

        $this->assertSame(self::STATUS, $response->getStatus());
    }

    public function testToArray()
    {
        $response = $this->response();

        $this->assertSame([
            BaseResponse::KEY_STATUS => self::STATUS,
        ], $response->toArray());
    }

    protected function response(): Response
    {
        return State::make([
            'TerminalKey' => self::TERMINAL_KEY,
            'OrderId'     => self::PAYMENT_ID,
            'Success'     => true,
            'Status'      => self::STATUS,
            'PaymentId'   => self::PAYMENT_EXTERNAL_ID,
            'ErrorCode'   => 0,
        ]);
    }
}
