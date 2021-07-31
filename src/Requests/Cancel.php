<?php

declare(strict_types=1);

namespace Helldar\CashierDriver\Tinkoff\QrCode\Requests;

class Cancel extends BaseRequest
{
    protected $path = '/v2/Cancel';

    public function getRawBody(): array
    {
        return [
            'PaymentId' => $this->model->getExternalId(),

            'Amount' => $this->model->getSum(),

            'Currency' => $this->model->getCurrency(),
        ];
    }
}
