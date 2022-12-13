@extends('frontend.layouts.index')

@section('title',language('frontend.blog.seo.title'))
@section('keywords', language('frontend.blog.seo.keyword') )
@section('description', language('frontend.blog.seo.description') )



@section('breadcrumb')
    <!-- breadcumb-area-start -->
    <div class="breadcumb-area bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb">
                        <h1 class="name">{!! language('frontend.post.name') !!}</h1>
                        <ul class="links" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.home.index') }}" title="{{ language('genereal.home') }}" itemprop="item">
                                    <span itemprop="name">{{ language('genereal.home') }}</span>
                                    <meta itemprop="position" content="0">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.post.index') }}" title="{{ language('frontend.post.name') }}" itemprop="item">
                                    <span itemprop="name">{{ language('frontend.post.name') }}</span>
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


    <!-- page-blog-area-start -->
    <div class="page-blog-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-blog-two-column page-blog">
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-lg-4 offset-lg-0 col-md-6 offset-md-0 col-sm-8 offset-sm-2 col-12">
                                    <div class="single-page-blog">
                                        <div class="bimg">
                                            <a href="{{ route('frontend.post.detail',$post->slug) }}">
                                                @if(empty($post->image))
                                                    <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                                         alt="{{$post->postsTranlations[0]->name }}">
                                                @else
                                                    <img src="{{  \App\Services\ImageService::resizeImageSize($post->image,'medium',80) }}"
                                                         alt="{{$post->postsTranlations[0]->name }}">
                                                @endif
                                                <span class="icon"><i class="fas fa-link"></i></span>
                                            </a>
                                            <p class="type">{{ \Illuminate\Support\Carbon::parse($post->created_at)->format('d.m.Y') }}</p>
                                        </div>
                                        <div class="content">
                                            <a class="h4 title" href="{{ route('frontend.post.detail',$post->slug) }}">{{ str_limit($post->postsTranlations[0]->name,50)  }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Paginate START -->
        <div class="my-pagination">
            <ul class="pagination">
                {{ $posts->appends(['search' => isset($searchText) ? $searchText : null])
                           ->render('vendor.pagination.frontend.my-pagination') }}

            </ul>
        </div>
    </div>
    <!-- page-blog-area-end -->

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



