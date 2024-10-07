<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:100|unique:products,name',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:1',
            'sale_price' => 'min:0',
            'image' => 'nullable',
            'description' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'name.string' => 'Tên sản phẩm phải là một chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 100 ký tự.',
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            
         
            'price.min' => 'Giá sản phẩm phải là số không âm.',

            'discount.required' => 'số lượng sản phẩm là bắt buộc.',
            'discount.numeric' => 'số lượng sản phẩm phải là một số.',
            'discount.min' => 'số lượngs sản phẩm nhiều hơn 0.',

            'sale_price.numeric' => 'Giá khuyến mãi phải là một số.',
            'sale_price.min' => 'Giá khuyến mãi phải là số không âm.',

        ];
    }
}
