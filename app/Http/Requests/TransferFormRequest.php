<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class TransferFormRequest extends FormRequestAbstract
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->route()?->getActionMethod();

        return [
            'transfer' => self::transfer(),
        ][$method] ?? [];
    }

    /**
     * Get transfer rules.
     *
     * @return string[]
     */
    private static function transfer(): array
    {
        return [
            'value' => 'required|numeric|min:0',
            'payer' => 'required|integer|exists:users,id',
            'payee' => 'required|integer|exists:users,id',
        ];
    }
}
