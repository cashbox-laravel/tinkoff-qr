<?php

declare(strict_types=1);

namespace Helldar\CashierDriver\Tinkoff\QrCode\Requests;

use Helldar\Cashier\Resources\Request;

abstract class BaseRequest extends Request
{
    protected $production_host = 'https://securepay.tinkoff.ru';

    public function getRawHeaders(): array
    {
        return [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function getHost(): string
    {
        return $this->production_host;
    }
}
