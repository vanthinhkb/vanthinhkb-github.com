@extends('frontend.master')

@section('main')

    <?php if(!empty($dataSeo)){

        $content = json_decode($dataSeo->content);

    } ?>

    <h1 style="display:none">{{ $dataSeo->title_h1 }}</h1>

    <div class="page-site blogs-site">

        <div class="art-breadcrumbs art-breadcrumbs-2">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="breadcrumbs-content">

                            <div class="image-box breadcrumb-image">

                                <img src="{{ $url.$dataSeo->banner }}" alt="Breadcrumb">

                            </div>

                            <div class="title-box title-breadcrumb" style="display:none">

                                <h2 class="title">Tin tức</h2>

                            </div>

                        </div>				

                    </div>

                </div>

            </div>

        

            <div class="container">

                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="breadcrumbs-content">

                            <div class="content-box content-breadcrumb">

                                <ul class="breadcrumb-box">

                                    <li>

										<a href="{{ url('/') }}" title="{{ trans('message.trang_chu') }}">{{ trans('message.trang_chu') }}</a>

									</li>

									<li>

										<span>{{ trans('message.tin_tuc') }}</span>

									</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div> <!--breadcrumbs-->

        <article class="art-blogs">

            <div class="container">

                <div class="row">

                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">

                        <div class="blogs-box">

                            <div class="blogs-content">

                                @foreach ($data as $key => $item)

                                    @if ($key == 0)

                                        <div class="item active">

                                            <div class="blog-box">

                                                <div class="blog-image">

                                                    <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">

                                                        <img src="{{ $url.$item->image }}" style="width: 100%; height: 100%;" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">

                                                    </a>

                                                </div>

                                                <div class="blog-content">

                                                    <div class="content">

                                                        <label>{{ trans('message.tin_moi') }}</label>

                                                        <h4 class="blog-name">

                                                            <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" class="blog-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>

                                                        </h4>	

                                                        <a href="blog-details.php" class="read-more">

                                                            <span>{{ trans('message.xem_ngay') }}</span>

                                                            <i class="far fa-long-arrow-alt-right icon"></i>

                                                        </a>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    @elseif ($key > 0)

                                        <div class="item">

                                            <div class="blog-box">

                                                <div class="blog-image">

                                                    <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">

                                                        <img src="{{ $url.$item->image }}" style="max-width: 355px; max-height: 185px; width: 100%; height: 100%;">

                                                    </a>

                                                </div>

                                                <div class="blog-content">

                                                    <h4 class="blog-name">

                                                        <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" class="blog-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>

                                                    </h4>	

                                                    <div class="blog-create-date">

                                                        <span>Ngày {{ $item->created_at->format('d/m/Y') }}</span>

                                                    </div>											

                                                    <div class="blog-short-des">

                                                        <p>{{ app()->getLocale() == 'vi' ? $item->desc : $item->desc_en }}</p>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    @endif

                                @endforeach

                            </div>



                            {{ $data->links('frontend.components.panigation') }}

                        </div>

                    </div>



                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">

                        @include('frontend.components.post-view-much')

                    </div>

                </div>

            </div>

        </article> <!-- art-products -->

	</div>

@stop