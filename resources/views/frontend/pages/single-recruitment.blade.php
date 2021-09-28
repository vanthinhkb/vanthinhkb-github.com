@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<div class="page-site recruitments-site">
		<div class="art-breadcrumbs art-breadcrumbs-2">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="breadcrumbs-content">
							<div class="image-box breadcrumb-image">
								<img src="{{ $url.$dataSeo->banner }}" alt="Breadcrumb">
							</div>
							<!-- <div class="title-box title-breadcrumb">
								<h1 class="title">Sản phẩm</h1>
							</div> -->
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
										<a href="{{ route('home.recruitment') }}" title="{{ trans('message.tuyen_dung') }}">{{ trans('message.tuyen_dung') }}</a>
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
		<article class="art-recruitments art-recruitment-details">
			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
						@include('frontend.components.sidebar-recruitment')
					</div>

					<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
						<div class="recruitment-details-box">
							<div class="recruitment-details-content">
								<div class="recruitment-detail-box">
									<div class="title-box title-recruitment-detail">
										<div class="recruitment-office">
											<label>VP {{ trans('message.'. (app()->getLocale() == 'vi' ? $data->office_area : $data->office_area_en)) }}</label>
										</div>
										<h1 class="title">{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</h1>
										<div class="recruitment-information">
											<ul>
												<li>{{ trans('message.muc_luong') }} : {{ $data->salary_from }}$ - {{ $data->salary_to }}$</li>
												<li>{{ trans('message.dia_diem') }} : {{ app()->getLocale() == 'vi' ? $data->address : $data->address_en }}</li>
												<li>{{ trans('message.ngay_cap_nhat') }} : {{ $data->updated_at->format('d/m/Y') }}</li>
											</ul>
										</div>
									</div>

									<div class="recruitment-detail-content">
										{!! app()->getLocale() == 'vi' ? $data->content : $data->content_en !!}

										<h4>{{ trans('message.lien_he') }}:</h4>
										<p>{{ @$site_info->personnel }} - {{ @$site_info->phone }}</p>
										<p>{{ trans('message.gui_cv_ve_email') }}: {{ @$site_info->email }}</p>

										<div class="button">
											<a href="{{ route('home.form-recruitment', ['slug' => $data->slug]) }}" class="btn btn-recruitment">{{ trans('message.ung_tuyen') }}</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</article> <!-- art-recruitments -->
	</div>
@stop
@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.page-recruitment').addClass('active');
		});
	</script>
@endsection