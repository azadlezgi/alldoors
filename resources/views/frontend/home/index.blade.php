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
                                    <img src="{{  \App\Services\ImageService::customImageSize($slide->image,632,422,80) }}" alt="{{ $slide->title }}">
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
                    </div>
                    @endif

                    <div class="socials"><span class="socials__desc">Мы в соцсетях:</span> <a rel="nofollow"
                                                                                              target="_blank"
                                                                                              href="https://vk.com/dveri_velldoris"
                                                                                              class="socials__item socials__item_vk"><i>
                                <svg class="icon">
                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_vk"></use>
                                </svg>
                            </i>
                            <svg width="0" height="0" viewBox="0 0 0 0" class="vh">
                                <radialGradient id="gradient" r="150%" cx="30%" cy="107%">
                                    <stop stop-color="#fdf497" offset="0"></stop>
                                    <stop stop-color="#fdf497" offset="0.05"></stop>
                                    <stop stop-color="#fd5949" offset="0.45"></stop>
                                    <stop stop-color="#d6249f" offset="0.6"></stop>
                                    <stop stop-color="#285AEB" offset="0.9"></stop>
                                </radialGradient>
                            </svg>
                        </a><a rel="nofollow" target="_blank" href="https://t.me/velldoris_official"
                               class="socials__item socials__item_telegram"><i>
                                <svg class="icon">
                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_telegram"></use>
                                </svg>
                            </i>
                            <svg width="0" height="0" viewBox="0 0 0 0" class="vh">
                                <radialGradient id="gradient" r="150%" cx="30%" cy="107%">
                                    <stop stop-color="#fdf497" offset="0"></stop>
                                    <stop stop-color="#fdf497" offset="0.05"></stop>
                                    <stop stop-color="#fd5949" offset="0.45"></stop>
                                    <stop stop-color="#d6249f" offset="0.6"></stop>
                                    <stop stop-color="#285AEB" offset="0.9"></stop>
                                </radialGradient>
                            </svg>
                        </a><a rel="nofollow" target="_blank"
                               href="https://www.youtube.com/channel/UCKSYBNpsYNPNqH6ijDRTsZw"
                               class="socials__item socials__item_yt"><i>
                                <svg class="icon">
                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_yt"></use>
                                </svg>
                            </i>
                            <svg width="0" height="0" viewBox="0 0 0 0" class="vh">
                                <radialGradient id="gradient" r="150%" cx="30%" cy="107%">
                                    <stop stop-color="#fdf497" offset="0"></stop>
                                    <stop stop-color="#fdf497" offset="0.05"></stop>
                                    <stop stop-color="#fd5949" offset="0.45"></stop>
                                    <stop stop-color="#d6249f" offset="0.6"></stop>
                                    <stop stop-color="#285AEB" offset="0.9"></stop>
                                </radialGradient>
                            </svg>
                        </a><a rel="nofollow" target="_blank" href="https://zen.yandex.ru/id/5ffc38c061dbd60faf5a82ae"
                               class="socials__item socials__item_yazen"><i>
                                <svg class="icon">
                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_yazen"></use>
                                </svg>
                            </i>
                            <svg width="0" height="0" viewBox="0 0 0 0" class="vh">
                                <radialGradient id="gradient" r="150%" cx="30%" cy="107%">
                                    <stop stop-color="#fdf497" offset="0"></stop>
                                    <stop stop-color="#fdf497" offset="0.05"></stop>
                                    <stop stop-color="#fd5949" offset="0.45"></stop>
                                    <stop stop-color="#d6249f" offset="0.6"></stop>
                                    <stop stop-color="#285AEB" offset="0.9"></stop>
                                </radialGradient>
                            </svg>
                        </a><a rel="nofollow" target="_blank" href="https://ok.ru/group/68895085494316"
                               class="socials__item socials__item_ok"><i>
                                <svg class="icon">
                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_ok"></use>
                                </svg>
                            </i>
                            <svg width="0" height="0" viewBox="0 0 0 0" class="vh">
                                <radialGradient id="gradient" r="150%" cx="30%" cy="107%">
                                    <stop stop-color="#fdf497" offset="0"></stop>
                                    <stop stop-color="#fdf497" offset="0.05"></stop>
                                    <stop stop-color="#fd5949" offset="0.45"></stop>
                                    <stop stop-color="#d6249f" offset="0.6"></stop>
                                    <stop stop-color="#285AEB" offset="0.9"></stop>
                                </radialGradient>
                            </svg>
                        </a></div>
                </div>
            </div>
            <div class="container">
                <div class="promovideoslider">
                    <div class="h1 promovideoslider__title">Видео</div> <!----></div>
            </div>
            <div class="catalog" style="min-height:600px;">
                <div class="catalog__wrapper container">
                    <div class="h1">Каталог</div>
                    <div class="catalog-slider" style="display:none;"><!----></div>
                    <ul class="catalog-sections">
                        <li class="catalog-sections__item"><a href="catalog/mezhkomnatnye-dveri/index.html"
                                                              class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/2ff/900_600_1/2ff55539df4e4196103f64eaf2960c48.jpg"
                                                         alt="Межкомнатные двери" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Межкомнатные двери</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/pokrytie/pokrytie-pod-pokrasku/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/765/900_600_1/765b332b0d60e331e2622802aa01492f.jpg"
                                                         alt="Скрытые двери" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Скрытые двери</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/pokrytie/pokrytie-emal/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/435/900_600_1/435797370df4c9f14d40f123110c78f8.jpg"
                                                         alt="Двери в эмали" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Двери в эмали</div>
                            </a></li>
                        <li class="catalog-sections__item"><a href="catalog/pogonazh/index.html"
                                                              class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/c12/831_600_1/c12fa59cb1bb53eaad4c0f2ec573dca5.jpg"
                                                         alt="Погонаж" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Погонаж</div>
                            </a></li>
                        <li class="catalog-sections__item"><a href="catalog/furnitura/index.html"
                                                              class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/ceb/831_600_1/ceb15c0a6fef60d1936567525d7d6bd1.jpg"
                                                         alt="Фурнитура" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Фурнитура</div>
                            </a></li>
                        <li class="catalog-sections__item"><a href="catalog/plintus/index.html"
                                                              class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/f38/831_600_1/f38d955b9fbe8c02b0554a14f456e1b9.jpg"
                                                         alt="Плинтус" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Плинтус</div>
                            </a></li>
                    </ul>
                </div>
            </div>
            <div class="catalog" style="min-height:600px;">
                <div class="catalog__wrapper container">
                    <div class="h1">Коллекции</div>
                    <div class="catalog-slider" style="display:none;"><!----></div>
                    <ul class="catalog-sections">
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/ledo/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/5b7/831_600_1/5b73209eb3f3f8b1f56c9bab0a34454a.jpg"
                                                         alt="Ledo" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Ledo</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/alto/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/2b0/900_600_1/2b0310a2452010d43d309f30b1ef6a0f.jpg"
                                                         alt="Alto" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Alto</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/fly/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/8c5/831_600_1/8c513b165c035fd31c9236702b45e61b.jpg"
                                                         alt="Fly" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Fly</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/invisible/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/345/900_600_1/345f131816fbe6d7b27028c960e5607b.jpg"
                                                         alt="Invisible" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Invisible</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/scandi/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/4c2/900_600_1/4c2a9fd0482387841aaee737fb85e81f.jpg"
                                                         alt="Scandi" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Scandi</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/scandi-neo/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/0f9/831_600_1/0f94b686cd1c7dab964bbcb9f687936b.jpg"
                                                         alt="Scandi Neo" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Scandi Neo</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/xline/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/1ad/900_600_1/1ad2f10bedfc132b407b583f14d403e1.jpg"
                                                         alt="Xline" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Xline</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/techno/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/722/900_600_1/7226df909981481895b1a082788c9aa6.jpg"
                                                         alt="Techno" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Techno</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/villa/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/301/900_600_1/3017dcc6b57f0f5a993ac7fe98aef9bb.jpg"
                                                         alt="Villa" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Villa</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/premier/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/db6/900_600_1/db645e9ecfc0efb01348f391cf8492ef.jpg"
                                                         alt="Premier" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Premier</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/smart-z/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/10c/900_600_1/10cb90c0c3389d01e4868ccd17cc7e98.jpg"
                                                         alt="Smart Z" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Smart Z</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/duplex/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/585/900_600_1/585d06400bba05b338488a04ac521578.jpg"
                                                         alt="Duplex" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Duplex</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/next/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/0de/900_600_1/0de68fa1923e84e0196864a8060e0051.jpg"
                                                         alt="Next" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Next</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/linea/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/9f3/900_600_1/9f3f78ede7494b604331969e3cc858ac.jpg"
                                                         alt="Linea" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Linea</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/unica/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/c01/900_600_1/c01df29f9143ccbdd817c42272db5a6e.jpg"
                                                         alt="Unica" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Unica</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/trend/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/6ce/900_600_1/6ce2b21e3f47db5eb8f5abe402613282.jpg"
                                                         alt="Trend" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Trend</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/city/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/8f0/900_600_1/8f06ada7cd9cd9a29b0342bd91c7532a.jpg"
                                                         alt="City" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">City</div>
                            </a></li>
                        <li class="catalog-sections__item"><a
                                    href="catalog/mezhkomnatnye-dveri/collections/loft/index.html"
                                    class="catalog-sections__link">
                                <div class="catalog-sections__image">
                                    <figure><!----> <img loading="lazy"
                                                         src="https://www.velldoris.net/upload/resize_cache/iblock/06d/900_600_1/06dba2caa74634882c1055b4ec35abd7.jpg"
                                                         alt="Loft" class="base-img"></figure>
                                </div>
                                <div class="h3 catalog-sections__item-title">Loft</div>
                            </a></li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="promotions">
                    <div class="h1 promotions__title">Новости и акции</div> <!----></div>
            </div>
            <section class="index-map">
                <div class="container">
                    <div class="index-map__wrapper">
                        <div class="index-map__text">
                            <div class="h2">Салоны в Санкт-Петербурге</div>
                            <address class="index-map__info index-map__info_address">
                                пр. Маршала Жукова, д. 41
                                <span>
                        Фирменный салон
                    </span></address>
                            <div class="index-map__info index-map__info_phone"><span>+7 (812) 606-75-51</span></div>
                            <!----></div>
                        <div class="index-map__map-wrapper">
                            <div><!----></div>
                        </div>
                    </div>
                    <a href="salons/index.html" class="btn btn_block btn_accent index-map__btn">
                        еще 14 салонов
                    </a></div>
            </section>
            <div class="about-index"><h1 class="visually-hidden">Межкомнатные двери от VELLDORIS</h1>
                <div class="container">
                    <div class="about-index__wrapper">
                        <div class="about__cards about-index__cards">
                            <ul class="about__cards-column about__cards-column_mobile">
                                <li tabindex="0" class="about__card about-card">
                                    <div class="about-card__main">
                                        <div class="about-card__bg">
                                            <figure><!----> <img loading="lazy"
                                                                 src="https://www.velldoris.net/upload/iblock/ca7/ca71341bc4b295cf86ebcf5efef34810.jpg"
                                                                 alt="20" class="base-img"></figure>
                                        </div>
                                        <div class="about-card__content">
                                            <div class="about-card__title"><span
                                                        class="about-card__title-special">20</span> <span
                                                        class="about-card__title-text">лет опыта</span></div>
                                            <div class="about-card__text about-card__text_tablet">Многолетний опыт
                                                работы, постоянный контроль качества и технологий, позволяют нам
                                                эффективно взаимодействовать с нашими партнерами и постоянно развиваться
                                                в сфере дверного производства.
                                            </div>
                                            <button type="button" class="about-card__toggle-btn"></button>
                                        </div>
                                    </div>
                                    <div class="about-card__opened-block"><p class="about-card__text">Многолетний опыт
                                            работы, постоянный контроль качества и технологий, позволяют нам эффективно
                                            взаимодействовать с нашими партнерами и постоянно развиваться в сфере
                                            дверного производства.</p></div>
                                </li>
                                <li tabindex="0" class="about__card about-card">
                                    <div class="about-card__main">
                                        <div class="about-card__bg">
                                            <figure><!----> <img loading="lazy"
                                                                 src="https://www.velldoris.net/upload/iblock/8a9/8a94e4e9b2b88cfa5bfe0df3e523e93f.jpg"
                                                                 alt="3000" class="base-img"></figure>
                                        </div>
                                        <div class="about-card__content">
                                            <div class="about-card__title"><span
                                                        class="about-card__title-special">3000</span> <span
                                                        class="about-card__title-text">точек продаж</span></div>
                                            <div class="about-card__text about-card__text_tablet">В ассортимент входят
                                                как стандартные дверные полотна, так и многофункциональные двери
                                                специального назначения: усиленные, усиленные звукоизоляционные
                                                (30,32,42 Db), огнестойкие (EI 30,45,60), маятниковые двери, а также
                                                двери с повышенной износостойкостью. Широкий выбор вариантов покрытия:
                                                окраска в любой цвет по системе Ral или NCS, меламиновые пленки
                                                (ламинат), Экошпон, пластик CPL или HPL, позволяет комплектовать любые
                                                объекты и создавать индивидуальные проектные решения в сотрудничестве с
                                                дизайнерами и архитекторами.
                                            </div>
                                            <button type="button" class="about-card__toggle-btn"></button>
                                        </div>
                                    </div>
                                    <div class="about-card__opened-block"><p class="about-card__text">В ассортимент
                                            входят как стандартные дверные полотна, так и многофункциональные двери
                                            специального назначения: усиленные, усиленные звукоизоляционные (30,32,42
                                            Db), огнестойкие (EI 30,45,60), маятниковые двери, а также двери с
                                            повышенной износостойкостью. Широкий выбор вариантов покрытия: окраска в
                                            любой цвет по системе Ral или NCS, меламиновые пленки (ламинат), Экошпон,
                                            пластик CPL или HPL, позволяет комплектовать любые объекты и создавать
                                            индивидуальные проектные решения в сотрудничестве с дизайнерами и
                                            архитекторами.</p></div>
                                </li>
                                <li tabindex="0" class="about__card about-card">
                                    <div class="about-card__main">
                                        <div class="about-card__bg">
                                            <figure><!----> <img loading="lazy"
                                                                 src="https://www.velldoris.net/upload/iblock/36f/36f38535576466e0db3153487dc8e384.jpg"
                                                                 alt="1000" class="base-img"></figure>
                                        </div>
                                        <div class="about-card__content">
                                            <div class="about-card__title"><span
                                                        class="about-card__title-special">1000</span> <span
                                                        class="about-card__title-text">опытных сотрудников</span></div>
                                            <div class="about-card__text about-card__text_tablet">Наши дизайнеры и
                                                технологи посещают выставки в Италии и Германии, тщательно изучают
                                                тенденции дизайна не только дверных блоков, но и деревообрабатывающей и
                                                мебельной отрасли.
                                                Наши технологи постоянно работают над возможностью технологических
                                                усовершенствований качества продукции (как в области новых материалов
                                                покрытий, так и в сфере оборудования).
                                            </div>
                                            <button type="button" class="about-card__toggle-btn"></button>
                                        </div>
                                    </div>
                                    <div class="about-card__opened-block"><p class="about-card__text">Наши дизайнеры и
                                            технологи посещают выставки в Италии и Германии, тщательно изучают тенденции
                                            дизайна не только дверных блоков, но и деревообрабатывающей и мебельной
                                            отрасли.
                                            Наши технологи постоянно работают над возможностью технологических
                                            усовершенствований качества продукции (как в области новых материалов
                                            покрытий, так и в сфере оборудования).</p></div>
                                </li>
                                <li tabindex="0" class="about__card about-card">
                                    <div class="about-card__main">
                                        <div class="about-card__bg">
                                            <figure><!----> <img loading="lazy"
                                                                 src="https://www.velldoris.net/upload/iblock/d63/d631c160648d4c8d386faa8b2b821413.jpg"
                                                                 alt="3" class="base-img"></figure>
                                        </div>
                                        <div class="about-card__content">
                                            <div class="about-card__title"><span
                                                        class="about-card__title-special">3</span> <span
                                                        class="about-card__title-text">завода в группе</span></div>
                                            <div class="about-card__text about-card__text_tablet">Завод по производству
                                                дверей VellDoris оснащен самыми современными автоматизированными
                                                деревоoбрабатывающими линиями от ведущих производителей Италии и
                                                Германии, что является залогом стабильности качества продукции.
                                            </div>
                                            <button type="button" class="about-card__toggle-btn"></button>
                                        </div>
                                    </div>
                                    <div class="about-card__opened-block"><p class="about-card__text">Завод по
                                            производству дверей VellDoris оснащен самыми современными
                                            автоматизированными деревоoбрабатывающими линиями от ведущих производителей
                                            Италии и Германии, что является залогом стабильности качества продукции.</p>
                                    </div>
                                </li>
                            </ul>
                            <ul class="about__cards-column about__cards-column_tablet">
                                <li tabindex="0" class="about__card about-card about-card_opened">
                                    <div class="about-card__main">
                                        <div class="about-card__bg">
                                            <figure><!----> <img loading="lazy"
                                                                 src="https://www.velldoris.net/upload/iblock/ca7/ca71341bc4b295cf86ebcf5efef34810.jpg"
                                                                 alt="20" class="base-img"></figure>
                                        </div>
                                        <div class="about-card__content">
                                            <div class="about-card__title"><span
                                                        class="about-card__title-special">20</span> <span
                                                        class="about-card__title-text">лет опыта</span></div>
                                            <div class="about-card__text about-card__text_tablet">Многолетний опыт
                                                работы, постоянный контроль качества и технологий, позволяют нам
                                                эффективно взаимодействовать с нашими партнерами и постоянно развиваться
                                                в сфере дверного производства.
                                            </div>
                                            <button type="button" class="about-card__toggle-btn"></button>
                                        </div>
                                    </div>
                                    <div class="about-card__opened-block"><p class="about-card__text">Многолетний опыт
                                            работы, постоянный контроль качества и технологий, позволяют нам эффективно
                                            взаимодействовать с нашими партнерами и постоянно развиваться в сфере
                                            дверного производства.</p></div>
                                </li>
                                <li tabindex="0" class="about__card about-card about-card_opened">
                                    <div class="about-card__main">
                                        <div class="about-card__bg">
                                            <figure><!----> <img loading="lazy"
                                                                 src="https://www.velldoris.net/upload/iblock/8a9/8a94e4e9b2b88cfa5bfe0df3e523e93f.jpg"
                                                                 alt="3000" class="base-img"></figure>
                                        </div>
                                        <div class="about-card__content">
                                            <div class="about-card__title"><span
                                                        class="about-card__title-special">3000</span> <span
                                                        class="about-card__title-text">точек продаж</span></div>
                                            <div class="about-card__text about-card__text_tablet">В ассортимент входят
                                                как стандартные дверные полотна, так и многофункциональные двери
                                                специального назначения: усиленные, усиленные звукоизоляционные
                                                (30,32,42 Db), огнестойкие (EI 30,45,60), маятниковые двери, а также
                                                двери с повышенной износостойкостью. Широкий выбор вариантов покрытия:
                                                окраска в любой цвет по системе Ral или NCS, меламиновые пленки
                                                (ламинат), Экошпон, пластик CPL или HPL, позволяет комплектовать любые
                                                объекты и создавать индивидуальные проектные решения в сотрудничестве с
                                                дизайнерами и архитекторами.
                                            </div>
                                            <button type="button" class="about-card__toggle-btn"></button>
                                        </div>
                                    </div>
                                    <div class="about-card__opened-block"><p class="about-card__text">В ассортимент
                                            входят как стандартные дверные полотна, так и многофункциональные двери
                                            специального назначения: усиленные, усиленные звукоизоляционные (30,32,42
                                            Db), огнестойкие (EI 30,45,60), маятниковые двери, а также двери с
                                            повышенной износостойкостью. Широкий выбор вариантов покрытия: окраска в
                                            любой цвет по системе Ral или NCS, меламиновые пленки (ламинат), Экошпон,
                                            пластик CPL или HPL, позволяет комплектовать любые объекты и создавать
                                            индивидуальные проектные решения в сотрудничестве с дизайнерами и
                                            архитекторами.</p></div>
                                </li><!----><!----></ul>
                            <ul class="about__cards-column about__cards-column_tablet"><!----><!---->
                                <li tabindex="0" class="about__card about-card about-card_opened">
                                    <div class="about-card__main">
                                        <div class="about-card__bg">
                                            <figure><!----> <img loading="lazy"
                                                                 src="https://www.velldoris.net/upload/iblock/36f/36f38535576466e0db3153487dc8e384.jpg"
                                                                 alt="1000" class="base-img"></figure>
                                        </div>
                                        <div class="about-card__content">
                                            <div class="about-card__title"><span
                                                        class="about-card__title-special">1000</span> <span
                                                        class="about-card__title-text">опытных сотрудников</span></div>
                                            <div class="about-card__text about-card__text_tablet">Наши дизайнеры и
                                                технологи посещают выставки в Италии и Германии, тщательно изучают
                                                тенденции дизайна не только дверных блоков, но и деревообрабатывающей и
                                                мебельной отрасли.
                                                Наши технологи постоянно работают над возможностью технологических
                                                усовершенствований качества продукции (как в области новых материалов
                                                покрытий, так и в сфере оборудования).
                                            </div>
                                            <button type="button" class="about-card__toggle-btn"></button>
                                        </div>
                                    </div>
                                    <div class="about-card__opened-block"><p class="about-card__text">Наши дизайнеры и
                                            технологи посещают выставки в Италии и Германии, тщательно изучают тенденции
                                            дизайна не только дверных блоков, но и деревообрабатывающей и мебельной
                                            отрасли.
                                            Наши технологи постоянно работают над возможностью технологических
                                            усовершенствований качества продукции (как в области новых материалов
                                            покрытий, так и в сфере оборудования).</p></div>
                                </li>
                                <li tabindex="0" class="about__card about-card about-card_opened">
                                    <div class="about-card__main">
                                        <div class="about-card__bg">
                                            <figure><!----> <img loading="lazy"
                                                                 src="https://www.velldoris.net/upload/iblock/d63/d631c160648d4c8d386faa8b2b821413.jpg"
                                                                 alt="3" class="base-img"></figure>
                                        </div>
                                        <div class="about-card__content">
                                            <div class="about-card__title"><span
                                                        class="about-card__title-special">3</span> <span
                                                        class="about-card__title-text">завода в группе</span></div>
                                            <div class="about-card__text about-card__text_tablet">Завод по производству
                                                дверей VellDoris оснащен самыми современными автоматизированными
                                                деревоoбрабатывающими линиями от ведущих производителей Италии и
                                                Германии, что является залогом стабильности качества продукции.
                                            </div>
                                            <button type="button" class="about-card__toggle-btn"></button>
                                        </div>
                                    </div>
                                    <div class="about-card__opened-block"><p class="about-card__text">Завод по
                                            производству дверей VellDoris оснащен самыми современными
                                            автоматизированными деревоoбрабатывающими линиями от ведущих производителей
                                            Италии и Германии, что является залогом стабильности качества продукции.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="about-index__content">
                            <div class="h1 about-index__title">О компании</div>
                            <div class="about-index__desc"><p>История Петербургской фабрики дверей Velldoris началась в
                                    2001 году с небольшого производства дверей по индивидуальным заказам. Постоянное
                                    развитие технической базы и поиск новых идей, профессиональный рост коллектива и
                                    востребованность нашей продукции на рынке позволили нам с 2013 года многократно
                                    увеличить масштаб деятельности. Была проведена глубокая модернизация оборудования,
                                    открыты новые производственные цеха и логистические комплексы, качественно пополнены
                                    кадровые ресурсы.</p>
                                <p>Современная компания Velldoris – это крупный производственный холдинг, занимающий
                                    достойное место в ТОП-5 ведущих дверных фабрик России. Ежемесячно выпускается более
                                    100 000 дверных блоков.</p>
                                <p>В структуру предприятия входят три крупные площадки в разных районах Ленинградской
                                    области и производственная площадка в Новосибирске. Для хранения и распределения
                                    готовой продукции в Ленобласти построен Логистический центр.</p></div>
                            <a href="about/index.html" class="about-index__btn btn btn_block btn_additional">Подробнее о
                                нас</a></div>
                    </div>
                </div>
            </div> <!----></div>
    </main>

@endsection

@section("JS")

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            items: 1,
            autoplay: true,
            autoplayTimeout: 3000,
        })
    </script>

@endsection

