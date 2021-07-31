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

namespace Tests\Helpers;

use Helldar\Cashier\Exceptions\Http\BadRequestClientException;
use Helldar\Cashier\Exceptions\Http\BaseException;
use Helldar\Cashier\Exceptions\Http\BuyerNotFoundClientException;
use Helldar\Cashier\Exceptions\Http\ContactTheSellerClientException;
use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Exception;
use Helldar\Contracts\Http\Builder as HttpBuilder;
use Helldar\Support\Facades\Http\Builder;
use Tests\TestCase;
use Throwable;

class ExceptionTest extends TestCase
{
    public function test7()
    {
        $this->expectException(BuyerNotFoundClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Buyer Not Found');
        $this->expectExceptionCode(404);

        $e = $this->exception(7);

        Exception::throw($e, $this->uri());
    }

    public function test7String()
    {
        $this->expectException(BuyerNotFoundClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Buyer Not Found');
        $this->expectExceptionCode(404);

        $e = $this->exception('7');

        Exception::throw($e, $this->uri());
    }

    public function test53()
    {
        $this->expectException(ContactTheSellerClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Contact The Seller');
        $this->expectExceptionCode(409);

        $e = $this->exception(53);

        Exception::throw($e, $this->uri());
    }

    public function test53String()
    {
        $this->expectException(ContactTheSellerClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Contact The Seller');
        $this->expectExceptionCode(409);

        $e = $this->exception('53');

        Exception::throw($e, $this->uri());
    }

    public function testDefault()
    {
        $this->expectException(BadRequestClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Bad Request');
        $this->expectExceptionCode(400);

        $e = $this->exception(10000);

        Exception::throw($e, $this->uri());
    }

    public function testDefaultString()
    {
        $this->expectException(BadRequestClientException::class);
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('https://example.com/foo: Bad Request');
        $this->expectExceptionCode(400);

        $e = $this->exception('10000');

        Exception::throw($e, $this->uri());
    }

    protected function exception($code): Throwable
    {
        return new \Exception('Foo', $code);
    }

    protected function uri(): HttpBuilder
    {
        return Builder::parse('https://example.com/foo');
    }
}
