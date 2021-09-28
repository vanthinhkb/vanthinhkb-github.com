<aside class="att-sidebars">
    <div class="sidebars-box">
        <div class="sidebars-content">
            <article class="sidebar-box art-categories">
                <div class="categories-box">
                    <div class="title-box title-categories title-sidebar">
                        <h3 class="title"><span>{{ trans('message.danh_muc_tuyen_dung') }}</span></h3>
                    </div>

                    <div class="categories-content">
                        <ul>
                            @foreach ($listCategory as $item)
                            <li>
                                <a href="{{ route('home.category-recruitment', ['slug' => $item->slug]) }}">
                                    {{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </article>

            <article class="sidebar-box art-fanpage">
                <div class="fanpage-box">
                    <div class="title-fanpage title-box title-sidebar">
                        <h3 class="title"><span>Fanpage</span></h3>
                    </div>
                    <div class="fanpage-content">
                        <div class="connection-mxh">
                            <div class="facebook-fanpage">
                                {!! @$site_info->fanpage !!}
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</aside>