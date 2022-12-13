@extends('frontend.layouts.index')

@section('title',empty($team->teamsTranlations[0]->title) ? $team->teamsTranlations[0]->name : $team->teamsTranlations[0]->title)
@section('keywords', $team->teamsTranlations[0]->keyword )
@section('description', $team->teamsTranlations[0]->description  )

@section('breadcrumb')
    <!-- breadcumb-area-start -->
    <div class="breadcumb-area bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb">
                        <h1 class="name">{{ $team->teamsTranlations[0]->name }}</h1>
                        <ul class="links" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.home.index') }}" title="{{ language('genereal.home') }}" itemprop="item">
                                    <span itemprop="name">{{ language('genereal.home') }}</span>
                                    <meta itemprop="position" content="0">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.team.index') }}" title="{{ language('frontend.team.name') }}" itemprop="item">
                                    <span itemprop="name">{{ language('frontend.team.name') }}</span>
                                    <meta itemprop="position" content="1">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.team.detail',$team->slug) }}" title="{{ $team->teamsTranlations[0]->name }}" itemprop="item">
                                    <span itemprop="name">{{ $team->teamsTranlations[0]->name }}</span>
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


        <div class="container">
            <div class="row">
                <div class="col-md-4">

                    <div class="team-detail-info-container">
                        <div class="team-detail-item-image">
                            @if(empty($team->image))
                                <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                     alt="{{$team->teamsTranlations[0]->name }}">
                            @else
                                <img src="{{  \App\Services\ImageService::customImageSize($team->image,180,180,80) }}"
                                     alt="{{ $team->teamsTranlations[0]->name }}">
                            @endif
                        </div>

                        @if(!is_null(json_decode($team->social)[0]->name))
                            <div class="team-detail-item-social">
                            <ul class="social">
                                @foreach(json_decode($team->social) as $key => $value)
                                    <li>
                                        <a {{ isset($value->status) ? 'target="_blank"': null }} href="{{ $value->link }}" rel="nofollow">
                                            <i class="socicon-{{ $value->name }}"></i>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                            </div>

                        @endif



                    </div>

                </div>
                <div class="col-md-8">
                    <div class="team-detail-content">
                        <h2>{{ $team->teamsTranlations[0]->name }}</h2>
                        <p>{!! $team->teamsTranlations[0]->text !!}</p>
                    </div>
                </div>
            </div>

        </div>


    <div class="back-team">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="teams-carousel-container">
                        <div class="bdcs-carousel owl-carousel">
                            @foreach($teams as $team)

                                <div class="single-team">

                                    <div class="img @if(is_null(json_decode($team->social)[0]->name)) img-before-none @endif " >
                                        @if(empty($team->image))
                                            <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                                 alt="{{$team->teamsTranlations[0]->name }}">
                                        @else
                                            <img src="{{  $team->image }}"
                                                 alt="{{ $team->teamsTranlations[0]->name }}">
                                        @endif
                                        <div class="content">
                                            <span class="default"><i class="flaticon-network"></i></span>

                                            @if(!is_null(json_decode($team->social)[0]->name))

                                                <ul class="social">
                                                    @foreach(json_decode($team->social) as $key => $value)
                                                        <li>
                                                            <a {{ isset($value->status) ? 'target="_blank"': null }} href="{{ $value->link }}" rel="nofollow">
                                                                <i class="socicon-{{ $value->name }}"></i>
                                                            </a>
                                                        </li>
                                                    @endforeach

                                                </ul>

                                            @endif
                                        </div>
                                    </div>
                                    <div class="team-item-name">
                                        <a href="{{ route('frontend.team.detail',$team->slug) }}">{{ $team->teamsTranlations[0]->name }}</a>
                                    </div>
                                    <div class="team-item-position">
                                        <a href="{{ route('frontend.team.detail',$team->slug) }}">{{ $team->teamsTranlations[0]->position }}</a>
                                    </div>
                                </div>


                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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


                .back-team {
                    margin-top: 60px;
                    background: #fbfbfb;
                    padding: 47px 0px 20px 0px;
                }
                .owl-dots {
                    display: none;
                }

                .team-item-position a {
                    font-size: 15px;
                }

                .team-item-name a {
                    font-size: 17px;
                    font-weight: 600;
                }

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
        $('.team-detail-info-container').sticky({
            topSpacing: 50,
            bottomSpacing: 1400
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



