<?php

namespace Tests\Resources;

use Helldar\Cashier\Constants\Currency;
use Tests\Fixtures\Requests\Request;
use Tests\TestCase;

class RequestTest extends TestCase
{
    public function testParams()
    {
        $this->assertSame(TestCase::PAYMENT_ID, $this->request()->getPaymentId());
        $this->assertSame(TestCase::PAYMENT_SUM_FORMATTED, $this->request()->getSum());
        $this->assertSame((string) Currency::RUB, $this->request()->getCurrency());
    }

    public function testCreatedAt()
    {
        $this->assertSame(TestCase::PAYMENT_DATE_FORMATTED, $this->request()->getCreatedAt());

        $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z/', $this->request()->getCreatedAt());
    }

    public function testNow()
    {
        $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z/', $this->request()->getCreatedAt());
        $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z/', $this->request()->getCreatedAt());
    }

    public function testUniqueId()
    {
        $request = $this->request();

        $this->assertMatchesRegularExpression('/^(([0-9]|[a-f]|[A-F]){32})$/', $request->getUniqueId());
        $this->assertMatchesRegularExpression('/^(([0-9]|[a-f]|[A-F]){32})$/', $request->getUniqueId());
    }

    public function testSameUniqueId()
    {
        $request = $this->request();

        $unique_id = $request->getUniqueId();

        $this->assertSame($unique_id, $request->getUniqueId());
        $this->assertSame($unique_id, $request->getUniqueId());
    }

    public function testRandomUniqueId()
    {
        $request = $this->request();

        $unique_id = $request->getUniqueId();

        $this->assertSame($unique_id, $request->getUniqueId());
        $this->assertSame($unique_id, $request->getUniqueId());

        $this->assertNotSame($unique_id, $request->getUniqueId(true));
        $this->assertNotSame($unique_id, $request->getUniqueId(true));
        $this->assertNotSame($unique_id, $request->getUniqueId());
    }

    public function testToArray()
    {
        $expected = [
            'OrderId' => TestCase::PAYMENT_ID,

            'Amount' => TestCase::PAYMENT_SUM_FORMATTED,

            'Currency' => (string) Currency::RUB,
        ];

        $this->assertSame($expected, $this->request()->toArray());
    }

    protected function request(): Request
    {
        return Request::make($this->model());
    }
}
