@extends('admin.layouts.index')
@section('title')
    Əməkdaş əlavə et
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
                            <a href="{{ route('admin.team.index') }}" class="text-muted">Əməkdaşlar</a>
                        </li>

                        <li class="breadcrumb-item">
                            Əməkdaş əlavə et
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
                                </ul>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <form class="form" id="submit-form" action="{{ route('admin.team.store') }}"
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


                                                                        <!--  POSITION  -->
                                                                        <div class="form-group">

                                                                            <span class="span-dvidder">Vəzifə ({{ $language->code }})</span>
                                                                            <input
                                                                                type="text"
                                                                                name="position[{{ $language->id }}]"
                                                                                value="{{ old('position.'. $language->id) }}"
                                                                                class=" form-control">
                                                                            @error('position.'. $language->id )<span
                                                                                class="text-danger">{{ myError($message) }}</span> @enderror
                                                                        </div>


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


                                                                    </div>

                                                                @endforeach


                                                            </div>

                                                            <div class="hr-dvidder"></div>

                                                            <!--  SOCIAL START  -->
                                                            <span class="span-dvidder">Social</span>
                                                            <div style="display: none" class="removeAllSocialicons  mb-5 mt-5">
                                                                <div class="btn btn-sm font-weight-bolder btn-light-danger">Iconları ləğv
                                                                    et
                                                                </div>
                                                            </div>
                                                            <div style="display: none" class="repeaterForm">
                                                                <div class=" row">
                                                                    <div  data-repeater-list="social" class="col-lg-12 sortableElements socialIconsContainer">


                                                                        @if(old('social') == null)

                                                                            <div data-repeater-item=""
                                                                                 class="form-group row">
                                                                                <div class="col-md-3">
                                                                                    <label class="socialIcons">
                                                                                        <input class="socialIconsInput" data-check="0"
                                                                                               type="text"
                                                                                               name="name">
                                                                                        <div data-toggle="modal"
                                                                                             data-target="#exampleModalPopovers"
                                                                                             class="social-icons-container">
                                                                        <span class="socialIconsItem">
                                                                            <i></i>
                                                                        </span>
                                                                                            <span
                                                                                                class="socialIconName">Icon Seç</span>
                                                                                            <div class="socialIconsArrow">
                                                                                                <i class="fas fa-chevron-down"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                    <div class="d-md-none mb-2"></div>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <input type="text" class="form-control" name="link"
                                                                                           value="{{ isset($value['link']) ? $value['link']:null }}"
                                                                                           placeholder="Link"/>
                                                                                    <div class="d-md-none mb-2"></div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="checkbox-inline">
                                                                                        <label class="checkbox checkbox-success">
                                                                                            <input type="checkbox" name="status"
                                                                                                {{ isset($value['status']) ? 'checked="checked"':null }}/>
                                                                                            <span></span>Yeni səhifə</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2 checkDeleteButton">
                                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                                       class="btn btn-sm font-weight-bolder btn-light-danger">
                                                                                        <i class="la la-trash-o"></i>Sil</a>
                                                                                </div>
                                                                            </div>

                                                                        @else


                                                                            @foreach(old('social') as $key => $value)

                                                                                <div data-repeater-item=""
                                                                                     class="form-group row">
                                                                                    <div class="col-md-3">
                                                                                        <label class="socialIcons">
                                                                                            <input class="socialIconsInput" data-check="0"
                                                                                                   type="text"
                                                                                                   value="{{ isset($value['name']) ? $value['name']:null }}"
                                                                                                   name="name">
                                                                                            <div data-toggle="modal"
                                                                                                 data-target="#exampleModalPopovers"
                                                                                                 class="social-icons-container">
                                                                            <span
                                                                                class="socialIconsItem">
                                                                                <i class="socicon-{{ isset($value['name']) ? $value['name']:null }} text-dark-50"></i>
                                                                            </span>
                                                                                                <span
                                                                                                    class="socialIconName">{{ isset($value['name']) ? $value['name']:'Icon Seç' }}</span>
                                                                                                <div class="socialIconsArrow">
                                                                                                    <i class="fas fa-chevron-down"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </label>
                                                                                        <div class="d-md-none mb-2"></div>
                                                                                    </div>
                                                                                    <div class="col-md-5">
                                                                                        <input type="text" class="form-control" name="link"
                                                                                               value="{{ isset($value['link']) ? $value['link']:null }}"
                                                                                               placeholder="Link"/>
                                                                                        <div class="d-md-none mb-2"></div>
                                                                                    </div>
                                                                                    <div class="col-md-2">
                                                                                        <div class="checkbox-inline">
                                                                                            <label class="checkbox checkbox-success">
                                                                                                <input type="checkbox" name="status"
                                                                                                    {{ isset($value['status']) ? 'checked="checked"':null }}/>
                                                                                                <span></span>Yeni səhifə</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-2 checkDeleteButton">
                                                                                        <a href="javascript:;" data-repeater-delete=""
                                                                                           class="btn btn-sm font-weight-bolder btn-light-danger">
                                                                                            <i class="la la-trash-o"></i>Sil</a>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                <div class=" row">
                                                                    <div class="repeatBtn">
                                                                        <a href="javascript:;" data-repeater-create=""
                                                                           class="btn btn-sm font-weight-bolder btn-light-success">
                                                                            <i class="la la-plus"></i>Əlavə et</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--  SOCIAL END  -->


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

                        <div  class="card-footer myCardFooterPadding">
                            <div class=" d-flex justify-content-end">
                                <button type="submit" form="submit-form" class="btn btn-success btn-sm ">Göndər
                                </button>
                            </div>
                        </div>

                    </div>

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
                                                class="activeButton"
                                            >

                                                <img
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

    <!--  ICONS MODAL START  -->
    <div class="modal fade" id="exampleModalPopovers" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sosial İkonlar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="sociconsModalBar ">
                        <input type="text" class="form-control mb-4" autocomplete="OFF" id="searchSocialIcons" placeholder="Axtar...">
                    </div>
                    <div class="sociconsModalContainer">

                        <!--  ICON START  -->
                        <span
                            data-dismiss="modal"
                            data-socicon="noicon"
                            class="sociconsItem"
                        >

                              <div class="sociconsItemIcon">
                                   <i class="fas fa-ban"></i>
                              </div>
                              <div class="sociconsItemCaption">İkonsuz</div>
                      </span>
                        <!--  ICON END  -->


                    @foreach(\App\Services\CommonService::socialIcons() as $icon)
                        <!--  ICON START  -->
                            <span
                                data-dismiss="modal"
                                data-socicon="{{ $icon }}"
                                class="sociconsItem"
                            >

                          <div class="sociconsItemIcon">
                               <i class="socicon-{{ $icon }}"></i>
                          </div>
                          <div class="sociconsItemCaption">{{ strtoupper($icon) }}</div>
                      </span>
                            <!--  ICON END  -->
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--  ICONS MODAL END  -->

@endsection

@section('CSS')
    <style>

        .modal {
            background: rgba(0, 0, 0, 0.08) !important;
        }

        @media (min-width: 576px) {
            .modal-content {
                -webkit-box-shadow: 0 0 1.5rem 0 rgba(0, 0, 0, 0.10);
                box-shadow: 0 0 1.5rem 0 rgba(0, 0, 0, 0.10);
            }
        }

        .span-dvidder {
            display: block;
        }
        .removeAllSocialicons {
            display: inline-block;
        }

        .repeatBtn {
            padding-right: 12.5px;
            padding-left: 12.5px;
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
            ckfinderAloneButton(x,y,'Images');


        })


    </script>
    <!--  BUTTON IMAGE END  -->

    <!--  REPEAT JS START  -->
    <script>
        // Class definition
        var KTFormRepeater = function () {

            // Private functions
            var repeatForm = function () {
                $('.repeaterForm').repeater({
                    initEmpty: false,
                    isFirstItemUndeletable: true,

                    // defaultValues: {
                    //     'link': 'default value'
                    // },

                    show: function () {
                        $(this).slideDown();
                    },

                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });
            }

            return {
                // public functions
                init: function () {
                    repeatForm();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTFormRepeater.init();
        });
    </script>
    <!--  REPEAT JS END  -->

    <!--  REPEAT BTN START  -->
    <script>
        $(document).on('click', '.repeatBtn', function () {
            const socialIcon = $(".socialIcons");
            socialIcon.last().find('.activeInput').val('');
            socialIcon.last().find('.socialIconsItem').html(`<i ></i>`);
            socialIcon.last().find('.socialIconName').html('Icon Seç');

        })
    </script>
    <!--  REPEAT BTN END  -->


    <!--  SOCIAL ICONS START  -->
    <script>
        $(document).on('click', '.sociconsItem', function () {
            let socIcon = $(this).data('socicon');

            if (socIcon == 'noicon') {

                // Iconsuz tiklandiqda
                $('.activeInput').val('');
                $('.socialIconsActive').find('.socialIconsItem').html(`<i ></i>`);
                $('.socialIconsActive').find('.socialIconName').html('Icon Seç');

            } else {

                $('.activeInput').val(socIcon);
                $('.socialIconsActive').find('.socialIconsItem').html(`<i class="socicon-${socIcon} text-dark-50"></i>`);
                $('.socialIconsActive').find('.socialIconName').html(socIcon.toUpperCase());

            }

        })

        // Icon SEC TIKLANDIQDA
        $(document).on('click', '.socialIcons', function () {
            $('.socialIcons').each(function () {
                $(this).removeClass('socialIconsActive');
                $(this).find('.socialIconsInput').removeClass('activeInput');
            })
            $(this).addClass('socialIconsActive');
            $(this).find('.socialIconsInput').addClass('activeInput');

        })

        $(document).on('click', '.removeAllSocialicons', function () {
            $('.socialIconsContainer').html('');
            $('.socialIconsContainer').html(`
            <div data-repeater-item="" class="form-group row ui-sortable-handle" style="">
            <div class="col-md-3">
                <label class="socialIcons">
                    <input class="socialIconsInput" data-check="0" type="text" name="social[0][name]">
                    <div data-toggle="modal" data-target="#exampleModalPopovers" class="social-icons-container">
            <span class="socialIconsItem">
                <i></i>
            </span>
                        <span class="socialIconName">Icon Seç</span>
                        <div class="socialIconsArrow">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </label>
                <div class="d-md-none mb-2"></div>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="social[0][link]" value="" placeholder="Link">
                <div class="d-md-none mb-2"></div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-inline">
                    <label class="checkbox checkbox-success">
                        <input type="checkbox" name="social[0][status][]">
                        <span></span>Yeni səhifə</label>
                </div>
            </div>
            <div class="col-md-2 checkDeleteButton"></div>
        </div>

            `);
        })

        /*   SOCIAL ICONS SEARCH START   */
        $(document).on('keyup','#searchSocialIcons',function (){
            let socialIconSearchText = $(this).val();
            clearTimeout(searchIconVar);
            socialIconsSearch(socialIconSearchText);
        })


        var searchIconVar;

        function socialIconsSearch(inputVal) {
            searchIconVar = setTimeout(function () {

                $.ajax({
                    url: "{{ route('admin.setting.searchIcons') }}",
                    type: 'POST',
                    data: {text: inputVal},
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success == true) {
                            var socialIconArr = response.data;
                            $('.sociconsModalContainer').html('');

                            if(response.isExists == 0){

                                $('.sociconsModalContainer').append(`
                                    <span
                                                data-dismiss="modal"
                                                data-socicon="noicon"
                                                class="sociconsItem"
                                            >

                                          <div class="sociconsItemIcon">
                                               <i class="fas fa-ban"></i>
                                          </div>
                                          <div class="sociconsItemCaption">İkonsuz</div>
                                  </span>
                                `);

                                socialIconArr.forEach(function (value){

                                    $('.sociconsModalContainer').append(`
                                                                      <span
                                                data-dismiss="modal"
                                                data-socicon="${value}"
                                                class="sociconsItem"
                                            >

                                          <div class="sociconsItemIcon">
                                               <i class="socicon-${value}"></i>
                                          </div>
                                          <div class="sociconsItemCaption">${value.toUpperCase()}</div>
                                      </span>
                                    `);
                                })


                            }else {
                                socialIconArr.forEach(function (value){

                                    $('.sociconsModalContainer').append(`
                                                                      <span
                                                data-dismiss="modal"
                                                data-socicon="${value}"
                                                class="sociconsItem"
                                            >

                                          <div class="sociconsItemIcon">
                                               <i class="socicon-${value}"></i>
                                          </div>
                                          <div class="sociconsItemCaption">${value.toUpperCase()}</div>
                                      </span>
                                    `);
                                })
                            }

                        } else {
                            toastr.error("Xəta baş verdi");
                        }
                    }
                });

            }, 500);

        }

        /*   SOCIAL ICONS SEARCH END   */

    </script>
    <!--  SOCIAL ICONS END  -->

    <script>
        /*   Sortable SOCIAL START   */
        $(".sortableElements").sortable({
            stop:function (){
                let uiSortablehandle = $('.socialIconsContainer').find('.ui-sortable-handle');
                uiSortablehandle.each(function (index){
                   if(index == 0){
                       $(this).find('.checkDeleteButton').html('');
                   }else {
                       $(this).find('.checkDeleteButton').html(`
                     <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                    <i class="la la-trash-o"></i>Sil</a>
                       `);
                   }
                });

            }
        });
        $(".sortableElements").disableSelection();
        /*   Sortable SOCIAL END   */


        $(function (){
            $('.repeaterForm').show();
            $('.removeAllSocialicons').show();
        })
    </script>

@endsection
