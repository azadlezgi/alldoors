<?php

namespace App\Http\Requests\Option;

use Illuminate\Foundation\Http\FormRequest;

class OptionEditRequest extends FormRequest
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

            /*   ATTRIBUTE GROUP   */
            'option_group_id' => 'required|exists:options_groups,id',


            /*   SORT   */
            'sort' => 'integer',

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


            /*   SORT   */
            'sort.integer' => 'Sıra yalnız rəqəmlərdən olmalıdır',


            /*   ATTRIBUTE GROUP   */
            'option_group_id.required' => 'Seçim qrup boş buraxıla bilməz',
            'option_group_id.exists' => 'Sistemdə bele bir atribut qrup ID yoxdur',


            /*   IMAGE   */
//            'image.required' => 'Foto boş buraxıla bilməz',
        ];
    }




}
