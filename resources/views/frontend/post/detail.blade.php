@extends('frontend.layouts.index')

@section('title',empty($post->title) ? $post->name : $post->title)
@section('keywords', $post->keyword )
@section('description', $post->description  )


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
                           href="{{ route('frontend.post.index') }}">
                            <span itemprop="name">{{ language('frontend.post.name') }}</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </div>
                </li>
                <li>
                    <div itemscope="itemscope" itemprop="itemListElement" itemtype="http://schema.org/ListItem"
                         class="breadcrumbs__item">
                        <a itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing"
                           href="{{ route('frontend.post.detail',$post->slug) }}">
                            <span itemprop="name">{{ $post->name }}</span>
                        </a>
                        <meta itemprop="position" content="3">
                    </div>
                </li>
            </ul>
        </div>
        @endsection

        @section('content')

            <div class="detail">
                <div class="container">
                    <div class="detail__inner">
                        <div class="detail__main">
                            <div class="detail__title">
                                <h1>{{ $post->name }}</h1>
                            </div>
                            <div class="detail__card-date additional-text">{{ $post->date }}</div>
                            <img alt="{{ $post->name }}"
                                 src="{{ $post->image }}"
                                 class="detail__card-img detail__card-img_mobile">
                            <div class="detail__content content">
                                {!! $post->text !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if(count($posts) > 0)
                <div class="container">
                        <h2>{{ language('frontend.post.other') }}</h2>
                    <div class="cards-grid">

                        @foreach($posts as $post)
                            <div class="cards-grid__item">
                                <a href="{{ route('frontend.post.detail',$post->slug) }}" class="cards-grid__card-img">
                                    <figure>
                                        <img
                                            loading="lazy"
                                            src="{{ $post->image }}"
                                            alt="{{$post->name }}"
                                            class="base-img"
                                            data-src="{{ $post->image }}"
                                            lazy="loaded"
                                        >
                                    </figure>
                                </a>
                                <div class="cards-grid__card-content">
                                    <div class="cards-grid__card-date additional-text">{{$post->date }}</div>
                                    <a href="{{ route('frontend.post.detail',$post->slug) }}"
                                       class="cards-grid__card-title h4">{{$post->name }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

    </main>

@endsection

@section('CSS')
@endsection

@section('JS')
@endsection



