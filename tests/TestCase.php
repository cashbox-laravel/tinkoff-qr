<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Tests\Fixtures\Models\Payment;

abstract class TestCase extends BaseTestCase
{
    public const PAYMENT_ID = '1234567890';

    public const PAYMENT_SUM = 12.34;

    public const PAYMENT_SUM_FORMATTED = 1234;

    public const PAYMENT_DATE = '2021-07-23 17:33:27';

    public const PAYMENT_DATE_FORMATTED = '2021-07-23T17:33:27Z';

    public const STATUS = 'NEW';

    public const URL = 'https://example.com';

    protected function model(): Payment
    {
        return new Payment();
    }
}
