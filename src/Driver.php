<?php

namespace Helldar\CashierDriver\Tinkoff\QrCode;

use Helldar\Cashier\DTO\Request;
use Helldar\Cashier\Resources\Response;
use Helldar\Cashier\Services\Driver as BaseDriver;
use Helldar\CashierDriver\Tinkoff\Auth\Concerns\Authorize;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Exception;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Statuses;
use Psr\Http\Message\UriInterface;

class Driver extends BaseDriver
{
    use Authorize;

    protected $statuses = Statuses::class;

    protected $response = Resources\Response::class;

    protected $exception = Exception::class;

    protected $production_host = 'https://securepay.tinkoff.ru';

    /**
     * According to information from technical support,
     * the test domain behaves incorrectly and often returns errors.
     * Therefore, Tinkoff Bank technical support recommends using
     * the production version of the API for both testing and basic requests.
     *
     * @var string
     */
    protected $dev_host = 'https://securepay.tinkoff.ru';

    protected $uri_create = '/v2/Init';

    protected $uri_get_qr = '/v2/GetQr';

    protected $uri_status = '/v2/GetState';

    protected $uri_revocation = '/v2/Cancel';

    public function start(): Response
    {
        $init = $this->init();

        $request = $this->requestDto(
            $this->url($this->uri_get_qr),
            $this->content([
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
            $this->content([
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
            $this->content([
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
            $this->content($this->resource->toArray(), false),
            $this->headers()
        );

        return $this->request($request);
    }

    protected function headers(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    protected function requestDto(UriInterface $url, array $data, array $headers): Request
    {
        return Request::make()
            ->setUrl($url)
            ->setData($data)
            ->setHeaders($headers);
    }
}
