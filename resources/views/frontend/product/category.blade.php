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
                    <div class="catalog-section__sort-line">
                        <div class="sort catalog-section__sort">
                            <span class="sort__desc">
                                Показывать сначала:
                            </span>
                            <div class="sort__list">
                                <div class="sort__item-current">
                                    <span class="sort__item-desc">Сначала</span>
                                    <span class="sort__item-option">Новинки</span>
                                </div>
                                <div class="sort__list-options">
                                    <div class="sort__item">
                                        <a rel="nofollow"
                                           href="/catalog/mezhkomnatnye-dveri/?sort=shows"
                                           class="sort__item-link"><span class="sort__item-desc">Сначала </span>
                                            <span class="sort__item-option"> Популярные</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="sort__list-options">
                                    <div class="sort__item">
                                        <a rel="nofollow"
                                           href="/catalog/mezhkomnatnye-dveri/?sort=price_asc"
                                           class="sort__item-link"><span class="sort__item-desc">Сначала </span>
                                            <span class="sort__item-option"> Дешевые</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="sort__list-options">
                                    <div class="sort__item">
                                        <a rel="nofollow"
                                           href="/catalog/mezhkomnatnye-dveri/?sort=price_desc"
                                           class="sort__item-link"><span class="sort__item-desc">Сначала </span>
                                            <span class="sort__item-option"> Дорогие</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn catalog-section__filters-button"><span>Фильтры</span> <i>
                                <svg class="icon">
                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_filter"></use>
                                </svg>
                            </i>
                        </a>
                    </div>
                    <div class="catalog-section__wrapper">
                        <div class="catalog-section__filter">
                            <div class="catalog-filter">
                                <div class="catalog-filter__wrapper">
                                    <noindex><a href="#" aria-label="Закрыть фильтр"
                                                class="btn btn_close catalog-filter__close"></a> <span class="h2">Фильтры</span>
                                        <form name="catalogfilter" method="get" class="catalog-filter__form">
                                            <div class="catalog-filter__item catalog-filter__item_price">
                                                <button type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active">
                                                    <span>Цена</span></button>
                                                <div class="catalog-filter__fields" style="max-height: 148px;">
                                                    <div class="catalog-filter__price">
                                                        <div class="catalog-filter__price-values"><span
                                                                class="catalog-filter__price-value catalog-filter__price-value_min">
                    4465 ₽
                </span> <span class="catalog-filter__price-value catalog-filter__price-value_max">
                    16840 ₽
                </span></div>
                                                        <div class="vue-slider vue-slider-ltr"
                                                             style="padding: 8px; width: auto; height: 4px;">
                                                            <div class="vue-slider-rail">
                                                                <div class="vue-slider-process"
                                                                     style="height: 100%; top: 0px; left: 0%; width: 100%; transition-property: width, left; transition-duration: 0.5s;"></div>
                                                                <div aria-valuetext="4465" class="vue-slider-dot"
                                                                     role="slider" aria-valuenow="4465"
                                                                     aria-valuemin="4465" aria-valuemax="16840"
                                                                     aria-orientation="horizontal" tabindex="0"
                                                                     style="width: 16px; height: 16px; transform: translate(-50%, -50%); top: 50%; left: 0%; transition: left 0.5s ease 0s;">
                                                                    <div class="catalog-filter__dot"></div>
                                                                </div>
                                                                <div aria-valuetext="16840" class="vue-slider-dot"
                                                                     role="slider" aria-valuenow="16840"
                                                                     aria-valuemin="4465" aria-valuemax="16840"
                                                                     aria-orientation="horizontal" tabindex="0"
                                                                     style="width: 16px; height: 16px; transform: translate(-50%, -50%); top: 50%; left: 100%; transition: left 0.5s ease 0s;">
                                                                    <div class="catalog-filter__dot"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="catalog-filter__item">
                                                <button type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active">
                                                    <span>Статус</span></button>
                                                <div class="catalog-filter__fields" style="max-height: 224px;">
                                                    <div class="checkbox"><input name="filter_section_2267"
                                                                                 id="filter_section_2267"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2267" class="checkbox__label"><!---->
                                                            Новинка <span class="checkbox__count">10</span></label>
                                                        <!----></div><!---->
                                                    <div class="checkbox"><input name="filter_section_2443"
                                                                                 id="filter_section_2443"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2443" class="checkbox__label"><!---->
                                                            Хит продаж <span class="checkbox__count">17</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_2444"
                                                                                 id="filter_section_2444"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2444" class="checkbox__label"><!---->
                                                            Эксклюзив <span class="checkbox__count">4</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_2458"
                                                                                 id="filter_section_2458"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2458" class="checkbox__label"><!---->
                                                            Под заказ <span class="checkbox__count">65</span></label>
                                                        <!----></div>
                                                </div>
                                            </div><!----><!---->
                                            <div class="catalog-filter__item">
                                                <button type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active">
                                                    <span>Тип</span></button>
                                                <div class="catalog-filter__fields" style="max-height: 188px;">
                                                    <div class="checkbox"><input name="filter_section_1925"
                                                                                 id="filter_section_1925"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1925" class="checkbox__label"><!---->
                                                            Глухие <span class="checkbox__count">81</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1953"
                                                                                 id="filter_section_1953"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1953" class="checkbox__label"><!---->
                                                            Остеклённые <span class="checkbox__count">128</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_2379"
                                                                                 id="filter_section_2379"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2379" class="checkbox__label"><!---->
                                                            С зеркалом <span class="checkbox__count">19</span></label>
                                                        <!----></div>
                                                </div>
                                            </div><!---->
                                            <div class="catalog-filter__item">
                                                <button type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active">
                                                    <span>Цвет</span></button>
                                                <div class="catalog-filter__fields" style="max-height: 260px;"><!---->
                                                    <!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                                    <!----><!----><!----><!----><!----><!---->
                                                    <div class="checkbox checkbox_color"><input
                                                            name="filter_section_1997" id="filter_section_1997"
                                                            type="checkbox" class="visually-hidden" value="Y"> <label
                                                            for="filter_section_1997" class="checkbox__label"><img
                                                                src="/upload/resize_cache/iblock/e3c/600_600_1/e3c0c1643cccfcf538cc48acef3bc13b.png"
                                                                alt="Светлый" class="checkbox__color">
                                                            Светлый <span class="checkbox__count">43</span></label>
                                                        <!----></div><!---->
                                                    <div class="checkbox checkbox_color"><input
                                                            name="filter_section_1999" id="filter_section_1999"
                                                            type="checkbox" class="visually-hidden" value="Y"> <label
                                                            for="filter_section_1999" class="checkbox__label"><img
                                                                src="/upload/resize_cache/iblock/d97/600_600_1/d97cf06ec21a83a812a4750caf976851.png"
                                                                alt="Серый" class="checkbox__color">
                                                            Серый <span class="checkbox__count">47</span></label>
                                                        <!----></div><!----><!---->
                                                    <div class="checkbox checkbox_color"><input
                                                            name="filter_section_2000" id="filter_section_2000"
                                                            type="checkbox" class="visually-hidden" value="Y"> <label
                                                            for="filter_section_2000" class="checkbox__label"><img
                                                                src="/upload/resize_cache/iblock/01a/600_600_1/01ab6f57f360768406b563f01c84e08d.png"
                                                                alt="Тёмный" class="checkbox__color">
                                                            Тёмный <span class="checkbox__count">24</span></label>
                                                        <!----></div><!----><!----><!----><!----><!----><!----><!---->
                                                    <!----><!----><!----><!---->
                                                    <div class="checkbox checkbox_color"><input
                                                            name="filter_section_1996" id="filter_section_1996"
                                                            type="checkbox" class="visually-hidden" value="Y"> <label
                                                            for="filter_section_1996" class="checkbox__label"><img
                                                                src="/upload/resize_cache/iblock/de4/600_600_1/de45f69f4d47cc278890c774d8ee56c5.png"
                                                                alt="Белый" class="checkbox__color">
                                                            Белый <span class="checkbox__count">64</span></label>
                                                        <!----></div><!----><!----><!----><!----><!----><!----><!---->
                                                    <!---->
                                                    <div class="checkbox checkbox_color"><input
                                                            name="filter_section_1998" id="filter_section_1998"
                                                            type="checkbox" class="visually-hidden" value="Y"> <label
                                                            for="filter_section_1998" class="checkbox__label"><img
                                                                src="/upload/resize_cache/iblock/1fa/600_600_1/1fa84f6bb6a0b636f0eacb9352dcdb56.png"
                                                                alt="Древесный" class="checkbox__color">
                                                            Древесный <span class="checkbox__count">33</span></label>
                                                        <!----></div><!----><!----><!----><!----><!----><!----><!---->
                                                    <!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                                </div>
                                            </div>
                                            <div class="catalog-filter__item">
                                                <button type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active">
                                                    <span>Стиль</span></button>
                                                <div class="catalog-filter__fields" style="max-height: 332px;">
                                                    <div class="checkbox"><input name="filter_section_1961"
                                                                                 id="filter_section_1961"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1961" class="checkbox__label"><!---->
                                                            Современный <span class="checkbox__count">170</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1962"
                                                                                 id="filter_section_1962"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1962" class="checkbox__label"><!---->
                                                            Классический <span class="checkbox__count">20</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1963"
                                                                                 id="filter_section_1963"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1963" class="checkbox__label"><!---->
                                                            Неоклассика <span class="checkbox__count">59</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1964"
                                                                                 id="filter_section_1964"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1964" class="checkbox__label"><!---->
                                                            Модерн <span class="checkbox__count">112</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1965"
                                                                                 id="filter_section_1965"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1965" class="checkbox__label"><!---->
                                                            Хай-Тек <span class="checkbox__count">41</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1966"
                                                                                 id="filter_section_1966"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1966" class="checkbox__label"><!---->
                                                            Скандинавский <span
                                                                class="checkbox__count">58</span></label> <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1967"
                                                                                 id="filter_section_1967"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1967" class="checkbox__label"><!---->
                                                            Лофт <span class="checkbox__count">36</span></label> <!---->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="catalog-filter__item">
                                                <button type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active">
                                                    <span>Покрытие</span></button>
                                                <div class="catalog-filter__fields" style="max-height: 332px;">
                                                    <div class="checkbox"><input name="filter_section_1969"
                                                                                 id="filter_section_1969"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1969" class="checkbox__label"><!---->
                                                            Экошпон <span class="checkbox__count">115</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1977"
                                                                                 id="filter_section_1977"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1977" class="checkbox__label"><!---->
                                                            Soft touch <span class="checkbox__count">34</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1978"
                                                                                 id="filter_section_1978"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1978" class="checkbox__label"><!---->
                                                            Eco flex <span class="checkbox__count">12</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1970"
                                                                                 id="filter_section_1970"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1970" class="checkbox__label"><!---->
                                                            3D flex <span class="checkbox__count">5</span></label>
                                                        <!----></div><!---->
                                                    <div class="checkbox"><input name="filter_section_1972"
                                                                                 id="filter_section_1972"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1972" class="checkbox__label"><!---->
                                                            Эмаль <span class="checkbox__count">34</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1979"
                                                                                 id="filter_section_1979"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1979" class="checkbox__label"><!---->
                                                            Под покраску <span class="checkbox__count">2</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1975"
                                                                                 id="filter_section_1975"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1975" class="checkbox__label"><!---->
                                                            Крашенные <span class="checkbox__count">1</span></label>
                                                        <!----></div><!----></div>
                                            </div>
                                            <div class="catalog-filter__item">
                                                <button type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active">
                                                    <span>Серия</span></button>
                                                <div class="catalog-filter__fields" style="max-height: 764px;">
                                                    <div class="checkbox"><input name="filter_section_1930"
                                                                                 id="filter_section_1930"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1930" class="checkbox__label"><!---->
                                                            Duplex <span class="checkbox__count">14</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1928"
                                                                                 id="filter_section_1928"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1928" class="checkbox__label"><!---->
                                                            Alto <span class="checkbox__count">40</span></label> <!---->
                                                    </div>
                                                    <div class="checkbox"><input name="filter_section_1943"
                                                                                 id="filter_section_1943"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1943" class="checkbox__label"><!---->
                                                            Premier <span class="checkbox__count">29</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1944"
                                                                                 id="filter_section_1944"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1944" class="checkbox__label"><!---->
                                                            Next <span class="checkbox__count">6</span></label> <!---->
                                                    </div>
                                                    <div class="checkbox"><input name="filter_section_1929"
                                                                                 id="filter_section_1929"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1929" class="checkbox__label"><!---->
                                                            Techno <span class="checkbox__count">16</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1949"
                                                                                 id="filter_section_1949"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1949" class="checkbox__label"><!---->
                                                            Scandi <span class="checkbox__count">26</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_2590"
                                                                                 id="filter_section_2590"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2590" class="checkbox__label"><!---->
                                                            Scandi Neo <span class="checkbox__count">4</span></label>
                                                        <!----></div><!---->
                                                    <div class="checkbox"><input name="filter_section_1950"
                                                                                 id="filter_section_1950"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1950" class="checkbox__label"><!---->
                                                            City <span class="checkbox__count">12</span></label> <!---->
                                                    </div>
                                                    <div class="checkbox"><input name="filter_section_1940"
                                                                                 id="filter_section_1940"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1940" class="checkbox__label"><!---->
                                                            Unica <span class="checkbox__count">5</span></label> <!---->
                                                    </div>
                                                    <div class="checkbox"><input name="filter_section_1941"
                                                                                 id="filter_section_1941"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1941" class="checkbox__label"><!---->
                                                            Linea <span class="checkbox__count">5</span></label> <!---->
                                                    </div><!---->
                                                    <div class="checkbox"><input name="filter_section_1932"
                                                                                 id="filter_section_1932"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1932" class="checkbox__label"><!---->
                                                            Smart Z <span class="checkbox__count">16</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_1927"
                                                                                 id="filter_section_1927"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_1927" class="checkbox__label"><!---->
                                                            Invisible <span class="checkbox__count">2</span></label>
                                                        <!----></div><!----><!----><!----><!----><!----><!----><!---->
                                                    <!----><!---->
                                                    <div class="checkbox"><input name="filter_section_2264"
                                                                                 id="filter_section_2264"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2264" class="checkbox__label"><!---->
                                                            Xline <span class="checkbox__count">8</span></label> <!---->
                                                    </div>
                                                    <div class="checkbox"><input name="filter_section_2265"
                                                                                 id="filter_section_2265"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2265" class="checkbox__label"><!---->
                                                            Trend <span class="checkbox__count">2</span></label> <!---->
                                                    </div>
                                                    <div class="checkbox"><input name="filter_section_2266"
                                                                                 id="filter_section_2266"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2266" class="checkbox__label"><!---->
                                                            Villa <span class="checkbox__count">9</span></label> <!---->
                                                    </div><!----><!----><!----><!----><!----><!----><!----><!---->
                                                    <!----><!---->
                                                    <div class="checkbox"><input name="filter_section_2419"
                                                                                 id="filter_section_2419"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2419" class="checkbox__label"><!---->
                                                            Вителия <span class="checkbox__count">4</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_2420"
                                                                                 id="filter_section_2420"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2420" class="checkbox__label"><!---->
                                                            Олимпия <span class="checkbox__count">4</span></label>
                                                        <!----></div><!----><!----><!----><!----><!----><!----><!---->
                                                    <!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                                    <!----><!----><!----><!---->
                                                    <div class="checkbox"><input name="filter_section_2586"
                                                                                 id="filter_section_2586"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2586" class="checkbox__label"><!---->
                                                            Fly <span class="checkbox__count">2</span></label> <!---->
                                                    </div><!---->
                                                    <div class="checkbox"><input name="filter_section_2591"
                                                                                 id="filter_section_2591"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2591" class="checkbox__label"><!---->
                                                            Ledo <span class="checkbox__count">4</span></label> <!---->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="catalog-filter__item">
                                                <button type="button"
                                                        class="btn btn_block btn_lined catalog-filter__item-btn catalog-filter__item-btn_active">
                                                    <span>Производитель</span></button>
                                                <div class="catalog-filter__fields" style="max-height: 152px;">
                                                    <div class="checkbox"><input name="filter_section_2141"
                                                                                 id="filter_section_2141"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2141" class="checkbox__label"><!---->
                                                            Velldoris <span class="checkbox__count">201</span></label>
                                                        <!----></div>
                                                    <div class="checkbox"><input name="filter_section_2142"
                                                                                 id="filter_section_2142"
                                                                                 type="checkbox" class="visually-hidden"
                                                                                 value="Y"> <label
                                                            for="filter_section_2142" class="checkbox__label"><!---->
                                                            Dverihall <span class="checkbox__count">8</span></label>
                                                        <!----></div>
                                                </div>
                                            </div><!----><!----><!----><!----><!---->
                                            <button type="button"
                                                    class="btn btn_block catalog-filter__reset catalog-filter__reset_additional">
                                                <span>Дополнительные параметры</span></button> <!----><!----><!---->
                                            <!----><!----><!----></form>
                                    </noindex>
                                </div>
                                <div class="catalog-filter__buttons">
                                    <noindex>
                                        <button type="button" class="btn btn_block catalog-filter__show">
                                            Показать выбранное
                                        </button>
                                        <a href="/catalog/mezhkomnatnye-dveri/"
                                           class="btn btn_block catalog-filter__reset"><span>Сбросить фильтр</span></a>
                                    </noindex>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-section__items">
                            @if($products)
                                <ul class="catalog-items">
                                    @foreach($products as $product)
                                        <li class="catalog-items__card" id="catalog-items__{{ $product->id }}">
                                            <div class="product-card">
                                                <div class="product-card__status">
                                                    <div class="product-card__status-item" style="background:#f9791a;">
                                                        Хит продаж
                                                    </div>
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
                                                                @if($option->option_value_image)
                                                                    <img
                                                                        src="{{ $option->option_value_image }}"
                                                                        alt="{{ $option->option_value_text }}"
                                                                        class="product-card__status-picture">
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </a>
                                                <a
                                                    href="{{ route('frontend.product.detail', $product->slug) }}"
                                                    class="h3 product-card__name">
                                                    {{ $product->name }}
                                                    <span class="product-card__color"></span>
                                                </a>
                                                <div class="product-card__price-line">
                                                    <div class="product-card__price-wrapper">
                                                        <div class="product-card__price product-card__price_old">
                                                            {{ $product->price }}
                                                        </div>
                                                        <div class="product-card__price">
                                                            {{ $product->price }}
                                                        </div>
                                                    </div>
                                                    <div class="product-card__buttons">
                                                        <a {{ route('frontend.product.detail', $product->slug) }} class="btn product-card__btn product-card__btn_basket">
                                                            dddds
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="navigation">
                                    <div class="container">
                                        <div class="pagination"><!---->
                                            <ul class="pagination__list">
                                                {{ $products->appends(['search' => isset($searchText) ? $searchText : null])
                                           ->render('vendor.pagination.frontend.product-pagination') }}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($category->text)
                                <section class="catalog-element-description">
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
@endsection

@section('JS')

@endsection



