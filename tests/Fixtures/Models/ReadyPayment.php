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

declare(strict_types=1);

namespace Tests\Fixtures\Models;

use Helldar\Cashier\Concerns\Casheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @property \Illuminate\Support\Carbon $created_at
 * @property float $sum
 * @property int $currency
 * @property int $status_id
 * @property int $type_id
 * @property string $id;
 */
class ReadyPayment extends Model
{
    use Casheable;

    protected $fillable = ['id', 'type_id', 'status_id', 'sum', 'currency', 'created_at'];

    protected $casts = [
        'id' => 'integer',

        'type_id'   => 'integer',
        'status_id' => 'integer',

        'sum'      => 'float',
        'currency' => 'integer',
    ];

    protected function getIdAttribute(): string
    {
        return TestCase::PAYMENT_ID;
    }

    protected function getTypeIdAttribute(): int
    {
        return TestCase::MODEL_TYPE_ID;
    }

    protected function getStatusIdAttribute(): int
    {
        return TestCase::MODEL_STATUS_ID;
    }

    protected function getSumAttribute(): float
    {
        return TestCase::PAYMENT_SUM;
    }

    protected function getCurrencyAttribute(): int
    {
        return TestCase::CURRENCY;
    }

    protected function getCreatedAtAttribute(): Carbon
    {
        return Carbon::parse(TestCase::PAYMENT_DATE);
    }
}
