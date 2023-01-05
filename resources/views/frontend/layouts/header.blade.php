<!DOCTYPE html>
<html lang="{{ request('currentLang') }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="{{ asset('frontend/assets/plugins/fontawesome/css/fontawesome-all.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/plugins/owlcarousel/assets/owl.carousel.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/plugins/owlcarousel/assets/owl.theme.default.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/plugins/animate/animate.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/plugins/bootstrap/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/css/layout.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/css/components.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/socicon/css/socicon.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/css/main.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('frontend/assets/css/style.css') }}" type="text/css" rel="stylesheet"/>
    @yield('CSS')
</head>

<body>

<div id="app" data-server-rendered="true" class="layout">
    <header class="header header--fixed">
        <div class="container">
            <div class="header__top-line">
                <div class="logo">
                    <a href="{{ route('frontend.home.index') }}" class="logo__link">
                        <img src="{{ asset('storage') }}/{{ setting('logo') }}" alt="{{ language('general.title') }}">
                    </a>
                </div>

                <div class="header__search header__search_desktop search search_shown" style="">
                    <form action="/search/" class="search__form">
                        <input type="search" name="q" placeholder="{{ language('general.search') }}"
                               class="input input_search search__input">
                        <label class="label">{{ language('general.search') }}</label>
                        <button type="submit" class="btn search__link">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="{{ asset('frontend/assets/img/icons.svg') }}#ico_loupe"></use>
                                </svg>
                            </i>
                        </button>
                    </form>
                </div>

                <div itemscope="itemscope" itemtype="http://schema.org/Organization"
                     class="salon header__salon header__salon--line header__salon--desktop">
                    <meta itemprop="name" content="{{ language('general.title') }}">
                    <span itemprop="address" itemscope="itemscope" itemtype="http://schema.org/PostalAddress"
                          class="salon__address">
                        <span itemprop="streetAddress">
                            @if(!empty(setting('address',true)))
                                {!! setting('address',true) !!}
                            @endif
                        </span>
                    </span>
                </div>

                <ul class="icons header__icons">
                    @if(!empty(json_decode(setting('tel'))))
                        @foreach(json_decode(setting('tel')) as $key => $value)
                            @if($loop->first)
                                <li class="salon__phone d-none d-md-block">
                                    <a itemprop="telephone" class="phone__link"
                                       href="tel:{{ \App\Services\CommonService::telText( $value->tel )[0] }}">{{ \App\Services\CommonService::telText( $value->tel )[1] }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                    <li>
                        <div class="lt-language d-xl-block">
                            <p class="current">
                                @foreach($allLanguages as $language)
                                    @if($currentLang == $language->code)
                                        <img src="{{ countryFlag($language->code) }}" alt="{{ $language->short_name }}">
                                        {{ mb_strtoupper($language->short_name) }}
                                    @endif
                                @endforeach
                            </p>
                            <ul class="list">
                                @foreach($allLanguages as $language)
                                    @if($currentLang != $language->code)
                                        <li data-language-code="{{ $language->code }}"
                                            class="language-change-request">
                                            <img src="{{ countryFlag($language->code) }}"
                                                 alt="{{ $language->short_name }}">
                                            <a href="javascript:void(0)">{{ mb_strtoupper($language->short_name) }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
                <button type="button" class="btn header__burger header__burger--mobile" type="button">
                    <span>{{ language('general.menu') }}</span>
                </button>
            </div>
        </div>
        <div class="header__menu-line">
            <div class="container">
                <div class="header__menu-wrapper">
                    <button type="button" class="btn header__burger header__burger--tablet" type="button">
                        <span>{{ language('general.menu') }}</span>
                    </button>
                    <div class="slide-menu" style="display: none;">
                        <div class="slide-menu__wrapper slide-menu__wrapper_short">
                            <div class="burger-menu">
                                <div class="container">
                                    <nav class="burger-nav">
                                        <ul class="burger-nav__list">
                                            @php
                                                $params = [
                                                    'li_class' => "burger-nav__item",
                                                    'a_class' => "burger-nav__link"
                                                ];
                                            @endphp
                                            {!! \App\Services\MenuServices::getMenu($HTTP_HOST,$languageID,1,0,[], $params) !!}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>


                    <nav class="header-menu header__menu header__menu_tablet">
                        <ul class="header-menu__list">
                            @php
                                $params = [
                                    'li_class' => "header-menu__item",
                                    'a_class' => "header-menu__link text-uppercase"
                                ];
                            @endphp
                            {!! \App\Services\MenuServices::getMenu($HTTP_HOST,$languageID,1,0,[], $params) !!}
                        </ul>
                    </nav>
                    <div class="callbacklink header__callback header__callback--orange header__callback--tablet">
                        <button class="btn btn_block btn_bordered" data-bs-toggle="modal" data-bs-target="#call_usModal">{{ language('general.call_us') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </header>



