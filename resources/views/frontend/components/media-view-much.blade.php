<aside class="att-sidebars">

    <div class="sidebars-box">

        <div class="sidebars-content">

            <article class="sidebar-box art-sidebar-blogs">

                <div class="sidebar-blogs-box">

                    <div class="title-box title-sidebar-blogs title-sidebar">

                        <h3 class="title"><span>{{ trans('message.xem_nhieu_nhat') }}</span></h3>

                    </div>



                    <div class="sidebar-blogs-content">

                    @foreach ($media_view_much as $item)
                        <div class="item">

                            <div class="blog-box">

                                <div class="blog-image">

                                    <a href="{{ route('home.single-media', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">

                                        <img src="{{ $item->image }}" alt="blog" style="max-width: 154px; max-height: 105px; width: 100%; height: 100%;">

                                    </a>

                                </div>

                                <div class="blog-content">

                                    <h4 class="blog-name">

                                        <a href="{{ route('home.single-media', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" class="blog-link">
                                        {{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>

                                    </h4>

                                </div>

                            </div>

                        </div>
                    @endforeach

                    </div>

                </div>

            </article>

        </div>

    </div>

</aside>
