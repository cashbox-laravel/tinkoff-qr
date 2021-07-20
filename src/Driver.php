<?php

namespace Helldar\CashierDriver\Tinkoff\QrCode;

use Helldar\Cashier\DTO\Request;
use Helldar\Cashier\Resources\Response;
use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\CashierDriver\Sber\QrCode\Helpers\Statuses;
use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Helldar\CashierDriver\Tinkoff\Auth\Facades\Auth;
use Psr\Http\Message\UriInterface;

class Driver extends BaseDriver
{
    protected $statuses = Statuses::class;

    protected $response = Resources\Response::class;

    protected $production_host = 'https://securepay.tinkoff.ru';

    protected $dev_host = 'https://rest-api-test.tinkoff.ru';

    protected $uri_create = 'Init';

    protected $uri_get_qr = 'GetQr';

    protected $uri_status = 'GetState';

    protected $uri_revocation = 'Cancel';

    public function start(): Response
    {
        $request = $this->requestDto(
            $this->url($this->uri_create),
            $this->resource->toArray(),
            $this->headers(false)
        );

        return $this->request($request);
    }

    public function check(): Response
    {
        $request = $this->requestDto(
            $this->url($this->uri_status),
            [
                'PaymentId' => $this->model->cashier->payment_id,
            ],
            $this->headers()
        );

        return $this->request($request, false);
    }

    public function refund(): Response
    {
        $request = $this->requestDto(
            $this->url($this->uri_revocation),
            [
                'PaymentId' => $this->model->cashier->payment_id,
            ],
            $this->headers()
        );

        return $this->request($request);
    }

    protected function headers(bool $hash = true): array
    {
        $headers = [];

        $auth = $this->authorization($hash);

        return array_merge($headers, $auth);
    }

    protected function authorization(bool $hash = true): array
    {
        $auth = $this->authDto($hash);

        return Auth::accessToken($auth);
    }

    protected function authDto(bool $hash): Client
    {
        return Client::make()
            ->hash($hash)
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
}
