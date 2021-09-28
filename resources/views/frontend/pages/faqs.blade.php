@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
    } ?>
    <div class="art-breadcrumbs art-breadcrumbs-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="breadcrumbs-content">
                        <div class="image-box breadcrumb-image">
                            <img src="{{ $url.$dataSeo->banner }}" alt="Breadcrumb">
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
                                    <span>FAQS</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <article class="art-blog-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="blog-details-box">
                        <div class="title-box title-blog-details">
                            <h3 class="title"><span>{{ trans('message.faqs') }}</span></h3>
                        </div>
                        <div id="accordion">
                            @foreach ($faqs as $key => $item)
                            
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                            {{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne_{{$key}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        {!! app()->getLocale() == 'vi' ? $item->content : $item->content_en !!}

                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                    <aside class="att-sidebars">
                        <div class="sidebars-box">
                            <div class="sidebars-content">
                                <article class="sidebar-box art-sidebar-blogs">
                                    <div class="sidebar-blogs-box">
                                        <div class="title-box title-sidebar-blogs title-sidebar">
                                            <h3 class="title"><span>{{ trans('message.tin_noi_bat') }}</span></h3>
                                        </div>

                                        <div class="sidebar-blogs-content">
                                            @foreach ($news_hot as $item)
                                            
                                            <div class="item">
                                                <div class="blog-box">
                                                    <div class="blog-image">
                                                        <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">
                                                            <img src="{{ $url.$item->image }}" alt="blog" style="max-width: 154px; max-height: 105px; width: 100%; height: 100%;">
                                                        </a>
                                                    </div>
                                                    <div class="blog-content">
                                                        <h4 class="blog-name">
                                                            <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" class="blog-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
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
                </div>
            </div>
        </div>
    </article> <!-- art-products -->

    <article class="art-products art-products-related">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="products-box products-related-box">
                        <div class="title-box title-products title-products-related">
                            <h3 class="title"><span>{{ trans('message.san_pham_khac') }}</span></h3>
                        </div>

                        <div class="products-content products-related-content">
                            <div class="slick-slider slick-products-related">
                                @foreach ($product as $item)
                               
                                <div class="item">
                                    <div class="product-box">
                                        <div class="product-image">
                                            <a href="{{ route('home.SingleProduct', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}">
                                                <img src="{{ $url.$item->image }}" alt="{{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}" style="max-width: 270px; max-height: 190px; width: 100%; height: 100%;">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <h4 class="product-name">
                                                <a href="{{ route('home.SingleProduct', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}" class="product-link">{{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article> <!-- art-products -->
@stop
@section('script')
	<script>
		$(document).ready(function($) {
			$('.main-site').addClass('page-site blog-details-site eaqs-site');
		});
	</script>
@endsection