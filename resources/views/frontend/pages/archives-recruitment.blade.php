@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<h1 style="display:none">{{ $dataSeo->title_h1 }}</h1>
	<div class="page-site recruitments-site">
		<div class="art-breadcrumbs art-breadcrumbs-2">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="breadcrumbs-content">
							<div class="image-box breadcrumb-image">
								<img src="{{ $url.$dataSeo->banner }}" alt="Breadcrumb">
							</div>
							<div class="title-box title-breadcrumb">
								<h2 style="display:none">Tuyển dụng</h2>
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
										<span>{{ trans('message.tuyen_dung') }}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!--breadcrumbs-->
		<article class="art-recruitments">
			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
						@include('frontend.components.sidebar-recruitment')
					</div>

					<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
						<div class="recruitments-box">
							<div class="recruitments-content">
								@foreach ($data as $item)
									<div class="item">
										<div class="recruitment-box">
											<div class="recruitment-image">
												<a href="{{ route('home.single-recruitment', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">
													<img src="{{ $url.$item->image }}" alt="Recruitment" style="max-width: 264px; max-height: 200px; width: 100%; height: 100%;">
												</a>
											</div>
											<div class="recruitment-content">
												<div class="recruitment-office">
													<label>VP {{ trans('message.'. (app()->getLocale() == 'vi' ? $item->office_area : $item->office_area_en)) }}</label>
												</div>
												<h4 class="recruitment-name">
													<a href="{{ route('home.single-recruitment', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" class="recruitment-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
												</h4>
												<div class="recruitment-information">
													<ul>
														<li>{{ trans('message.muc_luong') }}: {{ $item->salary_from }}$ - {{ $item->salary_to }}$</li>
														<li>{{ trans('message.dia_diem') }} : {{ app()->getLocale() == 'vi' ? $item->address : $item->address_en }}</li>
														<li>{{ trans('message.ngay_cap_nhat') }} : {{ $item->updated_at->format('d/m/Y') }}</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>

							{{ $data->links('frontend.components.panigation') }}
						</div>
					</div>
				</div>
			</div>
		</article> <!-- art-recruitments -->
		</div>
	</div>
@stop
@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.page-recruitment').addClass('active');
		});
	</script>
@endsection

