<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'category_id'=> ['required'],
        'sku' => ['required'],
        'product_name'=> ['required'],
        'description'=> ['required'],
        'model_no'=> ['required'],
        'grade'=> ['required'],
        'percentage'=> ['required'],
        'specification'=> ['required'],
        'base_price'=> ['required'],
        'expected_value'=> ['required'],
        ];
    }
}
