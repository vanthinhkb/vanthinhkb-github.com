<footer class="footers">
    <div class="footer-main">
        <div class="container container-2">
            <div class="row">
                <div class="col-xl-4 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="footer-menu footer-contact">
                        <div class="footer-box">
                            <div class="footer-title title-box">
                                <h3 class="title">{{ app()->getLocale() == 'vi' ? @$site_info->name_company : @$site_info->name_company_en }}</h3>
                            </div>
                            <div class="footer-content">
                                {!! app()->getLocale() == 'vi' ? @$site_info->address : @$site_info->address_en !!}
                                <ul>
                                    <li>
                                        <span>Hotline: {{ @$site_info->hotline }}</span>
                                    </li>
                                    <li>
                                        <span>Email: {{ @$site_info->email }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-3 col-sm-6 col-12">
                    <div class="footer-menu">
                        <div class="footer-box footer-categories">
                            <div class="footer-title title-box">
                                <h3 class="title">{{ trans('message.danh_muc') }}</h3>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    @foreach ($menuFooter as $item)
                                    <li class="item {{ url($item->url) == url()->current() ? 'active' : null }}">
                                        <a href="{{ url($item->url) }}" title="{{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}">
                                            {{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-8 col-md-4 col-sm-6 col-12">

                    <div class="footer-menu">

                        <div class="footer-box footer-categories">

                            <div class="footer-title title-box">

                                <h3 class="title">{{ trans('message.ho_tro') }}</h3>

                            </div>

                            <div class="footer-content">

                                <ul>
                                @if (!empty(@$site_info->support))
                                    @foreach ($site_info->support as $item)
                                    <li class="item active">

                                        <a href="{{ $item->link }}" title="{{ app()->getLocale() == 'vi' ? @$item->name : @$item->name_en }}">
                                            {{ app()->getLocale() == 'vi' ? @$item->name : @$item->name_en }}</a>

                                    </li>
                                    @endforeach
                                @endif

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-12">
                    <div class="footer-menu footer-question">

                        <div class="footer-box">

                            <div class="footer-title title-box">

                                <h3 class="title">Fanpage</h3>

                            </div>

                            <div class="footer-content">

                                <div class="connection-mxh">

                                    <div class="facebook-fanpage">

                                        {!! @$site_info->fanpage !!}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="footer-menu footer-socials">

                        <div class="footer-box">

                            <div class="footer-content">

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

                            </div>

                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="copy-right">
                        <p>{{ @$site_info->copyright }}</p>
                        <p><a href="http://online.gov.vn/Home/WebDetails/78322" target="_blank">
                            <img alt="" title="" src='http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png'/>
                        </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</footer> <!-- footers -->