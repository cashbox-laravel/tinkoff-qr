<?php

namespace Tests\Fixtures\Models;

use Helldar\Cashier\Concerns\Casheable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Support\Carbon $created_at
 * @property float $sum
 * @property int $currency
 * @property int $status_id
 * @property int $type_id
 * @property string $id;
 */
class RequestPayment extends Model
{
    use Casheable;

    protected $table = 'payments';

    protected $fillable = ['id', 'type_id', 'status_id', 'sum', 'currency', 'created_at'];

    protected $casts = [
        'id' => 'integer',

        'type_id'   => 'integer',
        'status_id' => 'integer',

        'sum'      => 'float',
        'currency' => 'integer',
    ];
}
