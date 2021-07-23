<?php

namespace Tests\Fixtures\Models;

use Helldar\CashierDriver\Tinkoff\QrCode\Resources\Response;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

/**
 * @property string $payment_id
 * @property Response $details
 */
class CashierDetail extends Model
{
    protected function getPaymentIdAttribute(): string
    {
        return TestCase::PAYMENT_ID;
    }

    protected function getDetailsAttribute(): Response
    {
        return Response::make([
            Response::KEY_PAYMENT_ID => TestCase::PAYMENT_ID,
            Response::KEY_STATUS     => TestCase::STATUS,
        ], false);
    }
}
