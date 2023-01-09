<?php $imgClassname = generateRandomString(20); ?>


@foreach ($oldData['sort'] as $keySort => $sortValue)
    <tr class="optionTr">
        <td data-label="Text">

            <div class="row">
                <div class="col-md-12">

                    @foreach($oldData['language_id'][$keySort] as $key => $language)

                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                              <img width="24"
                                   src="{{ countryFlag(\App\Services\LanguageData::getLanguageCode($language)) }}"/>
                                    </span>
                            </div>
                            <textarea class="form-control" form="submit-form"
                                      name="option_list[language][{{$keySort}}][{{ $language }}]"
                                      placeholder="Text"
                            >{{ $oldData['language'][$keySort][$language] }}</textarea>
                            <input type="hidden" name="option_list[language_id][{{$keySort}}][]"
                                   value="{{ $language }}">
                        </div>

                    @endforeach


                </div>

            </div>


        </td>

        <td data-label="Foto" class="option-image-colum"
            @if($oldType == 1)
                style="display: block;"
             @elseif($oldType == 2)
                style="display: none;"
            @endif
        >
            <div class="option-box-container">

                <!--  IMAGES CONTAINER START  -->
                <div class="row">
                    <div class="col-md-12 ">

                        <div class="custom-preloader-container">
                            <div class="custom-preloader-loader"></div>
                        </div>

                        <!--  IMAGES START  -->
                        <div class="images-post-container" style="display: none">

                            <div class="images-post-container" data-class-name="{{$imgClassname}}{{$keySort}}">
                                <div class="images-post-item" style="width: 130px; height: 130px">
                                    <div
                                        style="display: {{ $oldData['image'][$keySort] == null? 'none':'flex' }}"
                                        tooltip="Sil"
                                        class="notPhotoPost notPhotoPostAloneOption notPhotoOption-{{ $imgClassname }}{{$keySort}}">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </div>
                                    <figure
                                        class="activeButtonAloneOption"
                                    >

                                        <img
                                            style="width: 130px; height: 130px"
                                            src="{{$oldData['image'][$keySort] == null ? asset('storage/no-image.png'): $oldData['image'][$keySort] }}"
                                            class="imgClassName-{{ $imgClassname }}{{$keySort}}"
                                        >

                                    </figure>
                                </div>
                            </div>

                            <!--  IMAGE INPUT  -->
                            <div class="image-post-input">
                                <input type="text"
                                       id="image_label-{{ $imgClassname }}{{$keySort}}"
                                       name="option_list[image][{{$keySort}}]"
                                       value="{{ $oldData['image'][$keySort] }}"
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
                <input type="number" min="0" class="form-control" name="option_list[sort][{{$keySort}}]" placeholder="Sıra"
                       value="{{ $sortValue }}">
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
@endforeach

