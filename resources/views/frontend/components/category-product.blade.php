<?php if(!empty($product)){
    $content = json_decode($product->content);
} ?>
<aside class="att-sidebars">
    <div class="sidebars-box">
        <div class="sidebars-content">
            <article class="sidebar-box art-categories">
                <div class="categories-box">
                    <div class="title-box title-categories title-sidebar">
                        <h3 class="title"><span>{{ trans('message.danh_muc_san_pham') }}</span></h3>
                    </div>

                    <div class="categories-content">
                        <ul>
                            <li>
                                <a href="{{ route('home.product') }}">
                                    {{ trans('message.tat_ca_san_pham') }}
                                    <span>({{ $totalProduct }})</span>
                                </a>
                            </li>
                            @foreach ($listCategory as $item)
                                <?php 
                                    $countProduct = \App\Models\ProductCategory::where('id_category', $item->id)->count();
                                ?>
                                <li>
                                    <a href="{{ route('home.category-product', ['slug' => $item->slug]) }}">
                                        {{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}
                                        <span>({{ $countProduct }})</span>
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

            <article class="sidebar-box art-banners">
                <div class="banners-box">
                    <div class="title-box title-banners title-sidebar">
                        <h3 class="title"><span>{{ trans('message.giai_thuong') }}</span></h3>
                    </div>

                    <div class="banners-content">
                        <ul>
                            @foreach (@$content->prize as $item)
                            <li>
                                <div class="banner-image">
                                    <img src="{{ $url.$item->image }}" title="{{ $item->name }}" alt="{{ $item->name }}" style="max-width: 248px; max-height: 246px; width: 100%; height: 100%;">
                                </div>
                            </li>
                           @endforeach
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    </div>
</aside>