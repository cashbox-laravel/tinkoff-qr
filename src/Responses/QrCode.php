<?php

declare(strict_types=1);

namespace Helldar\CashierDriver\Tinkoff\QrCode\Responses;

use Helldar\Cashier\Http\Response;

class QrCode extends Response
{
    public const KEY_URL = 'url';

    protected $map = [
        self::KEY_EXTERNAL_ID => 'PaymentId',

        self::KEY_STATUS => 'Status',

        self::KEY_URL => 'Data',
    ];

    public function getUrl(): ?string
    {
        return $this->value(self::KEY_URL);
    }
}
