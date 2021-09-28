<header class="headers">

    <div class="header-top">

        <div class="container">

            <div class="row">

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

                    <div class="top-left">

                        <div class="contact-box">

                            <ul>

                                <li>

                                    <i class="fas fa-phone-alt icon"></i>

                                    <span>{{ @$site_info->hotline }}</span>

                                </li>

                                <li>

                                    <i class="fas fa-envelope icon"></i>

                                    <span>{{ @$site_info->email }}</span>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>



                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

                    <div class="top-right">

                        <div class="groups-box">

                            <div class="socials-box">

                                <ul class="socials-list">

                                    @if (!empty(@$site_info->social))

                                        @foreach ($site_info->social as $item)

                                            <li class="item">

                                                <a href="{{ $item->link }}" class="icon" title="{{ $item->name }}" rel="nofollow">

                                                    <i class="{{ $item->icon }}"></i>

                                                </a>

                                            </li>

                                        @endforeach

                                    @endif

                                </ul>

                            </div>



                            <div class="languages-box">

                                <ul>

                                    <li>

                                        <a href="{{ route('home.change-language', ['lang'=> 'vi']) }}" title="VI">VI</a>

                                    </li>

                                    <li>

                                        <a href="{{ route('home.change-language', ['lang'=> 'en']) }}" title="EN">EN</a>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="header-main">

        <div class="header-stick">

            <div class="container">

                <div class="row">

                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-4">

                        <div class="logos-box">

                            <div class="logos-content">

                                <a href="{{ url('/') }}" title="Công ty TNHH HiChem">

                                    <img src="{{url('/')}}{{ @$site_info->logo }}" alt="Công ty TNHH HiChem">

                                </a>

                            </div>

                        </div>

                    </div>



                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9 col-8">

                        <div class="groups-box">

                            <div class="megamenu megamenu-desktop d-none d-lg-block">

                                <nav class="nav">

                                    <ul class="megamenu-content">

                                        @foreach ($menuHeader as $item)

                                            @if ($item->parent_id == null)

                                                <li class="item {{ $item->class }} {{ url($item->url) == url()->current() ? 'active' : null }}">

                                                    <a href="{{ url($item->url) }}" @if ($item->class == 'link') target="_blank" @endif title="{{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}">

                                                        {{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}</a>

                                                </li>

                                            @endif

                                        @endforeach					                         

                                    </ul>

                                </nav>

                            </div> <!--megamenu-->
                            
                            <div class="groups-box">
                                <div class="search-box">
                                    <div class="search-box-title">
                                        <button class="btn">
                                            <i class="far fa-search icon"></i>
                                        </button>
                                    </div>

                                    <div class="search-box-content">
                                        <form action="{{ route('home.search-all') }}" method="GET">
                                            <div class="form-content groups-box">
                                                <div class="form-group">
                                                    <select class="form-control" name="t">
                                                        <option value="">{{ trans('message.chon') }}</option>
                                                        <option value="san_pham">{{ trans('message.san_pham') }}</option>
                                                        <option value="tin_tuc">{{ trans('message.tin_tuc') }}</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" name="q" placeholder="{{ trans('message.tim_kiem') }}" class="form-control">
                                                </div>

                                                <div class="form-group form-button">
                                                    <button class="btn">
                                                        <i class="far fa-search icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @if (Auth::guard('customer')->check())
                                    <div class="user-box user-login">
                                        <div class="user-box-title">
                                            <a href="javascript:0" class="btn">
                                                <i class="fas fa-user icon"></i>
                                            </a>
                                        </div>
                                        <div class="user-box-content">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('home.manage-account') }}" title="{{ trans('message.quan_ly_tai_khoan') }}">{{ trans('message.quan_ly_tai_khoan') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('home.logout') }}" title="{{ trans('message.dang_xuat') }}" class="logout">{{ trans('message.dang_xuat') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="user-box">
                                        <div class="user-box-title">
                                            <a href="javascript:0" class="btn">
                                                <span>{{ trans('message.tai_khoan') }}</span>
                                            </a>
                                        </div>
                                        <div class="user-box-content">
                                            <ul>
                                                <li>
                                                    <a href="javascript:0" title="{{ trans('message.dang_nhap') }}" class="popups-title-dang-nhap">{{ trans('message.dang_nhap') }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:0" title="{{ trans('message.dang_ky') }}" class="popups-title-dang-ky">{{ trans('message.dang_ky') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                
                            </div>


                            <div class="megamenu megamenu-mobile d-lg-none">

                                <div class="mobile-content">

                                    <button class="menu-open">

                                        <span></span>        

                                    </button>



                                    <div class="modal menu-content">

                                        <!-- Modal content -->

                                        <div class="modal-content animated zoomIn">

                                            <div class="menu-close">

                                                <span class="close">×</span>

                                            </div>



                                            <div class="modal-body">

                                                <nav class="nav">

                                                    <ul class="megamenu-content">

                                                        @foreach ($menuHeader as $item)

                                                            @if ($item->parent_id == null)

                                                                <li class="item {{ $item->class }} {{ url($item->url) == url()->current() ? 'active' : null }}">

                                                                    <a href="{{ url($item->url) }}" title="{{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}">

                                                                        {{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}</a>

                                                                </li>

                                                            @endif

                                                        @endforeach			                         

                                                    </ul>

                                                </nav>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div> <!-- megamenu-mobile -->

                        </div>								

                    </div>

                </div>

            </div>

        </div>				

    </div>		

</header> <!-- headers -->