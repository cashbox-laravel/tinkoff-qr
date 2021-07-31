<?php

declare(strict_types=1);

namespace Tests\Fixtures\Models;

use Helldar\Cashier\Concerns\Casheable;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @property \Illuminate\Support\Carbon $created_at
 * @property float $sum
 * @property int $currency
 * @property int $status_id
 * @property int $type_id
 * @property string $client_id
 * @property string $client_secret
 * @property string $external_id
 * @property string $id;
 */
class Payment extends BaseModel
{
    use Casheable;

    protected function getIdAttribute(): string
    {
        return TestCase::PAYMENT_ID;
    }

    protected function getClientIdAttribute(): string
    {
        return TestCase::TERMINAL_KEY;
    }

    protected function getClientSecretAttribute(): string
    {
        return TestCase::TERMINAL_SECRET;
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

    protected function getExternalIdAttribute(): string
    {
        return TestCase::PAYMENT_EXTERNAL_ID;
    }

    protected function getTypeIdAttribute(): int
    {
        return TestCase::MODEL_TYPE_ID;
    }

    protected function getStatusIdAttribute(): int
    {
        return TestCase::MODEL_STATUS_ID;
    }
}
