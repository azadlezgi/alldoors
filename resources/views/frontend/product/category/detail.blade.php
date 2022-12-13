@extends('frontend.layouts.index')

@section('title',empty($product->productsTranlations[0]->title) ? $product->productsTranlations[0]->name : $product->productsTranlations[0]->title)
@section('keywords', $product->productsTranlations[0]->keyword )
@section('description', $product->productsTranlations[0]->description  )


@section('breadcrumb')
    <!--  breadcrumb  -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 breadcrumb-my">
                <li class="breadcrumb-item"><a
                        href="{{ route('frontend.home.index') }}">{{ language('genereal.home') }}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('frontend.product.index') }}">{{ language('frontend.product.all_name') }}</a>
                <li class="breadcrumb-item"><a
                        href="{{ route('frontend.product.index') }}">{{ language('frontend.category.all_name') }}</a>
                </li>
                {!! \App\Services\CategoriesService::breadcrumbCategories($fullCategorySlug,$languageID,$product->productsTranlations[0]->name) !!}
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
                    @if(!empty($product->image) || !empty($product->images))
                        <div class="col-md-7">

                            @if(empty($product->images))
                                <img
                                    src="{{ $product->image  }}"
                                    class="img-fluid mb-4" alt="{{ $product->productsTranlations[0]->name }}">
                            @else



                                <div class="swipe-slider">
                                    <div id="simpleModal" class="modal">
                                        <div class="slider-modal-content">
                                            <span class="closeBtn">&times;</span>
                                            <!-- Swiper modal -->
                                            <div id="swiper-container-modal" class="swiper-container-modal">
                                                <div class="swiper-wrapper">
                                                    @if(!empty($product->images))
                                                        @foreach(json_decode($product->images,true) as $productImage)
                                                            <div class="swiper-slide swiper-slide-modal">
                                                                <div class="swiper-zoom-container">
                                                                    <img class="swiper-lazy swiper-lazy-modal"
                                                                         data-src="{{ $productImage }}">
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

                                            @if(!empty($product->images))
                                                @foreach(json_decode($product->images,true) as $productImage)

                                                    <div class="swiper-slide minimum-height"><img
                                                            class="swiper-slide-img"
                                                            src="{{$productImage }}">
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
                                    <div class="swiper-container gallery-thumbs">
                                        <div class="swiper-wrapper">

                                            @if(!empty($product->images))
                                                @foreach(json_decode($product->images,true) as $productImage)
                                                    <div class="swiper-slide swiper-slide-thumbs">
                                                        <img src="{{ $productImage }}">
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
                        <div class="product-item-details">
                            <h4>{{ $product->productsTranlations[0]->name }}</h4>
                            <p>
                                {!! $product->productsTranlations[0]->text !!}
                            </p>

                            <!--  Kateqoriyalar  -->
                            @isset($product->productsCategoriesCheck)
                                <div class="product-item-model">
                                    <div>{!! language('frontend.category.name') !!}</div>
                                    <div>
                                        @isset($product->productsCategoriesCheck)
                                            @foreach($product->productsCategoriesCheck as $category)
                                                <a href="{{ route('frontend.product.category.index',$category->slug) }}">
                                                    {{ $category->name }}
                                                </a>
                                                @if (!$loop->last)&nbsp;,&nbsp;@endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            @endisset

                        <!--  MODEL  -->
                            @isset($product->getProductModel)
                                <div class="product-item-model">
                                    <div>{!! language('frontend.model.name') !!}</div>
                                    <div>{{ \App\Services\ModelsService::getProductModelName($product->getProductModel->model_id,$languageID)->name }}</div>
                                </div>
                            @endisset

                        <!--  TEYINAT  -->
                            @isset($product->getProductDestination)
                                <div class="product-item-teyinat">
                                    <div>{!! language('frontend.destination.name') !!}</div>
                                    <div>{{ \App\Services\DestinationService::getProductDestinationName($product->getProductDestination->destination_id,$languageID)->name }}</div>
                                </div>
                            @endisset

                            @if($product->price != null)
                                <div class="product-item-price">
                                    <h5>{{ language('frontend.product.price') }}</h5>
                                    <div>{{ $product->price }} AZN</div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="features">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="categories">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <!--  ATTRIBUTES  -->
                                    @if(!empty($checkAttributeGroupList))
                                        <li class="nav-item">
                                            <button class="nav-link active" id="features-tab" data-bs-toggle="tab"
                                                    data-bs-target="#features"
                                                    type="button" role="tab" aria-controls="features"
                                                    aria-selected="true">
                                                {{ language('frontend.attribute.name') }}
                                            </button>
                                        </li>
                                    @endif

                                <!--  PRICE TABLE  -->
                                    @isset($product->productsTranlations[0]->price_table)
                                        <li class="nav-item">
                                            <button class="nav-link @if(empty($checkAttributeGroupList)) active @endif"
                                                    id="price-table-tab" data-bs-toggle="tab"
                                                    data-bs-target="#price-table"
                                                    type="button" role="tab" aria-controls="price-table"
                                                    aria-selected="false">
                                                {{ language('frontend.product.price.table') }}
                                            </button>
                                        </li>
                                    @endisset

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @if(!empty($checkAttributeGroupList))
                                        <div class="tab-pane fade show active " id="features" role="tabpanel"
                                             aria-labelledby="features-tab">
                                            <div class="row">
                                                <div class="col-md-7">

                                                    @foreach($attributeGroups as $attributeGroup)

                                                        @if(in_array($attributeGroup->id,$checkAttributeGroupList))


                                                            <div class="features-item-group">
                                                                <div>{{ $attributeGroup->name }}</div>
                                                            </div>
                                                            @foreach($attributes as $attribute)
                                                                @if($attribute->attribute_group_id == $attributeGroup->id)
                                                                    <div class="features-item">
                                                                        <div>{{ $attribute->attributes_translations_name }}</div>
                                                                        <div>{{ $attribute->name }}</div>
                                                                    </div>
                                                                @endif
                                                            @endforeach


                                                        @endif


                                                    @endforeach



                                                    {{--                                                <div class="features-item-group">--}}
                                                    {{--                                                    <div>Flan qrup</div>--}}
                                                    {{--                                                </div>--}}
                                                    {{--                                                <div class="features-item">--}}
                                                    {{--                                                    <div>Lorem İpsum</div>--}}
                                                    {{--                                                    <div>Lorem İpsum</div>--}}
                                                    {{--                                                </div>--}}


                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                <!--  PRICE TABLE  -->
                                    @isset($product->productsTranlations[0]->price_table)
                                        <div
                                            class="tab-pane fade  @if(empty($checkAttributeGroupList)) show active @endif "
                                            id="price-table" role="tabpanel"
                                            aria-labelledby="price-table-tab">
                                            <div class="row">
                                                <style>
                                                    .priceTableTd td {
                                                        border-width: thin;
                                                    }
                                                </style>
                                                <div class="col-md-7 priceTableTd">
                                                    {!! $product->productsTranlations[0]->price_table !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                            </div>
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



