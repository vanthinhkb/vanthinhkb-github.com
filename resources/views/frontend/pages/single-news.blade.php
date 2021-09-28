@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<div class="page-site blog-details-site">
		<div class="art-breadcrumbs art-breadcrumbs-2">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="breadcrumbs-content">
							<div class="image-box breadcrumb-image">
								<img src="{{ $url.$dataSeo->banner }}" alt="Breadcrumb">
							</div>
							<div class="title-box title-breadcrumb" style="display:none">
								<h2 class="title">{{ trans('message.tin_tuc') }}</h2>
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
										<a href="{{ route('home.news') }}" title="{{ trans('message.tin_tuc') }}">{{ trans('message.tin_tuc') }}</a>
									</li>
									<li>
										<span>{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!--breadcrumbs-->
		<article class="art-blog-details">
			<div class="container">
				<div class="row">
					<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
						<div class="blog-details-box">
							<div class="title-box title-blog-details">
								<label>{{ trans('message.tin_moi') }}</label>

								<h1 class="title"><span>{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span></h1>

								<div class="blog-create-date">
									<span>{{ trans('message.tin_tuc') }}</span>
									<span>{{ $data->created_at->format('d/m/Y') }}</span>
								</div>
								@if (!empty($data->desc) && app()->getLocale() == 'vi')
								<div class="blog-short-des">
									<p>{{ $data->desc }}</p>
								</div>
								@elseif (!empty($data->desc_en) && app()->getLocale() == 'en')
								<div class="blog-short-des">
									<p>{{ $data->desc_en }}</p>
								</div>
								@endif
							</div>

							<div class="blog-detail-content">
								<div class="blog-description-content btn-them-thu">
									<div class="content">
										{!! app()->getLocale() == 'vi' ? $data->content : $data->content_en !!}
									</div>
									@if (!empty($data->content) && app()->getLocale() == 'vi')
									<div class="content-button">
										<button class="btn-xem-them">
											{{ trans('message.xem_them') }}
											<i class="fal fa-angle-double-down icon"></i>
										</button>
										<button class="btn-thu-gon thu-gon-blog">
											<i class="fal fa-angle-double-up icon"></i>
											{{ trans('message.thu_gon') }}
										</button>
									</div>
									@elseif (!empty($data->content_en) && app()->getLocale() == 'en')
									<div class="content-button">
										<button class="btn-xem-them">
											{{ trans('message.xem_them') }}
											<i class="fal fa-angle-double-down icon"></i>
										</button>
										<button class="btn-thu-gon thu-gon-blog">
											<i class="fal fa-angle-double-up icon"></i>
											{{ trans('message.thu_gon') }}
										</button>
									</div>
									@else
									@endif
								</div>
								
							</div>
							
						</div>

						<div class="art-contacts art-contacts-details">
							<div class="contacts-box">
								<div class="title-box title-contacts">
									<h3 class="title"><span>{{ trans('message.lien_he') }}</span></h3>
								</div>
								@if (Auth::guard('customer')->check())
								<?php
									@$account = DB::table('account')->select()->where('id',Auth::guard('customer')->user()->id)->where('status', 1)->first();
								?>
								@endif
								<div class="contacts-content">
									<form class="contacts-form" id="frm_contact_all">
										<div class="form-content">
											<div class="form-group">
												<input class="form-control" type="text" name="name" value="{{ @$account->name }}" placeholder="{{ trans('message.ho_ten') }}">
												<span class="fr-error" id="error_name"></span>
											</div>	
											<div class="form-group">
												<input class="form-control" type="text" name="phone" value="{{ @$account->phone }}" placeholder="{{ trans('message.so_dien_thoai') }}">
												<span class="fr-error" id="error_phone"></span>
											</div>	
											<div class="form-group">
												<input class="form-control" type="text" name="email" value="{{ @$account->email }}" placeholder="Email">
												<span class="fr-error" id="error_email"></span>
											</div>
											<div class="form-group">
												<textarea class="form-control" type="text" name="content" placeholder="{{ trans('message.thong_tin_them') }}" rows="6"></textarea>
												<span class="fr-error" id="error_content"></span>
											</div>	

											<div class="form-group">
												<div class="button">
													<button class="btn btn-off btn_all">{{ trans('message.gui_yeu_cau') }}</button>
													<input type="hidden" name="link_news" value="{{ route('home.single-news', $data->slug) }}">
												</div>
											</div>	
										</div>
									</form>
								</div>
							</div>
						</div>
						<?php 
							$id_product = json_decode($data->id_product);
							if (!empty($id_product)) {
								$product = App\Models\Products::whereIn('id', $id_product)->where('status', 1)->get();
							} else {
								$product = [];
							}
						?>
						@if (!empty($product))
						<article class="art-products art-products-related art-products-blogs-related">
							<div class="container">
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="products-box products-related-box">
											<div class="title-box title-products title-products-related">
												<h3 class="title"><span>{{ trans('message.san_pham_khac') }}</span></h3>
											</div>

											<div class="products-content products-related-content">
												<div class="slick-slider slick-products-blogs-related">
													@foreach ($product as $item)
													
													<div class="item">
														<div class="product-box">
															<div class="product-image">
																<a href="{{ route('home.SingleProduct', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}">
																	<img src="{{ $url.$item->image }}" alt="{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}" >
																</a>
															</div>
															<div class="product-content">
																<h4 class="product-name">
																	<a href="{{ route('home.SingleProduct', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}" class="product-link">{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</a>
																</h4>
																<div class="product-prices">
																	<label>{{ trans('message.gia') }}: </label>
																	<span class="price">{{ is_numeric($item->price) ? number_format($item->price, '0', ',', ',') : trans('message.' . $item->price) }}</span>
																</div>
																<div class="product-button">
																	<a href="{{ route('home.SingleProduct', ['slug' => $item->slug]) }}" title="{{ trans('message.xem_chi_tiet') }}" class="btn" tabindex="0">
																		<span>{{ trans('message.xem_chi_tiet') }}</span>
																	</a>
																</div>
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
						</article>
						@endif

						<div class="art-comments">
							<div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5" data-width="780"></div>

							<div id="fb-root"></div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
						@include('frontend.components.post-view-much')
					</div>
				</div>
			</div>
		</article> <!-- art-products -->

		<article class="art-blogs-related">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="blogs-box blogs-related-box">
							<div class="title-box title-products title-blogs-related">
								<h3 class="title"><span>{{ trans('message.tin_tuc_noi_bat') }}</span></h3>
							</div>
							<div class="blogs-content blogs-related-content">
								<div class="slick-slider slick-blogs-related">
									@foreach ($post_same as $item)
										<div class="item">
											<div class="blog-box">
												<div class="blog-image">
													<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}">
														<img src="{{ $url.$item->image }}" alt="{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}" style="max-width: 370px; max-height: 270px; width: 100%; height: 100%;">
													</a>
												</div>
												<div class="blog-content">
													<h4 class="blog-name">
														<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}" class="blog-link">{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</a>
													</h4>			
													<div class="blog-create-date">
													<span>{{ $item->created_at->format('M d, Y') }}</span>
													</div>									
													<div class="blog-short-des">
														<p>{{ app()->getLocale() == 'vi' ? $data->desc : $data->desc_en }}</p>
													</div>
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
		</article> <!-- art-blogs -->
	</div>
@stop
@section('script')
	<script>
		$(document).ready(function($) {
			$('.page-blog').addClass('active');
		});
		
	</script>
@endsection