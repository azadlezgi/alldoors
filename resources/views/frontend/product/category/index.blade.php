@extends('frontend.layouts.index')

@section('title',language('frontend.product.title'))
@section('keywords', language('frontend.product.keyword') )
@section('description', language('frontend.product.description') )

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
                {!! \App\Services\CategoriesService::breadcrumbCategories($fullCategorySlug,$languageID) !!}
            </ol>
        </nav>
    </div>
@endsection

@section('content')



    <!-- CONTENT START -->
    <div class="content">
        <div class="container">


            @if($categories->count() > 0)
                <div class="categories-container">
                    <div class="gallery-title">
                        <h4>{{ language('frontend.category.name') }} ({{ $categoryName }})</h4>
                    </div>

                    <!-- Categories  -->
                    <div class="categories-box">
                        <div class="owl-carousel owl-theme">
                            @foreach($categories as $category)
                                <a href="{{ route('frontend.product.category.index',$fullCategorySlug.'/'.$category->slug) }}">
                                    <div class="categories-item">
                                        <div class="categories-item-body">
                                            @if(!empty($category->image))
                                                <img
                                                    src="{{ $category->image }}"
                                                    alt="{{ $category->name }}">
                                            @else
                                                <img
                                                    style="object-fit: contain"
                                                    src="{{ asset('storage/no-image.png') }}"
                                                    alt="{{ $category->name }}">
                                            @endif

                                        </div>
                                        <div class="categories-item-footer">
                                            <h4>{{ $category->name }}</h4>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endif


            <div class="products">
                @if($products->total() > 0)

                    <div class="gallery-title">
                        <h4>{{ language('frontend.product.all_name') }}</h4>
                        <div>{{ $products->total() }}</div>
                    </div>

                    <div class="product-box">
                        <div class="row">

                            @foreach($products as $product)
                                <div class="col-md-4">
                                    <a href="{{ route('frontend.product.category.detail',$fullCategorySlug.'/'.$product->slug) }}">
                                        <div class="product-item wow  animate__animated animate__zoomIn">
                                            @if(empty($product->image))
                                                <img style="object-fit: contain"
                                                     src="{{ asset('storage/no-image.png') }}"
                                                     alt="{{$product->productsTranlations[0]->name }}">
                                            @else
                                                <img src="{{  $product->image }}"
                                                     alt="{{$product->productsTranlations[0]->name }}">
                                            @endif

                                            <div class="product-detail">
                                                <h4>{{$product->productsTranlations[0]->name }}</h4>
                                                <h5>@if(!empty($product->price)){{$product->price }} AZN @endif</h5>
                                            </div>
                                            <div class="product-detail-categories">
                                                <!--  Kateqoriyalar  -->
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
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>


                        <!--  Paginate START -->
                        <div class="my-pagination">
                            <ul class="pagination">
                                {{ $products->appends(['search' => isset($searchText) ? $searchText : null])
                                           ->render('vendor.pagination.frontend.my-pagination') }}

                            </ul>
                        </div>
                    </div>
                    <!--  Paginate END -->
                @else
                    <h5 class="text-muted">{{  sprintf(language('frontend.product.check'), $categoryName)  }}</h5>
                @endif


            </div>


        </div>
    </div>
    <!-- CONTENT END -->


@endsection

@section('CSS')
@endsection

@section('JS')
    <script>
        /* OWL CAROUSEL */
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            margin: 40,
            nav: false,
            loop: false,
            dots: false,
            autoplayTimeout: false,
            autoplayHoverPause: false,
            stagePadding: 0,
            autoWidth: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 3
                },
                991: {
                    items: 3
                }
            }
        })


    </script>
@endsection





