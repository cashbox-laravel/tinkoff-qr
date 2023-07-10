<?php

/*
 * This file is part of the "cashier-provider/tinkoff-qr" project.
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
 * @see https://github.com/cashier-provider/tinkoff-qr
 */

declare(strict_types=1);

namespace TinkoffQr\src\Requests;

use TinkoffQr\src\Requests\BaseRequest;

class GetQR extends BaseRequest
{
    protected $path = '/v2/GetQr';

    public function getRawBody(): array
    {
        return [
            'PaymentId' => $this->model->getExternalId(),
        ];
    }
}
