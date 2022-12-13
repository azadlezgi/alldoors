<?php

namespace App\Http\Requests\Slide;

use Illuminate\Foundation\Http\FormRequest;

class SlideEditRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            /*   TITLE   */
            'title.*' => 'max:255',

            /*  SUB TITLE   */
            'sub_title.*' => 'max:255',

            /*   IMAGE   */
            'image.*' => 'required',
        ];
    }


    public function messages()
    {
        return [

            /*   TITLE   */
            'title.*.max' => 'Title <span>[[@:attribute@]]</span> maximum 255 simvol olmalıdır',

            /*  SUB TITLE   */
            'sub_title.*.max' => 'Sub Title <span>[[@:attribute@]]</span> maximum 255 simvol olmalıdır',

            /*   IMAGE   */
            'image.*.required' => 'Foto <span>[[@:attribute@]]</span> boş buraxıla bilməz',
        ];
    }




}
