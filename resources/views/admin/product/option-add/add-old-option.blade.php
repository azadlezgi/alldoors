<?php
$makeID = generateRandomString(20);
$make2ID = generateRandomString(20);
?>
<div class="col-lg-3">
    <!--  TAB AJAX START  -->
    <ul class="nav flex-column nav-pills optionTab">

        @foreach($oldData['option_id'] as $optionKey => $optionID)
            <li class="nav-item">
                <a class="nav-link
             @if($loop->first) active @endif
            " id="{{ $make2ID }}{{ $optionID }}" data-toggle="tab" href="#{{ $makeID }}{{ $optionID }}"
                   aria-controls="{{ $makeID }}{{ $optionID }}">
                    <span class="nav-icon"><i class="fa fa-minus-circle"></i></span>
                    <span class="nav-text">{{ $oldData['option_name'][$optionKey] }}</span>
                    <input type="hidden" value="{{ $oldData['option_name'][$optionKey] }}" name="option_list[option_name][]">
                    <input type="hidden" value="{{ $optionID }}" name="option_list[option_id][]" class="optionID">
                    <input type="hidden" value="{{ $oldData['option_type'][$optionKey] }}"
                           name="option_list[option_type][]" class="optionType">
                </a>
            </li>
        @endforeach

    </ul>

    <div class="option-box-container mt-4 mb-5">
        <input type="text" placeholder="Seçim" class="form-control optionSearch">
        <div tabindex="1" class="option-box-item">
            <!--  CODE  -->
        </div>
    </div>

    <div data-optionIndexCheck="" class="optionIndexCheck"></div>
</div>
<div class="col-lg-9">
    <!--  TAB CONTENT  -->
    <div class="tab-content optionContent" style="padding-top: 0">


        <?php
            $say = 0;
            $say2 = 0;
        ?>
        @foreach($oldData['option_id'] as $optionKey => $optionID)
            <?php $dataUniqueID = generateRandomString(20) ?>

        <div class="tab-pane
         @if($loop->first) active show @endif
        " id="{{ $makeID }}{{ $optionID }}" data-uniq-id="{{$dataUniqueID}}" role="tabpanel" aria-labelledby="{{ $make2ID }}{{ $optionID }}">

            <div class="table-responsive table table-striped table-hover">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Seçimlər</th>
                        <th scope="col"
                            @if($oldData['option_type'][$optionKey] == 2)
                                style="display:none;"
                           @endif

                        >Foto</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sıra</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="option-tbody">

                    @if($oldData['option_type'][$optionKey] == 1)
                        <?php $optionsKey = $say++; ?>
                        @include('admin.product.option-add.option-content.image-and-text',compact('oldData','optionsKey','optionID','dataUniqueID'))
                    @endif

                    @if($oldData['option_type'][$optionKey] == 2)
                            <?php $optionsKey = $say2++; ?>
                        @include('admin.product.option-add.option-content.text',compact('oldData','optionsKey','optionID','dataUniqueID'))
                    @endif


                    </tbody>
                </table>
            </div>

            <div class="option-box-add-container">
                <div class="option-box-add">
                    <i class="fa fa-plus-circle"></i>
                </div>
            </div>

        </div>
        @endforeach


    </div>
</div>
