@extends('admin.layouts.index')
@section('title')
    Məhsul əlavə et
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
                            <a href="{{ route('admin.product.index') }}" class="text-muted">Məhsullar</a>
                        </li>

                        <li class="breadcrumb-item">
                            Məhsul əlavə et
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
                        <!--begin::Card header-->
                        <div class="card-header card-header-tabs-line nav-tabs-line-3x">
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">

                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a class="nav-link active" data-toggle="tab" href="#tab-page-general">
                                            <span class="nav-text font-size-lg">ÜMUMİ</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#tab-page-images">
                                            <span class="nav-text font-size-lg">ŞƏKİLLƏR</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#tab-page-price-table">
                                            <span class="nav-text font-size-lg">QİYMƏT CƏDVƏLİ</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#tab-page-attribute">
                                            <span class="nav-text font-size-lg">ATRİBUTLAR</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->


                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#tab-page-options">
                                            <span class="nav-text font-size-lg">SEÇİMLƏR</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->


                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#tab-page-seo">
                                            <span class="nav-text font-size-lg">SEO</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->

                                </ul>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <form class="form" id="submit-form" action="{{ route('admin.product.store') }}"
                                  method="POST"
                            >
                                @csrf

                                <div style="padding-top: 0" class="tab-content">
                                    <!--begin::Tab-->
                                    <div class="tab-pane show active " id="tab-page-general" role="tabpanel">

                                        {{-- Error messages--}}
                                        {{ myErrors($errors) }}

                                        <div class="row">
                                            <div class="col-md-12 ">


                                                <div style="padding: 0.25rem;" class="card-body">


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
                                                                             <img
                                                                                 src="{{ countryFlag($language->code) }}"/>
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


                                                                        <!--  NAME START  -->
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
                                                                        <!--  NAME END  -->


                                                                        <!-- SUB NAME START  -->
                                                                        <div class="form-group">
                                                                            <span class="span-dvidder">Qısa Ad ({{ $language->code }})</span>
                                                                            <input
                                                                                type="text"
                                                                                name="sub_name[{{ $language->id }}]"
                                                                                value="{{ old('sub_name.'. $language->id) }}"
                                                                                class=" form-control">
                                                                            @error('sub_name.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  SUB NAME END  -->


                                                                        <!--  CONTENT START  -->
                                                                        <div class="form-group">
                                                                            <span class="span-dvidder">Mətn ({{ $language->code }})</span>
                                                                            <textarea
                                                                                type="text"
                                                                                name="text[{{ $language->id }}]"
                                                                                class="tinymceEditor form-control">{{ old('text.'. $language->id) }}</textarea>
                                                                            @error('text.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  CONTENT END  -->


                                                                        <!--  SHORT CONTENT START  -->
                                                                        <div class="form-group">
                                                                            <span class="span-dvidder">Qısa Mətn ({{ $language->code }})</span>
                                                                            <textarea
                                                                                type="text"
                                                                                name="short_text[{{ $language->id }}]"
                                                                                class="tinymceEditor form-control">{{ old('short_text.'. $language->id) }}</textarea>
                                                                            @error('short_text.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  SHORT CONTENT END  -->


                                                                    </div>

                                                                @endforeach

                                                                <!--  PRICE  -->
                                                                <div class="form-group">
                                                                    <span class="span-dvidder">Qiymət</span>
                                                                    <input type="text" name="price" autocapitalize="OFF"
                                                                           value="{{ old('price') }}"
                                                                           class=" form-control">
                                                                    @error('price' )<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>


                                                                <!--  SPECIAL PRICE  -->
                                                                <div class="form-group">
                                                                    <hr class="hr mt-10 mb-10"/>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <span
                                                                                class="span-dvidder">Endirimli Qiymət</span>
                                                                            <input type="text" name="special_price"
                                                                                   autocapitalize="OFF"
                                                                                   value="{{ old('special_price') }}"
                                                                                   class=" form-control">
                                                                            @error('special_price' )<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>


                                                                        <div class="col-md-4 my-md-mt-4">
                                                                         <span
                                                                             class="span-dvidder">Başlama tarixi</span>
                                                                            <div class="input-group date"
                                                                                 id="special_price_start_date"
                                                                                 data-target-input="nearest">
                                                                                <input type="text"
                                                                                       name="special_price_start_date"
                                                                                       class="form-control datetimepicker-input"
                                                                                       placeholder="Başlama tarixi"
                                                                                       value="{{ old('special_price_start_date') }}"
                                                                                       data-target="#special_price_start_date"/>
                                                                                <div class="input-group-append"
                                                                                     data-target="#special_price_start_date"
                                                                                     data-toggle="datetimepicker">
                                                                                  <span class="input-group-text">
                                                                                   <i class="ki ki-calendar"></i>
                                                                                  </span>
                                                                                </div>
                                                                            </div>

                                                                        </div>


                                                                        <div class="col-md-4 my-md-mt-4">
                                                                             <span
                                                                                 class="span-dvidder">Bitmə tarixi</span>
                                                                            <div class="input-group date"
                                                                                 id="special_price_end_date"
                                                                                 data-target-input="nearest">
                                                                                <input type="text"
                                                                                       name="special_price_end_date"
                                                                                       class="form-control datetimepicker-input"
                                                                                       placeholder="Bitmə tarixi"
                                                                                       value="{{ old('special_price_end_date') }}"
                                                                                       data-target="#special_price_end_date"/>
                                                                                <div class="input-group-append"
                                                                                     data-target="#special_price_end_date"
                                                                                     data-toggle="datetimepicker">
                                                                                  <span class="input-group-text">
                                                                                   <i class="ki ki-calendar"></i>
                                                                                  </span>
                                                                                </div>
                                                                            </div>

                                                                        </div>


                                                                    </div>

                                                                </div>

                                                                <!-- Dimensions (Ölçülər) -->
                                                                <div class="form-group">
                                                                    <hr class="hr mt-10 mb-10"/>

                                                                    <div class="row">

                                                                        <!--  UZUNLUQ  -->
                                                                        <div class="col-md-4">
                                                                            <span class="span-dvidder">Uzunluq</span>
                                                                            <input type="text" name="length"
                                                                                   autocapitalize="OFF"
                                                                                   value="{{ old('length') }}"
                                                                                   class=" form-control">
                                                                            @error('length' )<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>

                                                                        <!--  EN  -->
                                                                        <div class="col-md-4 my-md-mt-4">
                                                                            <span class="span-dvidder">En</span>
                                                                            <input type="text" name="width"
                                                                                   autocapitalize="OFF"
                                                                                   value="{{ old('width') }}"
                                                                                   class=" form-control">
                                                                            @error('width' )<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>

                                                                        <!--  HÜNDÜRLÜK  -->
                                                                        <div class="col-md-4 my-md-mt-4">
                                                                            <span class="span-dvidder">Hündürlük</span>
                                                                            <input type="text" name="height"
                                                                                   autocapitalize="OFF"
                                                                                   value="{{ old('height') }}"
                                                                                   class=" form-control">
                                                                            @error('height' )<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>


                                                                    </div>

                                                                </div>


                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>

                                        </div>

                                    </div>
                                    <!--end::Tab-->

                                    <!--begin::Tab-->
                                    <div class="tab-pane " id="tab-page-images" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 ">

                                                <div style="padding: 0.25rem;" class="card-body">


                                                    <div class="row">
                                                        <div class="col-md-12 ">

                                                            <div class="tab-content">
                                                                <div class="images-box-container">

                                                                    <div class="images-box-add">
                                                                        <div class="fa fa-plus"></div>
                                                                    </div>

                                                                    <!--  JavaScriptle bura elave edir  -->
                                                                    <div id="sortable"
                                                                         class="images-box-item-container">
                                                                        @if(old('images') != null)
                                                                            @foreach(old('images') as $iamge)
                                                                                <div class="images-box-item">
                                                                                    <div class="removeButton">
                                                                                        <span
                                                                                            class="fa fa-times"></span>
                                                                                    </div>
                                                                                    <img width="200" src="{{ $iamge }}">
                                                                                    <input form="submit-form"
                                                                                           type="hidden" name="images[]"
                                                                                           value="{{ $iamge }}">
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Tab-->

                                    <!--begin::Tab-->
                                    <div class="tab-pane " id="tab-page-price-table" role="tabpanel">


                                        <div class="row">
                                            <div class="col-md-12 ">


                                                <div style="padding: 0.25rem;" class="card-body">


                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="card-toolbar">
                                                                <ul class="nav nav-tabs nav-bold nav-tabs-line">

                                                                    @foreach(cache('key-all-languages') as $key => $language)
                                                                        <li class="nav-item">
                                                                            <a class="nav-link {{ $key == 0 ? 'active': null }}"
                                                                               data-toggle="tab"
                                                                               href="#language-price-table-{{ $language->id }}-tab">
                                                                        <span class="nav-icon">
                                                                             <img
                                                                                 src="{{ countryFlag($language->code) }}"/>
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
                                                                        id="language-price-table-{{ $language->id }}-tab"
                                                                        role="tabpanel"
                                                                        aria-labelledby="language-price-table-{{ $language->id }}-tab">

                                                                        <!--  PRICE TABLE START  -->
                                                                        <div class="form-group">
                                                                            <span class="span-dvidder">Qiymət cədvəli ({{ $language->code }})</span>
                                                                            <textarea
                                                                                type="text"
                                                                                name="price_table[{{ $language->id }}]"
                                                                                class="tinymceEditor form-control">{{ old('price_table.'. $language->id) }}</textarea>
                                                                            @error('price_table.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  PRICE TABLE END  -->


                                                                    </div>

                                                                @endforeach


                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <small>Cədvəlin borderinə <b class="text-danger">(#D8D8D8)</b> bu rəng
                                                    kodunu və ya
                                                    digər istədiyiniz rəngi verə bilərsiniz. </small>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Tab-->


                                    <!--begin::Tab-->
                                    <div class="tab-pane " id="tab-page-attribute" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div style="padding: 0.25rem;" class="card-body">


                                                        <?php //Cache::add('attributlar', old('attribute_list'), 100000);
                                                        ?>
                                                    <table class="table-responsive-my">

                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Atribut</th>
                                                            <th scope="col">Text</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="attributeTbody">
                                                        @if(old('attribute_list') != null)
                                                                <?php $oldData = old('attribute_list'); ?>
                                                            @include('admin.product.attribute-add.add-old-attribute',compact('oldData'))
                                                        @endif

                                                        <!--  TR START  -->

                                                        <!--  TR END  -->

                                                        </tbody>
                                                        <div data-attributeIndexCheck=""
                                                             class="attributeIndexCheck"></div>

                                                    </table>
                                                    <div class="attribute-box-add-container">
                                                        <div class="attribute-box-add">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Tab-->


                                    <!--begin::Tab-->
                                    <div class="tab-pane " id="tab-page-options" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12 ">

                                                <div style="padding: 0.25rem;" class="card-body">


                                                    <div class="row">
                                                        <div class="col-lg-12 ">
                                                            <div style="padding: 0.25rem;" class="card-body">


                                                                <div class="row">
                                                                    @if(old('option_list') != null)
                                                                            <?php
                                                                            $oldData = old('option_list');
                                                                            ?>
                                                                        @include('admin.product.option-add.add-old-option',compact('oldData'))

                                                                    @else
                                                                        <div class="col-lg-3">
                                                                            <!--  TAB AJAX START  -->
                                                                            <ul class="nav flex-column nav-pills optionTab"></ul>

                                                                            <div class="option-box-container mt-4 mb-5">
                                                                                <input type="text" placeholder="Seçim"
                                                                                       class="form-control optionSearch">
                                                                                <div tabindex="1"
                                                                                     class="option-box-item">
                                                                                    <!--  CODE  -->
                                                                                </div>
                                                                            </div>

                                                                            <div data-optionIndexCheck=""
                                                                                 class="optionIndexCheck"></div>
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <!--  TAB CONTENT  -->
                                                                            <div class="tab-content optionContent"
                                                                                 style="padding-top: 0"></div>
                                                                        </div>
                                                                    @endif


                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Tab-->


                                    <!--begin::Tab-->
                                    <div class="tab-pane " id="tab-page-seo" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 ">

                                                <div style="padding: 0.25rem;" class="card-body">


                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="card-toolbar">
                                                                <ul class="nav nav-tabs nav-bold nav-tabs-line">

                                                                    @foreach(cache('key-all-languages') as $key => $language)
                                                                        <li class="nav-item">
                                                                            <a class="nav-link {{ $key == 0 ? 'active': null }}"
                                                                               data-toggle="tab"
                                                                               href="#language-seo-{{ $language->id }}-tab">
                                                                        <span class="nav-icon">
                                                                             <img
                                                                                 src="{{ countryFlag($language->code) }}"/>
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
                                                                        id="language-seo-{{ $language->id }}-tab"
                                                                        role="tabpanel"
                                                                        aria-labelledby="language-seo-{{ $language->id }}-tab">


                                                                        <!--  TITLE START  -->
                                                                        <div class="form-group">
                                                                            <span class="span-dvidder">Title ({{ $language->code }})</span>
                                                                            <input
                                                                                type="text"
                                                                                name="title[{{ $language->id }}]"
                                                                                value="{{ old('title.'. $language->id) }}"
                                                                                class=" form-control">
                                                                            @error('title.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  TITLE END  -->


                                                                        <!--  KEYWORD START  -->
                                                                        <div class="form-group">
                                                                            <span class="span-dvidder">Keyword ({{ $language->code }})</span>
                                                                            <input
                                                                                type="text"
                                                                                name="keyword[{{ $language->id }}]"
                                                                                value="{{ old('keyword.'. $language->id) }}"
                                                                                class=" form-control">
                                                                            @error('keyword.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  KEYWORD END  -->


                                                                        <!--  DESCRIPTION START  -->
                                                                        <div class="form-group">
                                                                            <span class="span-dvidder">Description ({{ $language->code }})</span>
                                                                            <textarea
                                                                                rows="6"
                                                                                type="text"
                                                                                name="description[{{ $language->id }}]"
                                                                                class=" form-control">{{ old('description.'. $language->id) }}</textarea>
                                                                            @error('description.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  DESCRIPTION END  -->


                                                                    </div>

                                                                @endforeach


                                                                <!--  SLUG START  -->
                                                                <div class="form-group">
                                                                    <span class="span-dvidder">Slug</span>
                                                                    <input
                                                                        type="text"
                                                                        name="slug"
                                                                        value="{{ old('slug') }}"
                                                                        class=" form-control">
                                                                    @error('slug' )<span
                                                                        class="text-danger">{{ $message }}</span> @enderror


                                                                </div>


                                                                <!--  SLUG END  -->

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Tab-->

                                </div>
                            </form>

                        </div>
                        <!--begin::Card body-->
                    </div>

                </div>
                <div class="col-my-lg-4 ">

                    <!--  QEYD  -->
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

                        </div>


                        <div class="card-footer myCardFooterPadding">
                            <div class=" d-flex justify-content-end">
                                <button type="submit" form="submit-form" class="btn btn-success btn-sm ">Göndər
                                </button>
                            </div>
                        </div>

                    </div>


                    <!--  PRODUCT PARENT  -->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Əsas məhsul</h3>
                            </div>


                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <div style="width: 100%" class="form-group">
                                    <select form="submit-form" class="form-control parentProduct"
                                            name="parent">
                                        <option value="0">-=Seç=-</option>
                                        @if($productParent != null)
                                            <option value="{{ $productParent->id }}"
                                                    selected>{{ $productParent->name }}</option>
                                        @endif
                                    </select>

                                </div>
                            </div>
                            @error('parent' )<span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <!--  PRODUCT GALLERIES  -->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Qalereyalar</h3>
                            </div>


                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <div style="width: 100%" class="form-group">
                                    <select form="submit-form" class="form-control parentGallery"
                                            name="gallery">
                                        <option value="0">-=Seç=-</option>
                                        @if($productGallery != null)
                                            <option value="{{ $productGallery->id }}"
                                                    selected>{{ $productGallery->name }}</option>
                                        @endif
                                    </select>

                                </div>
                            </div>
                            @error('gallery' )<span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <!--  Dizayn  -->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Dizayn</h3>
                            </div>


                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <div style="width: 100%" class="form-group">
                                    <select form="submit-form" class="form-control countriesOverflow selectpicker"
                                            name="model" data-size="5" data-live-search="true">
                                        <option value="">Seç</option>
                                        @foreach($models as $model)
                                            <option
                                                {{ old('model') == $model->id ? 'selected' : '' }} value="{{ $model->id }}">{{ $model->name  }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            @error('model' )<span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>


                    <!--  CATEGORY  -->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Kateqoriyalar</h3>
                            </div>


                        </div>

                        <div class="card-body">
                            <!--  STATUS  -->
                            <div class="form-group row">
                                <div style="width: 100%" class="form-group">
                                    <div class="checkbox-list categories-list">

                                        {{ \App\Services\CategoriesService::getTreeProductCategories($defaultLanguage) }}

                                    </div>
                                </div>

                            </div>
                            @error('categories' )<span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <!--  COLLECTION  -->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Kolleksiyalar</h3>
                            </div>


                        </div>

                        <div class="card-body">
                            <!--  STATUS  -->
                            <div class="form-group row">
                                <div style="width: 100%" class="form-group">
                                    <div class="checkbox-list categories-list">

                                        {{ \App\Services\CollectionsService::getTreeProductCollections($defaultLanguage) }}

                                    </div>
                                </div>

                            </div>
                            @error('collections' )<span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>


                    <!--  Manufacturer  -->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">İstehsalçılar</h3>
                            </div>


                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <div style="width: 100%" class="form-group">
                                    <select form="submit-form" class="form-control countriesOverflow selectpicker"
                                            name="manufacturer" data-size="5" data-live-search="true">
                                        <option value="">Seç</option>
                                        @foreach($manufacturers as $manufacturer)
                                            <option
                                                {{ old('manufacturer') == $manufacturer->id ? 'selected' : '' }} value="{{ $manufacturer->id }}">{{ $manufacturer->name  }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            @error('manufacturer' )<span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>


                    <!--  FOTO  -->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Şəkil</h3>
                            </div>

                        </div>

                        <div style="padding-top: 2px; padding-bottom: 2px;" class="card-body">

                            <!--  IMAGES CONTAINER START  -->
                            <div class="row">
                                <div class="col-md-12 ">

                                    <!--  IMAGES START  -->
                                    <div
                                        class="images-post-container">
                                        <div class="images-post-item">

                                            <div
                                                style="display: {{ old('image') == null? 'none':'flex' }}"
                                                tooltip="Sil"
                                                class="notPhotoPost notPhotoPostAlone">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </div>
                                            <figure
                                                class="activeButtonAlone"
                                            >

                                                <img
                                                    style="width: 100%;"
                                                    src="{{old('image') == null ? asset('storage/no-image.png'): old('image') }}"
                                                    class="previewImage"
                                                >

                                            </figure>
                                        </div>
                                    </div>

                                    <!--  IMAGE INPUT  -->
                                    <div class="image-post-input">
                                        <input type="text"
                                               id="image_label"
                                               name="image"
                                               value="{{ old('image' ) }}"
                                               form="submit-form"
                                        >

                                    </div>
                                    @error('image' )<span
                                        class="text-danger">{{ $message }}</span> @enderror


                                    <!--  IMAGES END  -->

                                </div>

                            </div>
                            <!--  IMAGES CONTAINER END  -->


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
        .modal-backdrop.show {
            opacity: 1 !important;
        }

        .modal-backdrop {
            background-color: rgba(255, 255, 255, 0.71) !important;
        }

        .optionTab .nav-item {
            border-bottom: 1px solid #f3f3f3;
        }

        @media (max-width: 767px) {
            .my-md-mt-4 {
                margin-top: 20px;
            }
        }

        @media (min-width: 576px) {
            .modal-content {
                -webkit-box-shadow: 0 0 1.5rem 0 rgba(0, 0, 0, 0.10);
                box-shadow: 0 0 1.5rem 0 rgba(0, 0, 0, 0.10);
            }
        }

        .optionTr {
            border-bottom: 1px solid #f1f1f1;
        }

        tr.optionTr td {
            vertical-align: inherit !important;
        }

        .option-not-result {
            display: flex;
            justify-content: center;
            align-items: center;
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

    <!--  SELECT 2 PRODUCT PARENT START  -->
    <script>
        $('.parentProduct').select2({
            ajax: {
                url: '{{ route('admin.product.getProductParent') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        parent_id: {{ old('parent') == null ? 0 : old('parent') }}
                    };
                },
            }
        });
    </script>
    <!--  SELECT 2 PRODUCT PARENT END  -->


    <!--  SELECT 2 PRODUCT GALLERY START  -->
    <script>
        $('.parentGallery').select2({
            ajax: {
                url: '{{ route('admin.product.getProductGallery') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        gallery_id: {{ old('gallery') == null ? 0 : old('gallery') }}
                    };
                },
            }
        });
    </script>
    <!--  SELECT 2 PRODUCT GALLERY END  -->

    <script>
        $("#sortable").sortable({
            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('updated');
                    }
                });
            }
        });
    </script>


    <!--  TINYMCE START -->
    <script>
        tinymce.init({
            selector: '.tinymceEditor',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 300,
            forced_root_block: "", // Bunu yandirdiqda adi vaxti <p> tagi ichine alirdisa artiq almiyacaq
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
            entity_encoding: "raw",
            entities: "nbsp",
            relative_urls: false,
            remove_script_host: true,
            file_picker_callback(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight
                let fileType = meta.filetype;

                /*   BUTTON FUNCTION START   */
                ckfinderTinyMCEButton(x, y, fileType);

            }
        });


    </script>
    <!--  TINYMCE END -->

    <!--  BUTTON TINYMCE IMAGE START  -->
    <script>

        $(document).on('click', '.activeButton', function () {
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderButton(x, y, 'Images');

        })

    </script>
    <!--  BUTTON TINYMCE IMAGE END  -->

    <!--  BUTTON IMAGE ALONE START  -->
    <script>

        $(document).on('click', '.activeButtonAlone', function () {
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderAloneButton(x, y, 'Images');

        })

    </script>
    <!--  BUTTON IMAGE ALONE END  -->


    <!--  BUTTON IMAGE ALONE MULTIPLE START  -->
    <script>

        $(document).on('click', '.images-box-add', function () {
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderAloneButtonMultiple(x, y, 'Images');

        })

    </script>
    <!--  BUTTON IMAGE ALONE MULTIPLE END  -->

    <!--   BUTTON IMAGE ALONE MULTIPLE REMOVE START   -->
    <script>

        $(document).on('click', '.removeButton', function () {
            $(this).parent().remove();
        })

    </script>
    <!-- BUTTON IMAGE ALONE MULTIPLE REMOVE END   -->

    <!--  ATTRIBUTE START  -->

    <!--  ATTRIBUTE SEARCH CLICK START  -->
    <script>
        $(document).on('click', '.attributeSearch', function () {
            $('.attribute-box-item').removeAttr('style');

            //indexi al
            let attributeIndex = $('.attributeSearch').index(this);
            $('.attributeIndexCheck').attr('data-attributeIndexCheck', attributeIndex);
            let searchinput = $(this).val();
            let searchAttribute = '';

            if (searchinput == '') {
                searchAttribute = '';
            } else {
                searchAttribute = searchinput;
            }

            clearTimeout(searchAttributeVar);
            searchAttributeFunction(searchAttribute, attributeIndex);

        })
    </script>
    <!--  ATTRIBUTE SEARCH CLICK END  -->

    <!--  ATTRIBUTE SEARCH KEYUP START  -->
    <script>
        $(document).on('keyup', '.attributeSearch', function () {
            $('.attribute-box-item').removeAttr('style');

            //indexi al
            let attributeIndex = $('.attributeSearch').index(this);
            $('.attributeIndexCheck').attr('data-attributeIndexCheck', attributeIndex);
            let searchinput = $(this).val();
            let searchAttribute = '';

            if (searchinput == '') {
                searchAttribute = '';
            } else {
                searchAttribute = searchinput;
            }

            clearTimeout(searchAttributeVar);
            searchAttributeFunction(searchAttribute, attributeIndex);


        })

        var searchAttributeVar;

        function searchAttributeFunction(searchAttribute, attributeIndex) {
            searchAttributeVar = setTimeout(function () {

                $.ajax({
                    url: "{{ route('admin.product.getAttributeAjax') }}",
                    type: 'POST',
                    data: {search: searchAttribute},
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success == true) {

                            $('.attribute-box-item').eq(attributeIndex).html(data.attributes)
                        } else {
                            toastr.error("Xəta baş verdi");
                        }
                    }
                });

            }, 300);

        }


    </script>
    <!--  ATTRIBUTE SEARCH KEYUP END  -->

    <!--  ATTIBUTE NAME START  -->
    <script>
        $(document).on('click', '.attribute-name li', function () {
            let attributeIndexCheck = $('.attributeIndexCheck').attr('data-attributeIndexCheck');
            let attributeValue = $(this).attr('data-attribute-value');
            let attributeText = $(this).text().trim();

            $('.attributeSearch').eq(attributeIndexCheck).val(attributeText);
            $('.attributeInput').eq(attributeIndexCheck).val(attributeValue);
            $('.attribute-box-item').hide();

        })

    </script>
    <!--  ATTIBUTE NAME END  -->

    <!--  REMOVE ATTRIBUTE START  -->
    <script>
        $(document).on('click', '.removeButtonAttribute', function () {
            $('.attribute-box-item').removeAttr('style');

            //indexi al
            let removeButtonAttribute = $('.removeButtonAttribute').index(this);
            $('.attributeTr').eq(removeButtonAttribute).remove();


        })
    </script>
    <!--  REMOVE ATTRIBUTE END  -->

    <!--  ADD ATTRIBUTE START  -->
    <script>
        $(document).on('click', '.attribute-box-add-container', function () {
            clearTimeout(addAttributeVar);
            addAttributeFunction();

        })

        var addAttributeVar;

        function addAttributeFunction() {
            addAttributeVar = setTimeout(function () {

                $.ajax({
                    url: "{{ route('admin.product.getAttributeAddAjax') }}",
                    type: 'POST',
                    data: {data: true},
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success == true) {
                            $('.attributeTbody').append(data.attributes);
                        } else {
                            toastr.error("Xəta baş verdi");
                        }
                    }
                });

            }, 300);

        }

    </script>
    <!--  ADD ATTRIBUTE END  -->

    <!--  ATTRIBUTE END  -->



    <!--  OPTION START  -->
    <!--  OPTION SEARCH CLICK START  -->
    <script>
        $(document).on('click', '.optionSearch', function () {
            let optionID = $('.optionID');

            let optionInputValues = [];
            if (typeof optionID.val() != undefined) {
                optionID.each(function (index, data) {
                    optionInputValues.push(data.value);
                })
            }


            $('.option-box-item').removeAttr('style');

            //indexi al
            let optionIndex = $('.optionSearch').index(this);
            $('.optionIndexCheck').attr('data-optionIndexCheck', optionIndex);
            let searchinput = $(this).val();
            let searchOption = '';

            if (searchinput == '') {
                searchOption = '';
            } else {
                searchOption = searchinput;
            }

            clearTimeout(searchOptionVar);
            searchOptionFunction(searchOption, optionIndex, optionInputValues);

        })
    </script>
    <!--  OPTION SEARCH CLICK END  -->

    <!--  OPTION SEARCH KEYUP START  -->
    <script>
        $(document).on('keyup', '.optionSearch', function () {
            $('.option-box-item').removeAttr('style');

            let optionID = $('.optionID');

            let optionInputValues = [];
            if (typeof optionID.val() != undefined) {
                optionID.each(function (index, data) {
                    optionInputValues.push(data.value);
                })
            }


            //indexi al
            let optionIndex = $('.optionSearch').index(this);
            $('.optionIndexCheck').attr('data-optionIndexCheck', optionIndex);
            let searchinput = $(this).val();
            let searchOption = '';

            if (searchinput == '') {
                searchOption = '';
            } else {
                searchOption = searchinput;
            }

            clearTimeout(searchOptionVar);
            searchOptionFunction(searchOption, optionIndex, optionInputValues);


        })

        var searchOptionVar;

        function searchOptionFunction(searchOption, optionIndex, optionInputValues) {
            $('.option-box-item').html(`
            <div class="custom-preloader-container" >
               <div class="custom-preloader-loader"></div>
             </div>
            `);

            searchOptionVar = setTimeout(function () {

                $.ajax({
                    url: "{{ route('admin.product.getOptionAjax') }}",
                    type: 'POST',
                    data: {search: searchOption, optionInputValues: optionInputValues},
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success == true) {

                            if (data.options == '') {
                                $('.option-box-item').eq(optionIndex).html(`<div class="option-not-result">Nəticə Yoxdur</div>`);
                            } else {
                                $('.option-box-item').eq(optionIndex).html(data.options);
                            }
                        } else {
                            toastr.error("Xəta baş verdi");
                        }
                    }
                });

            }, 300);

        }


    </script>
    <!--  OPTION SEARCH KEYUP END  -->

    <!--  OPTION NAME START  -->
    <script>
        $(document).on('click', '.option-name li', function () {

            let optionIndexCheck = $('.optionIndexCheck').attr('data-optionIndexCheck');
            let optionValue = $(this).attr('data-option-value');
            let optionType = $(this).attr('data-option-type');
            let optionText = $(this).text().trim();

            $('.optionSearch').eq(optionIndexCheck).val('');

            // $('.optionSearch').eq(optionIndexCheck).val(optionText);
            // $('.optionInput').eq(optionIndexCheck).val(optionValue);
            $('.option-box-item').hide();

            $('.optionTab .nav-link').removeClass('active');
            $('.optionContent .tab-pane').removeClass('active');
            $('.optionContent .tab-pane').removeClass('show');


            let navLinkNameID = makeString(20);
            let tabPanelID = makeString(20);

            /*   TAB   */
            $('.optionTab').append(`
           <li class="nav-item">
            <a class="nav-link active" id="${navLinkNameID}" data-toggle="tab" href="#${tabPanelID}" aria-controls="${tabPanelID}" >
                 <span class="nav-icon"><i class="fa fa-minus-circle"></i></span>
         <span class="nav-text">${optionText}</span>
        <input type="hidden" value="${optionText}" name="option_list[option_name][]">
        <input type="hidden" value="${optionValue}" name="option_list[option_id][]" class="optionID">
        <input type="hidden" value="${optionType}" name="option_list[option_type][]" class="optionType">
          </a>
         </li>
        `);

            /*   TAB CONTENT   */
            $('.optionContent').append(`
                 <div class="tab-pane active show" id="${tabPanelID}" data-uniq-id="${makeString(20)}" role="tabpanel" aria-labelledby="${navLinkNameID}">



                            <div class="table-responsive table table-striped table-hover">
                               <table class="table">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Seçimlər</th>
                                    <th scope="col" ${optionType == 2 ? 'style="display:none;"' : ''}>Foto</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Sıra</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                             <tbody class="option-tbody">

                                 </tbody>
                          </table>
                        </div>

                            <div class="option-box-add-container">
                                <div class="option-box-add">
                                    <i class="fa fa-plus-circle"></i>
                                </div>
                            </div>

                </div>
        `);


        })

    </script>
    <!--  OPTION NAME END  -->


    <!--  SELECT OPTION TAB START  -->
    <script>
        $(document).on('click', '.optionTab .nav-item', function () {
            let currentIndex = $(this).index();

            $('.optionContent .tab-pane').removeClass('active');
            $('.optionContent .tab-pane').removeClass('show');

            $('.optionContent .tab-pane').eq(currentIndex).addClass('active');


            if (currentIndex == "-1") {
                $('.optionContent .tab-pane').removeClass('active');

                $('.optionContent .tab-pane').eq(0).addClass('active');
            }


        });
    </script>
    <!--  SELECT OPTION TAB END  -->


    <!--  DELETE OPTION TAB START  -->
    <script>
        $(document).on('click', '.optionTab .nav-icon', function () {
            let optionTabNavLink = $(this).closest('.nav-item');
            let optionTabID = optionTabNavLink.find('.nav-link').attr('id')


            $('.optionContent').find(`.tab-pane[aria-labelledby=${optionTabID}]`).remove();
            optionTabNavLink.remove();


            $('.optionTab .nav-link').removeClass('active');
            $('.optionContent .tab-pane').removeClass('active');
            $('.optionContent .tab-pane').removeClass('show');

            $('.optionTab .nav-link').eq(0).addClass('active');
            $('.optionContent .tab-pane').eq(0).addClass('active');


        });
    </script>
    <!--  DELETE OPTION TAB END  -->


    <!--  ADD OPTION START  -->
    <script>
        $(document).on('click', '.option-box-add-container', function () {
            let optionID = $('.optionTab .nav-link.active').find('.optionID').val();
            let tabContentID = $(this).closest('.active').attr('data-uniq-id');
            clearTimeout(addOptionVar);
            addOptionFunction(optionID, tabContentID);

        })

        var addOptionVar;

        function addOptionFunction(optionID, tabContentID) {

            addOptionVar = setTimeout(function () {

                $.ajax({
                    url: "{{ route('admin.product.getOptionAddAjax') }}",
                    type: 'POST',
                    data: {data: true, optionID: optionID, tabContentID: tabContentID},
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success == true) {
                            $('.optionContent .tab-pane.active').find('.option-tbody').append(data.options);

                        } else {
                            toastr.error("Xəta baş verdi");
                        }
                    }
                });

            }, 300);

        }

    </script>
    <!--  ADD OPTION END  -->


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




    <!--  BUTTON IMAGE FOR OPTION ALONE START  -->
    <script>

        $(document).on('click', '.activeButtonAloneOption', function () {
            let imgClassName = $(this).closest('.images-post-container-option').attr('data-class-name');
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderAloneButtonForOptions(x, y, 'Images', imgClassName);

        })

    </script>
    <!--  BUTTON IMAGE FOR OPTION ALONE END  -->



    <script>
        $(document).on('click', '.notPhotoPostAloneOption', function () {
            let imgClassName = $(this).closest('.images-post-container-option').attr('data-class-name');
            $(this).hide();
            $('#image_label-' + imgClassName).val('');
            $('.imgClassName-' + imgClassName).attr("src", noPhoto)
        })
    </script>


    <!--  BUTTON IMAGE FOR OPTION SIZE START  -->
    <script>
        $(function () {
            $('.images-post-container-option .images-post-items').css({'width': 100, 'height': 100});
            $('.images-post-container-option .activeButton').css({'width': 100, 'height': 100});
            $('.images-post-container-option figure img').css({'width': 100, 'height': 100});
            $('.images-post-container-option .custom-preloader-container').hide();
            $('.images-post-container-option .images-post-container-option').show();

            $(window).resize(function () {
                $('.images-post-container-option .images-post-items').css({'width': 100, 'height': 100});
                $('.images-post-container-option .activeButton').css({'width': 100, 'height': 100});
                $('.images-post-container-option figure img').css({'width': 100, 'height': 100});
            });
        });

    </script>
    <!--  BUTTON IMAGE FOR OPTION SIZE END  -->


    <!--  OPTION END  -->



    <!--  SPECIAL PRICE DATE AND TIME START  -->
    <script>
        $('#special_price_start_date').datetimepicker({
            locale: 'az'
        });
        $('#special_price_end_date').datetimepicker({
            useCurrent: false,
            locale: 'az'
        });

        $('#special_price_start_date').on('change.datetimepicker', function (e) {
            $('#special_price_end_date').datetimepicker('minDate', e.date);
        });
        $('#special_price_end_date').on('change.datetimepicker', function (e) {
            $('#special_price_start_date').datetimepicker('maxDate', e.date);
        });
    </script>
    <!--  SPECIAL PRICE DATE AND TIME END  -->

@endsection
