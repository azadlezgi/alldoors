@extends('frontend.layouts.index')

@section('title',empty($post->postsTranlations[0]->title) ? $post->postsTranlations[0]->name : $post->postsTranlations[0]->title)
@section('keywords', $post->postsTranlations[0]->keyword )
@section('description', $post->postsTranlations[0]->description  )


@section('breadcrumb')
    <!--  breadcrumb  -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 breadcrumb-my">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}">{{ language('genereal.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.post.index') }}">{{ language('frontend.post.all_name') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.post.index') }}">{{ language('frontend.category.all_name') }}</a></li>
                {!! \App\Services\PostsService::breadcrumbPostsCategories($fullCategorySlug,$languageID,$post->postsTranlations[0]->name) !!}
            </ol>
        </nav>
    </div>
@endsection

@section('content')

    <!-- CONTENT START -->
    <div class="content">
        <div class="container">
            <div class="products-item">
                <div class="row">
                    @if(!empty($post->image) || !empty($post->images))
                        <div class="col-md-7">

                            @if(empty($post->images))
                                <img
                                    src="{{ $post->image  }}"
                                    class="img-fluid mb-4" alt="{{ $post->postsTranlations[0]->name }}">
                            @else



                                <div class="swipe-slider">
                                    <div id="simpleModal" class="modal">
                                        <div class="slider-modal-content">
                                            <span class="closeBtn">&times;</span>
                                            <!-- Swiper modal -->
                                            <div id="swiper-container-modal" class="swiper-container-modal">
                                                <div class="swiper-wrapper">
                                                    @if(!empty($post->images))
                                                        @foreach(json_decode($post->images,true) as $postImage)
                                                            <div class="swiper-slide swiper-slide-modal">
                                                                <div class="swiper-zoom-container">
                                                                    <img class="swiper-lazy swiper-lazy-modal"
                                                                         data-src="{{ $postImage }}">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif


                                                </div>
                                                <!-- Add Pagination -->
                                                <div id="swiper-pagination-modal" class="swiper-pagination"></div>
                                                <!-- Add Pagination -->
                                                <div id="swiper-button-next-modal" class="swiper-button-next"></div>
                                                <div id="swiper-button-prev-modal" class="swiper-button-prev"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Swiper -->
                                    <div class="swiper-container swiper-container-main">
                                        <div class="swiper-wrapper">

                                            @if(!empty($post->images))
                                                @foreach(json_decode($post->images,true) as $postImage)

                                                    <div class="swiper-slide minimum-height"><img
                                                            class="swiper-slide-img"
                                                            src="{{$postImage }}">
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                        <!-- Add Pagination -->
                                        <!--                            <div class="swiper-pagination"></div>-->
                                        <!-- Add Pagination -->
                                        <!--                            <div class="swiper-button-next"></div>-->
                                        <!--                            <div class="swiper-button-prev"></div>-->
                                    </div>

                                    <!-- Swiper thumbnails -->
                                    <div class="swiper-container post-thumbs">
                                        <div class="swiper-wrapper">

                                            @if(!empty($post->images))
                                                @foreach(json_decode($post->images,true) as $postImage)
                                                    <div class="swiper-slide swiper-slide-thumbs">
                                                        <img src="{{ $postImage }}">
                                                    </div>
                                                @endforeach
                                            @endif


                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            @endif
                        </div>
                    @endif

                    <div class="col-md-5">
                        <div class="post-item-details">
                            <h4>{{ $post->postsTranlations[0]->name }}</h4>
                            <p>
                                {!! $post->postsTranlations[0]->text !!}
                            </p>
                            <!--  Kateqoriyalar  -->
                            @isset($post->postsCategoriesCheck)
                                <div class="post-item-categories">
                                    <div>{!! language('frontend.category.name') !!}</div>
                                    <div>
                                        @isset($post->postsCategoriesCheck)
                                            @foreach($post->postsCategoriesCheck as $category)
                                                <a href="{{ route('frontend.post.category.index',$category->slug) }}">
                                                    {{ $category->name }}
                                                </a>
                                                @if (!$loop->last)&nbsp;,&nbsp;@endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            @endisset

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- CONTENT END -->



@endsection

@section('CSS')
    <!-- THIS PAGE -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/plugins/swipe-slider/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/plugins/swipe-slider/css/swipeslider.min.css') }}">
@endsection

@section('JS')
    <!-- THIS PAGE -->
    <script src="{{ asset('frontend/assets/plugins/swipe-slider/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/swipe-slider/js/swipeslider.js') }}"></script>

@endsection



