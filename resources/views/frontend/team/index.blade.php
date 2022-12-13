@extends('frontend.layouts.index')

@section('title',language('frontend.team.seo.title'))
@section('keywords', language('frontend.team.seo.keyword') )
@section('description', language('frontend.team.seo.description') )

@section('breadcrumb')
    <!-- breadcumb-area-start -->
    <div class="breadcumb-area bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb">
                        <h1 class="name">{!! language('frontend.team.name') !!}</h1>
                        <ul class="links" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.home.index') }}" title="{{ language('genereal.home') }}" itemprop="item">
                                    <span itemprop="name">{{ language('genereal.home') }}</span>
                                    <meta itemprop="position" content="0">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="{{ route('frontend.team.index') }}" title="{{ language('frontend.team.name') }}" itemprop="item">
                                    <span itemprop="name">{{ language('frontend.team.name') }}</span>
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


    <!-- explore-team-area-start -->
    <div class="explore-service-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        @if(!empty(language('frontend.team.top_title')))
                            <div class="h6">{!! language('frontend.team.top_title') !!}</div>@endif
                        @if(!empty(language('frontend.team.title')))
                            <h2>{!! language('frontend.team.title') !!}</h2>@endif
                        @if(!empty(language('frontend.team.sub_title')))
                            <p>{!! language('frontend.team.sub_title') !!}</p>@endif
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($teams as $team)
                    <div class="col-md-4 col-sm-6">
                        <div class="single-team">
                            <div class="img @if(is_null(json_decode($team->social)[0]->name)) img-before-none @endif " >
                                @if(empty($team->image))
                                    <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                         alt="{{$team->teamsTranlations[0]->name }}">
                                @else
                                    <img src="{{  \App\Services\ImageService::customImageSize($team->image,182,182,80) }}"
                                         alt="{{ $team->teamsTranlations[0]->name }}">
                                @endif
                                <div class="content">
                                    <span class="default"><i class="flaticon-network"></i></span>


                                    @if(!is_null(json_decode($team->social)[0]->name))

                                        <ul class="social">
                                            @foreach(json_decode($team->social) as $key => $value)
                                                <li>
                                                    <a {{ isset($value->status) ? 'target="_blank"': null }} href="{{ $value->link }}" rel="nofollow">
                                                        <i class="socicon-{{ $value->name }}"></i>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </div>
                            <div class="team-item-name">
                                <a href="{{ route('frontend.team.detail',$team->slug) }}">{{ $team->teamsTranlations[0]->name }}</a>
                            </div>
                            <div class="team-item-position">
                                <a href="{{ route('frontend.team.detail',$team->slug) }}">{{ $team->teamsTranlations[0]->position }}</a>
                            </div>
                        </div>
                    </div>

                @endforeach


            </div>

        </div>
        <!--  Paginate START -->
        <div class="my-pagination">
            <ul class="pagination">
                {{ $teams->appends(['search' => isset($searchText) ? $searchText : null])
                           ->render('vendor.pagination.frontend.my-pagination') }}

            </ul>
        </div>
    </div>
    <!-- explore-team-area-end -->


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
    <style>

        .team-item-position a {
            font-size: 15px;
        }

        .team-item-name a {
            font-size: 17px;
            font-weight: 600;
        }

        .single-team {
            margin: 0px 0 80px;
        }

        .team-item-name {
            font-size: 20px;
            font-weight: 600;
            margin-top: 13px;
        }

        .team-item-position{

        }

    </style>
@endsection

@section('JS')
@endsection



