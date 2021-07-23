<?php

namespace Tests\Resources;

use Helldar\CashierDriver\Tinkoff\QrCode\Resources\Response;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testPaymentId()
    {
        $this->assertSame(TestCase::PAYMENT_ID, $this->response()->paymentId());
    }

    public function testStatus()
    {
        $this->assertSame(TestCase::STATUS, $this->response()->getStatus());
    }

    public function testUrl()
    {
        $this->assertSame(TestCase::URL, $this->response()->getUrl());
    }

    public function testToArray()
    {
        $this->assertSame([
            Response::KEY_STATUS => TestCase::STATUS,
            Response::KEY_URL    => TestCase::URL,
        ], $this->response()->toArray());
    }

    public function testPut()
    {
        $response = $this->response();

        $this->assertSame(TestCase::PAYMENT_ID, $response->paymentId());
        $this->assertSame(TestCase::STATUS, $response->getStatus());
        $this->assertSame(TestCase::URL, $response->getUrl());

        $this->assertSame([
            Response::KEY_STATUS => TestCase::STATUS,
            Response::KEY_URL    => TestCase::URL,
        ], $this->response()->toArray());

        $response->put('foo', 'bar');
        $response->put(Response::KEY_STATUS, 'FORM_SHOWED');

        $this->assertSame(TestCase::PAYMENT_ID, $response->paymentId());
        $this->assertSame('FORM_SHOWED', $response->getStatus());
        $this->assertSame(TestCase::URL, $response->getUrl());

        $this->assertSame([
            Response::KEY_STATUS => 'FORM_SHOWED',
            Response::KEY_URL    => TestCase::URL,
        ], $this->response()->toArray());
    }

    protected function response(): Response
    {
        return Response::make([
            'PaymentId' => TestCase::PAYMENT_ID,
            'Status'    => TestCase::STATUS,
            'Data'      => TestCase::URL,
        ]);
    }
}
