<?php

/*
 * This file is part of the "andrey-helldar/cashier-tinkoff-qr" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 *
 * @copyright 2021 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/andrey-helldar/cashier-tinkoff-qr
 */

namespace Helldar\CashierDriver\Tinkoff\QrCode\Helpers;

use Helldar\Cashier\Services\Statuses as BaseStatus;

class Statuses extends BaseStatus
{
    public const NEW = [
        'FORM_SHOWED',
        'NEW',
    ];

    public const REFUNDING = [
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
