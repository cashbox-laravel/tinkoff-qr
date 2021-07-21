<?php

namespace Helldar\CashierDriver\Tinkoff\QrCode;

use Helldar\Cashier\DTO\Request;
use Helldar\Cashier\Resources\Response;
use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\CashierDriver\Sber\QrCode\Helpers\Statuses;
use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Helldar\CashierDriver\Tinkoff\Auth\Facades\Auth;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Exception;
use Psr\Http\Message\UriInterface;

class Driver extends BaseDriver
{
    protected $statuses = Statuses::class;

    protected $response = Resources\Response::class;

    protected $exception = Exception::class;

    protected $production_host = 'https://securepay.tinkoff.ru';

    protected $dev_host = 'https://rest-api-test.tinkoff.ru';

    protected $uri_create = '/v2/Init';

    protected $uri_get_qr = '/v2/GetQr';

    protected $uri_status = '/v2/GetState';

    protected $uri_revocation = '/v2/Cancel';

    public function start(): Response
    {
        $init = $this->init();

        $request = $this->requestDto(
            $this->url($this->uri_get_qr),
            $this->body([
                'PaymentId' => $init->paymentId(),
            ]),
            $this->headers()
        );

        return $this->request($request)->put('Status', $init->getStatus());
    }

    public function check(): Response
    {
        $request = $this->requestDto(
            $this->url($this->uri_status),
            $this->body([
                'PaymentId' => $this->model->cashier->payment_id,
            ]),
            $this->headers()
        );

        return $this->request($request, false);
    }

    public function refund(): Response
    {
        $request = $this->requestDto(
            $this->url($this->uri_revocation),
            $this->body([
                'PaymentId' => $this->model->cashier->payment_id,

                'Amount' => $this->resource->getSum(),

                'Currency' => $this->resource->getCurrency(),
            ]),
            $this->headers()
        );

        return $this->request($request);
    }

    protected function init(): Response
    {
        $request = $this->requestDto(
            $this->url($this->uri_create),
            $this->body($this->resource->toArray(), false),
            $this->headers()
        );

        return $this->request($request);
    }

    protected function headers(bool $hash = true): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    protected function authorization(array $data, bool $hash = true): array
    {
        $auth = $this->authDto($data, $hash);

        return Auth::accessToken($auth);
    }

    protected function authDto(array $data, bool $hash): Client
    {
        return Client::make()
            ->hash($hash)
            ->data($data)
            ->clientId($this->auth->getClientId())
            ->clientSecret($this->auth->getClientSecret());
    }

    protected function requestDto(UriInterface $url, array $data, array $headers): Request
    {
        return Request::make()
            ->setUrl($url)
            ->setData($data)
            ->setHeaders($headers);
    }

    protected function body(array $data, bool $hash = true): array
    {
        $auth = $this->authorization($data, $hash);

        return array_merge($data, $auth);
    }
}
