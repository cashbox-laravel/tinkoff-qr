# Tinkoff QR Cashier Driver

Cashier provides an expressive, fluent interface to manage billing services.

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Installation

To get the latest version of `Tinkoff QR Cashier Driver`, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require andrey-helldar/cashier-tinkoff-qr
```

Or manually update `require` block of `composer.json` and run `composer update`.

```json
{
    "require": {
        "andrey-helldar/cashier-tinkoff-qr": "^1.0"
    }
}
```

## Using

> See [parent](https://github.com/andrey-helldar/cashier#readme) project.

Create resource file:

```php
namespace App\Payments;

use Helldar\Cashier\Resources\Model;

class Tinkoff extends Model
{
    protected function paymentId(): string
    {
        return (string) $this->model->id;
    }

    protected function sum(): float
    {
        return (float) $this->model->sum;
    }

    protected function currency(): int
    {
        return $this->model->currency;
    }

    protected function createdAt(): Carbon
    {
        return $this->model->created_at;
    }
}
```

Edit the `config/cashier.php` file:

```php
use App\Models\Payment;
use App\Payments\Tinkoff as TinkoffDetails;
use Helldar\Cashier\Constants\Driver;
use Helldar\CashierDriver\Tinkoff\QrCode\Driver as TinkoffQrDriver;

return [
    //

    'payment' => [
        'map' => [
            Payment::TYPE_TINKOFF => 'tinkoff_qr'
        ]
    ],

    'drivers' => [
        'tinkoff_qr' => [
            Driver::DRIVER => TinkoffQrDriver::class,

            Driver::DETAILS => TinkoffDetails::class,

            Driver::CLIENT_ID       => env('CASHIER_TINKOFF_CLIENT_ID'),
            Driver::CLIENT_SECRET   => env('CASHIER_TINKOFF_CLIENT_SECRET'),
        ]
    ]
];
```

## For Enterprise

Available as part of the Tidelift Subscription.

The maintainers of `andrey-helldar/cashier-tinkoff-qr` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source
packages you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact packages you
use. [Learn more](https://tidelift.com/subscription/pkg/packagist-andrey-helldar-cashier-tinkoff-qr?utm_source=packagist-andrey-helldar-cashier-tinkoff&utm_medium=referral&utm_campaign=enterprise&utm_term=repo)
.

[badge_downloads]:      https://img.shields.io/packagist/dt/andrey-helldar/cashier-tinkoff-qr.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/andrey-helldar/cashier-tinkoff-qr.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/andrey-helldar/cashier-tinkoff-qr?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/andrey-helldar/cashier-tinkoff-qr
