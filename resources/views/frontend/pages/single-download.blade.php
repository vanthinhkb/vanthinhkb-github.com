@extends('frontend.master')
@section('main')
<div class="art-breadcrumbs art-breadcrumbs-2">

	<div class="container-fluid">

		<div class="row">

			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

				<div class="breadcrumbs-content">

					<div class="image-box breadcrumb-image">

						<img src="{{ $dataSeo->banner }}" alt="Breadcrumb">

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

                                <a href="{{ route('home.download') }}" title="{{ trans('message.download') }}">{{ trans('message.download') }}</a>

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

                        <h1 class="title"><span>{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span></h1>



                        <div class="blog-create-date d-flex ">

                            <span class="">{{ trans('message.ngay_dang') }}: </span>

                            <span class="">{{ app()->getLocale() == 'vi' ? $data->created_at->format('d/m/Y') : $data->created_at->format('M d, Y') }}</span>

                            <button class="btn btn-download ms-auto" style="margin-left: auto;">
                                <a href="{{ url($data->file_download) }}" target="_blank" style="color: #fff;">

                                    <i class="fad fa-arrow-alt-to-bottom"></i>

                                </a>

                            </button>

                        </div>



                        <div class="blog-short-des">

                            <p>{{ app()->getLocale() == 'vi' ? $data->desc : $data->desc_en }}</p>

                        </div>



                    </div>



                    <div class="blog-detail-content">

                        <div class="blog-description-content btn-them-thu">

                            <div class="content">

                            {!! app()->getLocale() == 'vi' ? $data->content : $data->content_en !!}

                            </div>



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

                        </div>

                    </div>

                </div>

                @include('frontend.components.fb-comments')

            </div>



            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">

                @include('frontend.components.download-view-much')

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

                        <h3 class="title"><span>{{ trans('message.bai_viet_khac') }}</span></h3>

                    </div>

                    <div class="blogs-content blogs-related-content">

                        <div class="slick-slider slick-blogs-related">

                        @foreach ($download_same as $item)
                            <div class="item">

                                <div class="blog-box">

                                    <div class="blog-image">

                                        <a href="{{ route('home.single-download', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">

                                            <img src="{{ $item->image }}" style="max-width: 370px; max-height: 270px; width: 100%; height: 100%;">

                                        </a>

                                    </div>

                                    <div class="blog-content">

                                        <h4 class="blog-name">

                                            <a href="{{ route('home.single-download', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" class="blog-link">
                                            {{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>

                                        </h4>

                                        <div class="blog-create-date d-flex">

                                            <span>{{ app()->getLocale() == 'vi' ? $item->created_at->format('d/m/Y') : $item->created_at->format('M d, Y') }}</span>

                                            <button class="btn btn-download ms-auto" style="margin-left: auto;">
                                                <a href="{{ url($item->file_download) }}" target="_blank" style="color: #fff;">

                                                    <i class="fad fa-arrow-alt-to-bottom"></i>

                                                </a>

                                            </button>
                                        </div>

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

@stop
@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.main-site').addClass('page-site blog-details-site');
		});
	</script>
@endsection
