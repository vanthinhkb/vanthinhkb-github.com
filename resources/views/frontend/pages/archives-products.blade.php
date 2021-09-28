@extends('frontend.master')
@section('main')
    <?php if(!empty($dataSeo)){
        $content = json_decode($dataSeo->content);
    } ?>
    <h2 style="display:none">{{ $dataSeo->title_h1 }}</h2>
    <div class="page-site products-site">
        <div class="art-breadcrumbs">
            <div class="container-fluid" style="display: none;">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="breadcrumbs-content">
                            <div class="image-box breadcrumb-image">
                                <img src="{{ $url.@$dataSeo->banner }}" alt="Breadcrumb">
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
                                    @if (!empty($category))
                                        <li>
                                            <a href="{{ route('home.product') }}" title="{{ trans('message.san_pham') }}">{{ trans('message.san_pham') }}</a> 
                                        </li>
                                        <li>
                                            <span>{{ app()->getLocale() == 'vi' ? $category->name : $category->name_en }}</span>
                                        </li>
                                    @else
                                        <li>
                                            <span>{{ trans('message.san_pham') }}</span>
                                        </li>
                                    @endif
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
					<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">

                        @include('frontend.components.category-product')
						
					</div>

					<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
						<div class="products-box shop-box">
							<div class="products-top">
								<div class="view-mode-box">
									<a class="view-grid active" href="#">
										<i class="fas fa-th icon grid-icon" aria-hidden="true"></i>
									</a>
									<a class="view-list" href="#">
										<i class="fas fa-list icon list-icon" aria-hidden="true"></i>
									</a>
								</div>
							</div>
                            @if (count($products))
							<div class="products-content shop-content">
                                @foreach ($products as $item)
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
                                @endforeach
                            </div>
                            @else
                            <div class="col-sm-12">
                                <div class="alert alert-success center" role="alert">
                                    {{ trans('message.khong_co_san_pham_phu_hop') }}
                                </div>
                            </div>
                            @endif

							{{ $products->links('frontend.components.panigation') }}
						</div>
					</div>
				</div>
			</div>
		</article> <!-- art-products -->

		@include('frontend.components.partner')
    </div>
@stop
@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.page-product').addClass('active');
		});
	</script>
@endsection