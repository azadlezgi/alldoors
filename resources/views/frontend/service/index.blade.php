@extends('frontend.layouts.index')

@section('title',language('frontend.service.seo.title'))
@section('keywords', language('frontend.service.seo.keyword') )
@section('description', language('frontend.service.seo.description') )

@section('breadcrumb')
    <!-- breadcumb-area-start -->
    <div class="breadcumb-area bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb">
                        <h1 class="name">{!! language('frontend.service.h1_name') !!}</h1>
                        <ul class="links" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.home.index') }}" title="{{ language('genereal.home') }}" itemprop="item">
                                    <span itemprop="name">{{ language('genereal.home') }}</span>
                                    <meta itemprop="position" content="0">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.service.index') }}" title="{{ language('frontend.service.name') }}" itemprop="item">
                                    <span itemprop="name">{{ language('frontend.service.name') }}</span>
                                    <meta itemprop="position" content="1">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area-end -->
@endsection

@section('content')

    <!-- explore-service-area-start -->
    <div class="explore-service-area" style="padding-top:50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        @if(!empty(language('frontend.service.top_title')))
                            <div class="h6">{!! language('frontend.service.top_title') !!}</div>@endif
                        @if(!empty(language('frontend.service.h2_name')))
                            <h2>{!! language('frontend.service.h2_name') !!}</h2>@endif
                        @if(!empty(language('frontend.service.sub_title')))
                            <p>{!! language('frontend.service.sub_title') !!}</p>@endif
                    </div>
                </div>
            </div>

            @if(!empty(language('frontend.service.top_content')))
            <div class="content">
                {!! language('frontend.service.top_content') !!}
            </div>
            @endif

            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-4 col-sm-6 col-md-6 col-12">
                        <div class="single-service">
                            <div class="img">
                                <a href="{{ route('frontend.service.detail',$service->slug) }}">
                                    @if(empty($service->image))
                                        <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                             alt="{{$service->servicesTranlations[0]->name }}">
                                    @else
                                        <img src="{{  \App\Services\ImageService::resizeImageSize($service->image,'medium',80) }}"
                                             alt="{{$service->servicesTranlations[0]->name }}">
                                    @endif
                                </a>
                            </div>
                            <div class="content">
                                <a href="{{ route('frontend.service.detail',$service->slug) }}" class="title">{{ str_limit($service->servicesTranlations[0]->name,28)  }}</a>
                                <div class="order-more">
                                    <a class="order"
                                       href="{{ route('frontend.home.contact') }}">{!! language('frontend.service.order_now') !!}</a>
                                    <a class="more" href="{{ route('frontend.service.detail',$service->slug) }}"
                                       style="text-transform:capitalize">{!! language('general.read_more') !!}</a>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach
            </div>



            @if(!empty(language('frontend.service.bottom_content')))
                <div class="content">
                    {!! language('frontend.service.bottom_content') !!}
                </div>
            @endif

        </div>
        <!--  Paginate START -->
        <div class="my-pagination">
            <ul class="pagination">
                {{ $services->appends(['search' => isset($searchText) ? $searchText : null])
                           ->render('vendor.pagination.frontend.my-pagination') }}

            </ul>
        </div>


    </div>
    <!-- explore-service-area-end -->

    <!-- welcome-area-start -->
    <div class="welcome-area">
        <div class="welcome-banner d-none d-lg-block"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        @if(!empty(language('frontend.welcome.consulting.top_title')))
                            <div class="h6">{!! language('frontend.welcome.consulting.top_title') !!}</div>@endif
                        @if(!empty(language('frontend.welcome.consulting.title')))
                            <div class="h2">{!! language('frontend.welcome.consulting.title') !!}</div>@endif
                        @if(!empty(language('frontend.welcome.consulting.sub_title')))
                            <p>{!! language('frontend.welcome.consulting.sub_title') !!}</p>@endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="welcome-faq">
                        <div class="accordion" id="accordion">
                            <!--  CARD 1  -->
                            @if(!empty(language('frontend.welcome.consulting.item1')))
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="h5 mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                    data-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                {!! language('frontend.welcome.consulting.item1') !!}
                                            </button>
                                        </div>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            {!! language('frontend.welcome.consulting.item_content1') !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        <!--  CARD 2  -->
                            @if(!empty(language('frontend.welcome.consulting.item2')))
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <div class="h5 mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseTwo" aria-expanded="false"
                                                    aria-controls="collapseTwo">
                                                {!! language('frontend.welcome.consulting.item2') !!}
                                            </button>
                                        </div>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            {!! language('frontend.welcome.consulting.item_content2') !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        <!--  CARD 3  -->
                            @if(!empty(language('frontend.welcome.consulting.item3')))
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <div class="h5 mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseThree" aria-expanded="false"
                                                    aria-controls="collapseThree">
                                                {!! language('frontend.welcome.consulting.item3') !!}
                                            </button>
                                        </div>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            {!! language('frontend.welcome.consulting.item_content3') !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        <!--  CARD 4  -->
                            @if(!empty(language('frontend.welcome.consulting.item4')))
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <div class="h5 mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseFour" aria-expanded="false"
                                                    aria-controls="collapseFour">
                                                {!! language('frontend.welcome.consulting.item4') !!}
                                            </button>
                                        </div>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            {!! language('frontend.welcome.consulting.item_content4') !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="wf-contact">
                            <a href="{{ route('frontend.home.contact') }}">
                                <p class="text">{!! language('frontend.home.header.free_advice') !!} <span><i
                                            class="fas fa-angle-right"></i></span></p>
                            </a>
                            <a class="phone" href="tel:{{ \App\Services\CommonService::telText( json_decode(setting('tel'),true)[0]['tel'] )[0] }}"><span><i
                                        class="fas fa-phone-volume"></i></span>
{{--                                {{ json_decode(setting('tel'),true)[0]['tel'] }}--}}
                                {{ \App\Services\CommonService::telText( json_decode(setting('tel'),true)[0]['tel'] )[1] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome-area-end -->

    <!-- brands-area-start -->
    <div class="brands-area">
        <div class="container">
            <div class="brand-carousel owl-carousel">


                @foreach($partners as $partner)
                    <div class="single-brand">
                        <img src="{{ $partner->image }}" alt="{{ $partner->name }}">
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- brands-area-end -->




@endsection

@section('CSS')
@endsection

@section('JS')
@endsection



