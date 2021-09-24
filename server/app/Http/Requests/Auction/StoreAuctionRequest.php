<?php

namespace App\Http\Requests\Auction;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuctionRequest extends FormRequest
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
            'start_time'    => ['required'],
            'close_time'    => ['required'],
            'result_time'   => ['required'],
            'paying_time'   => ['required'],
            'product_id'     =>['required', 'unique:auctions,product_id'],
            'category_id'     =>['required']
        ];
    }

    public function messages()
    {
        return [
            'product_id.unique' => 'The product has already been taken',
        ];
    }
}
