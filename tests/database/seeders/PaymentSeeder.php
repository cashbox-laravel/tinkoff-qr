<?php

namespace Tests\database\seeders;

use Illuminate\Database\Seeder;
use Tests\Fixtures\Models\RequestPayment;
use Tests\TestCase;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        RequestPayment::create([
            'id'         => TestCase::PAYMENT_ID,
            'type_id'    => TestCase::MODEL_TYPE_ID,
            'status_id'  => TestCase::MODEL_STATUS_ID,
            'sum'        => TestCase::PAYMENT_SUM,
            'currency'   => TestCase::CURRENCY,
            'created_at' => TestCase::PAYMENT_DATE,
        ]);
    }
}
