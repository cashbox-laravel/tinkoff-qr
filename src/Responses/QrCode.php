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

namespace Helldar\CashierDriver\Tinkoff\QrCode\Responses;

use Helldar\Cashier\Http\Response;

class QrCode extends Response
{
    public const KEY_URL = 'url';

    protected $map = [
        self::KEY_EXTERNAL_ID => 'PaymentId',

        self::KEY_STATUS => 'Status',

        self::KEY_URL => 'PaymentURL',
    ];

    public function getUrl(): ?string
    {
        return $this->value(self::KEY_URL);
    }

    public function isEmpty(): bool
    {
        return empty($this->getExternalId()) || empty($this->getUrl());
    }
}
