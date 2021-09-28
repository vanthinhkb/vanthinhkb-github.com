@extends('frontend.master')
@section('main')
	<?php if(!empty($contentHome)){
		$content = json_decode($contentHome->content);
	} ?>
	<h1 style="display:none">{{ $contentHome->title_h1 }}</h1>
	<h2 style="display:none">{{ $contentHome->title_h1 }}</h2>
	<div class="home-site">
		<article class="art-slidershow">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="slidershow-box">
							<div class="slidershow-content">
								<div class="slick-slider slick-slidershow">
									@foreach ($slider as $item)
										<div class="item">
											<div class="slider-box">
												<div class="slider-image">
													<a href="{{ $item->link }}" target="_blank">
														<img src="{{ $url.$item->image }}" alt="{{ $item->name }}" style="max-width: 1920px; max-height: 700px; width: 100%; height: 100%;">
													</a>
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
		</article> <!-- art-slidershow -->
	
		<article class="art-banners art-about-us">
			<div class="container">
				<div class="row">
					<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
						<div class="banner-image">
							<img src="{{ $url.@$content->about->image }}" alt="{{ @$content->about->title }}" style="max-width: 739px; max-height: 546px; width: 100%; height: 100%;">
						</div>
					</div>
	
					<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 width-box">
						<div class="banner-box">
							<div class="title-box title-banner">
								<h3 class="title"><span>{{ @$content->about->title }}</span></h3>
							</div>
	
							<div class="banner-content">
								{!! @$content->desc !!}
							</div>
	
							<div class="button">
								<a href="{{ route('home.about') }}" class="btn" title="Xem thêm">{{ trans('message.xem_them') }}</a>
							</div>
						</div>
					</div>
				</div>
		</article>
		
		<article class="art-features">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="features-box">
							<div class="title-box title-features">
								<h3 class="title"><span>{{ trans('message.tai_sao_chon_chung_toi') }}</span></h3>
							</div>
	
							<div class="features-content">
								@foreach (@$content->whychoose->list as $item)
									<div class="item">
										<div class="feature-box">
											<div class="feature-image">
												<img src="{{ $url.$item->icon }}" alt="{{ $item->title }}">
											</div>
											<div class="feature-content">
												<h4>{{ $item->title }}</h4>
												<div class="content">
													<p>{{ $item->content }}</p>
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
		</article> <!-- art-features -->
	
		<article class="art-products">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="products-box">
							<div class="title-box title-products">
								<h3 class="title"><span>{{ trans('message.san_pham_noi_bat') }}</span></h3>
							</div>
	
							<div class="products-content">
								<div class="slick-slider slick-products">
									@foreach ($product_hot as $item)
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
															class="product-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
													</h4>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</article> <!-- art-products -->
	
		<article class="art-blogs">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="blogs-box">
							<div class="title-box title-blogs">
								<h3 class="title"><span>{{ trans('message.tin_tuc_noi_bat') }}</span></h3>
							</div>
	
							<div class="blogs-content">
								<div class="slick-slider slick-blogs">
									@foreach ($posts_hot as $item)
										<div class="item">
											<div class="blog-box">
												<div class="blog-image">
													<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">
														<img src="{{ $url.$item->image }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" style="max-width: 370px; max-height: 270px; width: 100%; height: 100%;">
													</a>
												</div>
												<div class="blog-content">
													<div class="blog-create-date">
														<i class="far fa-calendar-alt icon"></i>
														<span>{{ $item->created_at->format('d/m/Y') }}</span>
													</div>
													<h4 class="blog-name">
														<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" 
															class="blog-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
													</h4>												
													<div class="blog-short-des">
														<p>{{ app()->getLocale() == 'vi' ? $item->desc : $item->desc_en }}</p>
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
	
		<article class="art-contacts">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="contacts-box">
							<div class="title-box title-contacts">
								<h3 class="title"><span>{{ trans('message.dang_ky_lam_dai_ly') }}</span></h3>
							</div>
	
							<div class="contacts-content">
								<form class="contacts-form" id="frm_register">
									<div class="form-content">
										<div class="form-group">
											<input class="form-control" type="text" name="name" placeholder="{{ trans('message.ho_ten') }}">
											<span class="fr-error" id="error_name"></span>
										</div>	
										<div class="form-group-control">
											<div class="form-group">
												<input class="form-control" type="text" name="email" placeholder="Email">
												<span class="fr-error" id="error_email"></span>
											</div>
											<div class="form-group">
												<input class="form-control" type="text" name="phone" placeholder="{{ trans('message.so_dien_thoai') }}">
												<span class="fr-error" id="error_phone"></span>
											</div>
										</div>	
										<div class="form-group">
											<textarea class="form-control" type="text" name="content" placeholder="{{ trans('message.noi_dung') }}" rows="4"></textarea>
											<span class="fr-error" id="error_content"></span>
										</div>	
	
										<div class="form-group">
											<div class="button">
												<button class="btn btn-send">{{ trans('message.gui') }}</button>
												<input type="hidden" name="type" value="register">
											</div>
										</div>	
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</article> <!-- art-contacts -->
	
		@include('frontend.components.partner')
	</div>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
			$('.btn-send').click(function(e) {
				e.preventDefault();
				$('.loadingcover').show();
				var data = $("#frm_register").serialize();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				$.ajax({
					type: 'POST',
					url: "{{ route('home.post-contact') }}",
					dataType: "json",
					data: data,
					success:function(data){
						if(data.message_name){
							$('.fr-error').css('display', 'block');
							$('#error_name').html(data.message_name);
						} else {
							$('#error_name').html('');
						}
						if(data.message_email){
							$('.fr-error').css('display', 'block');
							$('#error_email').html(data.message_email);
						} else {
							$('#error_email').html('');
						}
						if(data.message_phone){
							$('.fr-error').css('display', 'block');
							$('#error_phone').html(data.message_phone);
						} else {
							$('#error_phone').html('');
						}
						if(data.message_content){
							$('.fr-error').css('display', 'block');
							$('#error_content').html(data.message_content);
						} else {
							$('#error_content').html('');
						}
						if (data.success) {
							$('#frm_register')[0].reset();
							toastr["success"](data.success, "Thông báo");
						}
						$('.loadingcover').hide();
					}
				});
			});
		});
	</script>
@endsection