<?php

namespace Tests\Fixtures\Requests;

use Carbon\Carbon;
use Helldar\Cashier\Constants\Currency;
use Helldar\CashierDriver\Tinkoff\QrCode\Resources\Request as BaseRequest;
use Tests\TestCase;

class Request extends BaseRequest
{
    protected function paymentId(): string
    {
        return TestCase::PAYMENT_ID;
    }

    protected function sum(): float
    {
        return TestCase::PAYMENT_SUM;
    }

    protected function currency(): int
    {
        return Currency::RUB;
    }

    protected function createdAt(): Carbon
    {
        return Carbon::parse(TestCase::PAYMENT_DATE);
    }
}
