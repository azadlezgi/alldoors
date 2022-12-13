<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCategoryEditRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            /*   NAME   */
            'name.*' => 'required|max:255|unique:services_categories_translations,name,'.$this->id.',category_id'

            /*   IMAGE   */
//            'image' => 'required',
        ];
    }


    public function messages()
    {
        return [

            /*   NAME   */
            'name.*.required' => 'Ad <span>[[@:attribute@]]</span> boş buraxıla bilməz',
            'name.*.unique' => 'Ad <span>[[@:attribute@]]</span> xanasındakı söz bazada mövcuddur.Zəhmət olmasa başqa bir ad seçin',
            'name.*.max' => 'Ad <span>[[@:attribute@]]</span> maximum 255 simvol olmalıdır',


            /*   IMAGE   */
//            'image.required' => 'Foto boş buraxıla bilməz',
        ];
    }




}
