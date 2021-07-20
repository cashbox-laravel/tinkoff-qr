<?php

namespace Helldar\CashierDriver\Tinkoff\QrCode\Resources;

use Helldar\Cashier\Resources\Response as Base;

class Response extends Base
{
    public const KEY_URL = 'url';

    protected $map = [
        self::KEY_PAYMENT_ID => 'PaymentId',
        self::KEY_STATUS     => 'Status',
        self::KEY_URL        => 'Data',
    ];

    public function getUrl(): ?string
    {
        return $this->value(self::KEY_URL);
    }
}
