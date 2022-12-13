<!--  TR START  -->
<tr class="attributeTr">
    <td data-label="Atribut" tabindex="1">
        <div class="attribute-box-container">
            <input type="text" placeholder="Atribut"
                   class="form-control attributeSearch">
            <input type="hidden" form="submit-form"
                   class="attributeInput"
                   name="attribute_list[][attribute_id]"
                   value="">
            <div tabindex="1" class="attribute-box-item">
                <!--  CODE  -->
            </div>
        </div>
    </td>
    <td data-label="Text">

        <div class="row">
            <div class="col-md-11">
            @foreach(cache('key-all-languages') as $key => $language)


                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                              <img width="24" src="{{ countryFlag($language->code) }}"/>
                                    </span>
                        </div>
                        <textarea class="form-control" form="submit-form"
                                  name="attribute_list[][language][{{ $language->id }}][text]"
                                  placeholder="Text"
                        ></textarea>
                    </div>
            @endforeach


            </div>
            <div class="col-md-1 removeButtonAttribute">
                <div class="attribute-box-delete-container">
                    <div class="attribute-box-delete">
                        <i class="fa fa-minus-circle"></i>
                    </div>
                </div>
            </div>
        </div>


    </td>

</tr>
<!--  TR END  -->
