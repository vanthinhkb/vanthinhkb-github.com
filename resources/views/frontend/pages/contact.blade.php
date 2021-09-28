@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<div class="page-site contacts-site">
		<div class="art-breadcrumbs art-breadcrumbs-2">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="breadcrumbs-content">
							<div class="image-box breadcrumb-image">
								<img src="{{ $url.$dataSeo->banner }}" alt="Breadcrumb">
							</div>
							<div class="title-box title-breadcrumb" style="display:none">
								<h2 class="title">Liên hệ</h2>
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
										<span>{{ trans('message.lien_he') }}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!--breadcrumbs-->
		<article class="art-banners art-contacts">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="title-box title-banner title-contacts">
							<h1 class="title"><span>{{ trans('message.lien_he_voi_chung_toi') }}</span></h1>
						</div>
						<div class="address-box">
							{!! app()->getLocale() == 'vi' ? @$site_info->address : @$site_info->address_en !!}
							<ul class="final">
								<li>
									<span>Hotline: {{ @$site_info->hotline }}</span>
								</li>
								<li>
									<span>Email: {{ @$site_info->email }}</span>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="contacts-box">
							<div class="title-box title-contacts">
								<h3 class="title"><span>{{ trans('message.gui_phan_hoi') }}</span></h3>
							</div>

							<div class="contacts-content">
								<form id="frm_contact" class="contacts-form">
									<div class="form-content">
										<div class="form-group">
											<!-- <i class="fas fa-user icon"></i> -->
											<input class="form-control" type="text" name="name" placeholder="{{ trans('message.ho_ten') }}">
											<span class="fr-error" id="error_name"></span>
										</div>	
										<div class="form-group">
											<!-- <i class="fas fa-envelope icon"></i> -->
											<input class="form-control" type="text" name="email" placeholder="Email">
											<span class="fr-error" id="error_email"></span>
										</div>
										<div class="form-group">
											<!-- <i class="fas fa-phone-alt icon"></i> -->
											<input class="form-control" type="text" name="phone" placeholder="{{ trans('message.so_dien_thoai') }}">
											<span class="fr-error" id="error_phone"></span>
										</div>
										<div class="form-group">
											<!-- <i class="fas fa-phone-alt icon"></i> -->
											<textarea class="form-control" type="text" name="content" placeholder="{{ trans('message.noi_dung') }}" rows="8"></textarea>
											<span class="fr-error" id="error_content"></span>
										</div>

										<div class="form-group">
											<div class="button">
												<button class="btn btn-submit">{{ trans('message.gui') }}</button>
												<input type="hidden" name="type" value="contact">
											</div>
										</div>	
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
		</article>
	</div>
@stop
@section('script')
	<script>
		$(document).ready(function() {
			$('.btn-submit').click(function(e){
				e.preventDefault();
				$('.loadingcover').show();
				var data = $("#frm_contact").serialize();
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
							$('#frm_contact')[0].reset();
							toastr["success"](data.success, "Thông báo");
						}
						$('.loadingcover').hide();
					}
				});
			});
		});
	</script>
@endsection