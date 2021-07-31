<?php

/*
 * This file is part of the "andrey-helldar/cashier-tinkoff-qr" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@ai-rus.com>
 *
 * @copyright 2021 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/andrey-helldar/cashier-tinkoff-qr
 */

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
