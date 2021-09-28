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
                                    <span>{{ trans('message.chinh_sach_bao_mat') }}</span>
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
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="blog-details-box">
                        <div class="title-box title-blog-details">
                            <h3 class="title"><span>{{ trans('message.chinh_sach_bao_mat') }}</span></h3>
                        </div>
                        <div id="accordion" style="padding-bottom: 20px">
                            {!! @$content->content !!}
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