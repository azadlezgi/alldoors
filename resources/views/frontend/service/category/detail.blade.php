@extends('frontend.layouts.index')

@section('title',empty($service->servicesTranlations[0]->title) ? $service->servicesTranlations[0]->name : $service->servicesTranlations[0]->title)
@section('keywords', $service->servicesTranlations[0]->keyword )
@section('description', $service->servicesTranlations[0]->description  )

@section('breadcrumb')
    <!--  breadcrumb  -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 breadcrumb-my">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}">{{ language('genereal.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.service.index') }}">{{ language('frontend.service.all_name') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.service.index') }}">{{ language('frontend.category.all_name') }}</a></li>
                {!! \App\Services\CategoriesService::breadcrumbServicesCategories($fullCategorySlug,$languageID,$service->servicesTranlations[0]->name) !!}
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
                    @if(!empty($service->image) || !empty($service->images))
                        <div class="col-md-7">

                            @if(empty($service->images))
                                <img
                                    src="{{ $service->image  }}"
                                    class="img-fluid mb-4" alt="{{ $service->servicesTranlations[0]->name }}">
                            @else



                                <div class="swipe-slider">
                                    <div id="simpleModal" class="modal">
                                        <div class="slider-modal-content">
                                            <span class="closeBtn">&times;</span>
                                            <!-- Swiper modal -->
                                            <div id="swiper-container-modal" class="swiper-container-modal">
                                                <div class="swiper-wrapper">
                                                    @if(!empty($service->images))
                                                        @foreach(json_decode($service->images,true) as $serviceImage)
                                                            <div class="swiper-slide swiper-slide-modal">
                                                                <div class="swiper-zoom-container">
                                                                    <img class="swiper-lazy swiper-lazy-modal"
                                                                         data-src="{{ $serviceImage }}">
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

                                            @if(!empty($service->images))
                                                @foreach(json_decode($service->images,true) as $serviceImage)

                                                    <div class="swiper-slide minimum-height"><img
                                                            class="swiper-slide-img"
                                                            src="{{$serviceImage }}">
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
                                    <div class="swiper-container service-thumbs">
                                        <div class="swiper-wrapper">

                                            @if(!empty($service->images))
                                                @foreach(json_decode($service->images,true) as $serviceImage)
                                                    <div class="swiper-slide swiper-slide-thumbs">
                                                        <img src="{{ $serviceImage }}">
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
                        <div class="service-item-details">
                            <h4>{{ $service->servicesTranlations[0]->name }}</h4>
                            <p>
                                {!! $service->servicesTranlations[0]->text !!}
                            </p>
                            <!--  Kateqoriyalar  -->
                            @isset($service->servicesCategoriesCheck)
                                <div class="service-item-categories">
                                    <div>{!! language('frontend.category.name') !!}</div>
                                    <div>
                                        @isset($service->servicesCategoriesCheck)
                                            @foreach($service->servicesCategoriesCheck as $category)
                                                <a href="{{ route('frontend.service.category.index',$category->slug) }}">
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



