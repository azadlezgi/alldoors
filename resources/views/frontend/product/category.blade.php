@extends('frontend.layouts.index')

@section('title',empty($category->title) ? $category->name : $category->title)
@section('keywords', $category->keyword )
@section('description', $category->description  )

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
                           href="{{ route('frontend.product.category.detail', $category->slug) }}">
                            <span itemprop="name">{{ $category->name }}</span>
                        </a>
                        <meta itemprop="position" content="3">
                    </div>
                </li>
            </ul>
        </div>
        @endsection

        @section('content')

            <div class="container">
                <h1>{{ $category->name }}</h1>
            </div>


            <div class="catalog-section">
                <div class="container">
                    <div class="catalog-section__sort-line d-flex justify-content-md-end justify-content-between">
                        <div class="sort catalog-section__sort">
                            <span class="sort__desc">
                                {{ language('frontend.catalog.oprder_by') }}
                            </span>
                            <div class="sort__list">
                                <div class="sort__item-current dropdown-toggle1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="sort__item-option">
                                        @if($sort == "popular")
                                            {{ language('frontend.catalog.sort_popular') }}
                                        @elseif($sort == "price_asc")
                                            {{ language('frontend.catalog.sort_cheap') }}
                                        @elseif($sort == "price_desc")
                                            {{ language('frontend.catalog.sort_expensive') }}
                                        @else
                                            {{ language('frontend.catalog.sort_last') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="dropdown-menu">
                                    <div class="sort__list-options">
                                        <div class="sort__item">
                                            <a rel="nofollow"
                                               href="{{ route('frontend.product.category.detail', $category->slug) }}"
                                               class="sort__item-link">
                                                <span class="sort__item-option">{{ language('frontend.catalog.sort_last') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="sort__list-options">
                                        <div class="sort__item">
                                            <a rel="nofollow" href="{{ route('frontend.product.category.detail', $category->slug) }}?sort=popular" class="sort__item-link">
                                                <span class="sort__item-option">{{ language('frontend.catalog.sort_popular') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="sort__list-options">
                                        <div class="sort__item">
                                            <a rel="nofollow" href="{{ route('frontend.product.category.detail', $category->slug) }}?sort=price_asc" class="sort__item-link">
                                                <span class="sort__item-option">{{ language('frontend.catalog.sort_cheap') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="sort__list-options">
                                        <div class="sort__item">
                                            <a rel="nofollow" href="{{ route('frontend.product.category.detail', $category->slug) }}?sort=price_desc" class="sort__item-link">
                                                <span class="sort__item-option">{{ language('frontend.catalog.sort_expensive') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="catalog-section__filters-button d-md-none">
                            <span class="me-2">{{ language('frontend.general.filters') }}</span>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_filter"></use>
                                </svg>
                            </i>
                        </a>
                    </div>
                    <div class="catalog-section__wrapper">
                        <div class="catalog-section__filter">
                            <div class="catalog-filter">
                                <noindex>
                                    <form name="catalogfilter" action="{{ route('frontend.product.search') }}" method="get" class="catalog-filter__form">
                                        <div class="catalog-filter__wrapper">
                                            <a href="#" aria-label="{{ language('frontend.catalog.filter_close') }}" class="btn btn_close catalog-filter__close d-md-none"></a>
                                            <span class="h2">{{ language('frontend.general.filters') }}</span>
                                            <div class="catalog-filter__item catalog-filter__item_price">
                                                <button
                                                        type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active1 accordion-button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapsePrice"
                                                        aria-expanded="true"
                                                        aria-controls="collapsePrice"
                                                >
                                                    <span>{{ language('frontend.catalog.filter_price') }}</span>
                                                </button>
                                                <div id="collapsePrice" class="catalog-filter__fields collapse show" aria-labelledby="headingPrice">
                                                    <div class="catalog-filter__price">
                                                        <div class="catalog-filter__price-values">
                                                            <span class="catalog-filter__price-value catalog-filter__price-value_min" id="price-min_view"></span>
                                                            <span class="catalog-filter__price-value catalog-filter__price-value_max" id="price-max_view"></span>
                                                        </div>

                                                        <input type="hidden" name="price-min" id="price-min" value=""/>
                                                        <input type="hidden" name="price-max" id="price-max" value=""/>

                                                        <div id="price-slider" class="noUi-background mb-4"></div>

                                                    </div>
                                                </div>
                                            </div>
                                            @if($filter_options)
                                                @foreach($filter_options as $filter_option)
                                                    <div class="catalog-filter__item">
                                                        <button
                                                                type="button"
                                                                class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active1 accordion-button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseOption{{ $filter_option['id'] }}"
                                                                aria-expanded="true"
                                                                aria-controls="collapseOption{{ $filter_option['id'] }}"
                                                        >
                                                            <span>{{ $filter_option['name'] }}</span>
                                                        </button>
                                                        <div id="collapseOption{{ $filter_option['id'] }}" class="catalog-filter__fields collapse show"
                                                             aria-labelledby="headingOption{{ $filter_option['id'] }}">
                                                            @if($filter_option['values'])
                                                                <div class="options_teaser">
                                                                    @foreach($filter_option['values'] as $options_values)
                                                                        <div class="checkbox{{ $options_values['id'] }}">
                                                                            <input name="filter_options[{{ $filter_option['id'] }}]"
                                                                                   id="filter_section_{{ $options_values['id'] }}" type="checkbox" class="visually-hidden" value="{{ $options_values['id'] }}">
                                                                            <label for="filter_section_{{ $options_values['id'] }}" class="checkbox__label ms-2">
                                                                                @if($filter_option['type'] == 1 && $options_values['image'] != "")
                                                                                    <img src="{{ $options_values['image'] }}" alt="{{ $options_values['text'] }}"
                                                                                         style="width: 20px; height: 20px; display: inline-block"/>
                                                                                @endif
                                                                                {{ $options_values['text'] }}
                                                                            </label>
                                                                        </div>
                                                                        @if($loop->index == 5) </div>
                                                                <div class="options_complete"> @endif
                                                                    @endforeach
                                                                </div>
                                                                @if(count($filter_option['values']) > 5)
                                                                    <span class="options_more">{{ language('frontend.general.show_more') }}</span>
                                                                @endif
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="catalog-filter__buttons mt-3">
                                            <button type="submit" class="btn btn_block btn_accent catalog-filter__show">
                                                {{ language('frontend.general.filter_submit') }}
                                            </button>
                                            {{--                                            <a href="{{ route('frontend.product.category.detail', $category->slug) }}" class="btn btn_block catalog-filter__reset">--}}
                                            {{--                                                <span>{{ language('frontend.general.filter_reset') }}</span>--}}
                                            {{--                                            </a>--}}
                                        </div>

                                    </form>
                                </noindex>
                            </div>
                        </div>
                        <div class="catalog-section__items">
                            @if($products)
                                <ul class="catalog-items">
                                    @foreach($products as $product)
                                        <li class="catalog-items__card" id="catalog-items__{{ $product->id }}">
                                            <div class="product-card">
                                                <div class="product-card__status">
                                                    @if($product->options)
                                                        @foreach($product->options as $option)
                                                            @if($option->option_id == 151)
                                                                <div class="product-card__status-item"
                                                                     style="background:#f9791a;">
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
                                <div class="navigation">
                                    <div class="container">
                                        <div class="pagination">
                                            <ul class="pagination__list">
                                                {{ $products->appends(['search' => isset($searchText) ? $searchText : null])
                                           ->render('vendor.pagination.frontend.product-pagination') }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($category->text)
                                <section class="catalog-element-description mb-4 mb-md-2">
                                    {!! $category->text !!}
                                </section>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

    </main>
@endsection

@section('CSS')
    <link href="{{ asset('frontend/assets/plugins/icheck/skins/minimal/orange.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/plugins/noUiSlider/nouislider.min.css') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('JS')
    <script>
        $('.options_more').click(function () {
            if ($(this).parent().hasClass('options_more_show')) {
                $(this).parent().removeClass('options_more_show');
                $(this).text('{{ language('frontend.general.show_more') }}');
            } else {
                $(this).parent().addClass('options_more_show');
                $(this).text('{{ language('frontend.general.show_less') }}');
            }
        });

        $('.catalog-section__filters-button').click(function () {
                $('.catalog-filter').addClass('catalog-filter_opened');
        });

        $('.catalog-filter__close').click(function () {
                $('.catalog-filter').removeClass('catalog-filter_opened');
        });
    </script>
    <script type="text/javascript" src="{{ asset('frontend/assets/plugins/icheck/icheck.min.js') }}"></script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_minimal-orange',
            radioClass: 'iradio_minimal-orange'
        });
    </script>
    <script type="text/javascript" src="{{ asset('frontend/assets/plugins/noUiSlider/nouislider.min.js') }}"></script>
    <script>
        var priceSlider = document.getElementById('price-slider');
        noUiSlider.create(priceSlider, {
            connect: true,
            behaviour: 'tap',
            margin: 50,
            start: [100, 2000],
            step: 1,
            range: {
                'min': 0,
                'max': 2500
            }
        });


        var priceValues = [
            document.getElementById('price-min'),
            document.getElementById('price-max')
        ];
        var priceViews = [
            document.getElementById('price-min_view'),
            document.getElementById('price-max_view')
        ];


        priceSlider.noUiSlider.on('update', function (values, handle) {
            priceValues[handle].value = values[handle];
            priceViews[handle].innerHTML = parseInt(values[handle]) + "₼";
        });
    </script>
@endsection



