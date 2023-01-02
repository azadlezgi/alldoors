@extends('frontend.layouts.index')

@section('title',language('frontend.blog.title'))
@section('keywords', language('frontend.blog.keywords') )
@section('description', language('frontend.blog.description') )



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
            </ul>
        </div>

        @endsection

        @section('content')

            <div class="container">
                <h1>{{ language('frontend.post.name') }}</h1>
            </div>


            <div class="container">
                @if($posts)
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

                    <div class="my-pagination">
                        <ul class="pagination">
                            {{ $posts->appends(['search' => isset($searchText) ? $searchText : null])
                                       ->render('vendor.pagination.frontend.my-pagination') }}

                        </ul>
                    </div>
                @else
                    No Result
                @endif

            </div>

    </main>

@endsection

@section('CSS')
@endsection

@section('JS')
@endsection



