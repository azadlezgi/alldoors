@extends('admin.layouts.index')
@section('title')
    Dillər
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Dillər</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}" class="text-muted">Panel</a>
                        </li>
                        @isset($searchText)
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.language.index') }}" class="text-muted">Dillər</a>
                            </li>
                            <li class="breadcrumb-item">
                                Axtar
                            </li>
                        @else
                            <li class="breadcrumb-item">
                                Dillər
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
                        <h3 class="card-label">Dillər</h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-title">
                            <form action="{{ route('admin.language.search') }}" method="GET">
                                <div class="input-group">
                                    <input
                                        type="search"
                                        class="form-control"
                                        value="@isset($searchText){{ $searchText }}@endisset"
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
                        <button
                            tooltip="Əlavə et"
                            flow="left"
                            data-toggle="modal"
                            data-target="#addDataModalButton"
                            class="btn addDataModalButton btn-icon btn-success btn-circle btn-lg">
                            <i class="flaticon-plus"></i>
                        </button>


                        <!--  DELETE BUTTON  -->
                        <a class="select-btn-action" href="#">
                            <button
                                tooltip="Sil"
                                flow="left"
                                class="btn btn-icon btn-danger btn-circle btn-lg ml-2">
                                <i class="flaticon-delete"></i>
                            </button>
                        </a>



                        <!--Elave et Modal START-->
                        <div class="modal fade" id="addDataModalButton" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalSizeLg" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Yeni dil Əlavə et</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body ">

                                        <!--  Errors  -->
                                        <div class="errorsText">
                                            <div class="alert alert-custom alert-light-danger fade show mb-5"
                                                 role="alert">
                                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                <div class="alert-text">
                                                    <ul></ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!--begin::Form-->
                                        <form id="languageAddForm" action="" method="POST">
                                        @csrf
                                        <!--  Ad  -->
                                            <div class="form-group row mt-10 ">
                                                <label class="col-form-label text-right col-md-3">Dil</label>
                                                <div class="col-md-6">
                                                    <select class="form-control countriesOverflow selectpicker"
                                                            name="name" data-size="5" data-live-search="true">
                                                        <option value="">Select</option>
                                                        @foreach($countriesAll as  $country)
                                                            <option value="{{ $country['code'] }}">
                                                                {{ $country['name'] }}
                                                                ({{ $country['nativeName'] }}) ({{ $country['code'] }})
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>

                                            <!--  Qisa AD  -->
                                            <div class="form-group row">
                                                <label class="col-form-label text-right col-md-3">Qisa ad</label>
                                                <div class="col-md-6">
                                                    <input class="form-control formAddShortName" name="short_name"
                                                           type="text">
                                                </div>
                                            </div>

                                            <!--  Sira  -->
                                            <div class="form-group row">
                                                <label class="col-form-label text-right col-md-3">Sıra</label>
                                                <div class="col-md-6">
                                                    <input type="number" min="0" name="sort"
                                                           class="form-control formAddSort">
                                                </div>
                                            </div>

                                            <!-- Default  -->
                                        {{--                                            <div class="form-group row">--}}
                                        {{--                                                <label class="col-form-label text-right col-md-3">Default</label>--}}
                                        {{--                                                <div class="col-md-6">--}}
                                        {{--                                               <span class="switch switch-outline switch-icon switch-success">--}}
                                        {{--                                                <label>--}}
                                        {{--                                                 <input type="checkbox" name="default"/>--}}
                                        {{--                                                 <span></span>--}}
                                        {{--                                                </label>--}}
                                        {{--                                               </span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}

                                        <!--  Status  -->
                                            <div class="form-group row">
                                                <label class="col-form-label text-right col-md-3">Status</label>
                                                <div class="col-md-6">
                                               <span class="switch switch-outline switch-icon switch-success">
                                                <label>
                                                 <input class="formAddStatus" type="checkbox" name="status"/>
                                                 <span></span>
                                                </label>
                                               </span>
                                                </div>
                                            </div>

                                        </form>


                                        <!--end::Form-->

{{--                                          <textarea class="editorTiny" name="name"></textarea>--}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger font-weight-bold"
                                                data-dismiss="modal">Bağla
                                        </button>
                                        <button type="button" class="btn languageAdd btn-success font-weight-bold">Yadda
                                            saxla
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Elave et Modal END-->


                        <!--Redakte et Modal START-->
                        <div class="modal fade" id="editDataModalButton" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalSizeLg" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title editMOdalTitle"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body ">


                                        <!--  Errors  -->
                                        <div class="errorsText2">
                                            <div class="alert alert-custom alert-light-danger fade show mb-5"
                                                 role="alert">
                                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                <div class="alert-text">
                                                    <ul></ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!--begin::Form-->
                                        <form id="languageUpdateForm" action="" method="POST">
                                            @csrf
                                            <input type="hidden" name="formID" class="formID">
                                            <!--  Ad  -->
                                            <div class="form-group row mt-10 ">
                                                <label class="col-form-label text-right col-md-3">Dil</label>
                                                <div class="col-md-6">
                                                    <!--  Ajax Ile gelir  -->
                                                    <div class="LanguageList">
                                                        <select class="form-control countriesOverflow selectpicker"
                                                                name="name" data-size="5" data-live-search="true">
                                                            <option value="">Select</option>
                                                            @foreach($countriesAll as  $country)
                                                                <option value="{{ $country['code'] }}">
                                                                    {{ $country['name'] }}
                                                                    ({{ $country['nativeName'] }})
                                                                    ({{ $country['code'] }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--  Qisa AD  -->
                                            <div class="form-group row">
                                                <label class="col-form-label text-right col-md-3">Qisa ad</label>
                                                <div class="col-md-6">
                                                    <input class="form-control formShortName" name="short_name"
                                                           type="text">
                                                </div>
                                            </div>

                                            <!--  Sira  -->
                                            <div class="form-group row">
                                                <label class="col-form-label text-right col-md-3">Sıra</label>
                                                <div class="col-md-6">
                                                    <input type="number" min="0" name="sort"
                                                           class="form-control formSort">
                                                </div>
                                            </div>

                                            <!-- Default  -->
                                            <div class="form-group row">
                                                <label class="col-form-label text-right col-md-3">Default</label>
                                                <div class="col-md-6">
                                                   <span
                                                       class="switch switch-outline switch-icon switch-success">
                                                    <label>
                                                     <input class="fromDefault" type="checkbox" name="default"/>
                                                     <span></span>
                                                    </label>
                                                   </span>
                                                </div>
                                            </div>

                                            <!--  Status  -->
                                            <div class="form-group row">
                                                <label class="col-form-label text-right col-md-3">Status</label>
                                                <div class="col-md-6">
                                               <span class="switch switch-outline switch-icon switch-success">
                                                <label>
                                                 <input class="formStatus" type="checkbox" name="status"/>
                                                 <span></span>
                                                </label>
                                               </span>
                                                </div>
                                            </div>

                                        </form>


                                        <!--end::Form-->


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger font-weight-bold"
                                                data-dismiss="modal">Bağla
                                        </button>
                                        <button type="button" class="btn languageUpdate btn-success font-weight-bold">
                                            Yadda
                                            saxla
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Redakte et Modal END-->



                    </div>
                </div>

                <div class="card-body">
                    <!--  MYTABLE START  -->
                    <table class="table table-hover table-striped" data-sorting="true">
                        <thead class="thead-light">
                        <tr>
                            @if($languages->count() != 0)
                                <th width="10" data-sortable="false">
                                    <label class="checkbox checkbox-success select-all-btn">
                                        <input type="checkbox"   />
                                        <span></span>
                                    </label>
                                </th>
                            @endif
                            <th width="10" data-breakpoints="xs">ID</th>
                            <th>Ad</th>
                            <th data-breakpoints="xs sm md">Qısa ad</th>
                            <th data-breakpoints="xs sm md">Kod</th>
                            <th data-breakpoints="xs sm md" data-sortable="false">Default</th>
                            <th data-breakpoints="xs sm md" data-sortable="false">Status</th>
                            <th width="40" data-breakpoints="xs sm md" data-sortable="false">Ayarlar</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($languages as $language)
                            <tr class="table-id-{{ $language->id }}" data-index="{{ $language->id }}" data-position="{{ $language->sort }}">
                                {{--                                <td>{{$loop->iteration}}</td>--}}

                                <!-- SELECT ALL -->
                                <td>
                                    <label class="checkbox checkbox-success select-element-btn" data-id="{{ $language->id }}">
                                        <input type="checkbox"   />
                                        <span></span>
                                    </label>
                                </td>

                                <td>{{$language->id}}</td>
                                <td class="sortableHandle">
                                    <span style="vertical-align: middle;" class="symbol symbol-20 symbol-circle mr-1">
                                        <img src="{{ countryFlag($language->code) }}"/>
                                    </span>
                                    {{ $language->name }}
                                </td>
                                <td>{{ $language->short_name }}</td>
                                <td>{{ $language->code }}</td>

                                <td>

                                    <form action="{{ route('admin.language.defaultStatus') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $language->id }}">
                                        <button type="submit"
                                                {{ $language->default == 1? 'disabled':'' }}
                                                class="defaultButton btn {{ $language->default == 1? ' btn-outline-success ':' btn-outline-danger ' }}
                                                    font-weight-bold btn-sm btn-pill">
                                            {{ $language->default == 1? 'Aktiv':'Passiv' }}
                                        </button>
                                    </form>

                                </td>

                                <td>
                                    @if($language->default != 1)
                                        <span class="switch switch-outline switch-icon switch-success">
                                        <label>
                                            <input
                                                class="statusActive"
                                                data-id="{{ $language->id }}"
                                                type="checkbox"
                                                {{ $language->status == 1? 'checked="checked"':"" }}
                                                name="select">
                                            <span></span>
                                        </label>
									</span>
                                    @endif
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
                                                    data-id="{{ $language->id }}"
                                                    data-code="{{ $language->code }}"
                                                    data-toggle="modal"
                                                    data-target="#editDataModalButton"
                                                    class="navi-item redakteEt">
                                                    <a href="#" class="navi-link text-center">
																		<span class="navi-text">
																			<span
                                                                                class="label label-xl label-inline label-light-primary">Redaktə et</span>
																		</span>
                                                    </a>
                                                </li>

                                                <li
                                                    class="navi-item deleteButton"
                                                    data-id="{{ $language->id }}"
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
                                Cəmi <b><span class="totalCount">{{ $languages->total() }}</span></b> yazı
                                @if($languages->hasPages())
                                    , <b>{{ $languages->lastPage() }}
                                </b> səhifədən  <b>{{ $languages->currentPage() }}</b>-ci göstərildi.
                                @endif

                            </span>
                        </div>
                        <!--  Paginate START -->
                        <div class="d-flex flex-wrap py-2 mr-3">
                            {{ $languages->appends(['search' => isset($searchText) ? $searchText : null])
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
                // "expandFirst": true, //bunu yandirdiqda birinci aciq olmush formada gelecek
                // "expandAll": true, //Hamsni achir
                // "showHeader": false, //Headeri sondurur
                // "showToggle": false, //Achib baqliyani sondurur
                // "toggleColumn": "first", //AChib baqliyanin yerini deyishir first, last

                // "columns": [  {
                //     "formatter": function(value, options, rowData){
                //         return "<span>" + value + "</span>";
                //     }
                // }],  //columun en brinci deyeriyle oyanamq

                // "columns": [{
                //     "style": {
                //         "color": "red"
                //     }
                // }] , //Columlari renglemek

                // "columns": [{
                //     "title": "ID"
                // }], //thead ichindeki adlari deyishmek

                // "columns": [{
                //     "sortable": false
                // }]
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
                    url: "{{ route('admin.language.statusAjax') }}",
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
                url: "{{ route('admin.language.sortAjax') }}",
                method: 'POST',
                dataType: 'JSON',
                data: {update: 1, positions: positions},
                success: function (response) {
                    toastr.success("Uğurla qeydə alındı");
                }
            });
        }

        /*   Sortable  END   */

        /*   Add START   */

        $(document).on('click', '.addDataModalButton', function () {
            $('.errorsText').hide();
            $('.formAddShortName').val('');
            $('.formAddSort').val('');
            $('.formAddStatus').removeAttr('checked');

        })

        $(document).on('click', '.languageAdd', function () {

            var languageFormData = $("#languageAddForm").serialize();
            $('.errorsText ul').text('');

            $.ajax({
                url: "{{ route('admin.language.add') }}",
                type: 'POST',
                data: languageFormData,
                dataType: 'JSON',
                success: function (response) {
                    var errors = response.msg;
                    var countyExists = response.countyExists;

                    $.each(errors, function (index, error) {
                        $('.errorsText ul').append('<li>' + error + '</li>')
                        $('.errorsText').fadeIn();
                    })

                    if (response.error) {
                        $('.errorsText ul').append('<li>' + countyExists + '</li>')
                        $('.errorsText').fadeIn();
                    }

                    if (response.success) {
                        $('.errorsText').remove();
                        toastr.success("Dil əlavə olundu");
                        setTimeout(function () {
                            window.location.href = "{{ route('admin.language.index') }}";
                        }, 2000);

                    }
                }
            });

        })
        /*   Add END   */

        /*   Edit START   */
        $(document).on('click', '.redakteEt', function () {

            $('.errorsText2').hide();

            var languageID = $(this).data('id');
            var languageCode = $(this).data('code');
            var fromDefault = false;
            var formStatus = false;

            /*   Lazim olan dili select et   */
            $('.LanguageList option[value="' + languageCode + '"]').attr('selected', 'selected');

            /*   Optionun ichindeki texti al   */
            var languageOptionText = $('.LanguageList option[value="' + languageCode + '"]').text();
            $('.LanguageList .filter-option-inner-inner').html(languageOptionText);
            $('.editMOdalTitle').text(languageOptionText)


            $.ajax({
                url: "{{ route('admin.language.editAjax') }}",
                type: 'POST',
                data: {languageID: languageID},
                dataType: 'JSON',
                success: function (response) {
                    $('.formShortName').val(response.formShortName);
                    $('.formID').val(response.formID);
                    $('.formSort').val(response.formSort);

                    if (response.fromDefault == 1) {
                        $('.fromDefault').attr('checked', 'checked');
                    } else {
                        $('.fromDefault').removeAttr('checked');
                    }

                    if (response.formStatus == 1) {
                        $('.formStatus').attr('checked', 'checked');
                    } else {
                        $('.formStatus').removeAttr('checked');
                    }


                }
            });


        })
        /*   Edit END   */


        /*   Update START   */
        $(document).on('click', '.languageUpdate', function () {

            var languageFormData = $("#languageUpdateForm").serialize();
            $('.errorsText2 ul').text('');

            $.ajax({
                url: "{{ route('admin.language.update') }}",
                type: 'POST',
                data: languageFormData,
                dataType: 'JSON',
                success: function (response) {
                    var errors = response.msg;
                    var countyExists = response.countyExists;
                    var message = response.message;

                    $.each(errors, function (index, error) {
                        $('.errorsText2 ul').append('<li>' + error + '</li>')
                        $('.errorsText2').fadeIn();
                    })

                    if (response.error) {
                        $('.errorsText2 ul').append('<li>' + message + '</li>')
                        $('.errorsText2').fadeIn();

                    }

                    if (response.success) {
                        $('.errorsText2').remove();
                        toastr.success("Dil redaktə olundu");
                        setTimeout(function () {
                            window.location.href = "{{ route('admin.language.index') }}";
                        }, 2000);

                    }
                }
            });

        })
        /*   Update END   */


        /*   Delete START   */

        $(document).on('click', '.deleteButton', function () {
            var languageID = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.language.deleteAjax') }}",
                type: 'POST',
                data: {id: languageID},
                dataType: 'JSON',
                success: function (response) {
                    if (response.error) {
                        // toastr.error(response.languageName+" default olaraq seçilidir.Silmək mümkün olmadı!",'Diqqət!');
                        Swal.fire({
                            title: "Diqqət!",
                            html: "<b>" + response.languageName + "</b> dili default olaraq seçilidir.Silmək mümkün olmadı!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }

                    if (response.success) {

                        Swal.fire({
                            title: "Diqqət?",
                            html: "<b>" + response.languageName + "</b> dilini silmək istədiyinizə əminsiniz?" +
                                "Dil silindikdə bu dil ilə bağlı bütün tərcümələr silinicək!",
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
                                    url: "{{ route('admin.language.delete') }}",
                                    type: 'POST',
                                    data: {id:languageID},
                                    dataType: 'JSON',
                                    success: function (response) {

                                        if (response.success) {
                                            $('.table-id-'+languageID).fadeOut(1000);
                                            // $('.table-id-'+languageID).remove();
                                            var totalCount = $('.totalCount').text();
                                            $('.totalCount').text(parseInt(totalCount)-1);

                                        }
                                    }
                                });

                                Swal.fire(
                                    "Silindi!",
                                    "<b>" + response.languageName + "</b> dili silindi!",
                                    "success"
                                )
                            }
                        });

                    }


                }
            });


        })

        /*   Delete END   */

        /*   EDITOR START   */
        tinymce.init({
            selector: "textarea.editorTiny",
            theme: "modern",
            height: 150,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
        /*   EDITOR END   */

    </script>


    <!--  DELETE ALL ELEMENTS (SELECTED) START  -->
    <script>
        deleteALlSelectedElements(
            'Diqqət?',
            'Seçilmişləri silmək istədiyinizə əminsiniz?',
            'Sil!',
            'Xeyir',
            '{{ route('admin.language.allDeleteAjax') }}',
            '{{ route('admin.language.index') }}'
        );
    </script>
    <!--  DELETE ALL ELEMENTS (SELECTED) END  -->

@endsection
