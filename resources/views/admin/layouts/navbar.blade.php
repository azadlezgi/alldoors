<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
        {{--            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">--}}
        {{--                <!--begin::Header Nav-->--}}
        {{--                <ul class="menu-nav">--}}
        {{--                    --}}{{--                    Qeyd: menyunun hemihse aciq olmaqi uchun bu class elave olunur -> menu-item-open--}}
        {{--                    <li class="menu-item  menu-item-here menu-item-rel menu-item-open menu-item-here menu-item-active"--}}
        {{--                        data-menu-toggle="click" aria-haspopup="true">--}}
        {{--                        <a target="_blank" href="{{ route('frontend.home.index') }}" class="menu-link">--}}
        {{--                            <span class="menu-text">Ana səhifə</span>--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    <li class="menu-item  menu-item-here menu-item-submenu  menu-item-rel menu-item-here menu-item-active"--}}
        {{--                        data-menu-toggle="click" aria-haspopup="true">--}}
        {{--                        <a href="javascript:;" class="menu-link menu-toggle">--}}
        {{--                            <span class="menu-text">Pages</span>--}}
        {{--                            <i class="menu-arrow"></i>--}}
        {{--                        </a>--}}
        {{--                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">--}}
        {{--                            <ul class="menu-subnav">--}}
        {{--                                <li class="menu-item menu-item-active" aria-haspopup="true">--}}
        {{--                                    <a href="/metronic/demo1/index.html" class="menu-link">--}}
        {{--															<span class="svg-icon menu-icon">--}}
        {{--																<!--begin::Svg Icon | path:assets/media/svg/icons/Clothes/Briefcase.svg-->--}}
        {{--																<svg xmlns="http://www.w3.org/2000/svg"--}}
        {{--                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"--}}
        {{--                                                                     width="24px" height="24px" viewBox="0 0 24 24"--}}
        {{--                                                                     version="1.1">--}}
        {{--																	<g stroke="none" stroke-width="1" fill="none"--}}
        {{--                                                                       fill-rule="evenodd">--}}
        {{--																		<rect x="0" y="0" width="24" height="24"/>--}}
        {{--																		<path--}}
        {{--                                                                            d="M5.84026576,8 L18.1597342,8 C19.1999115,8 20.0664437,8.79732479 20.1528258,9.83390904 L20.8194924,17.833909 C20.9112219,18.9346631 20.0932459,19.901362 18.9924919,19.9930915 C18.9372479,19.9976952 18.8818364,20 18.8264009,20 L5.1735991,20 C4.0690296,20 3.1735991,19.1045695 3.1735991,18 C3.1735991,17.9445645 3.17590391,17.889153 3.18050758,17.833909 L3.84717425,9.83390904 C3.93355627,8.79732479 4.80008849,8 5.84026576,8 Z M10.5,10 C10.2238576,10 10,10.2238576 10,10.5 L10,11.5 C10,11.7761424 10.2238576,12 10.5,12 L13.5,12 C13.7761424,12 14,11.7761424 14,11.5 L14,10.5 C14,10.2238576 13.7761424,10 13.5,10 L10.5,10 Z"--}}
        {{--                                                                            fill="#000000"/>--}}
        {{--																		<path--}}
        {{--                                                                            d="M10,8 L8,8 L8,7 C8,5.34314575 9.34314575,4 11,4 L13,4 C14.6568542,4 16,5.34314575 16,7 L16,8 L14,8 L14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 C10.4477153,6 10,6.44771525 10,7 L10,8 Z"--}}
        {{--                                                                            fill="#000000" fill-rule="nonzero"--}}
        {{--                                                                            opacity="0.3"/>--}}
        {{--																	</g>--}}
        {{--																</svg>--}}
        {{--                                                                <!--end::Svg Icon-->--}}
        {{--															</span>--}}
        {{--                                        <span class="menu-text">My Account</span>--}}
        {{--                                    </a>--}}
        {{--                                </li>--}}
        {{--                            </ul>--}}
        {{--                        </div>--}}
        {{--                    </li>--}}
        {{--                </ul>--}}
        {{--                <!--end::Header Nav-->--}}
        {{--            </div>--}}
        <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">

            <!--  HOME PAGE START  -->

            <div class="topbar-item" title="Ana səhifə">
                <a target="_blank" href="{{ route('frontend.home.index') }}">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1" id="kt_quick_cart_toggle">
										<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Home.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                    </div>
                </a>
            </div>

            <!--  HOME PAGE END  -->

            <!--  CACHE CLEAR START  -->
            <div id="cache-clear" class="topbar-item" title="Keşi təmizlə">
                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1" id="kt_quick_cart_toggle">
	<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Media/Repeat.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M12,8 L8,8 C5.790861,8 4,9.790861 4,12 L4,13 C4,14.6568542 5.34314575,16 7,16 L7,18 C4.23857625,18 2,15.7614237 2,13 L2,12 C2,8.6862915 4.6862915,6 8,6 L12,6 L12,4.72799742 C12,4.62015048 12.0348702,4.51519416 12.0994077,4.42878885 C12.264656,4.2075478 12.5779675,4.16215674 12.7992086,4.32740507 L15.656242,6.46136716 C15.6951359,6.49041758 15.7295917,6.52497737 15.7585249,6.56395854 C15.9231063,6.78569617 15.876772,7.09886961 15.6550344,7.263451 L12.798001,9.3840407 C12.7118152,9.44801079 12.607332,9.48254921 12.5,9.48254921 C12.2238576,9.48254921 12,9.25869158 12,8.98254921 L12,8 Z" fill="#000000"/>
        <path d="M12.0583175,16 L16,16 C18.209139,16 20,14.209139 20,12 L20,11 C20,9.34314575 18.6568542,8 17,8 L17,6 C19.7614237,6 22,8.23857625 22,11 L22,12 C22,15.3137085 19.3137085,18 16,18 L12.0583175,18 L12.0583175,18.9825492 C12.0583175,19.2586916 11.8344599,19.4825492 11.5583175,19.4825492 C11.4509855,19.4825492 11.3465023,19.4480108 11.2603165,19.3840407 L8.40328311,17.263451 C8.18154548,17.0988696 8.13521119,16.7856962 8.29979258,16.5639585 C8.32872576,16.5249774 8.36318164,16.4904176 8.40207551,16.4613672 L11.2591089,14.3274051 C11.48035,14.1621567 11.7936615,14.2075478 11.9589099,14.4287888 C12.0234473,14.5151942 12.0583175,14.6201505 12.0583175,14.7279974 L12.0583175,16 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                </div>
            </div>
            <!--  CACHE CLEAR END  -->

            <!--begin::Languages-->
            <div class="dropdown">
                <!--begin::Toggle-->
{{--                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">--}}
{{--                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">--}}
{{--                        <?php $languageCode = LanguageData::getDefaultLanguage() ?>--}}
{{--                        <img class="h-20px w-20px rounded-sm"--}}
{{--                             src="{{ asset('assets/images/flags').'/'.$languageCode['code'].'.svg' }}"--}}
{{--                             alt="{{ $languageCode['name'] }}"/>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">

                        <!--begin::Item-->
                        @foreach(LanguageData::getList() as $language)
                            <li class="navi-item">
                                <a href="#" class="navi-link">
													<span class="symbol symbol-20 mr-3">
														<img
                                                            src="{{ asset('assets/images/flags').'/'.$language->code.'.svg' }}"
                                                            alt="{{ $language->name }}">
													</span>
                                    <span class="navi-text">{{$language->name}}</span>
                                </a>
                            </li>
                    @endforeach
                    <!--end::Item-->

                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Languages-->
            <!--begin::User-->
            <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                     id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"></span>
                    <span
                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ auth()->user()->name }}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
											<span class="symbol-label font-size-h5 font-weight-bold">
                                                <div class="symbol-label"
                                                     style="background-image:url('{{ asset('storage/profile/'. auth()->user()->profile_photo) }}')">
                                                    @if(empty(auth()->user()->profile_photo))
                                                        <div class="profil-foto-header-not">
                                                            {{ substr(auth()->user()->name,0,1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </span>
										</span>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
