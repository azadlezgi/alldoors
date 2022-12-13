@extends('frontend.layouts.index')

@section('title',language('frontend.service.title'))
@section('keywords', language('frontend.service.keyword') )
@section('description', language('frontend.service.description') )


@section('breadcrumb')
    <!--  breadcrumb  -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 breadcrumb-my">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}">{{ language('genereal.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.service.index') }}">{{ language('frontend.service.all_name') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.service.index') }}">{{ language('frontend.category.all_name') }}</a></li>
                {!! \App\Services\CategoriesService::breadcrumbServicesCategories($fullCategorySlug,$languageID) !!}
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
                <div class="service-title">
                    <h4>{{ language('frontend.category.name') }} ({{ $categoryName }})</h4>
                </div>

                <!-- Categories  -->
                <div class="categories-box">
                    <div class="owl-carousel owl-theme">
                        @foreach($categories as $category)
                            <a href="{{ route('frontend.service.category.index',$fullCategorySlug.'/'.$category->slug) }}">
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


            <div class="service">
                @if($servicecCount > 0)

                <div class="service-title">
                    <h4>{{ language('frontend.service.all_name') }}</h4>
                    <div>{{ $servicecCount }}</div>
                </div>

                <div class="service-box">
                    <div class="row">

                        @foreach($services as $service)

                            <div class="col-md-4">
                                <a href="{{ route('frontend.service.category.detail',$fullCategorySlug.'/'.$service->slug) }}">
                                    <div class="service-item wow  animate__animated animate__zoomIn">
                                        @if(empty($service->image))
                                            <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                                 alt="{{$service->servicesTranlations[0]->name }}">
                                        @else
                                            <img src="{{  $service->image }}"
                                                 alt="{{$service->servicesTranlations[0]->name }}">
                                        @endif


                                        <div class="service-detail">
                                            <h4>{{$service->servicesTranlations[0]->name }}</h4>
                                            <h5>
                                                @isset($service->servicesCategoriesCheck)
                                                    @foreach($service->servicesCategoriesCheck as $category)
                                                        {{ $category->name }}
                                                        @if (!$loop->last)&nbsp;,&nbsp;@endif
                                                    @endforeach
                                                @endisset
                                            </h5>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @endforeach
                    </div>


                    <!--  Paginate START -->
                    <div class="my-pagination">
                        <ul class="pagination">
                            {{ $services->appends(['search' => isset($searchText) ? $searchText : null])
                                       ->render('vendor.pagination.frontend.my-pagination') }}

                        </ul>
                    </div>
                </div>
                <!--  Paginate END -->
                @else
                    <h5 class="text-muted">{{  sprintf(language('frontend.service.check'), $categoryName)  }}</h5>
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





