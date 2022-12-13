@if(isset($oldData['option_value_id']['image_and_text']))

        <?php $optionValues = \App\Services\OptionService::getOptionValues($optionID, cache('language-defaultID')) ?>


    @if(isset(array_values($oldData['option_value_id']['image_and_text'])[$optionsKey]))
    @foreach(array_values($oldData['option_value_id']['image_and_text'])[$optionsKey] as $key => $optionValueID)

            <?php $imgClassname = generateRandomString(20); ?>
            <!--  TR START  -->
        <tr class="optionTr">
            <!--  OPTIONS  -->
            <td>
                <div class="row">
                    <div class="col-lg-12">

                        <select form="submit-form" class="form-control colum-option-box"
                                name="option_list[option_value_id][image_and_text][{{$dataUniqueID}}][]">

                            @foreach($optionValues as $option)
                                <option value="{{ $option->id }}"
                                        @if($optionValueID == $option->id) selected @endif
                                >{{ $option->text }}</option>
                            @endforeach

                        </select>


                    </div>
                </div>

            </td>

            <!--  FOTO  -->
            <td>

                <div class="option-box-container">

                    <!--  IMAGES CONTAINER START  -->
                    <div class="row">
                        <div class="col-md-12 ">


                            <!--  IMAGES START  -->
                            <div class="images-post-container-option">

                                <div class="images-post-container-option" data-class-name="{{$imgClassname}}">
                                    <div class="images-post-items" style="width: 100px; height: 100px">

                                        <div

                                            @if(array_values($oldData['image']['image_and_text'])[$optionsKey][$key] === null)
                                                style="display: none"
                                            @else

                                                style="display: flex"
                                            @endif

                                            tooltip="Sil"
                                            class=" notPhotoPostAloneOption notPhotoOption-{{$imgClassname}}">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </div>
                                        <figure
                                            class="activeButtonAloneOption"
                                        >

                                            <img
                                                style="width: 100px; height: 100px"
                                                src="{{ array_values($oldData['image']['image_and_text'])[$optionsKey][$key] == null ? asset('storage/no-image.png'): array_values($oldData['image']['image_and_text'])[$optionsKey][$key] }}"
                                                class="imgClassName-{{ $imgClassname }}"
                                            >

                                        </figure>
                                    </div>
                                </div>

                                <!--  IMAGE INPUT  -->
                                <div class="image-post-input">
                                    <input type="text"
                                           id="image_label-{{ $imgClassname }}"
                                           name="option_list[image][image_and_text][{{$dataUniqueID}}][]"
                                           form="submit-form"
                                           value="{{ array_values($oldData['image']['image_and_text'])[$optionsKey][$key] }}"
                                    >

                                </div>


                                <!--  IMAGES END  -->

                            </div>

                        </div>
                        <!--  IMAGES CONTAINER END  -->
                    </div>
                </div>
            </td>


            <!--  PRICE  -->
            <td class="colum-sort-box">
                <div class="colum-sort">
                    <input type="number" form="submit-form" step=".01" min="0" class="form-control"
                           name="option_list[price][image_and_text][{{$dataUniqueID}}][]"
                           value="{{ array_values($oldData['price']['image_and_text'])[$optionsKey][$key] }}"
                           placeholder="Price">
                </div>
            </td>

            <!--  SORT  -->
            <td class="colum-sort-box">
                <div class="colum-sort">
                    <input type="text" form="submit-form" min="0" class="form-control"
                           name="option_list[sort][image_and_text][{{$dataUniqueID}}][]"
                           value="{{ array_values($oldData['sort']['image_and_text'])[$optionsKey][$key] }}"
                           placeholder="Sıra">
                </div>
            </td>

            <td>
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

    @endforeach
    @endif
@endif
