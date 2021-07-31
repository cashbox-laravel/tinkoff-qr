<?php

namespace Tests\Fixtures\Resources;

use Helldar\Cashier\Resources\Model as BaseModel;
use Illuminate\Support\Carbon;

/** @property \Tests\Fixtures\Models\Payment $model */
class Model extends BaseModel
{
    public function getExternalId(): ?string
    {
        return $this->model->external_id;
    }

    protected function clientId(): string
    {
        return $this->model->client_id;
    }

    protected function clientSecret(): string
    {
        return $this->model->client_secret;
    }

    protected function paymentId(): string
    {
        return $this->model->id;
    }

    protected function sum(): float
    {
        return $this->model->sum;
    }

    protected function currency(): string
    {
        return (string) $this->model->currency;
    }

    protected function createdAt(): Carbon
    {
        return $this->model->created_at;
    }
}
