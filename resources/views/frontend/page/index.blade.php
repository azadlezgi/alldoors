@extends('frontend.layouts.index')

@section('title',empty($page->title) ? $page->name : $page->title)
@section('keywords', $page->keyword )
@section('description', $page->description )

@section('breadcrumb')

<main class="main main--mt">
    <div class="container">
        <ul itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li>
                <div itemscope="itemscope" itemprop="itemListElement" itemtype="http://schema.org/ListItem"
                     class="breadcrumbs__item">
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
                       href="{{ route('frontend.page.index',$page->slug) }}">
                        <span itemprop="name">{{ $page->name }}</span>
                    </a>
                    <meta itemprop="position" content="2">
                </div>
            </li>
        </ul>
    </div>
@endsection

@section('content')

    <div class="container">
        <h1>{{ $page->name }}</h1>
    </div>

    <div class="content">
        <div class="content__wrapper container">
            <div class="text-block">
                {!! $page->text !!}
            </div>
        </div>
    </div>
</main>

@endsection

@section('CSS')
@endsection

@section('JS')
@endsection



