<?php

declare(strict_types=1);

namespace Helldar\CashierDriver\Tinkoff\QrCode\Requests;

class Init extends BaseRequest
{
    protected $path = '/v2/Init';

    public function getRawBody(): array
    {
        return [
            'OrderId' => $this->model->getPaymentId(),

            'Amount' => $this->model->getSum(),

            'Currency' => $this->model->getCurrency(),
        ];
    }
}
