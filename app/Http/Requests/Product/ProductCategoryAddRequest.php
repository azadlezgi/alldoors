<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryAddRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            /*   NAME   */
            'name.*' => 'required|max:255'


            /*   IMAGE   */
//            'image' => 'required',
        ];
    }


    public function messages()
    {
        return [

            /*   NAME   */
            'name.*.required' => 'Ad <span>[[@:attribute@]]</span> boş buraxıla bilməz',
            'name.*.max' => 'Ad <span>[[@:attribute@]]</span> maximum 255 simvol olmalıdır',


            /*   IMAGE   */
//            'image.required' => 'Foto boş buraxıla bilməz',
        ];
    }




}
