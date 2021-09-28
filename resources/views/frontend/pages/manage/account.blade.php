@extends('frontend.master')
@section('main')
    <section class="section-manage__banner">
        <img src="{{ url('/uploads/images/manage__banner.jpg') }}" alt="banner">
    </section>
    <section class="page-manage">
        <div class="container tab-control">
            <div class="page-manage__header">
                <h2 class="meange__title control__show">
                    {{ trans('message.quan_ly_tai_khoan') }}
                </h2>
            </div>
            <?php
                $account = DB::table('account')->select()->where('id',Auth::guard('customer')->user()->id)->where('status', 1)->first();
            ?>
            <div class="page-manage__body">
                <div class="group">
                    @include('frontend.pages.manage.sidebar-manage')
                    <div class="item">
                        <div class="tab-content manage__content desktop">

                            <div class="tab-item active" id="tab1">
                                <form action="{{ route('home.post-manage-account') }}" method="POST" id="frm_manage_user">
                                    @csrf
                                    @include('frontend.pages.manage.manage-user')
                                    <div class="cus__text desktop">
                                        <button type="submit" class="btn btn__up btn_manage_user">
                                            {{ trans('message.cap_nhat') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-item" id="tab2">
                                <form action="" id="frm_password">
                                    @include('frontend.pages.manage.manage-password')
                                    <div class="cus__text desktop">
                                        <button class="btn btn__up btn_password">
                                            {{ trans('message.cap_nhat') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-item" id="tab3">
                                <form action="" id="frm_manage_order">
                                    @include('frontend.pages.manage.manage-order')
                                </form>
                            </div>
                        </div>
                        <div class="mobile">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                {{ trans('message.quan_ly_tai_khoan') }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body  manage__content">
                                            <form action="{{ route('home.post-manage-account') }}" method="POST" id="frm_manage_user">
                                            @csrf
                                                @include('frontend.pages.manage.manage-user')
                                                <div class="cus__text">
                                                    <button class="btn btn__up">
                                                        {{ trans('message.cap_nhat') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                {{ trans('message.thay_doi_mat_khau') }}
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body  manage__content">
                                            <form action="" id="frm_password">
                                                @include('frontend.pages.manage.manage-password')
                                                <div class="cus__text">
                                                    <button class="btn btn__up btn_password">
                                                        {{ trans('message.cap_nhat') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                {{ trans('message.quan_ly_don_hang') }}
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body  manage__content">
                                            @include('frontend.pages.manage.manage-order')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@stop
@section('script')
	<script>
        $('html, body').animate({scrollTop:500}, 400);
		$(document).ready(function($) {
			$('.main-site').addClass('page-site main-manage');
		});
        var urlPassword = "{{ route('home.post-change-password') }}";
        var urlManageOrder = "{{ route('home.search-order') }}";
	</script>
@endsection