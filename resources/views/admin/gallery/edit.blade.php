@extends('admin.layouts.index')
@section('title')
    Qalereya redaktə et
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
                            <a href="{{ route('admin.gallery.index') }}" class="text-muted">Qalereyalar</a>
                        </li>

                        <li class="breadcrumb-item">
                            Qalereya redaktə et
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
                                        <a class="nav-link" data-toggle="tab" href="#tab-page-seo">
                                            <span class="nav-text font-size-lg">SEO</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#tab-page-images">
                                            <span class="nav-text font-size-lg">Şəkillər</span>
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
                            <form class="form" id="submit-form" action="{{ route('admin.gallery.update') }}"
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
                                                                                value="{{ old('name.'. $language->id,getTranslateData($gallery->galleriesTranlations,$language->id,'name')) }}"
                                                                                class=" form-control">
                                                                            @error('name.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  NAME END  -->


                                                                        <!--  CONTENT START  -->
                                                                        <div class="form-group">
                                                                            <span class="span-dvidder">Mətn ({{ $language->code }})</span>
                                                                            <textarea
                                                                                type="text"
                                                                                name="text[{{ $language->id }}]"
                                                                                class="tinymceEditor form-control">{{ old('text.'. $language->id,getTranslateData($gallery->galleriesTranlations,$language->id,'text')) }}</textarea>
                                                                            @error('text.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>
                                                                        <!--  CONTENT END  -->


                                                                    </div>

                                                                @endforeach


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
                                                                                value="{{ old('title.'. $language->id,getTranslateData($gallery->galleriesTranlations,$language->id,'title')) }}"
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
                                                                                value="{{ old('keyword.'. $language->id,getTranslateData($gallery->galleriesTranlations,$language->id,'keyword')) }}"
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
                                                                                class=" form-control">{{ old('description.'. $language->id,getTranslateData($gallery->galleriesTranlations,$language->id,'description')) }}</textarea>
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
                                                                        value="{{ old('slug',$gallery->slug) }}"
                                                                        class=" form-control">
                                                                    @error('slug' )<span
                                                                        class="text-danger">{{ $message }}</span> @enderror

                                                                    @foreach(cache('key-all-languages') as $key => $language)
                                                                        <div class="input-group mt-2">
                                                                            <div class="input-group-prepend">
                                                                            <span style="padding: 0 5px"
                                                                                  class="input-group-text"> <img
                                                                                    style="width: 20px;"
                                                                                    src="{{ countryFlag($language->code) }}"/></span>
                                                                            </div>

                                                                            <div class="input-group-prepend">
                                                                            <span style="padding: 0 5px"
                                                                                  class="input-group-text">{{ env('APP_URL') }}</span>
                                                                            </div>

                                                                            <input
                                                                                style="height: 21px;"
                                                                                type="text" readonly
                                                                                value="{{$language->code == cache('language-default') ? "": "/".$language->code}}/gallery/{{ $gallery->slug }}"
                                                                                class="form-control">
                                                                        </div>

                                                                    @endforeach


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
                                                                        <div class="far fa-image"></div>
                                                                    </div>

                                                                    <div class="videos-box-add addVideoModalButton"
                                                                         data-toggle="modal"
                                                                         data-target="#addVideoModalButton">
                                                                        <div class="fa fa-plus"></div>
                                                                        <div class="fab fa-youtube"></div>
                                                                    </div>


                                                                    <!--  JavaScriptle bura elave edir  -->
                                                                    <div id="sortable"
                                                                         class="images-box-item-container">
                                                                        @if(old('files') != null)
                                                                            @foreach(old('files')['type'] as $oldFileTypeKey => $oldFileType)
                                                                                @if($oldFileType == 1)

                                                                                    <div class="images-box-item">
                                                                                        <div class="removeButton">
                                                                                            <span
                                                                                                class="fa fa-times"></span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="gallery-image-tools-box">
                                                                                            <i class="far fa-image"></i>

                                                                                            <div data-element-type="1"
                                                                                                 data-element-url="{{ old('files')['link'][$oldFileTypeKey] }}"
                                                                                                 class="fa fa-eye showImageOrVideoModalButton"
                                                                                                 data-toggle="modal"
                                                                                                 data-target="#showImageOrVideoModalButton"></div>
                                                                                        </div>
                                                                                        <img width="200"
                                                                                             src="{{ old('files')['link'][$oldFileTypeKey] }}">
                                                                                        <input form="submit-form"
                                                                                               type="hidden"
                                                                                               name="files[link][]"
                                                                                               value="{{ old('files')['link'][$oldFileTypeKey] }}">
                                                                                        <input form="submit-form"
                                                                                               type="hidden"
                                                                                               name="files[type][]"
                                                                                               value="1">
                                                                                    </div>

                                                                                @endif

                                                                                @if($oldFileType == 2)
                                                                                    <div class="images-box-item">
                                                                                        <div class="removeButton">
                                                                                            <span
                                                                                                class="fa fa-times"></span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="gallery-video-tools-box">
                                                                                            <div
                                                                                                class="fab fa-youtube"></div>
                                                                                            <div data-element-type="2"
                                                                                                 data-element-url="{{ old('files')['link'][$oldFileTypeKey] }}"
                                                                                                 class="fa fa-eye showImageOrVideoModalButton"
                                                                                                 data-toggle="modal"
                                                                                                 data-target="#showImageOrVideoModalButton"></div>
                                                                                        </div>
                                                                                        <img width="200"
                                                                                             src="https://img.youtube.com/vi/{{ old('files')['link'][$oldFileTypeKey] }}/default.jpg">
                                                                                        <input form="submit-form"
                                                                                               type="hidden"
                                                                                               name="files[link][]"
                                                                                               value="{{ old('files')['link'][$oldFileTypeKey] }}">
                                                                                        <input form="submit-form"
                                                                                               type="hidden"
                                                                                               name="files[type][]"
                                                                                               value="2">
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach

                                                                        @else
                                                                            @if(!empty($gallery->images))
                                                                                <?php $filesLinks = json_decode($gallery->images,true)['link']; ?>
                                                                                @foreach(json_decode($gallery->images,true)['type'] as $filesDataTypeKey => $filesDataTypeValue)
                                                                                    @if($filesDataTypeValue == 1)

                                                                                        <div class="images-box-item">
                                                                                            <div class="removeButton">
                                                                                            <span
                                                                                                class="fa fa-times"></span>
                                                                                            </div>
                                                                                            <div
                                                                                                class="gallery-image-tools-box">
                                                                                                <i class="far fa-image"></i>

                                                                                                <div data-element-type="1"
                                                                                                     data-element-url="{{ $filesLinks[$filesDataTypeKey] }}"
                                                                                                     class="fa fa-eye showImageOrVideoModalButton"
                                                                                                     data-toggle="modal"
                                                                                                     data-target="#showImageOrVideoModalButton"></div>
                                                                                            </div>
                                                                                            <img width="200"
                                                                                                 src="{{ $filesLinks[$filesDataTypeKey] }}">
                                                                                            <input form="submit-form"
                                                                                                   type="hidden"
                                                                                                   name="files[link][]"
                                                                                                   value="{{ $filesLinks[$filesDataTypeKey] }}">
                                                                                            <input form="submit-form"
                                                                                                   type="hidden"
                                                                                                   name="files[type][]"
                                                                                                   value="1">
                                                                                        </div>

                                                                                    @endif

                                                                                    @if($filesDataTypeValue == 2)
                                                                                        <div class="images-box-item">
                                                                                            <div class="removeButton">
                                                                                            <span
                                                                                                class="fa fa-times"></span>
                                                                                            </div>
                                                                                            <div
                                                                                                class="gallery-video-tools-box">
                                                                                                <div
                                                                                                    class="fab fa-youtube"></div>
                                                                                                <div data-element-type="2"
                                                                                                     data-element-url="{{ $filesLinks[$filesDataTypeKey] }}"
                                                                                                     class="fa fa-eye showImageOrVideoModalButton"
                                                                                                     data-toggle="modal"
                                                                                                     data-target="#showImageOrVideoModalButton"></div>
                                                                                            </div>
                                                                                            <img width="200"
                                                                                                 src="https://img.youtube.com/vi/{{ $filesLinks[$filesDataTypeKey] }}/default.jpg">
                                                                                            <input form="submit-form"
                                                                                                   type="hidden"
                                                                                                   name="files[link][]"
                                                                                                   value="{{ $filesLinks[$filesDataTypeKey] }}">
                                                                                            <input form="submit-form"
                                                                                                   type="hidden"
                                                                                                   name="files[type][]"
                                                                                                   value="2">
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
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


                            <!--  ID  -->
                            <input type="hidden" form="submit-form" name="id" value="{{ $gallery->id }}">


                            <!--  STATUS  -->
                            <div class="form-group row">
                                <label for="status" class="col-lg-3 col-form-label">Status</label>
                                <div class="col-lg-9">
                                    <select form="submit-form" class="form-control" name="status">
                                        <option {{ $gallery->status == 1?'selected':'' }} value="1">Aktiv</option>
                                        <option {{ $gallery->status == 0?'selected':'' }} value="0">Passiv</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="save-tools-item">
                                        <div>Tarix yaradılma:</div>
                                        <div>{{ \Illuminate\Support\Carbon::parse($gallery->created_at)->format('Y-m-d H:i') }}</div>
                                    </div>
                                    <div class="save-tools-item">
                                        <div>Tarix yenilənmə:</div>
                                        <div>{{ updateDate($gallery->updated_at,$gallery->galleriesTranlations) }}</div>
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

                                        {{ \App\Services\CategoriesService::getTreeEditGalleryCategories($defaultLanguage,0,$selectCategories) }}

                                    </div>
                                </div>
                            </div>

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
                                                style="display: {{ old('image',$gallery->image) == null? 'none':'flex' }}"
                                                tooltip="Sil"
                                                class="notPhotoPost notPhotoPostAlone">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </div>
                                            <figure
                                                class="activeButton"
                                            >

                                                <img
                                                    src="{{old('image',$gallery->image) == null ? asset('storage/no-image.png'): old('image',$gallery->image) }}"
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
                                               value="{{ old('image',$gallery->image) }}"
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


    <!--Elave et Modal START-->
    <div class="modal fade" id="addVideoModalButton" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalSizeLg" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Video əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body ">
                    <input form="submit-form" class="form-control gallery-youtube-url" type="text"
                           placeholder="Youtube link">
                    <span class="gallery-modal-error text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger font-weight-bold closeVideoModalButton"
                            data-dismiss="modal">Bağla
                    </button>
                    <button type="button" class="btn gallery-video-add btn-success font-weight-bold">Əlavə et</button>
                </div>
            </div>
        </div>
    </div>
    <!--Elave et Modal END-->



    <!-- FOTO VE YA VIDEO GOSTER Modal START-->
    <div class="modal fade" id="showImageOrVideoModalButton" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalSizeLg" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body ">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger font-weight-bold closeImageOrVideoModal"
                            data-dismiss="modal">Bağla
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- FOTO VE YA VIDEO GOSTER Modal END-->


@endsection

@section('CSS')
    <style>
        .modal-backdrop.show {
            opacity: 0.2 !important;
        }

        .modal-backdrop {
            background-color: #000 !important;
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


    <!--  BUTTON IMAGE START  -->
    <script>

        $(document).on('click', '.activeButton', function () {
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderAloneButton(x, y, 'Images');


        })


    </script>
    <!--  BUTTON IMAGE END  -->

    <!--  BUTTON IMAGE ALONE MULTIPLE START  -->
    <script>

        $(document).on('click', '.images-box-add', function () {
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderAloneButtonMultipleImageAndVideo(x, y, 'Images');

        })

    </script>
    <!--  BUTTON IMAGE ALONE MULTIPLE END  -->

    <!-- BUTTON IMAGE ALONE MULTIPLE REMOVESTART   -->
    <script>
        $(document).on('click', '.removeButton', function () {
            $(this).parent().remove();
        })
    </script>
    <!-- BUTTON IMAGE ALONE MULTIPLE REMOVE END   -->


    <!-- BUTTON VIDEO ADD START   -->
    <script>
        $(document).on('click', '.gallery-video-add', function () {
            let youtubeUrl = $('.gallery-youtube-url').val();


            if (youtubeUrl == '') {
                $('.gallery-modal-error').html('Link boş ola bilməz');
                $('.gallery-modal-error').show();
            } else {

                let trimYoutubeUrl = /^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/|shorts\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/;
                let make_youtubeID = youtubeUrl.match(trimYoutubeUrl);
                if (make_youtubeID) {


                    $('#sortable').append(`<div class="images-box-item">
                        <div class="removeButton">
                            <span class="fa fa-times"></span>
                        </div>
                         <div class="gallery-video-tools-box">
                           <div class="fab fa-youtube"></div>
                          <div data-element-type="2" data-element-url="${make_youtubeID[1]}" class="fa fa-eye showImageOrVideoModalButton" data-toggle="modal" data-target="#showImageOrVideoModalButton" ></div>
                        </div>
                        <img width="200" src="https://img.youtube.com/vi/${make_youtubeID[1]}/default.jpg" >
                        <input form="submit-form" type="hidden" name="files[link][]" value="${make_youtubeID[1]}">
                        <input form="submit-form" type="hidden" name="files[type][]" value="2">
                    </div>`)

                    $('#addVideoModalButton').modal('hide');
                    $('.gallery-youtube-url').val('');
                } else {
                    $('.gallery-modal-error').html('Səhv youtube formatı');
                    $('.gallery-modal-error').show();
                }


            }

        });


        <!--  GALLERY SHOW ERROR START  -->
        $(document).on('keyup', '.gallery-youtube-url', function () {
            $('.gallery-modal-error').hide();
        });
        <!--  GALLERY SHOW ERROR END  -->


    </script>
    <!-- BUTTON VIDEO ADD END   -->


    <!--  SHOW VIDEO AND IMAGE MODAL START   -->
    <script>
        $(document).on('click', '.showImageOrVideoModalButton', function () {
            let elementType = $(this).attr('data-element-type');

            if (elementType == 2) {
                let elementUrl = $(this).attr('data-element-url');
                $('#showImageOrVideoModalButton .modal-body').html(`
           <iframe src="https://www.youtube.com/embed/${elementUrl}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen="true" width="100%" height="400">
            </iframe>
           `);
            }

            if (elementType == 1) {
                let elementUrl = $(this).attr('data-element-url');
                $('#showImageOrVideoModalButton .modal-body').html(`<img style="width: 100%" src="${elementUrl}">`);
            }

        });
    </script>
    <!--  SHOW VIDEO AND IMAGE MODAL END  -->


    <!--  CLOSE VIDEO AND IMAGE SHOW MODAL START   -->
    <script>
        $(document).on('click', '.closeImageOrVideoModal, .ki-close', function () {
            $('#showImageOrVideoModalButton .modal-body').html('');
            $('.gallery-youtube-url').val('');
            $('.gallery-modal-error').hide();
        });
    </script>
    <!--  CLOSE VIDEO AND IMAGE SHOW MODAL END  -->


    <!--  CLOSE VIDEO MODAL START   -->
    <script>
        $(document).on('click', '.closeVideoModalButton', function () {
            $('#showImageOrVideoModalButton .modal-body').html('');
            $('.gallery-youtube-url').val('');
            $('.gallery-modal-error').hide();
        });

        $('#addVideoModalButton').on('hidden.bs.modal', function () {
            $('.gallery-youtube-url').val('');
            $('.gallery-modal-error').hide();
        })

        $('#showImageOrVideoModalButton').on('hidden.bs.modal', function () {
            $('#showImageOrVideoModalButton .modal-body').html('');
        })
    </script>
    <!--  CLOSE VIDEO MODAL END  -->

@endsection
