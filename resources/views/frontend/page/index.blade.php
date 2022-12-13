@extends('frontend.layouts.index')

@section('title',empty($page->title) ? $page->name : $page->title)
@section('keywords', $page->keyword )
@section('description', $page->description )

@section('breadcrumb')
    <!-- breadcumb-area-start -->
    <div class="breadcumb-area bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb">
                        <h1 class="name">{{ $page->name }}</h1>
                        <ul class="links">
                            <li><a href="{{ route('frontend.home.index') }}">{{ language('genereal.home') }}</a></li>
                            <li><a href="{{ route('frontend.page.index',$page->slug) }}">{{ $page->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area-end -->
@endsection

@section('content')


    <div style="margin-top: 70px; {{ $page->slug != 'haqqimizda' ? 'margin-bottom: 100px':null }}" class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $page->text !!}
            </div>
        </div>
    </div >

    @if($page->slug == 'haqqimizda')

        <!-- about-tab-area-start -->
{{--        <div class="about-tab-area">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">--}}
{{--                        <div class="about-tab-img">--}}
{{--                            {!! language('frontent.page.about_us.misson.image') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">--}}
{{--                        <div class="about-tab">--}}
{{--                            <nav>--}}
{{--                                <div class="nav nav-tabs" id="nav-tab" role="tablist">--}}
{{--                                    @if(!empty(language('frontent.page.about_us.misson')))--}}
{{--                                        <a class="nav-item nav-link active" id="nav-mission-tab" data-toggle="tab"--}}
{{--                                           href="#nav-mission" role="tab" aria-controls="nav-mission"--}}
{{--                                           aria-selected="true">--}}
{{--                                            {!! language('frontent.page.about_us.misson') !!}--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                    @if(!empty(language('frontent.page.about_us.vision')))--}}
{{--                                        <a class="nav-item nav-link" id="nav-vision-tab" data-toggle="tab"--}}
{{--                                           href="#nav-vision" role="tab" aria-controls="nav-vision"--}}
{{--                                           aria-selected="false">--}}
{{--                                            {!! language('frontent.page.about_us.vision') !!}--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                    @if(!empty(language('frontent.page.about_us.values')))--}}

{{--                                        <a class="nav-item nav-link" id="nav-values-tab" data-toggle="tab"--}}
{{--                                           href="#nav-values" role="tab" aria-controls="nav-values"--}}
{{--                                           aria-selected="false">--}}
{{--                                            {!! language('frontent.page.about_us.values') !!}--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </nav>--}}
{{--                            <div class="tab-content" id="nav-tabContent">--}}
{{--                                @if(!empty(language('frontent.page.about_us.misson')))--}}
{{--                                    <div class="tab-pane fade show active" id="nav-mission" role="tabpanel"--}}
{{--                                         aria-labelledby="nav-mission-tab">--}}
{{--                                        <div class="about-tab-box">--}}
{{--                                            {!! language('frontent.page.about_us.misson.item') !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                @if(!empty(language('frontent.page.about_us.vision')))--}}
{{--                                    <div class="tab-pane fade" id="nav-vision" role="tabpanel"--}}
{{--                                         aria-labelledby="nav-vision-tab">--}}
{{--                                        <div class="about-tab-box">--}}
{{--                                            {!! language('frontent.page.about_us.vision.item') !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                @if(!empty(language('frontent.page.about_us.values')))--}}
{{--                                    <div class="tab-pane fade" id="nav-values" role="tabpanel"--}}
{{--                                         aria-labelledby="nav-values-tab">--}}
{{--                                        <div class="about-tab-box">--}}
{{--                                            {!! language('frontent.page.about_us.values.item') !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- about-tab-area-end -->

        <!-- team-area-start -->
        <div class="team-area">
            <div class="container">
                <div class="row">

                    @foreach($teams as $team)
                        <div class="col-md-4 col-sm-6">
                            <div class="single-team">
                                <div class="img @if(is_null(json_decode($team->social)[0]->name)) img-before-none @endif " >
                                    @if(empty($team->image))
                                        <img style="object-fit: contain" src="{{ asset('storage/no-image.png') }}"
                                             alt="{{$team->teamsTranlations[0]->name }}">
                                    @else
                                        <img src="{{  $team->image }}"
                                             alt="{{ $team->teamsTranlations[0]->name }}">
                                    @endif
                                    <div class="content">
                                        <span class="default"><i class="flaticon-network"></i></span>


                                        @if(!is_null(json_decode($team->social)[0]->name))

                                            <ul class="social">
                                                @foreach(json_decode($team->social) as $key => $value)
                                                    <li>
                                                        <a {{ isset($value->status) ? 'target="_blank"': null }} href="{{ $value->link }}">
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
        </div>
        <!-- team-area-end -->


        <!-- need-consultant-area-start -->
        <div class="need-consultant-area bg-with-black">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="need-consultant">
                            <h2 class="title">{!! language('frontent.page.about_us.section.consultant.title') !!}</h2>
                            <p class="text">{!! language('frontent.page.about_us.section.consultant.sub_title') !!}</p>
                            <a class="contact"
                               href="{{ route('frontend.home.contact') }}">{!! language('frontend.contact.name') !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- need-consultant-area-end -->


        <!-- contact-details-area-start -->
        <div class="contact-details-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="all-contact-details">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="single-contact-details">
                                        <div class="icon">
                                            <span class="fas fa-map-marker-alt"></span>
                                        </div>
                                        <div class="h4 title">{!! language('frontend.contact.address') !!}</div>
                                        <p class="desc">{{  setting('address',true) }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="single-contact-details">
                                        <div class="icon">
                                            <span class="far fa-envelope"></span>
                                        </div>
                                        <div class="h4 title">{!! language('frontend.contact.email') !!}</div>
                                        <a class="desc"
                                           href="mailto:{{  setting('email') }}">{{  setting('email') }}</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 col-12">
                                    <div class="single-contact-details">
                                        <div class="icon">
                                            <span class="fas fa-phone"></span>
                                        </div>
                                        <div class="h4 title">{!! language('frontend.contact.tel') !!}</div>
                                        @foreach( json_decode(setting('tel')) as $tel)
                                            <a class="desc" href="tel:{{ \App\Services\CommonService::telText( $tel->tel )[0] }}">{{ \App\Services\CommonService::telText( $tel->tel )[1] }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact-details-area-end -->
        <!-- map-start -->
        <div class="map-area">
            <div class="gmap">
                <div id="googleMap"></div>
            </div>
        </div>
        <!-- map-end -->

    @endif

@endsection

@section('CSS')
@endsection

@section('JS')
@endsection



