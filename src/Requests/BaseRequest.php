<?php

declare(strict_types=1);

namespace Helldar\CashierDriver\Tinkoff\QrCode\Requests;

use Helldar\Cashier\Http\Request;
use Helldar\CashierDriver\Tinkoff\Auth\Support\Auth;

abstract class BaseRequest extends Request
{
    protected $host = 'https://securepay.tinkoff.ru';

    protected $auth = Auth::class;

    public function getRawHeaders(): array
    {
        return [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function getHost(): string
    {
        return $this->host;
    }
}
