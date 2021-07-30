<?php

namespace Tests\Helpers;

use Helldar\Cashier\Exceptions\Http\BadRequestClientException;
use Helldar\Cashier\Exceptions\Http\BaseException;
use Helldar\Cashier\Exceptions\Http\BuyerNotFoundClientException;
use Helldar\Cashier\Exceptions\Http\ContactTheSellerClientException;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Exception;
use Helldar\Support\Facades\Http\Builder;
use Psr\Http\Message\UriInterface;
use Tests\TestCase;

class ExceptionTest extends TestCase
{
    public function test7()
    {
        $this->expectException(BuyerNotFoundClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Buyer Not Found');
        $this->expectExceptionCode(404);

        Exception::make()->throw(7, $this->uri());
    }

    public function test7String()
    {
        $this->expectException(BuyerNotFoundClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Buyer Not Found');
        $this->expectExceptionCode(404);

        Exception::make()->throw('7', $this->uri());
    }

    public function test53()
    {
        $this->expectException(ContactTheSellerClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Contact The Seller');
        $this->expectExceptionCode(409);

        Exception::make()->throw(53, $this->uri());
    }

    public function test53String()
    {
        $this->expectException(ContactTheSellerClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Contact The Seller');
        $this->expectExceptionCode(409);

        Exception::make()->throw('53', $this->uri());
    }

    public function testDefault()
    {
        $this->expectException(BadRequestClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Bad Request');
        $this->expectExceptionCode(400);

        Exception::make()->throw(10000, $this->uri());
    }

    public function testDefaultString()
    {
        $this->expectException(BadRequestClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Bad Request');
        $this->expectExceptionCode(400);

        Exception::make()->throw('10000', $this->uri());
    }

    protected function uri(): UriInterface
    {
        return Builder::parse('https://example.com/foo');
    }
}
