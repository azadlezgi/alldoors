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
                <div class="mb-2 mb-md-0">
                    <span class="footer__year">AllDoors &copy; 2022 {{ language('general.rights_reserved') }}</span>
                    <div class="footer__copyright">{!! language('general.copyright') !!}</div>
                </div>
                <div class="footer_menu d-none d-md-block">
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


{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="call_usModal" tabindex="-1" aria-labelledby="call_usModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h1 class="modal-title fs-5" id="call_usModalLabel">{{ language('general.call_us_modal_title') }}</h1>--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <div class="form-layout">--}}
{{--                    <form action="/api/form/callback/" method="POST" class="form">--}}
{{--                        <div>--}}
{{--                            <p class="form__text">{{ language('general.call_us_modal_desc') }}</p>--}}
{{--                        </div>--}}

{{--                        <div class="form__section">--}}
{{--                            <div class="form__item">--}}
{{--                                <input name="form_text_1" placeholder="{{ language('general.call_us_form_name') }}"--}}
{{--                                       type="text" class="input form__input">--}}
{{--                                <label class="form__label">{{ language('general.call_us_form_name') }}</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form__section">--}}
{{--                            <div class="form__item">--}}
{{--                                <input name="form_text_2" placeholder="{{ language('general.call_us_form_phone') }}"--}}
{{--                                       type="text" class="input form__input" inputmode="text">--}}
{{--                                <label class="form__label">{{ language('general.call_us_form_phone') }}</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form__submit">--}}
{{--                            <button type="submit" name="submit" class="btn">--}}
{{--                                <span>{{ language('general.call_us_form_submit') }}</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

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
    const languageChange = "{{ route('frontend.language.change') }}";
    const fullUrl = "{{ url()->full() }}";
</script>
<script src="{{ asset('assets/js/common.js') }}"></script>

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

@yield('JS')
</body>
</html>
