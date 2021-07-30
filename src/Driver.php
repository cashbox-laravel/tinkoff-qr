<?php

namespace Helldar\CashierDriver\Tinkoff\QrCode;

use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\CashierDriver\Tinkoff\Auth\Support\Auth;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Exception;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Statuses;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\Cancel;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\GetQR;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\GetState;
use Helldar\CashierDriver\Tinkoff\QrCode\Requests\Init;
use Helldar\CashierDriver\Tinkoff\QrCode\Responses\Check;
use Helldar\CashierDriver\Tinkoff\QrCode\Responses\Create;
use Helldar\CashierDriver\Tinkoff\QrCode\Responses\Refund;
use Helldar\Contracts\Cashier\Http\Responses\Response;

class Driver extends BaseDriver
{
    protected $exceptions = Exception::class;

    protected $statuses = Statuses::class;

    public function start(): Response
    {
        $this->init();

        $request = GetQR::make($this->model, Auth::class);

        return $this->request($request, Create::class);
    }

    public function check(): Response
    {
        $request = GetState::make($this->model, Auth::class);

        return $this->request($request, Check::class);
    }

    public function refund(): Response
    {
        $request = Cancel::make($this->model, Auth::class);

        return $this->request($request, Refund::class);
    }

    protected function init(): Response
    {
        $request = Init::make($this->model, Auth::class, false);

        return $this->request($request, Responses\Init::class);
    }
}
