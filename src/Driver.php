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

namespace Helldar\CashierDriver\Tinkoff\QrCode;

use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Exception;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Statuses;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\Cancel;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\GetQR;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\GetState;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\Init;
use Helldar\CashierDriver\Tinkoff\QrCode\Resources\Details;
use Helldar\CashierDriver\Tinkoff\QrCode\Responses\QrCode;
use Helldar\CashierDriver\Tinkoff\QrCode\Responses\Refund;
use Helldar\CashierDriver\Tinkoff\QrCode\Responses\State;
use Helldar\Contracts\Cashier\Http\Response;

class Driver extends BaseDriver
{
    protected $exceptions = Exception::class;

    protected $statuses = Statuses::class;

    protected $details = Details::class;

    public function start(): Response
    {
        $this->init();

        $request = GetQR::make($this->model);

        return $this->request($request, QrCode::class);
    }

    public function check(): Response
    {
        $request = GetState::make($this->model);

        return $this->request($request, State::class);
    }

    public function refund(): Response
    {
        $request = Cancel::make($this->model);

        return $this->request($request, Refund::class);
    }

    protected function init(): Response
    {
        $request = Init::make($this->model);

        return $this->request($request, Responses\Init::class);
    }
}
