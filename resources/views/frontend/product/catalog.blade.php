@extends('frontend.layouts.index')

@section('title',language('frontend.catalog.title'))
@section('keywords', language('frontend.catalog.keyword') )
@section('description', language('frontend.catalog.description') )

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
            </ul>
        </div>
        @endsection

        @section('content')

            <div class="container">
                <h1>{{ language('frontend.catalog.name') }}</h1>
            </div>

            <div class="content">
                <div class="catalog__wrapper container">
                    @if($categories)
                        <ul class="catalog-sections" style="margin-bottom: 20px">
                            @foreach($categories as $category)
                                <li class="catalog-sections__item">
                                    <a href="{{ route('frontend.product.category.detail', $category->slug) }}" class="catalog-sections__link">
                                        <div class="catalog-sections__image">
                                            <figure>
                                                <img
                                                    loading="lazy"
                                                    src="{{ $category->image }}"
                                                    alt="{{ $category->name }}"
                                                    class="base-img"
                                                    data-src="{{ $category->image }}"
                                                    lazy="loaded"
                                                >
                                            </figure>
                                        </div>
                                        <div class="h3 catalog-sections__item-title">{{ $category->name }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        No result
                    @endif

                    <div class="text-block">
                        {!! language('frontend.catalog.text') !!}
                    </div>
                </div>
            </div>
    </main>
@endsection

@section('CSS')
@endsection

@section('JS')

@endsection



