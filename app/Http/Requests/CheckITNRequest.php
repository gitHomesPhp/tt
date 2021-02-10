<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\ITNValidator;
use Illuminate\Foundation\Http\FormRequest;

class CheckITNRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'itn' => [
                'required',
                'string',
                new ITNValidator,
            ],
        ];
    }
}
