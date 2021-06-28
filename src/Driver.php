<?php

namespace Helldar\CashierDriver\Tinkoff\QR;

use Helldar\Cashier\DTO\Response;
use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\CashierDriver\Tinkoff\QR\Helpers\Statuses;

class Driver extends BaseDriver
{
    protected $statuses = Statuses::class;

    protected $production_host = 'https://securepay.tinkoff.ru';

    protected $dev_host = 'https://rest-api-test.tinkoff.ru';

    public function init(): Response
    {
        // TODO: Implement init() method.
    }

    public function check(): Response
    {
        // TODO: Implement check() method.
    }

    public function refund(): Response
    {
        // TODO: Implement refund() method.
    }
}
