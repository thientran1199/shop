<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return[
            'p_name'=>'required|min:5',
            'p_code'=>'required',
            'p_color'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'image'=>'required|image|mimes:png,jpg,jpeg|max:1000',
            'category_id'=>'required',
        ];
    }
    public function messages(){
        return [
            'p_name.required' => trans('Tên sản phẩm không được để trống'),
            'p_name.unique' => trans('Tên sản phẩm đã tồn tại'),
            'p_code.required' => trans('Mã sản phẩm không được để trống'),
            'p_code.unique' => trans('Mã sản phẩm đã tồn tại'),
            'category_id.required' => trans('Phải chọn danh mục'),
            'price.min' => trans('Giá phải > 0'),
            'price.not_in' => trans('Giá phải > 0')
        ];

    }
}
