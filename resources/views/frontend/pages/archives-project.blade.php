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

					<!-- <div class="title-box title-breadcrumb">

						<h1 class="title">Tin tức</h1>

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

								<span>{{ trans('message.du_an') }}</span>

							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</div>

</div> <!--breadcrumbs-->

<article class="art-blogs">

    <div class="container">

        <div class="row">

            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">

                <div class="blogs-box">

                    <div class="blogs-content">
                        @foreach ($data as $key => $item)
                        @if ($key == 0)
                        <div class="item active">

                            <div class="blog-box">

                                <div class="blog-image">

                                    <a href="{{ route('home.single-project', ['slug' => $item->slug]) }}" title="project">

                                        <img src="{{ $item->image }}" style="width: 100%; height: 100%;">

                                    </a>

                                </div>

                                <div class="blog-content">

                                    <div class="content">

                                        <label>{{ trans('message.du_an_moi') }}</label>

                                        <h4 class="blog-name">

                                            <a href="{{ route('home.single-project', ['slug' => $item->slug]) }}" title="project" class="blog-link">
                                            {{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}
                                            </a>

                                        </h4>

                                        <a href="{{ route('home.single-project', ['slug' => $item->slug]) }}" class="read-more">

                                            <span>{{ trans('message.xem_ngay') }}</span>

                                            <i class="far fa-long-arrow-alt-right icon"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>
                        @else
                        <div class="item">

                            <div class="blog-box">

                                <div class="blog-image">

                                    <a href="{{ route('home.single-project', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">

                                        <img src="{{ $item->image }}" style="max-width: 355px; max-height: 185px; width: 100%; height: 100%;">

                                    </a>

                                </div>

                                <div class="blog-content">

                                    <h4 class="blog-name">

                                        <a href="{{ route('home.single-project', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" class="blog-link">
                                        {{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}
                                        </a>

                                    </h4>

                                    <div class="blog-create-date">

                                        <span>{{ trans('message.day') }} {{ app()->getLocale() == 'vi' ? $item->created_at->format('d/m/Y') : $item->created_at->format('M d, Y') }}</span>

                                    </div>

                                    <div class="blog-short-des">

                                        <p>
                                        {{ app()->getLocale() == 'vi' ? $item->desc : $item->desc_en }}
                                        </p>

                                    </div>

                                    <div class="project-link">

                                        <a href="{{ route('home.single-project', ['slug' => $item->slug]) }}">{{ trans('message.xem_them') }}</a>

                                    </div>
                                </div>

                            </div>

                        </div>
                        @endif
                        @endforeach
                    </div>

                    {{ $data->links('frontend.components.panigation') }}

                </div>

            </div>

            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">

                @include('frontend.components.project-view-much')

            </div>

        </div>

    </div>

</article> <!-- art-products -->

@stop
@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.main-site').addClass('page-site blogs-site');
		});
	</script>
@endsection
