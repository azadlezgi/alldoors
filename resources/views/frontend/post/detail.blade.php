@extends('frontend.layouts.index')

@section('title',empty($post->postsTranlations[0]->title) ? $post->postsTranlations[0]->name : $post->postsTranlations[0]->title)
@section('keywords', $post->postsTranlations[0]->keyword )
@section('description', $post->postsTranlations[0]->description  )


@section('breadcrumb')
    <!-- breadcumb-area-start -->
    <div class="breadcumb-area bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb">
                        <h1 class="name">{{ $post->postsTranlations[0]->name }}</h1>
                        <ul class="links" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.home.index') }}" title="{{ language('genereal.home') }}" itemprop="item">
                                    <span itemprop="name">{{ language('genereal.home') }}</span>
                                    <meta itemprop="position" content="0">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.post.index') }}" title="{{ language('frontend.post.name') }}" itemprop="item">
                                    <span itemprop="name">{{ language('frontend.post.name') }}</span>
                                    <meta itemprop="position" content="1">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.post.detail',$post->slug) }}" title="{{ $post->postsTranlations[0]->name }}" itemprop="item">
                                    <span itemprop="name">{{ $post->postsTranlations[0]->name }}</span>
                                    <meta itemprop="position" content="2">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area-end -->
@endsection

@section('content')


    <!-- page-blog-area-start -->
    <div class="page-blog-details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12 col-12">
                    <div class="page-blog-details">
                        <div class="single-page-blog">
                            @if(!empty($post->image))
                            <div class="bimg">
                                <img src="{{  \App\Services\ImageService::resizeImageSize($post->image,'large',80) }}" alt="{{ $post->postsTranlations[0]->name }}">
                            </div>
                            @endif
                            <div class="content">
                                <h2 class="title">{{ $post->postsTranlations[0]->name }}</h2>
                                <div class="meta">
                                    <div class="date">
                                        <p>
                                            <span><i
                                                    class="far fa-calendar-alt"></i></span>{{ \Illuminate\Support\Carbon::parse($post->created_at)->format('d.m.Y') }}
                                        </p>
                                    </div>
                                </div>
                                <p>{!! $post->postsTranlations[0]->text !!}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12">
                    <div class="sd-sidebar">
                        <div class="sdsw-feature sd-sidebar-widget">
                            <div class="h4 title">{!! language('frontend.blog.latest') !!}</div>
                            <ul class="list">
                                @foreach($posts as $postRecent)
                                    <li><a href="{{ route('frontend.post.detail',$postRecent->slug) }}">
                                    <span class="img">

                                        @if(empty($postRecent->image))
                                            <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                                 alt="{{$postRecent->postsTranlations[0]->name }}">
                                        @else

                                            <img src="{{  \App\Services\ImageService::resizeImageSize($postRecent->image,'thumbnail',80) }}"
                                                 alt="{{$postRecent->postsTranlations[0]->name }}">
                                        @endif
                                    </span>
                                            <span class="content">
                                        <span class="name">{{ str_limit($postRecent->postsTranlations[0]->name,50)  }}</span>
                                        <span class="type">{{ \Illuminate\Support\Carbon::parse($postRecent->created_at)->format('d.m.Y') }}</span>
                                    </span>
                                        </a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sdsw-contact sd-sidebar-widget">
                            <div class="h4 title">{{ language('frontend.contact.name') }}:</div>
                            <div class="sdswc-info-box">
                                <span class="icon"><i class="fas fa-mobile-alt"></i></span>
                                <p class="name">{!! language('frontend.contact.tel') !!}</p>

                                @foreach( json_decode(setting('tel')) as $tel)
                                    <p class="info">
                                        <a href="tel:{{ \App\Services\CommonService::telText( $tel->tel )[0] }}">{{ \App\Services\CommonService::telText( $tel->tel )[1] }}</a>
                                    </p>
                                @endforeach
                            </div>
                            <div class="sdswc-info-box">
                                <span class="icon"><i class="far fa-envelope-open"></i></span>
                                <p class="name">{!! language('frontend.contact.email') !!}:</p>
                                <p class="info">
                                    <a href="mailto:{{  setting('email') }}">{{  setting('email') }}</a>
                                </p>
                            </div>
                            <div class="sdswc-info-box">
                                <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                <p class="name">{!! language('frontend.contact.address') !!}:</p>
                                <p class="info">{{  setting('address',true) }}</p>
                            </div>
                        </div>
                        <div class="sdsw-free sd-sidebar-widget">
                            <div class="h4 title">{!! language('frontend.home.header.free_advice') !!}</div>
                            <form>
                                <div class="sdsw-free-input-box">
                                    <input type="text" class="checkForm"
                                           data-validation-message="{{ language('frontend.contact.form_error_name') }}"
                                           autocomplete="OFF" id="name" name="name"
                                           placeholder="{{ language('frontend.contact.form_name') }}">
                                </div>
                                <div class="sdsw-free-input-box">
                                    <input type="text" class="checkForm"
                                           data-validation-message="{{ language('frontend.contact.form_error_email') }}"
                                           autocomplete="OFF" id="email" name="email"
                                           placeholder="{{ language('frontend.contact.form_email') }}">
                                </div>
                                <div class="sdsw-free-input-box">
                                    <input type="text" class="checkForm"
                                           data-validation-message="{{ language('frontend.contact.form_error_tel') }}"
                                           autocomplete="OFF" id="mobil" name="mobil"
                                           placeholder="{{ language('frontend.contact.form_mobil') }}">
                                </div>
                                <div class="sdsw-free-input-box">
                                     <textarea class=" checkForm"
                                               data-validation-message="{{ language('frontend.contact.form_error_text') }}"
                                               autocomplete="OFF" id="text" name="text"
                                               placeholder="{{ language('frontend.contact.form_text') }}"></textarea>
                                </div>
                                <div class="sdsw-free-input-box">
                                    <div class="submit-form-error mb-4" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    <ul></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="submit-form-success mb-4" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <button id="submitForm" class="btn my-btn-success">
                                            <span
                                                class="submitForm">{{ language('frontend.contact.form_submit') }}</span>
                                        <div class="spinner-box">
                                            <span>{{ language('frontend.contact.form_submit_sending') }}</span>
                                            <span><div id="spinner"></div></span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-blog-area-end -->

        <!-- brands-area-start -->
        <div class="brands-area">
            <div class="container">
                <div class="brand-carousel owl-carousel">


                    @foreach($partners as $partner)
                        <div class="single-brand">
                            <img src="{{ $partner->image }}" alt="{{ $partner->name }}">
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
        <!-- brands-area-end -->
        @endsection

        @section('CSS')
            <style>

                .spinner-box {
                    display: none;
                    justify-content: center;
                    align-items: center;
                }

                .spinner-box span:first-child {
                    margin-right: 10px;
                }

                @keyframes spinner {
                    from {
                        transform: rotate(0deg);
                    }
                    to {
                        transform: rotate(360deg);
                    }
                }


                #spinner {
                    position: relative;
                    width: 30px;
                    height: 30px;
                    min-width: 30px;
                    min-height: 30px;
                    border: 3px solid rgba(255, 255, 255, 0.1);
                    border-right: 5px solid #ffffff;
                    border-radius: 50%;
                    animation: spinner 1s linear infinite;
                }
            </style>
    @endsection

    @section('JS')
        <!--  SUBMIT START  -->
            <script>
                var nameFieldRequiredTranslate = "{!! language('frontend.contact.form_error_name') !!}";
                var emailFieldRequiredTranslate = "{!!  language('frontend.contact.form_error_email') !!}";
                var telFieldRequiredTranslate = "{!! language('frontend.contact.form_error_tel') !!}";
                var textFieldRequiredTranslate = "{!! language('frontend.contact.form_error_text') !!}";
                var successTranslate = "{!! language('frontend.contact.form_submit_success') !!}";
            </script>

            <script>
                $(function () {

                    /*   ERROR MESSAGE   */
                    function errorFormSend(text) {
                        $('.submit-form-error ul').append('<li>' + text + '</li>');
                    }


                    /*   INPUTLRA TIKLANDIQDA ALERTLERI BAGLA   */
                    $(document).on('click', 'input, textarea', function () {
                        $('.submit-form-error').hide();
                        $('.submit-form-error ul').html('');
                        $('.submit-form-success').hide();
                        $('.submit-form-error .alert-success').html('');
                    })


                    /*   SUBMIT BUTTONUNA TIKLANDIQDA   */
                    $(document).on('click', '#submitForm', function (event) {
                        event.preventDefault();

                        /*   SUBMIT BUTTONUNA TIKLANDIQDA ALERTLERI BAGLA   */
                        $('.submit-form-error ul').html('');
                        $('.submit-form-error').hide();
                        $('.submit-form-error .alert-success').html('');
                        $('.submit-form-success').hide();


                        /*   DATALARI AL   */
                        var name = $('#name').val();
                        var subject = $('#subject').val();
                        var email = $('#email').val();
                        var mobil = $('#mobil').val();
                        var text = $('#text').val();


                        /*   ERROR OLDUQUNU CHECK ET   */
                        $(".checkForm").each(function () {
                            if ($(this).val() == "") {
                                $('.submit-form-error').fadeIn();
                                errorFormSend($(this).attr('data-validation-message'))
                            }
                        });

                        /*   EGER ERROR YOXDURSA SUBMIT ET   */
                        if (name != "" && email != "" && mobil != "" && text != "") {

                            $('.submitForm').hide();
                            $('.spinner-box').css('display', 'flex');

                            $.ajax({
                                url: "{{ route('frontend.home.contactSendAjax') }}",
                                type: 'POST',
                                data: {
                                    name: name,
                                    subject: subject,
                                    email: email,
                                    mobil: mobil,
                                    text: text,
                                },
                                dataType: 'JSON',
                                success: function (data) {

                                    /*   EGER ERROR VARSA RESPONSE OLARAQ ALERTE YAZ   */
                                    if (data.error == true) {
                                        $('.submit-form-error ul').html('');
                                        $.each(data.data, function (index, value) {
                                            $('.submit-form-error').fadeIn();
                                            errorFormSend(value)
                                        });

                                        $('.submitForm').show();
                                        $('.spinner-box').css('display', 'none');
                                    }

                                    /*   EGER DOGRUDURSA ALERTE YAZ VE TEMIZLE   */
                                    if (data.success == true) {
                                        $('.submit-form-success').fadeIn();
                                        $('.submit-form-success .alert-success').html(successTranslate);

                                        $(".checkForm").each(function () {
                                            $(this).val('');
                                        });

                                        $('#subject').val('');

                                        $('.submitForm').show();
                                        $('.spinner-box').css('display', 'none');
                                    }


                                }
                            });
                        }


                    })

                })
            </script>
            <!--  SUBMIT END  -->

@endsection



