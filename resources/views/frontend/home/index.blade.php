@extends('frontend.layouts.index')

@section('title',empty(language('frontend.home.title'))?language('genereal.title'):language('frontend.home.title'))
@section('keywords', language('frontend.home.keyword') )
@section('description', language('frontend.home.description') )

@section('content')

    <main class="main main--mt">
        <div>
            <div class="mainscreen">
                <div class="container mainscreen__container">

                    @if($slides)
                        <div class="swiper-slider">
                            <div class="mainscreen__wrapper owl-carousel owl-theme">
                                @foreach($slides as $slide)
                                    <div class="mainscreen__item item">
                                        <div class="mainscreen__image">
                                            <img
                                                src="{{  \App\Services\ImageService::customImageSize($slide->image,632,422,80) }}"
                                                alt="{{ $slide->title }}">
                                        </div>
                                        <div class="mainscreen__text">
                                            @if($slide->title)
                                                <div class="h1 mainscreen__title">{{ $slide->title }}</div>
                                            @endif
                                            @if($slide->sub_title)
                                                <div class="mainscreen__desc">
                                                    {!! $slide->sub_title !!}
                                                </div>
                                            @endif
                                            @if($slide->button_name || $slide->button_url)
                                                <div class="mainscreen__btn">
                                                    <a href="{{ $slide->button_url }}" class="btn btn_block btn_accent">
                                                        @if($slide->button_name)
                                                            {{ $slide->button_name }}
                                                        @else
                                                            {{ language('frontend.general.more') }}
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mainscreen__controls">
                                <div class="slider-dots swiper-pagination-clickable swiper-pagination-bullets"></div>
                                <div class="slider-arrows"></div>
                            </div>
                        </div>
                    @endif

                    @if(!empty(json_decode(setting('social'))))
                        <div class="socials">
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
            </div>
            {{--            <div class="container">--}}
            {{--                <div class="promovideoslider">--}}
            {{--                    <div class="h1 promovideoslider__title">Видео</div> <!----></div>--}}
            {{--            </div>--}}

            @if($products_categories)
                <div class="catalog">
                    <div class="catalog__wrapper container">
                        <div class="h1">{{ language('frontend.home.catalog') }}</div>
                        <ul class="catalog-sections">

                            @foreach($products_categories as $products_category)
                                <li class="catalog-sections__item">
                                    <a href="{{ route('frontend.product.category.detail', $products_category->slug) }}"
                                       class="catalog-sections__link">
                                        <div class="catalog-sections__image">
                                            <figure>
                                                <img loading="lazy" src="{{ $products_category->image }}"
                                                     alt="{{ $products_category->name }}" class="base-img">
                                            </figure>
                                        </div>
                                        <div
                                            class="h3 catalog-sections__item-title">{{ $products_category->name }}</div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            @endif


            @if($products_collections)
                <div class="catalog">
                    <div class="catalog__wrapper container">
                        <div class="h1">{{ language('frontend.home.collection') }}</div>
                        <ul class="catalog-sections">

                            @foreach($products_collections as $products_collection)
                                <li class="catalog-sections__item">
                                    <a href="{{ route('frontend.product.collection.detail', $products_collection->slug) }}"
                                       class="catalog-sections__link">
                                        <div class="catalog-sections__image">
                                            <figure>
                                                <img loading="lazy" src="{{ $products_collection->image }}"
                                                     alt="{{ $products_collection->name }}" class="base-img">
                                            </figure>
                                        </div>
                                        <div
                                            class="h3 catalog-sections__item-title">{{ $products_collection->name }}</div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            @endif


            @if($posts)
                <div class="container">
                    <div class="promotions">
                        <div class="h1 promotions__title">{{ language('frontend.home.news') }}</div>
                        <div class="swiper-slider promotions__slider slider">
                            <div class="promotions-slider__wrapper">
                                <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                                    <div class="swiper-wrapper1 row">
                                        @foreach($posts as $post)
                                            <div class="swiper-slide swiper-slide-active col-md-4">
                                                <div class="promotions-item">
                                                    <a href="{{ route('frontend.post.detail', $post->slug) }}"
                                                       class="promotions-item__image">
                                                        <figure>
                                                            <img src="{{ $post->image }}" alt="{{ $post->name }}"
                                                                 class="base-img">
                                                        </figure>
                                                    </a>
                                                    <div
                                                        class="promotions-item__date additional-text">{{ $post->date }}</div>
                                                    <a href="{{ route('frontend.post.detail', $post->slug) }}"
                                                       class="promotions-item__title h4">{{ $post->name }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                </div>
                            </div>
                            <div class="promotions-slider__controls">
                                <div class="slider-controls">
                                    <div data-dots="0"
                                         class="slider-dots swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-lock">
                                        <button class="slider-dots__item slider-dots__item_active" type="button"
                                                tabindex="0" role="button" aria-label="Go to slide 1"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <section class="index-map">
                <div class="container">
                    <div class="index-map__wrapper">
                        <div class="index-map__text">
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
                            @if(!empty(setting('map')))
                                <div>
                                    {!! setting('map') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('frontend.home.contact') }}" class="btn btn_block btn_accent index-map__btn">
                        {{ language('frontend.home.contact_us') }}
                    </a>
                </div>
            </section>

            <section class="about-index">
                <h1 class="visually-hidden">Межкомнатные двери от VELLDORIS</h1>
                <div class="container">
                    <div class="about-index__wrapper">
                        <div class="about__cards about-index__cards">
                            @if($banners)
                                <ul class="about__cards-column about__cards-column_mobile">
                                    @foreach($banners as $banner)
                                        <li tabindex="0" class="about__card about-card">
                                            <div class="about-card__main">
                                                <div class="about-card__bg">
                                                    <figure>
                                                        <img src="{{ $banner->image }}" alt="" class="base-img">
                                                    </figure>
                                                </div>
                                                <div class="about-card__content">
                                                    <div class="about-card__title">
                                                        {!! $banner->title !!}
                                                    </div>
                                                    <div class="about-card__text about-card__text_tablet">
                                                        {!! $banner->sub_title !!}
                                                    </div>
                                                    <button
                                                        type="button"
                                                        class="about-card__toggle-btn collapsed"
                                                        data-bs-toggle="collapse"
                                                        href="#collapseAboutMobile{{ $banner->id }}"
                                                        role="button"
                                                        aria-expanded="false"
                                                        aria-controls="collapseAboutMobile{{ $banner->id }}"
                                                    ></button>
                                                </div>
                                            </div>
                                            <div class="about-card__opened-block collapse"
                                                 id="collapseAboutMobile{{ $banner->id }}">
                                                <p class="about-card__text">{!! $banner->sub_title !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <ul class="about__cards-column about__cards-column_tablet">
                                    @foreach($banners as $banner)
                                        @if($loop->index <= 4)
                                            <li tabindex="0" class="about__card about-card about-card_opened">
                                                <div class="about-card__main">
                                                    <div class="about-card__bg">
                                                        <figure><
                                                            <img src="{{ $banner->image }}" alt="" class="base-img">
                                                        </figure>
                                                    </div>
                                                    <div class="about-card__content">
                                                        <div class="about-card__title">
                                                            {!! $banner->title !!}
                                                        </div>
                                                        <div class="about-card__text about-card__text_tablet">
                                                            {!! $banner->sub_title !!}
                                                        </div>
                                                        <button type="button" class="about-card__toggle-btn"></button>
                                                    </div>
                                                </div>
                                                <div class="about-card__opened-block">
                                                    <p class="about-card__text">{!! $banner->sub_title !!}</p>
                                                </div>
                                            </li>

                                            @if($loop->index == 1)
                                            </ul>
                                            <ul class="about__cards-column about__cards-column_tablet">
                                            @endif

                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="about-index__content">
                            <div class="h1 about-index__title">О компании</div>
                            <div class="about-index__desc"><p>История Петербургской фабрики дверей Velldoris
                                    началась в
                                    2001 году с небольшого производства дверей по индивидуальным заказам. Постоянное
                                    развитие технической базы и поиск новых идей, профессиональный рост коллектива и
                                    востребованность нашей продукции на рынке позволили нам с 2013 года многократно
                                    увеличить масштаб деятельности. Была проведена глубокая модернизация
                                    оборудования,
                                    открыты новые производственные цеха и логистические комплексы, качественно
                                    пополнены
                                    кадровые ресурсы.</p>
                                <p>Современная компания Velldoris – это крупный производственный холдинг, занимающий
                                    достойное место в ТОП-5 ведущих дверных фабрик России. Ежемесячно выпускается
                                    более
                                    100 000 дверных блоков.</p>
                                <p>В структуру предприятия входят три крупные площадки в разных районах
                                    Ленинградской
                                    области и производственная площадка в Новосибирске. Для хранения и распределения
                                    готовой продукции в Ленобласти построен Логистический центр.</p></div>
                            <a href="about/index.html" class="about-index__btn btn btn_block btn_additional">Подробнее
                                о
                                нас</a>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </main>

@endsection

@section("JS")

    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                nav: true,
                dots: true,
                items: 1,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                margin: 30,
                navContainer: '.mainscreen__controls .slider-arrows',
                dotsContainer: '.mainscreen__controls .slider-dots',
            });
        });
    </script>

@endsection

