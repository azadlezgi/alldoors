@extends('frontend.layouts.index')

@section('title',language('frontend.service.title'))
@section('keywords', language('frontend.service.keywords') )
@section('description', language('frontend.service.description') )



@section('breadcrumb')

    <main class="main main--mt">
        <div class="container">
            <ul itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
                <li>
                    <div itemscope="itemscope" itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="breadcrumbs__item">
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
                           href="{{ route('frontend.service.index') }}">
                            <span itemprop="name">{{ language('frontend.service.name') }}</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </div>
                </li>
            </ul>
        </div>

        @endsection

        @section('content')

            <div class="container">
                <h1>{{ language('frontend.service.name') }}</h1>
            </div>


            <div class="container">
                @if($services)
                    <div class="cards-grid1 mt-4">

                        @foreach($services as $service)
                            <div class="row review mb-5">
                                <div class="col-12 col-lg-auto text-center">
                                    <img src="{{ $service->image }}">
                                </div>
                                <div class="col-12 col-lg">
                                    <div class="h-100 ms-lg-5 px-3 px-lg-4 pt-3 pb-1 bg-grey">
                                        <p class="fw-bold">{{ $service->name }}</p>
                                        {!! $service->text !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    <div class="my-pagination">
                        <ul class="pagination">
                            {{ $services->appends(['search' => isset($searchText) ? $searchText : null])
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
