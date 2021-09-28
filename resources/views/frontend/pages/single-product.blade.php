@extends('frontend.master')
@section('main')
    <div class="page-site product-details-site">
        <div class="art-breadcrumbs">
            <div class="container-fluid" style="display: none;">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="breadcrumbs-content">
                            <div class="image-box breadcrumb-image">
                                <img src="assets/images/bg-breadcrumb.jpg" alt="Breadcrumb">
                            </div>
                            <div class="title-box title-breadcrumb">
                                <h2 class="title">{{ trans('message.san_pham') }}</h2>
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
										<a href="{{ route('home.product') }}" title="{{ trans('message.san_pham') }}">{{ trans('message.san_pham') }}</a>
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
        <article class="art-products art-product-details">
			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
						@include('frontend.components.category-product')
					</div>

					<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
						<div class="products-box product-details-box">
							<div class="products-content product-details-content">
								<div class="product-detail-images">
                                    <?php if(!empty($data->more_image)){
                                        $more_image = json_decode($data->more_image);
                                    } ?>
									<div class="slick-slider slick-products-for">
										<div class="item">
											<img src="{{ $url.$data->image }}" alt="{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}" style="max-width: 430px; max-height: 259px; width: 100%; height: 100%;">
                                        </div>
                                        @if (!empty($more_image))
                                            @foreach ($more_image as $key => $item)
                                                <div class="item">
                                                    <img src="{{ $url.$item }}" style="max-width: 430px; max-height: 259px; width: 100%; height: 100%;">
                                                </div>
                                            @endforeach
                                        @endif
									</div>
									<div class="slick-slider slick-products-nav">
										<div class="item">
											<img src="{{ $url.$data->image }}" style="max-width: 135px; max-height: 90px; width: 100%; height: 100%;">
										</div>
										@if (!empty($more_image))
                                            @foreach ($more_image as $key => $item)
                                                <div class="item">
                                                    <img src="{{ $url.$item }}" style="max-width: 430px; max-height: 259px; width: 100%; height: 100%;">
                                                </div>
                                            @endforeach
                                        @endif
									</div>
								</div>

								<div class="product-detail-content">
									<div class="content">
										<h1 class="title">{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</h1>

										<div class="product-prices">
											<label>{{ trans('message.gia') }}: </label>
											<span class="price">{{ is_numeric($data->price) ? number_format($data->price, '0', ',', ',') : trans('message.' . $data->price) }}</span>
										</div>

										<div class="summary-information">
											<ul>
												<li>
													<label>{{ trans('message.ma_san_pham') }}:</label>
													<span>{{ $data->code }}</span>
												</li>
												<li>
													<label>{{ trans('message.xuat_xu') }}:</label>
													<span>{{ app()->getLocale() == 'vi' ? $data->origin : $data->origin_en }}</span>
												</li>
												<li>
													<label>{{ trans('message.tinh_trang') }}:</label>
													<span>{{ $data->status_product == 0 ? trans('message.het_hang') : trans('message.con_hang') }}</span>
												</li>
											</ul>
										</div>

										<div class="product-button">
											<a href="tel:{{ @$site_info->hotline }}" title="Hotline" class="btn">
												<!-- <i class="fas fa-phone-alt icon"></i> -->
												<img src="{{ url('/') }}/images/pr-d-hotline.png" alt="Icon">
												<span>{{ @$site_info->hotline }}</span>
											</a>
											@if (Auth::guard('customer')->check())
											<a href="#" title="{{ trans('message.dat_hang') }}" class="btn btn-oder btn-popup btn-popup-order">
												<span>{{ trans('message.dat_hang') }}</span>
											</a>
											@else
											<a href="#" title="{{ trans('message.dat_hang') }}" class="btn btn-oder btn-popup popups-title-dang-nhap">
												<span>{{ trans('message.dat_hang') }}</span>
											</a>
											@endif

											<a href="#" title="{{ trans('message.tai') }} Catalog" class="btn btn-download">
												<span>{{ trans('message.tai') }} Catalog</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="art-product-description">
							<div class="product-description-box">
								<div class="product-description-content btn-them-thu">
									<div class="">
										<h3 class="title"><span>{{ trans('message.mo_ta_chi_tiet') }}</span></h3>

										<div class="content">
											{!! app()->getLocale() == 'vi' ? $data->content : $data->content_en !!}
										</div>	
										@if (!empty($data->content) && app()->getLocale() == 'vi')
										<div class="content-button">
											<button class="btn-xem-them">
												{{ trans('message.xem_them') }}
												<i class="fal fa-angle-double-down icon"></i>
											</button>
											<button class="btn-thu-gon">
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
											<button class="btn-thu-gon">
												<i class="fal fa-angle-double-up icon"></i>
												{{ trans('message.thu_gon') }}
											</button>
										</div>
										@else
										@endif
									</div>	
																						
								</div>
							</div>
						</div>
						<div class="art-contacts art-contacts-details">
							<div class="contacts-box">
								<div class="title-box title-contacts">
									<h3 class="title"><span>{{ trans('message.lien_he_san_pham') }}</span></h3>
								</div>
								@if (Auth::guard('customer')->check())
								<?php
									@$account = DB::table('account')->select()->where('id',Auth::guard('customer')->user()->id)->where('status', 1)->first();
								?>
								@endif

								<div class="contacts-content">
									<h4>{{ trans('message.ten_san_pham') }} - <span>{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span></h4>

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
													<input type="hidden" name="link_product" value="{{ route('home.SingleProduct', $data->slug) }}">
												</div>
											</div>	
										</div>
									</form>
								</div>
							</div>
						</div>
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
                                @if (count($product_same_category))
								<div class="slick-slider slick-products-related">
                                    @foreach ($product_same_category as $item)
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</article> <!-- art-products -->
	</div>
	<div class="art-popups art-popups-oder">
		<div class="popups-box">
			<div class="popups-content">
				<div class="title-box title-popup">
					<h3 class="title"><span>{{ trans('message.dat_hang') }}</span></h3>
				</div>
				<div class="popup-content">
					<form class="contacts-form" id="frm_order">
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
								<textarea class="form-control" type="text" name="content" placeholder="{{ trans('message.noi_dung') }}" rows="6"></textarea>
								<span class="fr-error" id="error_content"></span>
							</div>	
	
							<div class="form-group">
								<div class="button">
									<button class="btn btn-order">{{ trans('message.gui_yeu_cau') }}</button>
									<input type="hidden" name="link_product" value="{{ route('home.SingleProduct', $data->slug) }}">
									<input type="hidden" name="id_account" value="{{ @$account->id }}">
									<input type="hidden" name="id_product" value="{{ $data->id }}">
								</div>
							</div>	
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')
	<script>
		$(document).ready(function($) {
			$('.page-product').addClass('active');

			$('.btn-order').click(function(e) {
				e.preventDefault();
				$('.loadingcover').show();
				var data = $("#frm_order").serialize();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				$.ajax({
					type: 'POST',
					url: "{{ route('home.post-order') }}",
					dataType: "json",
					data: data,
					success:function(data){
						$('.art-popups-oder').addClass('active');
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
							$('.art-popups-oder').removeClass('active');
							$('#frm_order')[0].reset();
							toastr["success"](data.success, data.notification);
						}
						$('.loadingcover').hide();
					}
				});
			});
			
		});
	</script>
@endsection