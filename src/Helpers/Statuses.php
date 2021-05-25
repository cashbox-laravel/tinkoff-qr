<?php

namespace Helldar\CashierDriver\Tinkoff\Helpers;

use Helldar\Cashier\Helpers\Statuses as BaseStatus;

class Statuses extends BaseStatus
{
    public const NEW = [
        'NEW',
    ];

    public const REFUNDING = [
        'AUTHORIZING',
        'AUTHORIZED',
        'CONFIRMING',
        'CONFIRMED',
        'REFUNDING',
    ];

    public const REFUNDED = [];

    public const FAILED = [];
}
