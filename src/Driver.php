<?php

namespace Helldar\CashierDriver\Tinkoff\QR;

use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\CashierDriver\Tinkoff\Helpers\Statuses;

class Driver extends BaseDriver
{
    protected $statuses = Statuses::class;

    protected $production_host = 'https://securepay.tinkoff.ru';

    protected $dev_host = 'https://rest-api-test.tinkoff.ru';
}
