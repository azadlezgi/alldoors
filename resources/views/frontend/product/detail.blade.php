@extends('frontend.layouts.index')


@section('title',empty($product->title) ? $product->name : $product->title)
@section('keywords', $product->keyword )
@section('description', $product->description )


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
                           href="{{ route('frontend.product.catalog') }}">
                            <span itemprop="name">{{ language('frontend.catalog.name') }}</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </div>
                </li>
                <li>
                    <div itemscope="itemscope" itemprop="itemListElement" itemtype="http://schema.org/ListItem"
                         class="breadcrumbs__item">
                        <a itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing"
                           href="{{ route('frontend.product.category.detail', $product->category_slug) }}">
                            <span itemprop="name">{{ $product->category_name }}</span>
                        </a>
                        <meta itemprop="position" content="3">
                    </div>
                </li>
                <li>
                    <div itemscope="itemscope" itemprop="itemListElement" itemtype="http://schema.org/ListItem"
                         class="breadcrumbs__item">
                        <a itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing"
                           href="{{ route('frontend.product.detail', $product->slug) }}">
                            <span itemprop="name">{{ $product->name }}</span>
                        </a>
                        <meta itemprop="position" content="4">
                    </div>
                </li>
            </ul>
        </div>
        @endsection

        @section('content')
            <div itemscope="itemscope" itemtype="http://schema.org/Product">
                <div class="catalog-element">
                    <div class="container">
                        <div class="catalog-element__wrapper">
                            <div class="catalog-element__gallery-inner catalog-element__gallery">
                                <div class="product-card__status">
                                    @if($product->options)
                                        @foreach($product->options as $option)
                                            @if($option->id == 151)
                                                @if($option->values)
                                                    @foreach($option->values as $option_value)
                                                        <div class="product-card__status-item" style="background:#f9791a;">
                                                            {{ $option_value->text }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <div class="catalog-element-gallery">
                                    <div class="swiper-container swiper-slider swiper-container-main">
                                        <div class="swiper-wrapper catalog-element-gallery__wrapper">
                                            <div class="swiper-slide catalog-element-gallery__item minimum-height">
                                                <img itemprop="image" src="{{ $product->image }}" alt="{{ $product->name }}" class="catalog-element-gallery__image swiper-slide-img">
                                            </div>

                                            @if($product->images)
                                                @foreach($product->images as $product_images)
                                                    <div class="swiper-slide catalog-element-gallery__item minimum-height">
                                                        <img itemprop="image" src="{{ $product_images }}" alt="{{ $product->name }}" class="catalog-element-gallery__image swiper-slide-img">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    @if($product->images)
                                        <div class="catalog-element-gallery__controls">
                                            <div class="swiper-container slider-dots-previews swiper-pagination-custom gallery-thumbs">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide slider-dots-previews__item swiper-slide-thumbs">
                                                        <div class="slider-dots-previews__item__image" style="background-image: url({{ $product->image }});"></div>
                                                    </div>

                                                    @foreach($product->images as $product_images)
                                                        <div class="swiper-slide slider-dots-previews__item swiper-slide-thumbs">
                                                            <div class="slider-dots-previews__item__image" style="background-image: url({{ $product_images }});"></div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    @endif

                                    <div id="galleryModal" class="modal">
                                        <div class="modal-content">
                                            <span class="closeBtn">&times;</span>
                                            <!-- Swiper modal -->
                                            <div id="swiper-container-modal" class="swiper-container-modal">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide swiper-slide-modal">
                                                        <div class="swiper-zoom-container">
                                                            <img class="swiper-lazy swiper-lazy-modal" data-src="{{ $product->image_big }}">
                                                        </div>
                                                    </div>

                                                    @if($product->images_big)
                                                        @foreach($product->images_big as $product_images_big)
                                                            <div class="swiper-slide swiper-slide-modal">
                                                                <div class="swiper-zoom-container">
                                                                    <img class="swiper-lazy swiper-lazy-modal" data-src="{{ $product_images_big }}">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>

                                                @if($product->images)
                                                    <!-- Add Pagination -->
                                                    <div id="swiper-pagination-modal" class="swiper-pagination"></div>
                                                    <!-- Add Pagination -->
                                                    <div id="swiper-button-next-modal" class="swiper-button-next"></div>
                                                    <div id="swiper-button-prev-modal" class="swiper-button-prev"></div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                @if($product->options)
                                    <div class="product-card__utp">
                                        @foreach($product->options as $option)
                                            @if($option->id == 155 && $option->values)
                                                @foreach($option->values as $option_value)
                                                    <img src="{{ $option_value->image }}" alt="{{ $option_value->text }}">
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="catalog-element__params">
                                <div class="catalog-element-params">
                                    <div>
                                        {{--                                        <div class="catalog-element-params__vendor">Articul: {{ $product->id }}</div>--}}
                                        <h1 itemprop="name">{{ $product->name }}</h1>

                                        <meta itemprop="mpn" content="{{ $product->id }}">
                                        <div itemprop="offers" itemtype="http://schema.org/Offer" itemscope="itemscope">
                                            <link itemprop="url" href="{{ route('frontend.product.detail', $product->slug) }}">
                                            <meta itemprop="availability" content="https://schema.org/InStock">
                                            <meta itemprop="priceCurrency" content="AZN">
                                            <meta itemprop="itemCondition" content="https://schema.org/UsedCondition">
                                            <meta itemprop="price" content="{{ $product->price }}">
                                            <meta itemprop="priceValidUntil" content="{{ $product->date }}">
                                        </div>
                                        <div itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating" itemscope="itemscope">
                                            <meta itemprop="reviewCount" content="1">
                                            <meta itemprop="ratingValue" content="5">
                                        </div>
                                        <div itemprop="review" itemtype="http://schema.org/Review" itemscope="itemscope">
                                            <div itemprop="author" itemtype="http://schema.org/Person" itemscope="itemscope">
                                                <meta itemprop="name" content="{{ $product->manufacturer_name }}">
                                            </div>
                                            <div itemprop="reviewRating" itemtype="http://schema.org/Rating" itemscope="itemscope">
                                                <meta itemprop="ratingValue" content="5">
                                                <meta itemprop="bestRating" content="5">
                                            </div>
                                        </div>
                                        <meta itemprop="sku" content="{{ $product->id }}">
                                        <div itemprop="brand" itemtype="http://schema.org/Brand" itemscope="itemscope">
                                            <meta itemprop="name" content="{{ $product->manufacturer_name }}">
                                        </div>

                                    </div>

                                    @if($product->options)
                                        <ul class="catalog-element-settings mb-5">
                                            @foreach($product->options as $option)
                                                @if($option->values && $option->id != 155 && $option->id != 158)
                                                    <li class="catalog-element-settings__item">
                                                        <span class="catalog-element-settings__item-title">{{ $option->name }}:</span>
                                                        <ul class="catalog-element-settings__item-values">
                                                            @foreach($option->values as $option_value)
                                                                <li class="catalog-element-settings__item-value-wrapper @if($option_value->image) catalog-element-settings__item-value-wrapper_pict @endif ">
                                                                    <span class="catalog-element-settings__item-value">
                                                                        @if($option_value->image)
                                                                            <img src="{{ $option_value->image }}" alt="{{ $option_value->text }}" class="catalog-element-settings__item-picture">
                                                                            <i class="catalog-element-settings__preloader">
                                                                                <svg class="icon">
                                                                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_skupreloader"></use>
                                                                                </svg>
                                                                            </i>
                                                                        @else
                                                                            {{ $option_value->text }}
                                                                        @endif
                                                                    </span>
                                                                    @if($option_value->image)
                                                                        <span class="catalog-element-settings__tooltip">{{ $option_value->text }}</span>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif

                                    <div class="catalog-element-price">
                                        <div class="catalog-element-price-actions">
                                            <div class="catalog-element-price-actions__total">
                                                <div class="catalog-element-price-total">
                                                    <div>
                                                        @if($product->special_price)
                                                            <div class="catalog-element-price-block__price catalog-element-price-block__price_old">
                                                                <span>{{ $product->price_view }}</span>
                                                            </div>
                                                            <div class="catalog-element-price-block__price catalog-element-price-total__price ms-0">
                                                                <span>{{ $product->special_price_view }}</span>
                                                            </div>
                                                        @else
                                                            <div class="catalog-element-price-block__price catalog-element-price-total__price ms-0">
                                                                <span>{{ $product->price_view }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="catalog-element-price-actions__btns">
                                                <div class="catalog-element-price-buttons">
                                                    <a href="{{ route('frontend.home.contact') }}" class="btn btn_accent catalog-element-price-buttons__oneclick">
                                                        {{ language('general.call_us') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-element-benefits">
                            <ul class="catalog-element-benefits__list">
                                <li>
                                    <a href="{{ route('frontend.service.index') }}" class="catalog-element-benefits__item">
                                        <i class="catalog-element-benefits__icon">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_ruler"></use>
                                            </svg>
                                        </i>
                                        <span>{{ language('frontend.product.benefit_measurements') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.service.index') }}" class="catalog-element-benefits__item">
                                        <i class="catalog-element-benefits__icon">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_floor"></use>
                                            </svg>
                                        </i>
                                        <span>{{ language('frontend.product.benefit_letsmake') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.service.index') }}" class="catalog-element-benefits__item">
                                        <i class="catalog-element-benefits__icon">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_box"></use>
                                            </svg>
                                        </i>
                                        <span>{{ language('frontend.product.benefit_deliver') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.service.index') }}" class="catalog-element-benefits__item">
                                        <i class="catalog-element-benefits__icon">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_customer-support"></use>
                                            </svg>
                                        </i>
                                        <span>{{ language('frontend.product.benefit_install') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.service.index') }}" class="catalog-element-benefits__item">
                                        <i class="catalog-element-benefits__icon">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_shield"></use>
                                            </svg>
                                        </i>
                                        <span>{{ language('frontend.product.benefit_quality') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        @if($product->text || $product->price_table || $product->attributes)
                            <section class="catalog-element-description">
                                <h2 class="h1">{{ language('frontend.product.description_text') }}</h2>
                                <div class="tabs">
                                    <div class="tabs__content-list">
                                        <div class="tabs__content">
                                            <div itemprop="description" class="catalog-element-specs" isactive="true">
                                                @if($product->text)
                                                    <div class="catalog-element-specs__text">
                                                        <div>
                                                            {!! $product->text !!}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($product->attributes)
                                                    <ul class="catalog-element-specs__attrs">
                                                        @foreach($product->attributes as $attribute)
                                                            <li class="catalog-element-specs__attr">
                                                                <span class="catalog-element-specs__attr-value">{{ $attribute->attributes_translations_name }}</span>
                                                                <span class="catalog-element-specs__dots"></span>
                                                                <span class="catalog-element-specs__attr-desc">{{ $attribute->name }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                                @if($product->price_table)
                                                    <div class="price_table mt-5">
                                                        {!! $product->price_table !!}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>
                </div>


                <div class="product-slider">
                    <div class="container">
                        <h2 class="h1">{{ language('frontend.product.other_products') }}</h2>
                        <div class="catalog-section__items">
                            @if(count($products) > 0)
                                <ul class="catalog-items">
                                    @foreach($products as $product)
                                        <li class="catalog-items__card" id="catalog-items__{{ $product->id }}">
                                            <div class="product-card">
                                                <div class="product-card__status">
                                                    @if($product->options)
                                                        @foreach($product->options as $option)
                                                            @if($option->option_id == 151)
                                                                <div class="product-card__status-item" style="background:#f9791a;">
                                                                    {{ $option->option_value_text }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <a href="{{ route('frontend.product.detail', $product->slug) }}"
                                                   class="product-card__image product-card__image_cover">
                                                    <figure class="product-card__figure">
                                                        <img loading="lazy" src="{{ $product->image }}"
                                                             alt="{{ $product->name }}" class="base-img"
                                                             data-src="{{ $product->image }}" lazy="loaded">
                                                    </figure>
                                                    @if($product->options)
                                                        <div class="product-card__status product-card__status_right">
                                                            @foreach($product->options as $option)
                                                                @if($option->option_value_image && $option->option_id == 155)
                                                                    <img
                                                                            src="{{ $option->option_value_image }}"
                                                                            alt="{{ $option->option_value_text }}"
                                                                            class="product-card__status-picture">
                                                                    {{--                                                                    {{ $option->option_id }}--}}
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </a>
                                                <a
                                                        href="{{ route('frontend.product.detail', $product->slug) }}"
                                                        class="h3 product-card__name">
                                                    <span class="product-card__color">{{ $product->name }}</span>
                                                </a>
                                                <div class="product-card__price-line">
                                                    <div class="product-card__price-wrapper">
                                                        @if($product->special_price)
                                                            <div class="product-card__price product-card__price_old">
                                                                {{ $product->price }}
                                                            </div>
                                                            <div class="product-card__price">
                                                                {{ $product->special_price }}
                                                            </div>
                                                        @else
                                                            <div class="product-card__price">
                                                                {{ $product->price }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="product-card__buttons">
                                                        <a href="{{ route('frontend.product.detail', $product->slug) }}"
                                                           class="btn btn_block btn_accent product-card__btn product-card__btn_basket">
                                                            {{ language('frontend.catalog.more') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

    </main>
@endsection

@section('CSS')
    <link href="{{ asset('frontend/assets/plugins/Swiper/swiper.min.css') }}" type="text/css" rel="stylesheet"/>

    <style>

        /* ................................................ modal .......................................................... */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100vw;
        }

        .modal-content {
            background-color: #232228;
            padding: 0;
            height: 100%;
            width: 100%;
            min-width: 300px;
            animation-name: modalOpen;
            animation-duration: 150ms;
            border: none;
            border-radius: 0;
        }

        .closeBtn {
            position: absolute;
            z-index: 4;
            color: white;
            right: 5px;
            font-size: 40px;
            padding: 10px;
        }

        .closeBtn:hover, .closeBtn:focus {
            color: rgb(114, 114, 114);
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes modalOpen {
            from {
                opacity: 0
            }
            to {
                opacity: 1
            }
        }

        #swiper-container-modal {
            z-index: 3;
            width: 100%;
            height: 100%;
            overflow: hidden;
            padding: 0;
            border: 0;
        }

        #swiper-pagination-modal {
            display: none;
        }

        #swiper-button-next-modal {
            transform: translateX(-40%);
            color: white;
        }

        #swiper-button-prev-modal {
            transform: translateX(40%);
            color: white;
        }

        .swiper-slide-modal {
            height: 100vh;
        }

        .swiper-lazy-modal {
            object-fit: contain;
            border: 0;
        }

        /* ............................................. responsiveness ....................................................... */
        @media all and (max-width: 520px) {
            .swiper {
                width: calc(100vw - 20px);
            }

            .swiper-button-next:after {
                font-size: 20px !important;
                transform: translateX(60%);
            }


            .swiper-button-prev:after {
                font-size: 20px !important;
                transform: translateX(-60%);
            }

            #swiper-button-next-modal {
                font-size: 20px !important;
                transform: translateX(20%);
            }

            #swiper-button-prev-modal {
                font-size: 20px !important;
                transform: translateX(-20%);
            }

            .swiper-pagination {
                padding: 4px;
            }

            .swiper-slide-img {
                width: calc(100 vw-32px);
                height: auto;
                border: 16px solid #d8d8d8;
                min-height: calc((0.5338 * 100vw) + 48.476px);
            }

            .swiper-pagination .swiper-pagination-bullet {
                height: 12px;
                width: 12px;
            }

            .gallery-thumbs .swiper-slide img {
                height: 14vw;
            }

        }


        @media all and (max-width: 360px) {
            .swiper-slide-img {
                border: 1px solid #d8d8d8;
            }
        }
    </style>
@endsection

@section('JS')
    <script type="text/javascript" src="{{ asset('frontend/assets/plugins/Swiper/swiper.min.js') }}"></script>
    <script>

        @if($product->images)
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 7,
        });
        @endif


        var swiper = new Swiper('.swiper-container-main', {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            spaceBetween: 0,
            @if($product->images)
            thumbs: {
                swiper: galleryThumbs
            }
            @endif
        });

        // swiper - modal
        var swiperModal = new Swiper('.swiper-container-modal', {
            observer: true,
            observeParents: true,
            observeChildren: true,
            spaceBetween: 0,
            @if($product->images)
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            @endif
            zoom: {
                maxRatio: 2,
                toggle: true,
            },
            loop: true,
            preloadImages: false,
            lazy: true,
            lazy: {
                loadPrevNext: true,
                loadOnTransitionStart: true,
            },

            effect: 'coverflow',
            coverflowEffect: {
                rotate: 60,
                slideShadows: false,
            },
            loop: true,

        });


        const nonModalGalleryImgContainer = document.querySelector(
            '.swiper-container-main'
        );
        const nonModalGalleryImgWrapper = nonModalGalleryImgContainer.querySelector(
            '.swiper-wrapper'
        );
        var modal = document.getElementById('galleryModal');
        var modalBtn = document.querySelectorAll('.swiper-slide-img');
        var closeBtn = document.getElementsByClassName('closeBtn')[0];

        function openModal() {
            document.body.style.position = 'fixed';
            document.body.style.top = `-${window.scrollY}px`;

            let swiperIndexPos = swiper.activeIndex;
            swiperModal.slideTo(swiperIndexPos);
            swiperModal.lazy.load();
            modal.style.display = 'block';
            swiper.keyboard.disable();
            swiperModal.keyboard.enable();
            document.addEventListener('keydown', closeModalWithKeyboard);
        }

        modalBtn.forEach(element => {
            element.addEventListener('click', openModal);
        })

        function openModalWithKeyboard(event) {
            if (event.key === 'Enter') {
                openModal();
            }
        }

        nonModalGalleryImgContainer.addEventListener('keydown', openModalWithKeyboard);


        function closeModal() {
            const scrollY = document.body.style.top;
            document.body.style.position = '';
            document.body.style.top = '';
            window.scrollTo(0, parseInt(scrollY || '0') * -1);

            let swiperModalIndexPos = swiperModal.activeIndex;
            swiper.slideTo(swiperModalIndexPos);
            modal.style.display = 'none';
            swiperModal.keyboard.disable();
            swiper.keyboard.enable();
            document.removeEventListener('keydown', closeModalWithKeyboard);
        }

        closeBtn.addEventListener('click', closeModal);

        function closeModalWithKeyboard(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        }
    </script>
@endsection