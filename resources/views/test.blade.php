<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                    @foreach($languages as $key => $language)
                        <button class="nav-link {{ $key == 0 ? 'active': null }} " id="language-{{ $language->id }}-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#language-{{ $language->id }}"
                                type="button" role="tab" aria-controls="language-{{ $language->id }}"
                                aria-selected="true">
                            {{ $language->short_name }}
                        </button>
                    @endforeach
                </div>
            </nav>
            <form class=" mt-4 mb-4" action="{{ route('home.test2') }}" method="POST">
                @CSRF
                <div class="tab-content" id="nav-tabContent">
                    @foreach($posts as $key => $post)
                        <div class="tab-pane fade show {{ $key == 0 ? 'active': null }}"
                             id="language-{{ $post->language }}"
                             role="tabpanel" aria-labelledby="language-{{ $post->language }}-tab">
                            <input class="form-control" name="ad[{{ $post->language }}]" type="text" value="{{ old('ad.'. $post->language ) }}">
                            <input type="hidden" name="language" value="{{ $post->language }}">
                            @error('ad.'. $post->language )<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                </div>

                <input class="form-control mt-4" type="number" name="status" min="0" max="1">
                <button class="btn btn-success  mt-4 mb-4">Gonder</button>
            </form>

        </div>
    </div>
</div>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
-->
</body>
</html>
