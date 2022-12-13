<?php $imgClassname =  generateRandomString(20);  ?>
    <!--  TR START  -->
<tr class="optionTr">
    <!--  OPTIONS  -->
    <td >
        <div class="row">
            <div class="col-lg-12">

                <select form="submit-form" class="form-control colum-option-box"
                        @if($optionData->type == 1)
                        name="option_list[option_value_id][image_and_text][{{$tabContentID}}][]"
                        @endif

                        @if($optionData->type == 2)
                            name="option_list[option_value_id][text][{{$tabContentID}}][]"
                        @endif

                >

                    @foreach($optionsValue as $option)
                        <option value="{{ $option->id }}">{{ $option->text }}</option>
                    @endforeach

                </select>


            </div>
        </div>

    </td>

    <!--  FOTO  -->
    @if($optionData->type == 1)
    <td >
        <div class="option-box-container">

            <!--  IMAGES CONTAINER START  -->
            <div class="row">
                <div class="col-md-12 ">

                    <!--  IMAGES START  -->
                    <div class="images-post-container-option" data-class-name="{{$imgClassname}}">
                        <div class="images-post-items" style="width: 100px; height: 100px">

                            <div
                                style="display: {{ old('image') == null? 'none':'flex' }}"
                                tooltip="Sil"
                                class=" notPhotoPostAloneOption notPhotoOption-{{$imgClassname}}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </div>
                            <figure
                                class="activeButtonAloneOption"
                            >

                                <img
                                    style="width: 100px; height: 100px"
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
                               @if($optionData->type == 1)
                                   name="option_list[image][image_and_text][{{$tabContentID}}][]"
                               @endif

                               @if($optionData->type == 2)
                                   name="option_list[image][text][{{$tabContentID}}][]"
                               @endif
                                form="submit-form"
                        >

                    </div>


                    <!--  IMAGES END  -->

                </div>

            </div>
            <!--  IMAGES CONTAINER END  -->
        </div>
    </td>
    @endif

    <!--  PRICE  -->
    <td  class="colum-sort-box">
        <div class="colum-sort">
            <input type="number" form="submit-form" step=".01" min="0" class="form-control"
                   @if($optionData->type == 1)
                       name="option_list[price][image_and_text][{{$tabContentID}}][]"
                   @endif

                   @if($optionData->type == 2)
                       name="option_list[price][text][{{$tabContentID}}][]"
                   @endif
                   placeholder="Price">
        </div>
    </td>

    <!--  SORT  -->
    <td  class="colum-sort-box">
        <div class="colum-sort">
            <input type="text" form="submit-form" min="0" class="form-control"
                   @if($optionData->type == 1)
                       name="option_list[sort][image_and_text][{{$tabContentID}}][]"
                   @endif

                   @if($optionData->type == 2)
                       name="option_list[sort][text][{{$tabContentID}}][]"
                   @endif
                    placeholder="Sıra" >
        </div>
    </td>

    <td >
        <div class="removeButtonOption">
            <div class="option-box-delete-container">
                <div class="option-box-delete">
                    <i class="fa fa-minus-circle"></i>
                </div>
            </div>
        </div>
    </td>

</tr>
<!--  TR END  -->
