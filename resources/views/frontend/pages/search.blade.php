@extends('frontend.master')
@section('main')
    <div class="page-site search-site">
        <div class="art-breadcrumbs">
            <div class="container-fluid" style="display: none;">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="breadcrumbs-content">
                            <div class="image-box breadcrumb-image">
                                <img src="" alt="Breadcrumb">
                            </div>
                            <div class="title-box title-breadcrumb">
                                <h1 class="title">{{ trans('message.trang_chu') }}</h1>
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
                                        <span>{{ trans('message.tim_kiem_tu_khoa') }}: {{ $keyword }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--breadcrumbs-->
        <article class="art-products">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="products-box shop-box">
                            @if (count($data))
							<div class="products-content shop-content">
                                @foreach ($data as $item)
                                    @if ($type == 'san_pham' || $type == '')
                                    <div class="item">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="{{ route('home.SingleProduct', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}">
                                                    <img src="{{ $url.$item->image }}" alt="{{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}" style="max-width: 270px; max-height: 190px; width: 100%; height: 100%;">
                                                </a>
                                            </div>
                                            <div class="product-content">
                                                <h4 class="product-name">
                                                    <a href="{{ route('home.SingleProduct', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}" 
                                                        class="product-link">{{ app()->getLocale() == 'vi' ? $item->name: $item->name_en }}</a>
                                                </h4>
                                                <div class="product-prices">
                                                    <label>{{ trans('message.gia') }}: </label>
                                                    <span class="price">{{ is_numeric($item->price) ? number_format($item->price, '0', ',', ',') : trans('message.' . $item->price) }}</span>
                                                </div>
                                                <div class="product-button">
                                                    <a href="{{ route('home.SingleProduct', ['slug' => $item->slug]) }}" title="{{ trans('message.xem_chi_tiet') }}" class="btn">
                                                        <span>{{ trans('message.xem_chi_tiet') }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
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
                            @else
                            <div class="col-sm-12">
                                <div class="alert alert-success center" role="alert">
                                    {{ trans('message.khong_co_san_pham_phu_hop') }}
                                </div>
                            </div>
                            @endif

							{{ $data->links('frontend.components.panigation', ['all' => $all]) }}
						</div>
					</div>
				</div>
			</div>
		</article> <!-- art-products -->
    </div>
@stop