@extends('frontend.layouts.index')

@section('title',empty($service->servicesTranlations[0]->title) ? $service->servicesTranlations[0]->name : $service->servicesTranlations[0]->title)
@section('keywords', $service->servicesTranlations[0]->keyword )
@section('description', $service->servicesTranlations[0]->description  )


@section('breadcrumb')
    <!-- breadcumb-area-start -->
    <div class="breadcumb-area bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb">
                        <h1 class="name">{{ $service->servicesTranlations[0]->name }}</h1>
                        <ul class="links" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.home.index') }}" title="{{ language('genereal.home') }}" itemprop="item">
                                    <span itemprop="name">{{ language('genereal.home') }}</span>
                                    <meta itemprop="position" content="0">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.service.index') }}" title="{{ language('frontend.service.name') }}" itemprop="item">
                                    <span itemprop="name">{{ language('frontend.service.name') }}</span>
                                    <meta itemprop="position" content="1">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.service.detail',$service->slug) }}" title="{{ $service->servicesTranlations[0]->name }}" itemprop="item">
                                    <span itemprop="name">{{ $service->servicesTranlations[0]->name }}</span>
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



    <!-- service-details-area-start -->
    <div class="service-detials-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="service-details">
                        @if(!empty($service->image))
                            <div class="bd-img">
                                <img  src="{{  \App\Services\ImageService::resizeImageSize($service->image,'large',80) }}"
                                      alt="{{ $service->servicesTranlations[0]->name }}">
                            </div>
                        @endif
                        <p>
                            {!! $service->servicesTranlations[0]->text !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12">
                    <div class="sd-sidebar">
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
                                <p class="info">
                                    <a href="{{ route('frontend.home.contact') }}">{{  setting('address',true) }}</a>
                                </p>
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


            <div class="bd-case-study service-detail-my">
                <h3 class="bdcs-title">{!! language('frontend.service.other_name') !!}</h3>
                <div class="bdcs-carousel owl-carousel">
                    @foreach($services as $service)
                        <div class="signle-bdcs">
                            <a href="{{ route('frontend.service.detail',$service->slug) }}" title="{{ $service->servicesTranlations[0]->name  }}">
                            @if(empty($service->image))
                                <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                     alt="{{$service->servicesTranlations[0]->name }}">
                            @else
                                <img src="{{  \App\Services\ImageService::resizeImageSize($service->image,'other_services',80) }}"
                                     alt="{{$service->servicesTranlations[0]->name }}">
                            @endif
                            </a>
                            <div class="content">
                                <a class="bdcss-title" href="{{ route('frontend.service.detail',$service->slug) }}">{{ str_limit($service->servicesTranlations[0]->name, 42)  }}</a>
{{--                                <a class="bdcss-link" href="{{ route('frontend.service.detail',$service->slug) }}">{!! language('general.read_more') !!}</a>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- service-details-area-end -->


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

    <!-- blog-area-start -->
    <div class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        @if(!empty(language('frontend.blog.top_title')))
                            <div class="h6">{!! language('frontend.blog.top_title') !!}</div>@endif
                        @if(!empty(language('frontend.blog.title')))
                            <h3>{!! language('frontend.blog.title') !!}</h3>@endif
                        @if(!empty(language('frontend.blog.sub_title')))
                            <p>{!! language('frontend.blog.sub_title') !!}</p>@endif
                    </div>
                </div>
            </div>
            <div class="blog-carousel owl-carousel">
                @foreach($posts as $post)
                    <div class="single-blog">
                        <div class="bimg">
                            <a href="{{ route('frontend.post.detail',$post->slug) }}">
                                @if(empty($post->image))
                                    <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                         alt="{{$post->postsTranlations[0]->name }}">
                                @else
                                    <img src="{{  \App\Services\ImageService::resizeImageSize($post->image,'medium',80) }}"
                                         alt="{{$post->postsTranlations[0]->name }}">
                                @endif
                                <span class="icon"><i class="fas fa-link"></i></span>
                            </a>
                            <p class="type">{{ \Illuminate\Support\Carbon::parse($post->created_at)->format('d.m.Y') }}</p>
                        </div>
                        <div class="content">
                            <a class="h4 title" href="{{ route('frontend.post.detail',$post->slug) }}">{{ str_limit($post->postsTranlations[0]->name,30) }}</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- blog-area-end -->


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
    <!-- Jquery sticky -->
    <script src="{{ asset('frontend/assets/plugins/sticky/jquery.sticky.js') }}"></script>
    <script>
        $('.sd-sidebar').sticky({
            topSpacing: 100,
            bottomSpacing: 1900
        });
    </script>


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



