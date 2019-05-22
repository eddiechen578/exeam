<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Entities\ProductSkus;
class AddCartRequest extends FormRequest
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
            'sku_id' => [
                'required',
                function ($attribute, $value, $fail){
                    if(!$sku = ProductSkus::find($value)){
                        return $fail('該商品不存在.');
                    }
                    if(!$sku->product->on_sale){
                        return $fail('該商品未上架.');
                    }
                    if($sku->stock === 0){
                        return $fail('該商品已售完.');
                    }
                    if($this->input('amount') > 0 && $this->input('amount') > $sku->stock){
                        return $fail('該商品庫存不足.');
                    }
                }
            ],
            'amount' => 'required|integer|min:1',
        ];
    }

    public function attributes(){
        return [
            'amount' => '商品數量'
        ];
    }

    public function messages(){
        return [
          'sku_id.required' => '請選擇商品.'
        ];
    }
}
