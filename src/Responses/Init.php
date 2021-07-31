<?php

declare(strict_types=1);

namespace Helldar\CashierDriver\Tinkoff\QrCode\Responses;

use Helldar\Cashier\Http\Response;

class Init extends Response
{
    protected $map = [
        self::KEY_EXTERNAL_ID => 'PaymentId',

        self::KEY_STATUS => 'Status',
    ];
}
