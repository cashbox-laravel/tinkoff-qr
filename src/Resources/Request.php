<?php

namespace Helldar\CashierDriver\Tinkoff\QrCode\Resources;

use Helldar\Cashier\Resources\Request as BasePayment;

abstract class Request extends BasePayment
{
    public function toArray(): array
    {
        return [
            'OrderId' => $this->paymentId(),

            'Amount' => $this->getSum(),
        ];
    }
}
