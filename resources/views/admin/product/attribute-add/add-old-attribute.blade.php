<?php
/*   PRODUCT ATTRIBUTE START   */
$html = '';
$languageID = '';

?>
@foreach(cache('key-all-languages') as $key => $language)
    @if($loop->last)
        <?php $languageID = $language->id ?>
    @endif

@endforeach
<?php

foreach ($oldData as $item):

    foreach ($item as $attribute):



        if (!is_array($attribute)) {

            $html .= ' <tr class="attributeTr">
                    <td data-label="Atribut" tabindex="1">
                        <div class="attribute-box-container">
                            <input type="text" placeholder="Atribut"
                            value="' . \App\Services\AttributeService::getAttributeName($attribute) . '"
                                   class="form-control attributeSearch">
                            <input type="hidden" form="submit-form"
                                   class="attributeInput"
                                   name="attribute_list[][attribute_id]"
                                   value="' . $attribute . '">
                            <div tabindex="1" class="attribute-box-item">
                                <!--  CODE  -->
                            </div>
                        </div>
                    </td>
                    <td data-label="Text">

                        <div class="row">
                            <div class="col-md-11">';


        } else {


            foreach ($attribute as $key => $item):



                $html .= '
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                              <img width="24" src="'.countryFlag(\App\Services\LanguageData::getLanguageCode($key)).'"/>
                                    </span>
                                    </div>
                                    <textarea class="form-control"
                                              form="submit-form"
                                              name="attribute_list[][language][' . $key . '][text]"
                                              placeholder="Text"
                                    >' . $item['text'] . '</textarea>
                                </div>';


                if ($key == $languageID) {
                    $html .= '</div>
                     <div class="col-md-1 removeButtonAttribute">
                                <div class="attribute-box-delete-container">
                                    <div class="attribute-box-delete">
                                        <i class="fa fa-minus-circle"></i>
                                    </div>
                                </div>
                            </div>
                       </div>


                    </td>

                </tr>';
                }


            endforeach;


        }


    endforeach;

endforeach;
/*   PRODUCT ATTRIBUTE END   */


echo $html;


?>
