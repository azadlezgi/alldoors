@extends('admin.layouts.index')
@section('title')
    Partnyorlar
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Partnyorlar</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}" class="text-muted">Panel</a>
                        </li>
                        @isset($searchText)
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.language.index') }}" class="text-muted">Partnyorlar</a>
                            </li>
                            <li class="breadcrumb-item">
                                Axtar
                            </li>
                        @else
                            <li class="breadcrumb-item">
                                Partnyorlar
                            </li>
                        @endisset
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
                        <h3 class="card-label">Partnyorlar</h3>
                    </div>
                    <div class="card-toolbar">
{{--                        <div class="card-title">--}}
{{--                            <form action="{{ route('admin.language.search') }}" method="GET">--}}
{{--                                <div class="input-group">--}}
{{--                                    <input--}}
{{--                                        type="search"--}}
{{--                                        class="form-control"--}}
{{--                                        value="@isset($searchText){{ $searchText }}@endisset"--}}
{{--                                        autocomplete="off"--}}
{{--                                        name="search"--}}
{{--                                        placeholder="Axtar...">--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <button type="submit" class="btn btn-success" type="button">Axtar</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}

                        <!--  ADD BUTTON  -->
                        <a href="{{ route('admin.partner.add') }}">
                            <button
                                tooltip="??lav?? et"
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
                            @if($partners->count() != 0)
                                <th width="10" data-sortable="false">
                                    <label class="checkbox checkbox-success select-all-btn">
                                        <input type="checkbox"   />
                                        <span></span>
                                    </label>
                                </th>
                            @endif
                            <th width="10" data-breakpoints="xs">ID</th>
                            <th>????kil</th>
                            <th>Ad</th>
                            <th data-breakpoints="xs sm md" data-sortable="false">Tarix</th>
                            <th data-breakpoints="xs sm md" data-sortable="false">Status</th>
                            <th width="40" data-breakpoints="xs sm md" data-sortable="false">Ayarlar</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($partners as $partner)
                            <tr class="table-id-{{ $partner->id }}" data-index="{{ $partner->id }}" data-position="{{ $partner->sort }}">

                                <!-- SELECT ALL -->
                                <td>
                                    <label class="checkbox checkbox-success select-element-btn" data-id="{{ $partner->id }}">
                                        <input type="checkbox"   />
                                        <span></span>
                                    </label>
                                </td>

                               <!-- ID -->
                                <td>{{$partner->id}}</td>

                                <!--  IMAGE  -->
                                <td class="sortableHandle">
                                    <span style="vertical-align: middle;" class="slideImage">
                                        <img src="{{ $partner->image }}" alt=""/>
                                    </span>
                                </td>

                                <!--  NAME  -->
                                <td>{{ $partner->partnersTranslations[0]->name }}</td>

                                <!--  Tarix  -->
                                <td>{{ updateDate($partner->updated_at,$partner->partnersTranslations) }}</td>


                                <!--  STATUS  -->
                                <td width="100">

                                        <span class="switch switch-outline switch-icon switch-success">
                                        <label>
                                            <input
                                                class="statusActive"
                                                data-id="{{ $partner->id }}"
                                                type="checkbox"
                                                {{ $partner->status == 1? 'checked="checked"':"" }}
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
                                                    <a href="{{ route('admin.partner.edit',$partner->id) }}" class="navi-link text-center">
																		<span class="navi-text">
																			<span
                                                                                class="label label-xl label-inline label-light-primary">Redakt?? et</span>
																		</span>
                                                    </a>
                                                </li>

                                                <li
                                                    class="navi-item deleteButton"
                                                    data-id="{{ $partner->id }}"
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
                                C??mi <b><span class="totalCount">{{ $partners->total() }}</span></b> yaz??
                                @if($partners->hasPages())
                                    , <b>{{ $partners->lastPage() }}
                                </b> s??hif??d??n  <b>{{ $partners->currentPage() }}</b>-ci g??st??rildi.
                                @endif

                            </span>
                        </div>
                        <!--  Paginate START -->
                        <div class="d-flex flex-wrap py-2 mr-3">
                            {{ $partners->appends(['search' => isset($searchText) ? $searchText : null])
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
                "empty": "M??lumat tap??lmad??",
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
                    url: "{{ route('admin.partner.statusAjax') }}",
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
                            toastr.error("X??ta ba?? verdi");
                        }
                    }
                });


            })
            /*   Status aktiv et END   */

            /*   Sortable  START   */
            $("#sortable").sortable({
                handle: ".sortableHandle",
                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index + 1)) {
                            $(this).attr('data-position', (index + 1)).addClass('updated');
                        }
                    });
                    //Position yadda saxla
                    saveNewPositions();
                }
            });
            $("#sortable").disableSelection();
        });

        /*   Yeni Sort elave et function   */
        function saveNewPositions() {
            var positions = [];
            $('.updated').each(function () {
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                $(this).removeClass('updated');
            });


            $.ajax({
                url: "{{ route('admin.partner.sortAjax') }}",
                method: 'POST',
                dataType: 'JSON',
                data: {update: 1, positions: positions},
                success: function (response) {
                    toastr.success("U??urla qeyd?? al??nd??");
                }
            });
        }

        /*   Sortable  END   */



        /*   Delete START   */

        $(document).on('click', '.deleteButton', function () {
            var slideID = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.partner.deleteAjax') }}",
                type: 'POST',
                data: {id: slideID},
                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {

                        Swal.fire({
                            title: "Diqq??t?",
                            html: "Partnyoru silm??k ist??diyiniz?? ??minsiniz?",
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
                                    url: "{{ route('admin.partner.delete') }}",
                                    type: 'POST',
                                    data: {id:slideID},
                                    dataType: 'JSON',
                                    success: function (response) {

                                        if (response.success) {
                                            $('.table-id-'+slideID).fadeOut(1000);
                                            // $('.table-id-'+languageID).remove();
                                            var totalCount = $('.totalCount').text();
                                            $('.totalCount').text(parseInt(totalCount)-1);

                                        }
                                    }
                                });

                                Swal.fire(
                                    "Silindi!",
                                    "Partnyor silindi!",
                                    "success"
                                )
                            }
                        });

                    }


                }
            });


        })

        /*   Delete END   */


    </script>

    <!--  DELETE ALL ELEMENTS (SELECTED) START  -->
    <script>
        deleteALlSelectedElements(
            'Diqq??t?',
            'Se??ilmi??l??ri silm??k ist??diyiniz?? ??minsiniz?',
            'Sil!',
            'Xeyir',
            '{{ route('admin.partner.allDeleteAjax') }}',
            '{{ route('admin.partner.index') }}'
        );
    </script>
    <!--  DELETE ALL ELEMENTS (SELECTED) END  -->

@endsection
