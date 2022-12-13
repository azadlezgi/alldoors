<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
{{--        <a href="{{ route('admin.index') }}" class="brand-logo">--}}
{{--            <img alt="Logo" src="{{ asset('backend/assets/media/logos/logo-panel.png') }}"/>--}}
{{--        </a>--}}
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<path
                                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"/>
										<path
                                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"/>
									</g>
								</svg>
                                <!--end::Svg Icon-->
							</span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
             data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">

                <!--  DASHBOARD  -->
                <li class="menu-item {{Route::is('admin.index')? "menu-item-active":""}}" aria-haspopup="true">
                    <a href="{{ route('admin.index') }}" class="menu-link">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"/>
													<path
                                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
													<path
                                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                        fill="#000000" opacity="0.3"/>
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <!--  CUSTOM SOZ  -->
                <li class="menu-section">
                    <h4 class="menu-text">Custom</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>




                <!--  Pages  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.page.index',
                                                        'admin.page.add',
                                                        'admin.page.edit',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">

                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Substract.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" fill-rule="nonzero"/>
                            <path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>



                        <span class="menu-text">Səhifələr</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  PAGES  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.page.index',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.page.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Səhifələr</span>
                                </a>
                            </li>

                            <!--  Səhifə əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.page.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.page.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Səhifə əlavə et</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>



                <!--  Fayl Menecer  -->
                <li class="menu-item {{Route::is('admin.FileManager.index')? "menu-item-active":""}}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.FileManager.index') }}" class="menu-link">

<span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Files/Group-folders.svg--><svg
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M4.5,21 L21.5,21 C22.3284271,21 23,20.3284271 23,19.5 L23,8.5 C23,7.67157288 22.3284271,7 21.5,7 L11,7 L8.43933983,4.43933983 C8.15803526,4.15803526 7.77650439,4 7.37867966,4 L4.5,4 C3.67157288,4 3,4.67157288 3,5.5 L3,19.5 C3,20.3284271 3.67157288,21 4.5,21 Z"
            fill="#000000" opacity="0.3"/>
        <path
            d="M2.5,19 L19.5,19 C20.3284271,19 21,18.3284271 21,17.5 L21,6.5 C21,5.67157288 20.3284271,5 19.5,5 L9,5 L6.43933983,2.43933983 C6.15803526,2.15803526 5.77650439,2 5.37867966,2 L2.5,2 C1.67157288,2 1,2.67157288 1,3.5 L1,17.5 C1,18.3284271 1.67157288,19 2.5,19 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>


                        <span class="menu-text">Fayl Menecer</span>
                    </a>
                </li>





                <!--  Post  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.post.index',
                                                        'admin.post.add',
                                                        'admin.post.edit',
                                                        'admin.post.category.index',
                                                        'admin.post.category.add',
                                                        'admin.post.category.edit',
                                                        'admin.post.search',
                                                        'admin.post.categories',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">


                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Clipboard-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
    </g>
</svg><!--end::Svg Icon--></span>





                        <span class="menu-text">Bloqlar</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  POSTS  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.post.index',
                                                      'admin.post.edit',
                                                      'admin.post.search',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.post.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bloqlar</span>
                                </a>
                            </li>

                            <!--  Post əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.post.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.post.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bloq əlavə et</span>
                                </a>
                            </li>


                            <!--  Post Categories  -->
{{--                            <li class="menu-item {{Route::is([--}}
{{--                                                     'admin.post.category.index',--}}
{{--                                                     'admin.post.category.add',--}}
{{--                                                     'admin.post.category.edit',--}}
{{--                                                     'admin.post.categories',--}}
{{--                                                    ])? "menu-item-active":""}}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.post.category.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot">--}}
{{--                                        <span></span>--}}
{{--                                    </i>--}}
{{--                                    <span class="menu-text">Kateqoriyalar </span>--}}
{{--                                </a>--}}
{{--                            </li>--}}


                        </ul>
                    </div>

                </li>





                <!--  Product  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.product.index',
                                                        'admin.product.add',
                                                        'admin.product.edit',
                                                        'admin.product.search',

                                                        'admin.product.category.index',
                                                        'admin.product.category.add',
                                                        'admin.product.category.edit',
                                                        'admin.product.category.search',
                                                        'admin.product.categories',

                                                        'admin.product.collection.index',
                                                        'admin.product.collection.add',
                                                        'admin.product.collection.edit',
                                                        'admin.product.collection.search',
                                                        'admin.product.collections',

                                                        'admin.product.model.index',
                                                        'admin.product.model.add',
                                                        'admin.product.model.edit',
                                                        'admin.product.model.search',
                                                        'admin.product.models',

                                                        'admin.product.manufacturer.index',
                                                        'admin.product.manufacturer.add',
                                                        'admin.product.manufacturer.edit',
                                                        'admin.product.manufacturer.search',
                                                        'admin.product.manufacturers',


                                                        'admin.attribute.group.index',
                                                        'admin.attribute.group.add',
                                                        'admin.attribute.group.edit',
                                                        'admin.attribute.group.search',


                                                        'admin.attribute.index',
                                                        'admin.attribute.add',
                                                        'admin.attribute.edit',
                                                        'admin.attribute.search',
                                                        'admin.attribute.list',



                                                        'admin.option.group.index',
                                                        'admin.option.group.add',
                                                        'admin.option.group.edit',
                                                        'admin.option.group.search',


                                                        'admin.option.index',
                                                        'admin.option.add',
                                                        'admin.option.edit',
                                                        'admin.option.search',
                                                        'admin.option.list',




                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">



                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Cart2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>




                        <span class="menu-text">Məhsullar</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  PRODUCTS  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.product.index',
                                                     'admin.product.edit',
                                                     'admin.product.search',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.product.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Məhsullar</span>
                                </a>
                            </li>

                            <!--  Məhsul əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.product.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.product.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Məhsul əlavə et</span>
                                </a>
                            </li>


                            <!--  Məhsul Dizayn  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.product.model.index',
                                                     'admin.product.model.add',
                                                     'admin.product.model.edit',
                                                     'admin.product.model.search',
                                                     'admin.product.models',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.product.model.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Dizaynlar</span>
                                </a>
                            </li>


                            <!--  Məhsul Categories  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.product.category.index',
                                                     'admin.product.category.add',
                                                     'admin.product.category.edit',
                                                     'admin.product.category.search',
                                                     'admin.product.categories',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.product.category.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Kateqoriyalar</span>
                                </a>
                            </li>


                            <!--  Məhsul Collections  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.product.collection.index',
                                                     'admin.product.collection.add',
                                                     'admin.product.collection.edit',
                                                     'admin.product.collection.search',
                                                     'admin.product.collections',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.product.collection.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Kolleksiyalar</span>
                                </a>
                            </li>



                            <!--  Məhsul Manufacturer  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.product.manufacturer.index',
                                                     'admin.product.manufacturer.add',
                                                     'admin.product.manufacturer.edit',
                                                     'admin.product.manufacturer.search',
                                                     'admin.product.manufacturers',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.product.manufacturer.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">İstehsalçılar</span>
                                </a>
                            </li>


                            <!--  ATTRIBUT  -->
                            <li class="menu-item menu-item-submenu {{Route::is([
                                                     'admin.attribute.group.index',
                                                     'admin.attribute.group.add',
                                                     'admin.attribute.group.edit',
                                                     'admin.attribute.group.search',

                                                     'admin.attribute.index',
                                                     'admin.attribute.add',
                                                     'admin.attribute.edit',
                                                     'admin.attribute.search',
                                                     'admin.attribute.list',

                                                    ])? "menu-item-open menu-item-here":""}}" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Atributlar</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu"  kt-hidden-height="120">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">


                                        <!--  ATTRIBUTE  -->
                                        <li class="menu-item  {{Route::is([
                                                        'admin.attribute.index',
                                                        'admin.attribute.add',
                                                        'admin.attribute.edit',
                                                        'admin.attribute.search',
                                                        'admin.attribute.list',

                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                            <a href="{{ route('admin.attribute.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Atributlar</span>
                                            </a>
                                        </li>


                                        <!--  ATTRIBUTE GROUP  -->
                                        <li class="menu-item  {{Route::is([
                                                     'admin.attribute.group.index',
                                                     'admin.attribute.group.add',
                                                     'admin.attribute.group.edit',
                                                     'admin.attribute.group.search',

                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                            <a href="{{ route('admin.attribute.group.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Atribut grup</span>
                                            </a>
                                        </li>






                                    </ul>
                                </div>
                            </li>



                            <!--  OPTION  -->
                            <li class="menu-item menu-item-submenu {{Route::is([
                                                     'admin.option.group.index',
                                                     'admin.option.group.add',
                                                     'admin.option.group.edit',
                                                     'admin.option.group.search',

                                                     'admin.option.index',
                                                     'admin.option.add',
                                                     'admin.option.edit',
                                                     'admin.option.search',
                                                     'admin.option.list',

                                                    ])? "menu-item-open menu-item-here":""}}" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Seçimlər</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu"  kt-hidden-height="120">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">


                                        <!--  OPTION  -->
                                        <li class="menu-item  {{Route::is([
                                                        'admin.option.index',
                                                        'admin.option.add',
                                                        'admin.option.edit',
                                                        'admin.option.search',
                                                        'admin.option.list',

                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                            <a href="{{ route('admin.option.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Seçimlər</span>
                                            </a>
                                        </li>


                                        <!--  OPTION GROUP  -->
                                        <li class="menu-item  {{Route::is([
                                                     'admin.option.group.index',
                                                     'admin.option.group.add',
                                                     'admin.option.group.edit',
                                                     'admin.option.group.search',

                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                            <a href="{{ route('admin.option.group.index') }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Seçimlər grup</span>
                                            </a>
                                        </li>






                                    </ul>
                                </div>
                            </li>





                        </ul>
                    </div>

                </li>




                <!--  Gallery  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.gallery.index',
                                                        'admin.gallery.add',
                                                        'admin.gallery.edit',
                                                        'admin.gallery.category.index',
                                                        'admin.gallery.category.add',
                                                        'admin.gallery.category.edit',
                                                        'admin.gallery.search',
                                                        'admin.gallery.categories',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">

                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Tools/Pantone.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L8,21 C5.790861,21 4,19.209139 4,17 C4,14.790861 5.790861,13 8,13 L20,13 C21.1045695,13 22,13.8954305 22,15 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z" fill="#000000" opacity="0.3"/>
        <path d="M15.5421357,5.69999981 L18.3705628,8.52842693 C19.1516114,9.30947552 19.1516114,10.5758055 18.3705628,11.3568541 L9.88528147,19.8421354 C8.3231843,21.4042326 5.79052439,21.4042326 4.22842722,19.8421354 C2.66633005,18.2800383 2.66633005,15.7473784 4.22842722,14.1852812 L12.7137086,5.69999981 C13.4947572,4.91895123 14.7610871,4.91895123 15.5421357,5.69999981 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z" fill="#000000" opacity="0.3"/>
        <path d="M5,3 L9,3 C10.1045695,3 11,3.8954305 11,5 L11,17 C11,19.209139 9.209139,21 7,21 C4.790861,21 3,19.209139 3,17 L3,5 C3,3.8954305 3.8954305,3 5,3 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>



                        <span class="menu-text">Qalereyalar</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  GALLERIES  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.gallery.index',
                                                      'admin.gallery.edit',
                                                      'admin.gallery.search',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.gallery.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Qalereyalar</span>
                                </a>
                            </li>

                            <!--  Qalereya əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.gallery.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.gallery.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Qalereya əlavə et</span>
                                </a>
                            </li>


                            <!--  Qalereya Categories  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.gallery.category.index',
                                                     'admin.gallery.category.add',
                                                     'admin.gallery.category.edit',
                                                     'admin.gallery.categories',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.gallery.category.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Kateqoriyalar </span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>


                <!--  Service  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.service.index',
                                                        'admin.service.add',
                                                        'admin.service.edit',
                                                        'admin.service.category.index',
                                                        'admin.service.category.add',
                                                        'admin.service.category.edit',
                                                        'admin.service.search',
                                                        'admin.service.categories',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">


                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Server.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M5,2 L19,2 C20.1045695,2 21,2.8954305 21,4 L21,6 C21,7.1045695 20.1045695,8 19,8 L5,8 C3.8954305,8 3,7.1045695 3,6 L3,4 C3,2.8954305 3.8954305,2 5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L16,6 C16.5522847,6 17,5.55228475 17,5 C17,4.44771525 16.5522847,4 16,4 L11,4 Z M7,6 C7.55228475,6 8,5.55228475 8,5 C8,4.44771525 7.55228475,4 7,4 C6.44771525,4 6,4.44771525 6,5 C6,5.55228475 6.44771525,6 7,6 Z" fill="#000000" opacity="0.3"/>
        <path d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,13 C21,14.1045695 20.1045695,15 19,15 L5,15 C3.8954305,15 3,14.1045695 3,13 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L16,13 C16.5522847,13 17,12.5522847 17,12 C17,11.4477153 16.5522847,11 16,11 L11,11 Z M7,13 C7.55228475,13 8,12.5522847 8,12 C8,11.4477153 7.55228475,11 7,11 C6.44771525,11 6,11.4477153 6,12 C6,12.5522847 6.44771525,13 7,13 Z" fill="#000000"/>
        <path d="M5,16 L19,16 C20.1045695,16 21,16.8954305 21,18 L21,20 C21,21.1045695 20.1045695,22 19,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,18 C3,16.8954305 3.8954305,16 5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 L11,18 Z M7,20 C7.55228475,20 8,19.5522847 8,19 C8,18.4477153 7.55228475,18 7,18 C6.44771525,18 6,18.4477153 6,19 C6,19.5522847 6.44771525,20 7,20 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>



                        <span class="menu-text">Xidmətlər</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  SERVICES  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.service.index',
                                                      'admin.service.edit',
                                                      'admin.service.search',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.service.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Xidmətlər</span>
                                </a>
                            </li>

                            <!--  Servis əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.service.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.service.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Xidmət əlavə et</span>
                                </a>
                            </li>


                            <!--  Servic Categories  -->
{{--                            <li class="menu-item {{Route::is([--}}
{{--                                                     'admin.service.category.index',--}}
{{--                                                     'admin.service.category.add',--}}
{{--                                                     'admin.service.category.edit',--}}
{{--                                                     'admin.service.categories',--}}
{{--                                                    ])? "menu-item-active":""}}" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.service.category.index') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot">--}}
{{--                                        <span></span>--}}
{{--                                    </i>--}}
{{--                                    <span class="menu-text">Kateqoriyalar</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}


                        </ul>
                    </div>

                </li>





                <!--  Menular  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.menu.index',
                                                        'admin.menu.edit',
                                                        'admin.menu.add',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">

								<span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Text/Menu.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                        <path
                            d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                            fill="#000000" opacity="0.3"/>
                    </g>
                    </svg><!--end::Svg Icon--></span>

                        <span class="menu-text">Menyu</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  Menu  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.menu.index',
                                                        'admin.menu.edit',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.menu.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Menyu</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>


                <!--  Slides  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.slide.index',
                                                        'admin.slide.add',
                                                        'admin.slide.edit',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">


       <span class="svg-icon menu-icon">
                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Image.svg-->
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>

                        <span class="menu-text">Slaydlar</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  Slaydlar  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.slide.index',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.slide.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Slaydlar</span>
                                </a>
                            </li>

                            <!--  Slayd əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.slide.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.slide.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Slayd əlavə et</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>




                <!--  Online Catalogs  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.onlineCatalog.index',
                                                        'admin.onlineCatalog.add',
                                                        'admin.onlineCatalog.edit',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">


       <span class="svg-icon menu-icon">
                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Image.svg-->
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>

                        <span class="menu-text">Onlayn Kataloqlar</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  Onlayn Kataloqlar  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.onlineCatalog.index',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.onlineCatalog.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Onlayn Kataloqlar</span>
                                </a>
                            </li>

                            <!--  Onlayn Kataloq əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.onlineCatalog.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.onlineCatalog.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Onlayn Kataloq əlavə et</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>




                <!--  Banners  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.banner.index',
                                                        'admin.banner.add',
                                                        'admin.banner.edit',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">


       <span class="svg-icon menu-icon">
                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Image.svg-->
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>

                        <span class="menu-text">Bannerlər</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  Bannerlər  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.banner.index',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.banner.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bannerlər</span>
                                </a>
                            </li>

                            <!--  Banner əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.banner.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.banner.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Banner əlavə et</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>




                <!--  Teams  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.team.index',
                                                        'admin.team.add',
                                                        'admin.team.edit',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">



                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Files/User-folder.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
        <path d="M12,13 C10.8954305,13 10,12.1045695 10,11 C10,9.8954305 10.8954305,9 12,9 C13.1045695,9 14,9.8954305 14,11 C14,12.1045695 13.1045695,13 12,13 Z" fill="#000000" opacity="0.3"/>
        <path d="M7.00036205,18.4995035 C7.21569918,15.5165724 9.36772908,14 11.9907452,14 C14.6506758,14 16.8360465,15.4332455 16.9988413,18.5 C17.0053266,18.6221713 16.9988413,19 16.5815,19 C14.5228466,19 11.463736,19 7.4041679,19 C7.26484009,19 6.98863236,18.6619875 7.00036205,18.4995035 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>


                        <span class="menu-text">Əməkdaşlar</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  Team  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.team.index',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.team.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Əməkdaşlar</span>
                                </a>
                            </li>

                            <!--  Team əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.team.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.team.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Əməkdaş əlavə et</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>





                <!--  Partners  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.partner.index',
                                                        'admin.partner.add',
                                                        'admin.partner.edit',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">



                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Group.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>


                        <span class="menu-text">Partnyorlar</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  Partner  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.partner.index',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.partner.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Partnyorlar</span>
                                </a>
                            </li>

                            <!--  Partner əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.partner.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.partner.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Partnyor əlavə et</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>




                <!--  Reviews  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.review.index',
                                                        'admin.review.add',
                                                        'admin.review.edit',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">




                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Chat6.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M14.4862 18L12.7975 21.0566C12.5304 21.54 11.922 21.7153 11.4386 21.4483C11.2977 21.3704 11.1777 21.2597 11.0887 21.1255L9.01653 18H5C3.34315 18 2 16.6569 2 15V6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V15C22 16.6569 20.6569 18 19 18H14.4862Z" fill="black"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 7H15C15.5523 7 16 7.44772 16 8C16 8.55228 15.5523 9 15 9H6C5.44772 9 5 8.55228 5 8C5 7.44772 5.44772 7 6 7ZM6 11H11C11.5523 11 12 11.4477 12 12C12 12.5523 11.5523 13 11 13H6C5.44772 13 5 12.5523 5 12C5 11.4477 5.44772 11 6 11Z" fill="black"/>
                    </g>
                </svg><!--end::Svg Icon--></span>


                        <span class="menu-text">Rəylər</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  Review  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.review.index',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.review.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Rəylər</span>
                                </a>
                            </li>

                            <!--  Review əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.review.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.review.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Rəy əlavə et</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>




                <!--  Istifadechiler  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.user.index',
                                                        'admin.user.add',
                                                        'admin.user.edit',
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">



                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Address-card.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>

                        <span class="menu-text">İstifadəçilər</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">

                            <!--  İstifadəçilər  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.user.index',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.user.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">İstifadəçilər</span>
                                </a>
                            </li>

                            <!--  İstifadəçi əlavə et  -->
                            <li class="menu-item {{Route::is([
                                                     'admin.user.add',
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.user.add') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">İstifadəçi əlavə et</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </li>


                <!--  AYARLAR  -->
                <li class="menu-item menu-item-submenu {{Route::is([
                                        'admin.logs',
                                        'admin.setting.index',
                                        ])? "menu-item-open":""}} " aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                        <span class="svg-icon menu-icon">
                           <svg
                               xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                               width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                    fill="#000000"/>
                            </g>
                        </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">Ayarlar</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
{{--                            <li class="menu-item {{Route::is('admin.logs')? "menu-item-active":""}}"--}}
{{--                                aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.logs') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot">--}}
{{--                                        <span></span>--}}
{{--                                    </i>--}}
{{--                                    <span class="menu-text">Loglar</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class="menu-item {{Route::is('admin.setting.index')? "menu-item-active":""}}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.setting.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Ayarlar</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!--  DILLER  -->
                <li class="menu-item menu-item-submenu {{Route::is(
                                                        [
                                                        'admin.language.index',
                                                        'admin.language.search',
                                                        'admin.languageGroup.index',
                                                        'admin.languageGroup.search',
                                                        'admin.languageGroup.groupDetailSearch',
                                                        'admin.languageGroup.detail',
                                                        'admin.languagePhrase.index',
                                                        'admin.languagePhrase.search'
                                                        ]
                                                        )? "menu-item-open":""}}" aria-haspopup="true"
                    data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z"
                                            fill="#000000"/>
                                        <path
                                            d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z"
                                            fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                                    </span>
                        <span class="menu-text">Dillər</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <!--  Dillər  -->

                            <li class="menu-item {{Route::is([
                                                        'admin.language.index',
                                                        'admin.language.search'
                                                    ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.language.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Dillər</span>
                                </a>
                            </li>
                            <!--  Dil Qrupları  -->
                            <li class="menu-item {{Route::is([
                                                            'admin.languageGroup.index',
                                                            'admin.languageGroup.search',
                                                            'admin.languageGroup.groupDetailSearch',
                                                            'admin.languageGroup.detail'
                                                            ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.languageGroup.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Dil qrupları</span>
                                </a>
                            </li>
                            <!--  Ifadələr  -->
                            <li class="menu-item {{Route::is([
                                                    'admin.languagePhrase.index',
                                                    'admin.languagePhrase.search'
                                                ])? "menu-item-active":""}}" aria-haspopup="true">
                                <a href="{{ route('admin.languagePhrase.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">İfadələr</span>
                                </a>
                            </li>

                        </ul>
                    </div>

                </li>


            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
