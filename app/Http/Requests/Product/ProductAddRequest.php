<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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


            /*   PRICE   */
            'price' => 'nullable|regex:/^\d{1,14}([\.\,]\d{1,6})?$/',

            /*   SPECIAL PRICE   */
            'special_price' => 'nullable|regex:/^\d{1,14}([\.\,]\d{1,6})?$/',

            /*   LENGTH   */
            'length' => 'nullable|regex:/^\d{1,14}([\.\,]\d{1,6})?$/',

            /*   WIDTH   */
            'width' => 'nullable|regex:/^\d{1,14}([\.\,]\d{1,6})?$/',

            /*   HEIGHT   */
            'height' => 'nullable|regex:/^\d{1,14}([\.\,]\d{1,6})?$/',

            /*   OPTION ID  */
            'option_list.option_id.*' => 'exists:options,id',

            /*   OPTION TYPE  */
            'option_list.option_type.*' => 'exists:options,type',

            /*   OPTION VALUE ID (TYPE 1-e gore)   */
            'option_list.option_value_id.image_and_text.*.*' => 'exists:options_values,id',

            /*   OPTION VALUE ID (TYPE 2-ye gore)   */
            'option_list.option_value_id.text.*.*' => 'exists:options_values,id',



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

            /*   PRICE   */
            'price.regex' => 'Səhv qiymət formatı',

            /*   SPECIAL PRICE   */
            'special_price.regex' => 'Səhv endirimli qiymət formatı',

            /*   LENGTH   */
            'length.regex' => 'Səhv uzunluq formatı',

            /*   WIDTH   */
            'width.regex' => 'Səhv en formatı',

            /*   HEIGHT   */
            'height.regex' => 'Səhv hündürlük formatı',

            /*   OPTION ID   */
            'option_list.option_id.*.exists' => 'Bele bir seçim mövcud deyil ',

            /*   OPTION TYPE   */
            'option_list.option_type.*.exists' => 'Bele bir seçim tipi mövcud deyil ',

            /*   OPTION VALUE ID (TYPE 1-e gore)   */
            'option_list.option_value_id.image_and_text.*.*.exists' => 'Bele bir seçim mətini mövcud deyil ',

            /*   OPTION VALUE ID (TYPE 2-ye gore)   */
            'option_list.option_value_id.text.*.*.exists' => 'Bele bir seçim mətini mövcud deyil ',

            /*   IMAGE   */
//            'image.required' => 'Foto boş buraxıla bilməz',
        ];
    }




}
