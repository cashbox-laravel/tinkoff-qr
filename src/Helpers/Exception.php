<?php

namespace Helldar\CashierDriver\Tinkoff\QrCode\Helpers;

use Helldar\Cashier\Exceptions\Client\BankInternalErrorException;
use Helldar\Cashier\Exceptions\Client\BuyerNotFoundClientException;
use Helldar\Cashier\Exceptions\Client\ContactTheSellerClientException;
use Helldar\Cashier\Exceptions\Client\TryAgainLaterClientException;
use Helldar\Cashier\Helpers\Exception as BaseException;

class Exception extends BaseException
{
    protected $codes = [
        7 => BuyerNotFoundClientException::class,

        53 => ContactTheSellerClientException::class,

        99  => TryAgainLaterClientException::class,
        100 => TryAgainLaterClientException::class,

        102 => ContactTheSellerClientException::class,

        103  => TryAgainLaterClientException::class,
        1012 => TryAgainLaterClientException::class,
        1013 => TryAgainLaterClientException::class,
        1030 => TryAgainLaterClientException::class,
        1034 => TryAgainLaterClientException::class,
        1041 => TryAgainLaterClientException::class,
        1043 => TryAgainLaterClientException::class,
        1057 => TryAgainLaterClientException::class,
        1065 => TryAgainLaterClientException::class,
        1089 => TryAgainLaterClientException::class,
        1091 => TryAgainLaterClientException::class,
        1096 => TryAgainLaterClientException::class,

        9999 => BankInternalErrorException::class,
    ];
}
