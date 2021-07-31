<?php

declare(strict_types=1);

namespace Helldar\CashierDriver\Tinkoff\QrCode\Requests;

class GetState extends BaseRequest
{
    protected $path = '/v2/GetState';

    public function getRawBody(): array
    {
        return [
            'PaymentId' => $this->model->getExternalId(),
        ];
    }
}
