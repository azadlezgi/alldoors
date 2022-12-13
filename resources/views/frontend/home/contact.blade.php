@extends('frontend.layouts.index')

@section('title',empty(language('frontend.contact.title')) ? language('frontend.contact.name') : language('frontend.contact.title'))
@section('keywords', language('frontend.contact.keywords') )
@section('description',language('frontend.contact.description') )

{{--@section('breadcrumb')--}}
{{--    <!-- breadcumb-area-start -->--}}
{{--    <div class="breadcumb-area bg-with-black">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="breadcumb">--}}
{{--                        <h1 class="name">{{ language('frontend.contact.name') }}</h1>--}}
{{--                        <ul class="links">--}}
{{--                            <li><a href="{{ route('frontend.home.index') }}">{!! language('genereal.home') !!}</a></li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('frontend.home.contact') }}">{{ language('frontend.contact.name') }}</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- breadcumb-area-end -->--}}
{{--@endsection--}}

@section('content')


    <!-- contact-details-area-start -->
    <div class="page-contact-details contact-details-area">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        @if(!empty(language('frontend.contact.top_title')))
                            <div class="h6">{!! language('frontend.contact.top_title') !!}</div>@endif
                        @if(!empty(language('frontend.contact.name')))
                            <h1>{!! language('frontend.contact.name') !!}</h1>@endif
                        @if(!empty(language('frontend.contact.sub_title')))
                            <p>{!! language('frontend.contact.sub_title') !!}</p>@endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="all-contact-details">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="single-contact-details">
                                    <div class="icon">
                                        <span class="fas fa-map-marker-alt"></span>
                                    </div>
                                    <div class="h4 title">{!! language('frontend.contact.address') !!}</div>
                                    <p class="desc">{{  setting('address',true) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="single-contact-details">
                                    <div class="icon">
                                        <span class="far fa-envelope"></span>
                                    </div>
                                    <div class="h4 title">{!! language('frontend.contact.email') !!}</div>
                                    <a class="desc" href="mailto:{{  setting('email') }}">{{  setting('email') }}</a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-12">
                                <div class="single-contact-details">
                                    <div class="icon">
                                        <span class="fas fa-phone"></span>
                                    </div>
                                    <div class="h4 title">{!! language('frontend.contact.tel') !!}</div>
                                    @foreach( json_decode(setting('tel')) as $tel)

                                        <a class="desc" href="tel:{{ \App\Services\CommonService::telText( $tel->tel )[0] }}">{{ \App\Services\CommonService::telText( $tel->tel )[1] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-details-area-end -->
    <!-- map-start -->
    <div class="map-area">
        <div class="gmap">
            <div id="googleMap"></div>
        </div>
    </div>
    <!-- map-end -->
    <!-- contact-send-msg-area-start -->
    <div class="contact-send-msg-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        @if(!empty(language('frontend.contact.box.top_title')))
                            <div class="h6">{!! language('frontend.contact.box.top_title') !!}</div>@endif
                        @if(!empty(language('frontend.contact.box.title')))
                            <h2>{!! language('frontend.contact.box.title') !!}</h2>@endif
                        @if(!empty(language('frontend.contact.box.sub_title')))
                            <p>{!! language('frontend.contact.box.sub_title') !!}</p>@endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="question-form-area">
                        <div class="cf-msg"></div>
                        <form id="formSend">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="cf-box">

                                        <input type="text" class="form-control checkForm"
                                               data-validation-message="{{ language('frontend.contact.form_error_name') }}"
                                               autocomplete="OFF" id="name" name="name"
                                               placeholder="{{ language('frontend.contact.form_name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="cf-box">
                                        <input type="text" class="form-control checkForm"
                                               data-validation-message="{{ language('frontend.contact.form_error_email') }}"
                                               autocomplete="OFF" id="email" name="email"
                                               placeholder="{{ language('frontend.contact.form_email') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="cf-box">
                                        <input type="text" class="form-control checkForm"
                                               data-validation-message="{{ language('frontend.contact.form_error_tel') }}"
                                               autocomplete="OFF" id="mobil" name="mobil"
                                               placeholder="{{ language('frontend.contact.form_mobil') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="cf-box">

                                        <textarea class="contact-textarea checkForm"
                                                  data-validation-message="{{ language('frontend.contact.form_error_text') }}"
                                                  autocomplete="OFF" id="text" name="text"
                                                  placeholder="{{ language('frontend.contact.form_text') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="cf-box">
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

                                        <button id="submitForm" class="cont-submit btn-contact">
                                            <span
                                                class="submitForm">{{ language('frontend.contact.form_submit') }}</span>
                                            <div class="spinner-box">
                                                <span>{{ language('frontend.contact.form_submit_sending') }}</span>
                                                <span><div id="spinner"></div></span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-send-msg-area-end -->
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



