<?php

namespace Helldar\CashierDriver\Tinkoff\QR\Requests;

use Helldar\Cashier\Requests\Payment as BasePayment;

abstract class Payment extends BasePayment
{
    public function toArray(): array
    {
        return [
            'OrderId' => $this->getPaymentId(),
            'Amount'  => $this->getSum(),
        ];
    }
}
