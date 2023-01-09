@extends('admin.layouts.index')
@section('title')
    Seçim əlavə et
@endsection

@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}" class="text-muted">Panel</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.option.group.index') }}" class="text-muted">Seçim qruplar</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.option.index') }}" class="text-muted">Seçimlər</a>
                        </li>

                        <li class="breadcrumb-item">
                            Seçim əlavə et
                        </li>

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-my-lg-8 ">

                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Seçim əlavə et</h3>
                            </div>

                        </div>

                        <div class="card-body">
                            {{-- Error messages--}}
                            {{ myErrors($errors) }}

                            <div class="row">
                                <div class="col-md-12 ">
                                    <form class="form" id="submit-form" action="{{ route('admin.option.store') }}"
                                          method="POST">
                                        @csrf

                                        <div class="card-body">

                                            <!--  OPTION GROUP START  -->
                                            <div class="form-group">
                                                <span class="span-dvidder">Seçim Qrup</span>

                                                <select
                                                        form="submit-form"
                                                        class="form-control countriesOverflow selectpicker"
                                                        name="option_group_id"
                                                        data-size="5"
                                                        data-live-search="true"
                                                >
                                                    <option value="">Seç</option>
                                                    @foreach($optionGroups as $optionGroup)
                                                        <option
                                                            {{ old('option_group_id') == $optionGroup->id ? 'selected' : '' }}
                                                            value="{{ $optionGroup->id }}">{{ $optionGroup->optionsGroupsTranslations[0]->name }}</option>
                                                    @endforeach

                                                </select>

                                                @error('option_group_id' )<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <!--  OPTION GROUP END  -->

                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="card-toolbar">
                                                        <ul class="nav nav-tabs nav-bold nav-tabs-line">

                                                            @foreach(cache('key-all-languages') as $key => $language)
                                                                <li class="nav-item">
                                                                    <a class="nav-link {{ $key == 0 ? 'active': null }}"
                                                                       data-toggle="tab"
                                                                       href="#language-{{ $language->id }}-tab">
                                                <span class="nav-icon">
                                                     <img src="{{ countryFlag($language->code) }}"/>
                                                </span>
                                                                        <span class="nav-text">
                                                         {{ $language->short_name }}
                                                    </span>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>


                                                    <div class="tab-content">


                                                        @foreach(cache('key-all-languages') as $key => $language)

                                                            <div
                                                                class="tab-pane fade show {{ $key == 0 ? 'active': null }} "
                                                                id="language-{{ $language->id }}-tab"
                                                                role="tabpanel"
                                                                aria-labelledby="language-{{ $language->id }}-tab">
                                                                <!--  NAME  -->
                                                                <div class="form-group">

                                                                    <span class="span-dvidder">Ad ({{ $language->code }})</span>
                                                                    <input
                                                                        type="text"
                                                                        name="name[{{ $language->id }}]"
                                                                        value="{{ old('name.'. $language->id) }}"
                                                                        class=" form-control">
                                                                    @error('name.'. $language->id )<span
                                                                        class="text-danger">{{ myError($message) }}</span> @enderror
                                                                </div>


                                                            </div>

                                                        @endforeach


                                                    </div>

                                                </div>

                                            </div>


                                            <!--  OPTIONS START  -->
                                            <div
                                                class="form-group option-status"
                                                @if(old('type') == 1 || old('type') == 2 || old('type') == 3)
                                                    style="display: block;"
                                                @elseif(empty(old('type')))
                                                    style="display: block;"
                                                @else
                                                    style="display: none;"
                                                @endif
                                            >
                                                <span class="span-dvidder">Seçim</span>
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div style="padding: 0.25rem;" class="card-body">


                                                            <div data-optionindexcheck=""
                                                                 class="optionIndexCheck"></div>
                                                            <table class="table-responsive-my">

                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">Text</th>
                                                                    <th scope="col" class="option-image-colum">Foto</th>
                                                                    <th scope="col">Sıra</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="optionTbody">
                                                                @if(old('option_list') != null)
                                                                        <?php
                                                                        $oldData = old('option_list');
                                                                        $oldType = old('type');
                                                                        ?>
                                                                    @include('admin.option.option-add.add-old-option',compact('oldData','oldType'))
                                                                @endif

                                                                <!--  TR START  -->


                                                                <!--  TR END  -->

                                                                </tbody>


                                                            </table>
                                                            <div class="option-box-add-container">
                                                                <div class="option-box-add">
                                                                    <i class="fa fa-plus-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  OPTIONS END  -->


                                        </div>


                                    </form>
                                </div>

                            </div>


                        </div>
                    </div>


                </div>
                <div class="col-my-lg-4 ">

                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Qeyd</h3>
                            </div>


                        </div>

                        <div class="card-body">

                            <!--  STATUS  -->
                            <div class="form-group row">
                                <label for="status" class="col-lg-3 col-form-label">Status</label>
                                <div class="col-lg-9">
                                    <select form="submit-form" class="form-control" name="status">
                                        <option {{ old('status') == '1' ? "selected": "" }} value="1">Aktiv</option>
                                        <option {{ old('status') == '0' ? "selected": "" }} value="0">Passiv</option>
                                    </select>
                                </div>
                            </div>

                            <!--  SORT  -->
                            <div class="form-group row">
                                <label for="status" class="col-lg-3 col-form-label">Sıra</label>
                                <div class="col-lg-9">
                                    <input type="number" min="0" form="submit-form" class="form-control" name="sort"
                                           value="{{ old('sort',0) }}">
                                </div>
                            </div>


                            <!--  TYPE  -->
                            <div class="form-group row">
                                <label for="status" class="col-lg-3 col-form-label">Tip</label>
                                <div class="col-lg-9">

                                    <div class="form-group">

                                        <select form="submit-form" class="form-control selectpicker option-type"
                                                name="type" data-size="5">
                                                <option {{ old('type') == 1 ? "selected": "" }} value="1">Şəkil və Text
                                                </option>
                                                <option {{ old('type') == 2 ? "selected": "" }} value="2">Text</option>

{{--                                            <optgroup label="Input">--}}
{{--                                                <option {{ old('type') == 4 ? "selected": "" }} value="4">Text</option>--}}
{{--                                                <option {{ old('type') == 5 ? "selected": "" }} value="5">Textarea--}}
{{--                                                </option>--}}
{{--                                            </optgroup>--}}
{{--                                            <optgroup label="File">--}}
{{--                                                <option {{ old('type') == 6 ? "selected": "" }} value="6">File</option>--}}
{{--                                            </optgroup>--}}
{{--                                            <optgroup label="Date">--}}
{{--                                                <option {{ old('type') == 7 ? "selected": "" }} value="7">Date</option>--}}
{{--                                                <option {{ old('type') == 8 ? "selected": "" }} value="8">Time</option>--}}
{{--                                                <option {{ old('type') == 9 ? "selected": "" }} value="9">Date & Time--}}
{{--                                                </option>--}}
{{--                                            </optgroup>--}}
                                        </select>


                                    </div>


                                </div>
                            </div>


                        </div>

                        <div class="card-footer myCardFooterPadding">
                            <div class=" d-flex justify-content-end">
                                <button type="submit" form="submit-form" class="btn btn-success btn-sm ">Göndər
                                </button>
                            </div>
                        </div>

                    </div>


                </div>


            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection

@section('CSS')
    <style>


        .span-dvidder {
            display: block;
            padding-bottom: 8px;
            font-weight: 600;
            color: #247dd8;
        }

        .modal-backdrop.show {
            opacity: 1 !important;
        }

        .modal-backdrop {
            background-color: rgba(255, 255, 255, 0.71) !important;
        }

        @media (min-width: 576px) {
            .modal-content {
                -webkit-box-shadow: 0 0 1.5rem 0 rgba(0, 0, 0, 0.10);
                box-shadow: 0 0 1.5rem 0 rgba(0, 0, 0, 0.10);
            }
        }


    </style>
@endsection

@section('js')

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });


    </script>


    <!--  BUTTON IMAGE ALONE START  -->
    <script>

        $(document).on('click', '.activeButtonAloneOption', function () {
            let imgClassName = $(this).closest('.images-post-container').attr('data-class-name');
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderAloneButtonForOptions(x, y, 'Images', imgClassName);

        })

    </script>
    <!--  BUTTON IMAGE ALONE END  -->


    <!--  BUTTON IMAGE SIZE START  -->
    <script>
        $(function () {
            $('.images-post-item').css({'width': 130, 'height': 130});
            $('.activeButton').css({'width': 130, 'height': 130});
            $('.images-post-container figure img').css({'width': 130, 'height': 130});
            $('.custom-preloader-container').hide();
            $('.images-post-container').show();

            $(window).resize(function () {
                $('.images-post-item').css({'width': 130, 'height': 130});
                $('.activeButton').css({'width': 130, 'height': 130});
                $('.images-post-container figure img').css({'width': 130, 'height': 130});
            });
        });

    </script>
    <!--  BUTTON IMAGE SIZE END  -->


    <!--  REMOVE OPTION START  -->
    <script>
        $(document).on('click', '.removeButtonOption', function () {
            $('.option-box-item').removeAttr('style');

            //indexi al
            let removeButtonOption = $('.removeButtonOption').index(this);
            $('.optionTr').eq(removeButtonOption).remove();


        })
    </script>
    <!--  REMOVE OPTION END  -->

    <!--  ADD OPTION START  -->
    <script>
        $(document).on('click', '.option-box-add-container', function () {
            let optionTypeCheck = $('.bootstrap-select .option-type').val();
            clearTimeout(addOptionVar);
            addOptionFunction(optionTypeCheck);

        })

        var addOptionVar;

        function addOptionFunction(optionTypeCheck) {
            addOptionVar = setTimeout(function () {

                $.ajax({
                    url: "{{ route('admin.option.getOptionAddAjax') }}",
                    type: 'POST',
                    data: {data: true},
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success == true) {
                            $('.optionTbody').append(data.options);

                            if (optionTypeCheck == 1) {
                                $('.option-image-colum').show();
                            }


                            if (optionTypeCheck == 2) {
                                $('.option-image-colum').hide();
                            }

                        } else {
                            toastr.error("Xəta baş verdi");
                        }
                    }
                });

            }, 300);

        }

    </script>
    <!--  ADD OPTION END  -->

    <!--  OPTION TYPE CHECK START  -->
    <script>

        const optionTypeVal = $('.option-type').val();

        if (optionTypeVal == 1) {
            $('.option-image-colum').show();
        }


        if (optionTypeVal == 2) {
            $('.option-image-colum').hide();
        }
    </script>
    <!--  OPTION TYPE CHECK END  -->

@endsection
