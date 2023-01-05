<?php $imgClassname =  generateRandomString(20);  ?>
<!--  TR START  -->
<tr class="optionTr">
    <td data-label="Text">

        <div class="row">
            <div class="col-md-12">
                @foreach(cache('key-all-languages') as $key => $language)


                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                              <img width="24" src="{{ countryFlag($language->code) }}"/>
                                    </span>
                        </div>
                        <textarea class="form-control" form="submit-form"
                                  name="option_list[language][{{$imgClassname}}][{{ $language->id }}]"
                                  placeholder="Text"
                        ></textarea>
                        <input type="hidden" name="option_list[language_id][{{$imgClassname}}][]" value="{{ $language->id }}">
                    </div>
                @endforeach


            </div>

        </div>


    </td>
    <td data-label="Foto" class="option-image-colum">
        <div class="option-box-container">

            <!--  IMAGES CONTAINER START  -->
            <div class="row">
                <div class="col-md-12 ">

{{--                    <div class="custom-preloader-container">--}}
{{--                        <div class="custom-preloader-loader"></div>--}}
{{--                    </div>--}}

                    <!--  IMAGES START  -->
{{--                    <div class="images-post-container" style="display: none">--}}

                    <div class="images-post-container" data-class-name="{{$imgClassname}}">
                        <div class="images-post-item" style="width: 130px; height: 130px">

                            <div
                                style="display: {{ old('image') == null? 'none':'flex' }}"
                                tooltip="Sil"
                                class="notPhotoPost notPhotoPostAloneOption notPhotoOption-{{$imgClassname}}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </div>
                            <figure
                                class="activeButtonAloneOption"
                            >

                                <img
                                    style="width: 130px; height: 130px"
                                    src="{{old('image') == null ? asset('storage/no-image.png'): old('image') }}"
                                    class="imgClassName-{{ $imgClassname }}"
                                >

                            </figure>
                        </div>
                    </div>

                    <!--  IMAGE INPUT  -->
                    <div class="image-post-input">
                        <input type="text"
                               id="image_label-{{ $imgClassname }}"
                               name="option_list[image][{{$imgClassname}}]"
                               form="submit-form"
                        >

                    </div>


                    <!--  IMAGES END  -->

                </div>

            </div>
            <!--  IMAGES CONTAINER END  -->
        </div>
    </td>
    <td data-label="Sıra" class="colum-sort-box">
        <div class="colum-sort">
            <input type="number" min="0" class="form-control" name="option_list[sort][{{$imgClassname}}]" placeholder="Sıra">
            <div class="removeButtonOption">
                <div class="option-box-delete-container">
                    <div class="option-box-delete">
                        <i class="fa fa-minus-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </td>
</tr>
<!--  TR END  -->
