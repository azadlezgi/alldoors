@if(isset($oldData['option_value_id']['text']))


    <?php $optionValues = \App\Services\OptionService::getOptionValues($optionID, cache('language-defaultID')) ?>


    @if(isset(array_values($oldData['option_value_id']['text'])[$optionsKey]))
    @foreach(array_values($oldData['option_value_id']['text'])[$optionsKey] as $key => $optionValueID)

            <?php $imgClassname = generateRandomString(20); ?>
            <!--  TR START  -->
        <tr class="optionTr">
            <!--  OPTIONS  -->
            <td>
                <div class="row">
                    <div class="col-lg-12">

                        <select form="submit-form" class="form-control colum-option-box"
                                name="option_list[option_value_id][text][{{$dataUniqueID}}][]">

                            @foreach($optionValues as $option)
                                <option value="{{ $option->id }}"
                                        @if($optionValueID == $option->id) selected @endif
                                >{{ $option->text }}</option>
                            @endforeach

                        </select>


                    </div>
                </div>

            </td>


            <!--  PRICE  -->
            <td class="colum-sort-box">
                <div class="colum-sort">
                    <input type="number" form="submit-form" step=".01" min="0" class="form-control"
                           name="option_list[price][text][{{$dataUniqueID}}][]"
                           value="{{ array_values($oldData['price']['text'])[$optionsKey][$key] }}"
                           placeholder="Price">
                </div>
            </td>

            <!--  SORT  -->
            <td class="colum-sort-box">
                <div class="colum-sort">
                    <input type="text" form="submit-form" min="0" class="form-control"
                           name="option_list[sort][text][{{$dataUniqueID}}][]"
                           value="{{ array_values($oldData['sort']['text'])[$optionsKey][$key] }}"
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
