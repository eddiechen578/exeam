<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Entities\ProductSkus;
use Illuminate\Validation\Rule;
class OrderRequest extends FormRequest
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
           'address_id' => ['required', Rule::exists('user_addresses', 'id')->where('user_id', $this->user()->id)],
            'items'     => 'required|array',
            'items.*.sku_id' => [
                'required',
                function($attribute, $value, $fail){
                    if(!$sku = ProductSkus::find($value)){
                        $fail('該商品不存在.');
                        return;
                    }
                    if(!$sku->product->on_sale){
                        $fail('該商品未上架');
                        return;
                    }
                    if($sku->stock === 0){
                        $fail('該商品已售完.');
                        return;
                    }
                    preg_match('/items\.(\d+)\.sku_id/', $attribute, $m);
                    $index  = $m[1];

                    $amount = $this->input('items')[$index]['amount'];
                    if($amount > 0 && $amount > $sku->stock){
                        return $fail('該商品庫存不足.');
                    }
                },
            ],
            'items.*.amount' => 'required|integer|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'items' => '商品',
            'items.*.sku_id' => '商品',
            'items.*.amount' => '商品數量',
        ];
    }
}
