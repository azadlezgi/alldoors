@extends('frontend.layouts.index')

@section('title',language('frontend.collection.title'))
@section('keywords', language('frontend.collection.keyword') )
@section('description', language('frontend.collection.description') )

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
                           href="{{ route('frontend.product.collection') }}">
                            <span itemprop="name">{{ language('frontend.collection.name') }}</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </div>
                </li>
            </ul>
        </div>
        @endsection

        @section('content')

            <div class="container">
                <h1>{{ language('frontend.collection.name') }}</h1>
            </div>

            <div class="content">
                <div class="catalog__wrapper container">
                    @if($collections)
                        <ul class="catalog-sections" style="margin-bottom: 20px">
                            @foreach($collections as $collection)
                                <li class="catalog-sections__item">
                                    <a href="{{ route('frontend.product.collection.detail', $collection->slug) }}" class="catalog-sections__link">
                                        <div class="catalog-sections__image">
                                            <figure>
                                                <img
                                                    loading="lazy"
                                                    src="{{ $collection->image }}"
                                                    alt="{{ $collection->name }}"
                                                    class="base-img"
                                                    data-src="{{ $collection->image }}"
                                                    lazy="loaded"
                                                >
                                            </figure>
                                        </div>
                                        <div class="h3 catalog-sections__item-title">{{ $collection->name }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        No result
                    @endif

                    <div class="text-block">
                        {!! language('frontend.product.collection_text') !!}
                    </div>
                </div>
            </div>
    </main>
@endsection

@section('CSS')
@endsection

@section('JS')

@endsection



