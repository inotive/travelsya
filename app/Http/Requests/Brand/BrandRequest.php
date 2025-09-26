<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $brandId = $this->route('brand') ? $this->route('brand')->id : null;

        $nameRule = 'required|string|max:255|unique:brands,name';
        if ($brandId) {
            $nameRule = 'required|string|max:255|unique:brands,name,' . $brandId;
        }

        return [
            'name' => $nameRule,
            'image' => $this->isMethod('post')
                ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                : 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
