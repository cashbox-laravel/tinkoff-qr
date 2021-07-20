<?php

namespace Helldar\CashierDriver\Tinkoff\QrCode\Helpers;

use Helldar\Cashier\Helpers\Statuses as BaseStatus;

class Statuses extends BaseStatus
{
    public const NEW = [
        'FORM_SHOWED',
        'NEW',
    ];

    public const REFUNDING = [
        'AUTHORIZED',
        'AUTHORIZING',
        'CONFIRMED',
        'CONFIRMING',
        'REFUNDING',
    ];

    public const REFUNDED = [
        'PARTIAL_REFUNDED',
        'REFUNDED',
        'REVERSED',
    ];

    public const FAILED = [
        'ATTEMPTS_EXPIRED',
        'CANCELED',
        'DEADLINE_EXPIRED',
        'REJECTED',
    ];

    public const SUCCESS = [
        'CONFIRMED',
    ];
}
