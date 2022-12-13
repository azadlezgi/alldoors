<?php

namespace App\Http\Requests\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class AttributeEditRequest extends FormRequest
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
            'attribute_group_id' => 'required|exists:attributes_groups,id',


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
            'attribute_group_id.required' => 'Atribut qrup boş buraxıla bilməz',
            'attribute_group_id.exists' => 'Sistemdə bele bir atribut qrup ID yoxdur',


            /*   IMAGE   */
//            'image.required' => 'Foto boş buraxıla bilməz',
        ];
    }




}
