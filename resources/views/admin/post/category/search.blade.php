@extends('admin.layouts.index')
@section('title')
    Bloq Kateqoriyalar Axtar
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Bloq Kateqoriyalar Axtar</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}" class="text-muted">Panel</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.post.category.index') }}" class="text-muted">Bloq Kateqoriyalar</a>
                        </li>
                        <li class="breadcrumb-item">
                            Axtar
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
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Bloq Kateqoriyalar</h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-title">
                            <form action="{{ route('admin.post.category.search') }}" method="GET">
                                <div class="input-group">
                                    <input
                                        type="search"
                                        class="form-control"
                                        value="{{ request('search') }}"
                                        autocomplete="off"
                                        name="search"
                                        placeholder="Axtar...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success" type="button">Axtar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!--  ADD BUTTON  -->
                        <a href="{{ route('admin.post.category.add') }}">
                            <button
                                tooltip="Əlavə et"
                                flow="left"
                                class="btn addDataModalButton btn-icon btn-success btn-circle btn-lg">
                                <i class="flaticon-plus"></i>
                            </button>
                        </a>


                        <!--  DELETE BUTTON  -->
                        <a class="select-btn-action" href="#">
                            <button
                                tooltip="Sil"
                                flow="left"
                                class="btn btn-icon btn-danger btn-circle btn-lg ml-2">
                                <i class="flaticon-delete"></i>
                            </button>
                        </a>


                    </div>
                </div>

                <div class="card-body">



                    <!--  MYTABLE START  -->
                    <table class="table table-hover table-striped" data-sorting="true">
                        <thead class="thead-light">
                        <tr>
                            @if($postCategories->count() != 0)
                                <th width="10" data-sortable="false">
                                    <label class="checkbox checkbox-success select-all-btn">
                                        <input type="checkbox"   />
                                        <span></span>
                                    </label>
                                </th>
                            @endif
                            <th width="10" data-breakpoints="xs">ID</th>
                            <th>Ad</th>
                            <th data-breakpoints="xs">Say</th>
                            <th data-breakpoints="xs sm md" data-sortable="false">Tarix</th>
                            <th data-breakpoints="xs sm md" data-sortable="false">Status</th>
                            <th width="40" data-breakpoints="xs sm md" data-sortable="false">Ayarlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($postCategories as $key => $postCategory)

                            <tr class="table-id-{{ $postCategory->id }}" data-index="{{ $postCategory->id }}" data-position="{{ $postCategory->sort }}">
                                <!-- SELECT ALL -->
                                <td>
                                    <label class="checkbox checkbox-success select-element-btn" data-id="{{ $postCategory->id }}">
                                        <input type="checkbox"   />
                                        <span></span>
                                    </label>
                                </td>


                                <!-- ID -->
                                <td>{{$postCategory->id}}</td>

                                <!--  NAME  -->
                                <td>
                                    {{ \App\Services\PostsService::getTreeIndex($defaultLanguage,$postCategory->id,$postCategory->parent) }}
                                    {{--                                    <a href="{{ route('admin.post.category.edit',$postCategory->id) }}">{{ $postCategory->postsCategoriesTranslations[0]->name }}</a>--}}
                                </td>

                                <!--  SAY  -->
                                <td><a href="{{ route('admin.post.categories',$postCategory->id) }}">{{ count($postCategories[$key]->getPostsCount) }}</a></td>


                                <!--  Tarix  -->
                                <td>{{ updateDate($postCategory->updated_at,$postCategory->postsCategoriesTranslations) }}</td>


                                <!--  STATUS  -->
                                <td width="100">

                                        <span class="switch switch-outline switch-icon switch-success">
                                        <label>
                                            <input
                                                class="statusActive"
                                                data-id="{{ $postCategory->id }}"
                                                type="checkbox"
                                                {{ $postCategory->status == 1? 'checked="checked"':"" }}
                                                name="select">
                                            <span></span>
                                        </label>
									</span>

                                </td>

                                <td>
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title=""
                                         data-placement="left" data-original-title="Quick actions">
                                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right"
                                             style="">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-header font-weight-bold py-4">
                                                    <span class="font-size-lg">Ayarlar:</span>
                                                    <i class="flaticon2-information icon-md text-muted"
                                                       data-toggle="tooltip" data-placement="right" title=""
                                                       data-original-title="Click to learn more..."></i>
                                                </li>
                                                <li class="navi-separator mb-3 opacity-70"></li>

                                                <li
                                                    class="navi-item redakteEt">
                                                    <a href="{{ route('admin.post.category.edit',$postCategory->id) }}" class="navi-link text-center">
																		<span class="navi-text">
																			<span
                                                                                class="label label-xl label-inline label-light-primary">Redaktə et</span>
																		</span>
                                                    </a>
                                                </li>

                                                <li
                                                    class="navi-item deleteButton"
                                                    data-id="{{ $postCategory->id }}"
                                                >
                                                    <a href="#" class="navi-link text-center">
																		<span class="navi-text">
																			<span
                                                                                class="label  label-xl label-inline label-light-danger">Sil</span>
																		</span>
                                                    </a>
                                                </li>

                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--  MYTABLE END  -->
                </div>
                <div class="card-footer">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex align-items-center py-3">
                            <span class="text-muted">
                                Cəmi <b><span class="totalCount">{{ $postCategories->total() }}</span></b> yazı
                                @if($postCategories->hasPages())
                                    , <b>{{ $postCategories->lastPage() }}
                                </b> səhifədən  <b>{{ $postCategories->currentPage() }}</b>-ci göstərildi.
                                @endif

                            </span>
                        </div>
                        <!--  Paginate START -->
                        <div class="d-flex flex-wrap py-2 mr-3">
                            {{ $postCategories->appends(['search' => request('search')])
                                 ->render('vendor.pagination.backend.my-pagination') }}
                        </div>
                        <!--  Paginate END -->
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
        jQuery(function ($) {
            $('.table').footable({
                "empty": "Məlumat tapılmadı",
            });
        });
    </script>

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*   Status aktiv et START   */
            $(document).on('click', '.statusActive', function () {
                var dataID = $(this).data('id');
                var statusActive = '';

                if ($(this).is(':checked')) {
                    statusActive = 1;
                } else {
                    statusActive = 0;
                }


                $.ajax({
                    url: "{{ route('admin.post.category.statusAjax') }}",
                    type: 'POST',
                    data: {id: dataID, statusActive: statusActive},
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success == true) {
                            if (data.data == 1) {
                                toastr.success("Status aktiv edildi");
                            } else {
                                toastr.success("Status deaktiv edildi");
                            }
                        } else {
                            toastr.error("Xəta baş verdi");
                        }
                    }
                });


            })
            /*   Status aktiv et END   */


        });





        /*   Delete START   */

        $(document).on('click', '.deleteButton', function () {
            let dataID = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.post.category.deleteAjax') }}",
                type: 'POST',
                data: {id: dataID},
                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {

                        if(response.error == null){


                            Swal.fire({
                                title: "Diqqət?",
                                html: "Kateqoriyanı silmək istədiyinizə əminsiniz?",
                                icon: "error",
                                showCancelButton: true,
                                confirmButtonText: "Sil!",
                                cancelButtonText: "Xeyir",
                                customClass: {
                                    confirmButton: "btn btn-light-danger font-weight-bold",
                                    cancelButton: 'btn btn-light-primary font-weight-bold',
                                }
                            }).then(function (result) {
                                if (result.value) {

                                    $.ajax({
                                        url: "{{ route('admin.post.category.delete') }}",
                                        type: 'POST',
                                        data: {id:dataID},
                                        dataType: 'JSON',
                                        success: function (response) {

                                            if (response.success) {
                                                $('.table-id-'+dataID).fadeOut(1000);
                                                // $('.table-id-'+languageID).remove();
                                                var totalCount = $('.totalCount').text();
                                                $('.totalCount').text(parseInt(totalCount)-1);

                                            }
                                        }
                                    });

                                    Swal.fire(
                                        "Silindi!",
                                        "Səhifə silindi!",
                                        "success"
                                    )
                                }
                            });



                        }else {

                            Swal.fire({
                                title: "Diqqət!",
                                html: "Bu kateqoriyanı silmək olmaz! <b>" + response.name + "</b> kateqoriyasına aid qalereyalar var!",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "ok!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });



                        }



                    }


                }
            });


        })

        /*   Delete END   */


    </script>

    <!--  DELETE ALL ELEMENTS (SELECTED) START  -->
    <script>
        deleteALlSelectedElements(
            'Diqqət?',
            'Seçilmişləri silmək istədiyinizə əminsiniz?',
            'Sil!',
            'Xeyir',
            '{{ route('admin.post.category.allDeleteAjax') }}',
            '{{ route('admin.post.category.index') }}'
        );
    </script>
    <!--  DELETE ALL ELEMENTS (SELECTED) END  -->

@endsection
