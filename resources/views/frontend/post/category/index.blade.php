@extends('frontend.layouts.index')

@section('title',language('frontend.post.title'))
@section('keywords', language('frontend.post.keyword') )
@section('description', language('frontend.post.description') )

@section('breadcrumb')
    <!--  breadcrumb  -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 breadcrumb-my">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}">{{ language('genereal.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.post.index') }}">{{ language('frontend.post.all_name') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.post.index') }}">{{ language('frontend.category.all_name') }}</a></li>
                {!! \App\Services\PostsService::breadcrumbPostsCategories($fullCategorySlug,$languageID) !!}
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
                <div class="post-title">
                    <h4>{{ language('frontend.category.name') }} ({{ $categoryName }})</h4>
                </div>

                <!-- Categories  -->
                <div class="categories-box">
                    <div class="owl-carousel owl-theme">
                        @foreach($categories as $category)
                            <a href="{{ route('frontend.post.category.index',$fullCategorySlug.'/'.$category->slug) }}">
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


            <div class="post">
                @if($postcCount > 0)

                <div class="post-title">
                    <h4>{{ language('frontend.post.all_name') }}</h4>
                    <div>{{ $postcCount }}</div>
                </div>

                <div class="post-box">
                    <div class="row">

                        @foreach($posts as $post)

                            <div class="col-md-4">
                                <a href="{{ route('frontend.post.category.detail',$fullCategorySlug.'/'.$post->slug) }}">
                                    <div class="post-item wow  animate__animated animate__zoomIn">
                                        @if(empty($post->image))
                                            <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                                 alt="{{$post->postsTranlations[0]->name }}">
                                        @else
                                            <img src="{{  $post->image }}"
                                                 alt="{{$post->postsTranlations[0]->name }}">
                                        @endif


                                        <div class="post-detail">
                                            <h4>{{$post->postsTranlations[0]->name }}</h4>
                                            <h5>
                                                @isset($post->postsCategoriesCheck)
                                                    @foreach($post->postsCategoriesCheck as $category)
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
                            {{ $posts->appends(['search' => isset($searchText) ? $searchText : null])
                                       ->render('vendor.pagination.frontend.my-pagination') }}

                        </ul>
                    </div>
                </div>
                <!--  Paginate END -->
                @else
                    <h5 class="text-muted">{{  sprintf(language('frontend.post.check'), $categoryName)  }}</h5>
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





