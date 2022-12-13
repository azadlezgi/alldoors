<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class GalleryEditRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            /*   NAME   */
            'name.*' => 'required|max:255',

            /*   Categories   */
            'categories' => 'required',

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


            /*   Categories   */
            'categories.required' => 'Kateqoriya boş buraxıla bilməz',

            /*   IMAGE   */
//            'image.required' => 'Foto boş buraxıla bilməz',
        ];
    }




}
