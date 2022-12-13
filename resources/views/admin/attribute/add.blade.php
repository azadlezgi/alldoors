@extends('admin.layouts.index')
@section('title')
    Atribut əlavə et
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
                            <a href="{{ route('admin.attribute.group.index') }}" class="text-muted">Atribut qruplar</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.attribute.index') }}" class="text-muted">Atributlar</a>
                        </li>

                        <li class="breadcrumb-item">
                            Atribut əlavə et
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
                                <h3 class="card-label">Atribut əlavə et</h3>
                            </div>

                        </div>

                        <div class="card-body">
                            {{-- Error messages--}}
                            {{ myErrors($errors) }}

                            <div class="row">
                                <div class="col-md-12 ">
                                    <form class="form" id="submit-form" action="{{ route('admin.attribute.store') }}"
                                          method="POST">
                                        @csrf

                                        <div class="card-body">

                                            <!--  ATTRIBUTE GROUP START  -->
                                            <div class="form-group">
                                                <span class="span-dvidder">Atribut Qrup</span>

                                                <select  form="submit-form" class="form-control countriesOverflow selectpicker"
                                                         name="attribute_group_id" data-size="5" data-live-search="true">
                                                    <option value="">Seç</option>
                                                    @foreach($attributeGroups as $attributeGroup)
                                                    <option
                                                        {{ old('attribute_group_id') == $attributeGroup->id ? 'selected' : '' }}
                                                        value="{{ $attributeGroup->id }}">{{ $attributeGroup->attributesGroupsTranslations[0]->name }}</option>
                                                    @endforeach

                                                </select>

                                                @error('attribute_group_id' )<span
                                                    class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <!--  ATTRIBUTE GROUP END  -->

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
                                        <option value="1">Aktiv</option>
                                        <option value="0">Passiv</option>
                                    </select>
                                </div>
                            </div>

                            <!--  SORT  -->
                            <div class="form-group row">
                                <label for="status" class="col-lg-3 col-form-label">Sıra</label>
                                <div class="col-lg-9">
                                    <input type="number" min="0" form="submit-form" class="form-control" name="sort" value="{{ old('sort',0) }}">
                                </div>
                            </div>


                        </div>

                        <div  class="card-footer myCardFooterPadding">
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


        .span-dvidder{
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


    <!--  BUTTON IMAGE START  -->
    <script>

        $(document).on('click', '.activeButton', function () {
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderAloneButton(x,y,'Images');


        })


    </script>
    <!--  BUTTON IMAGE END  -->

@endsection
