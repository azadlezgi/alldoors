@extends('frontend.layouts.index')

@section('title',empty(language('frontend.contact.title')) ? language('frontend.contact.name') : language('frontend.contact.title'))
@section('keywords', language('frontend.contact.keywords') )
@section('description',language('frontend.contact.description') )

@section('breadcrumb')

    <main class="main main--mt">
        <div class="container">
            <ul itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
                <li>
                    <div itemscope="itemscope" itemprop="itemListElement" itemtype="http://schema.org/ListItem"
                         class="breadcrumbs__item">
                        <a itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing"
                           href="{{ route('frontend.home.index') }}">
                            <span itemprop="name">{{ language('genereal.home_page') }}</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </div>
                </li>
                <li>
                    <div itemscope="itemscope" itemprop="itemListElement" itemtype="http://schema.org/ListItem"
                         class="breadcrumbs__item">
                        <a itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing"
                           href="{{ route('frontend.home.contact') }}">
                            <span itemprop="name">{{ language('frontend.contact.name') }}</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </div>
                </li>
            </ul>
        </div>

        @endsection

        @section('content')



            <div class="container">

                @if(!empty(setting('map')))
                    <div>
                        {!! setting('map') !!}
                    </div>
                @endif

                <div class="index-map__wrapper">
                    <div class="index-map__text mb-4">
                        <div class="h2">{{ language('frontend.home.contact_us') }}</div>
                        @if(!empty(setting('address',true)))
                            <address
                                class="index-map__info index-map__info_address">{!! setting('address',true) !!}</address>
                        @endif
                        @if(!empty(json_decode(setting('tel'))))
                            <div class="index-map__info index-map__info_phone">
                                @foreach(json_decode(setting('tel')) as $key => $value)
                                    {{--                                    @if($loop->first)--}}
                                    <span>
                                            <a href="tel:{{ \App\Services\CommonService::telText( $value->tel )[0] }}"
                                               style="color: #0c0e1a">{{ \App\Services\CommonService::telText( $value->tel )[1] }}</a>
                                        </span>
                                    {{--                                    @endif--}}
                                @endforeach
                            </div>
                        @endif
                        @if(!empty(setting('email')))
                            <div class="index-map__info index-map__info_email">{!! setting('email') !!}</div>
                        @endif
                    </div>
                    <div class="index-map__map-wrapper">

                        <div class="question-form-area mt-5">
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
                                    <div class="col-lg-12 col-sm-12 col-12 pt-4 pb-4">
                                        <div class="cf-box">

                                        <textarea class="contact-textarea checkForm form-control"
                                                  data-validation-message="{{ language('frontend.contact.form_error_text') }}"
                                                  autocomplete="OFF" id="text" name="text"
                                                  placeholder="{{ language('frontend.contact.form_text') }}"
                                                  style="height: 120px;"
                                        ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="cf-box">
                                            <div class="submit-form-error mb-4" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger m-0">
                                                            <ul class="m-0 p-0"></ul>
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

                                            <button id="submitForm" class="cont-submit btn-contact btn btn_block btn_accent">
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
                {{--                    <a href="{{ route('frontend.home.contact') }}" class="btn btn_block btn_accent index-map__btn">--}}
                {{--                        {{ language('frontend.home.contact_us') }}--}}
                {{--                    </a>--}}
            </div>

    </main>

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



