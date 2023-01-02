<div class="footer">
    <div class="container">
        <div class="footer-inner">
            <div class="footer__top-line">
                <div class="logo footer__logo">
                    <span class="logo__link">
                        <img src="{{ asset('storage') }}/{{ setting('logo') }}" alt="{{ language('general.title') }}"
                             width="225" height="70">
                    </span>
                </div>


                @if(!empty(json_decode(setting('social'))))
                    <div class="socials footer__socials">
                        <span class="socials__desc">{{ language('genereal.we_social') }}</span>
                        @foreach(json_decode(setting('social')) as $key => $value)
                            <a
                                rel="nofollow"
                                target="_blank"
                                href="{{ $value->link }}"
                                class="socials__item socials__item_{{ $value->name }}"
                            >
                                <i class="icon socicon-{{ $value->name }}"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="footer__bottom-line">
                <div>
                    <span class="footer__year">AllDoors &copy; 2022 {{ language('general.rights_reserved') }}</span>
                    <div class="footer__copyright">{!! language('general.copyright') !!}</div>
                </div>
                <div class="footer_menu">
                    <ul class="footer-menu__list">
                        @php
                            $params = [
                                'li_class' => "footer-menu__item",
                                'a_class' => "footer-menu__link text-uppercase"
                            ];
                        @endphp
                        {!! \App\Services\MenuServices::getMenu($HTTP_HOST,$languageID,2,0,[], $params) !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="call_usModal" tabindex="-1" aria-labelledby="call_usModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="call_usModalLabel">{{ language('general.call_us_modal_title') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-layout">
                    <form action="/api/form/callback/" method="POST" class="form">
                        <div>
                            <p class="form__text">{{ language('general.call_us_modal_desc') }}</p>
                        </div>

                        <div class="form__section">
                            <div class="form__item">
                                <input name="form_text_1" placeholder="{{ language('general.call_us_form_name') }}"
                                       type="text" class="input form__input">
                                <label class="form__label">{{ language('general.call_us_form_name') }}</label>
                            </div>
                        </div>
                        <div class="form__section">
                            <div class="form__item">
                                <input name="form_text_2" placeholder="{{ language('general.call_us_form_phone') }}"
                                       type="text" class="input form__input" inputmode="text">
                                <label class="form__label">{{ language('general.call_us_form_phone') }}</label>
                            </div>
                        </div>
                        <div class="form__submit">
                            <button type="submit" name="submit" class="btn">
                                <span>{{ language('general.call_us_form_submit') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<div class="notifications notifications--top"></div>--}}
{{--<div class="notifications notifications--bottom"></div> <!----></div>--}}

<script type="text/javascript" src="{{ asset('frontend/assets/plugins/jquery/jquery-3.6.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/plugins/jquery/jquery-ui.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('frontend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('frontend/assets/plugins/OwlCarousel/js/owl.carousel.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('frontend/assets/plugins/owl/owl.carousel.min.js') }}"></script>

{{--<script type="text/javascript" src="{{ asset('frontend/assets/js/bundle.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('frontend/assets/js/svgxuse.min.js') }}"></script>


<script>
    $(document).ready(function () {
        $('.header__burger').click(function () {
            if ($(this).hasClass('header__burger_active')) {
                $(this).removeClass('header__burger_active');
                $('body').removeClass('body_locked');
                $('.header .slide-menu').hide("slide", {direction: "left"}, 400);
            } else {
                $(this).addClass('header__burger_active');
                $('body').addClass('body_locked');
                $('.header .slide-menu').show("slide", {direction: "left"}, 400);
            }
        });
    });
</script>


{{--<!-- footer-start -->--}}
{{--<footer>--}}
{{--    <div class="footer-top-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-sm-6 col-12">--}}
{{--                    <div class="fw-info footer-widget">--}}
{{--                        <div class="flogo">--}}
{{--                            @if(empty(setting('logo_dark')))--}}
{{--                                <img src="{{ asset('storage/no-image.png') }}" alt="{{ language('general.title') }}">--}}
{{--                            @else--}}
{{--                                <img src="{{ asset('storage') }}/{{ setting('logo_dark') }}"--}}
{{--                                     alt="{{ language('general.title') }}">--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="address">--}}
{{--                            <div class="h5"><span><i--}}
{{--                                        class="fas fa-map-marker-alt"></i></span> {!! language('frontend.contact.address') !!}--}}
{{--                                :</div>--}}
{{--                            <p>{{  setting('address',true) }}</p>--}}
{{--                        </div>--}}
{{--                        @if(!empty(json_decode(setting('social'))))--}}

{{--                            <ul class="social">--}}
{{--                                @foreach(json_decode(setting('social')) as $key => $value)--}}
{{--                                    <li>--}}
{{--                                        <a {{ isset($value->status) ? 'target="_blank"': null }} href="{{ $value->link }}" target="_blank" rel="nofollow">--}}
{{--                                            <i class="socicon-{{ $value->name }}"></i>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}

{{--                            </ul>--}}

{{--                        @endif--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6 col-12">--}}
{{--                    <div class="fw-categories footer-widget">--}}
{{--                        <div class="h4 title">{!!  language('general.menu') !!}</div>--}}
{{--                        <ul class="list">--}}
{{--                            @foreach(\App\Services\MenuServices::getFooterMenu($languageID,2) as $footerMenu)--}}
{{--                                <li><a href="{{ $footerMenu->link }}"><span><i class="fas fa-long-arrow-alt-right"></i></span>--}}
{{--                                        {{ $footerMenu->label }}</a></li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6 col-12">--}}
{{--                    <div class="fw-categories footer-widget">--}}
{{--                        <div class="h4 title">{!!  language('frontend.service.name') !!}</div>--}}
{{--                        <ul class="list">--}}
{{--                            @foreach(\App\Services\ServicesService::getServices($languageID,6) as $service)--}}
{{--                                <li><a href="{{ route('frontend.service.detail',$service->slug) }}"><span><i--}}
{{--                                                class="fas fa-long-arrow-alt-right"></i></span> {{ str_limit($service->servicesTranlations[0]->name,30)  }}</a></li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-sm-6 col-12">--}}
{{--                    <div class="fw-rpost footer-widget">--}}
{{--                        <div class="h4 title">{!!  language('frontend.blog.latest') !!}</div>--}}
{{--                        <ul class="rpost">--}}
{{--                            @foreach(\App\Services\PostsService::getPosts($languageID,3) as $post)--}}
{{--                                <li><a href="{{ route('frontend.post.detail',$post->slug) }}">--}}
{{--                                    <span class="img">--}}
{{--                                         @if(empty($post->image))--}}
{{--                                            <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"--}}
{{--                                                 alt="{{$post->postsTranlations[0]->name }}">--}}
{{--                                        @else--}}
{{--                                            <img src="{{  \App\Services\ImageService::resizeImageSize($post->image,'thumbnail',80) }}"--}}
{{--                                                 alt="{{$post->postsTranlations[0]->name }}">--}}
{{--                                        @endif--}}
{{--                                    </span>--}}
{{--                                        <span class="content">--}}
{{--                                        <span class="name">{{ str_limit($post->postsTranlations[0]->name,35)  }}</span>--}}
{{--                                        <span class="date"><span><i class="far fa-clock"></i></span>--}}
{{--                                        {{ \Illuminate\Support\Carbon::parse($post->created_at)->format('d.m.Y') }}--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                                    </a></li>--}}
{{--                            @endforeach--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="footer-bottom-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="fba-left">--}}
{{--                        <p>© 2021 - {{ date('Y') }} | {!! setting('copyright',true) !!}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="fba-right">--}}
{{--                        <p>{!! setting('created_by',true) !!}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}
{{--<!-- footer-end -->--}}

{{--<!-- gmap-script -->--}}
{{--<script>--}}
{{--    // function initMap() {--}}
{{--    //     var locationRio = {lat: 40.382947, lng: 49.871543};--}}
{{--    //     var map = new google.maps.Map(document.getElementById('googleMap'), {--}}
{{--    //         zoom: 16,--}}
{{--    //         center: locationRio,--}}
{{--    //         gestureHandling: 'cooperative'--}}
{{--    //     });--}}
{{--    //     var marker = new google.maps.Marker({--}}
{{--    //         position: locationRio,--}}
{{--    //         map: map,--}}
{{--    //         title: 'Hello World!'--}}
{{--    //     });--}}
{{--    // }--}}

{{--    function initMap() {--}}
{{--        var directionsService = new google.maps.DirectionsService;--}}
{{--        var directionsDisplay = new google.maps.DirectionsRenderer;--}}

{{--        var position = {lat: 40.382947, lng: 49.871543};--}}

{{--        var map = new google.maps.Map(document.getElementById('googleMap'), {--}}
{{--            zoom: 16,--}}
{{--            center: position--}}
{{--        });--}}

{{--        var marker = new google.maps.Marker({--}}
{{--            position: position,--}}
{{--            map: map--}}
{{--        });--}}

{{--        directionsDisplay.setMap(map);--}}

{{--        var onChangeHandler = function() {--}}
{{--            calculateAndDisplayRoute(directionsService, directionsDisplay);--}}
{{--        };--}}
{{--        // document.getElementById('start').addEventListener('change', onChangeHandler);--}}
{{--        // document.getElementById('end').addEventListener('change', onChangeHandler);--}}

{{--        // Try HTML5 geolocation.--}}
{{--        if (navigator.geolocation) {--}}
{{--            navigator.geolocation.getCurrentPosition(function(position) {--}}

{{--                calculateAndDisplayRoute(directionsService, directionsDisplay, position.coords.latitude, position.coords.longitude );--}}

{{--            }, function() {--}}
{{--                handleLocationError(true, infoWindow, map.getCenter());--}}
{{--            });--}}
{{--        }--}}

{{--    }--}}

{{--    function calculateAndDisplayRoute(directionsService, directionsDisplay, lat, lng) {--}}
{{--        directionsService.route({--}}

{{--            origin: {lat: lat, lng: lng},--}}
{{--            destination: {lat: 40.382947, lng: 49.871543},--}}


{{--            travelMode: 'DRIVING'--}}
{{--        }, function(response, status) {--}}
{{--            if (status === 'OK') {--}}
{{--                directionsDisplay.setDirections(response);--}}
{{--            } else {--}}
{{--                window.alert('Directions request failed due to ' + status);--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
{{--<script async defer--}}
{{--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpv-0dfKoMdCnaDZoNRqqsRooGoAAwPcU&callback=initMap">--}}
{{--</script>--}}
{{--<!-- gmap-script -->--}}

{{--<!-- Scripts -->--}}
{{--<script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js?ver=1.0.0') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery-ui.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery.pogo-slider.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/parallax.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/countdown.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery.fancybox.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/imagesLoaded-PACKAGED.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/isotope-packaged.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery.meanmenu.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery.scrollUp.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery.mixitup.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/jquery.waypoints.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/assets/js/theme.js') }}"></script>--}}

{{--<!--  Language Change  -->--}}
{{--<script>--}}
{{--    const languageChange = "{{ route('frontend.language.change') }}";--}}
{{--    const fullUrl = "{{ url()->full() }}";--}}
{{--</script>--}}
{{--<script src="{{ asset('assets/js/common.js') }}"></script>--}}


{{--<!-- Yandex.Metrika counter -->--}}
{{--<script>--}}
{{--    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};--}}
{{--        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})--}}
{{--    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");--}}

{{--    ym(88167758, "init", {--}}
{{--        clickmap:true,--}}
{{--        trackLinks:true,--}}
{{--        accurateTrackBounce:true,--}}
{{--        webvisor:true--}}
{{--    });--}}
{{--</script>--}}
{{--<noscript><div><img src="https://mc.yandex.ru/watch/88167758" style="position:absolute; left:-9999px;" alt=""></div></noscript>--}}
{{--<!-- /Yandex.Metrika counter -->--}}


{{--<!-- Global site tag (gtag.js) - Google Analytics -->--}}
{{--<script async src="https://www.googletagmanager.com/gtag/js?id=G-VGH3738JHT"></script>--}}
{{--<script>--}}
{{--    window.dataLayer = window.dataLayer || [];--}}
{{--    function gtag(){dataLayer.push(arguments);}--}}
{{--    gtag('js', new Date());--}}

{{--    gtag('config', 'G-VGH3738JHT');--}}
{{--</script>--}}


@yield('JS')
</body>
</html>
