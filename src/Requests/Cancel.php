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
