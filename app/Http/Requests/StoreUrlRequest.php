<?php

namespace App\Http\Requests;

use App\Data\StoreUrlData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class StoreUrlRequest extends FormRequest
{
    /**
     * @use WithData<StoreUrlData>
     */
    use WithData;

    protected string $dataClass = StoreUrlData::class;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->dataClass::getValidationRules($this->all());
    }
}
