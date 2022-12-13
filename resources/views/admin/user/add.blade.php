@extends('admin.layouts.index')
@section('title')
    İstifadəçi əlavə et
@endsection

@section('content')


    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}" class="text-muted">Panel</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.user.index') }}" class="text-muted">İstifadəçilər</a>
                        </li>

                        <li class="breadcrumb-item">
                            İstifadəçi əlavə et
                        </li>

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-my-lg-8 ">

                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">İstifadəçi əlavə et</h3>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <form class="form" id="submit-form" action="{{ route('admin.user.store') }}" method="POST">
                                        @csrf

                                        <div class="card-body">

                                            <div class="mb-15">
                                                <!--  Login  -->
                                                <div class="form-group row">
                                                    <label for="username" class="col-lg-3 col-form-label">İstifadəçi adı</label>
                                                    <div class="col-lg-9">
                                                        <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control form-control-lg"   placeholder="İstifadəçi adı"/>
                                                        @error('username' )<span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <!--  Ad soyad  -->
                                                <div class="form-group row">
                                                    <label for="name" class="col-lg-3 col-form-label">Ad soyad</label>
                                                    <div class="col-lg-9">
                                                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control form-control-lg"   placeholder="Ad soyad"/>
                                                        @error('name' )<span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <!--  E-mail  -->
                                                <div class="form-group row">
                                                    <label for="email" class="col-lg-3 col-form-label">E-mail</label>
                                                    <div class="col-lg-9">
                                                        <input id="email" type="text" name="email" value="{{ old('email') }}" class="form-control form-control-lg"   placeholder="E-mail"/>
                                                        @error('email' )<span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <!--Şifrə-->
                                                <div class="form-group row">
                                                    <label for="password" class="col-lg-3 col-form-label">Şifrə</label>
                                                    <div class="col-lg-9">
                                                        <input id="password" type="password" name="password" {{ old('password') }} class="form-control form-control-lg"   placeholder="Şifrə"/>
                                                        @error('password' )<span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <!--Təkrar şifrə-->
                                                <div class="form-group row">
                                                    <label for="password_confirmation" class="col-lg-3 col-form-label">Təkrar şifrə</label>
                                                    <div class="col-lg-9">
                                                        <input id="password_confirmation" type="password" name="password_confirmation" {{ old('password_confirmation') }} class="form-control form-control-lg"   placeholder="Təkrar şifrə"/>
                                                        @error('password_confirmation' )<span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <!--Icaze-->
                                                <div class="form-group row">
                                                    <label for="roles" class="col-lg-3 col-form-label">İcazə</label>
                                                    <div class="col-lg-2">
                                                        <select class="form-control" name="roles" id="roles">
                                                            @foreach($roles as $role)
                                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('roles' )<span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <!--Status-->
                                                <div class="form-group row">
                                                    <label for="status" class="col-lg-3 col-form-label">Status</label>
                                                    <div class="col-lg-2">
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="0">Passiv</option>
                                                            <option value="1">Aktiv</option>
                                                        </select>
                                                        @error('status' )<span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>


                        </div>
                    </div>


                </div>
                <div class="col-my-lg-4 ">
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Qeyd</h3>
                            </div>

                        </div>

{{--                        <div class="card-body">--}}
{{--                            <!--  BODY CODE  -->--}}
{{--                        </div>--}}


                        <div  class="card-footer myCardFooterPadding">
                            <div class=" d-flex justify-content-end">
                                <button type="submit" form="submit-form" class="btn btn-success btn-sm ">Göndər
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection

@section('CSS')

@endsection

@section('js')

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });


    </script>




@endsection
