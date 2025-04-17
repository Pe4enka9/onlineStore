<?php

namespace App\Http\Requests\Api;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Validation\Rule;

class WebhookRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', 'integer', Rule::exists(Status::class, 'id')],
            'payment_id' => ['required', 'string', Rule::exists(Order::class, 'payment_id')],
        ];
    }
}
