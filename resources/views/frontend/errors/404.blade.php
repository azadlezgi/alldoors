@extends('frontend.layouts.index')

@section('title','title')
@section('keywords', 'keywords' )
@section('description', 'description' )


@section('content')


    <!-- CONTENT START -->
    <div class="content">
        <div class="container">
          <div class="page-container">
              <h3>404</h3>
              <p>{!! mb_strtoupper(language('general.404_page')) !!}</p>
          </div>
        </div>
    </div>
    <!-- CONTENT END -->


@endsection

@section('CSS')
@endsection

@section('JS')
@endsection



