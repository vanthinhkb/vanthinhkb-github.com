@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<h1 style="display:none">{{ $dataSeo->title_h1 }}</h1>
	<h2 style="display:none">{{ $dataSeo->title_h1 }}</h2>
	<div class="page-site about-us-site">
		<div class="art-breadcrumbs art-breadcrumbs-2">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="breadcrumbs-content">
							<div class="image-box breadcrumb-image">
								<img src="{{ $url.$dataSeo->banner }}" alt="Breadcrumb">
							</div>
							<!-- <div class="title-box title-breadcrumb">
								<h1 class="title">Về chúng tôi</h1>
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
										<span>{{ trans('message.gioi_thieu') }}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!--breadcrumbs-->
		
		<article class="art-banners art-about-us">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="title-box title-banner">
							<h3 class="title"><span>{{ @$content->title }}</span></h3>
						</div>
					</div>
					<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
						<div class="banner-image">
							<img src="{{ $url.@$content->image }}" alt="{{ @$content->title }}" style="max-width: 502px; max-height: 505px; width: 100%; height: 100%;">
						</div>
					</div>

					<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
						<div class="banner-box">
							<div class="banner-content">
								{!! @$content->content !!}

								<div class="banner-tab-box">
									<div class="banner-tab-content active">
										<h4>{{ @$content->content_1->title }}</h4>
										<div class="content">
											{!! @$content->content_1->content !!}
										</div>
									</div>
									<div class="banner-tab-content">
										<h4>{{ @$content->content_2->title }}</h4>
										<div class="content">
											{!! @$content->content_2->content !!}
										</div>
									</div>
									<div class="banner-tab-content">
										<h4>{{ @$content->content_3->title }}</h4>
										<div class="content">
											{!! @$content->content_3->content !!}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</article>

		@include('frontend.components.partner')
	</div>
@stop