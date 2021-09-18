<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id'    => ['required'],
            'sku'            => ['required','unique:products,sku',],
            'product_name'   => ['required'],
            'description'    => ['required'],
            'model_no'       => ['required'],
            'grade'          => ['required'],
            'percentage'     => ['required'],
            'specification'  => ['required'],
            'base_price'     => ['required'],
            'expected_value' => ['required'],
            'front_image'    => ['required'],
            'back_image'     => ['required'],
            'left_image'     => ['required'],
            'right_image'    => ['required'],
        ];
    }
}
