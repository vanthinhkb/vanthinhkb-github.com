@extends('frontend.master')

@section('main')

	<div class="page-site contacts-site recruitment-form-site">

        <div class="art-breadcrumbs art-breadcrumbs-2">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="breadcrumbs-content">

                            <div class="image-box breadcrumb-image">

                                <img src="{{url('/')}}{{ $dataSeo->banner }}" alt="Breadcrumb">

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

										<span>{{ trans('message.ung_tuyen_vi_tri') }} {{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span>

									</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div> <!--breadcrumbs-->

        <article class="art-recruitment-form">

            <div class="container">

                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="recruitment-form-box contacts-box">

                            <div class="title-box title-recruitment-form">

                                <h1 class="title"><span>{{ trans('message.ung_tuyen_vi_tri') }} {{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span></h1>

                            </div>

                            <div class="recruitment-form-content">

                                <form class="contacts-form" id="frm_recruitment" method="POST" action="{{ route('home.post-recruitment') }}" enctype="multipart/form-data">

                                    <div class="form-content">

                                        <div class="form-group">

                                            <!-- <i class="fas fa-user icon"></i> -->

                                            <label>{{ trans('message.ho_ten') }}</label>

                                            <input class="form-control" type="text" name="name" placeholder="">

                                            <span class="fr-error" id="error_name"></span>

                                        </div>	

                                        <div class="form-group">

                                            <!-- <i class="fas fa-envelope icon"></i> -->

                                            <label>Email</label>

                                            <input class="form-control" type="text" name="email" placeholder="">

                                            <span class="fr-error" id="error_email"></span>

                                        </div>

                                        <div class="form-group">

                                            <!-- <i class="fas fa-phone-alt icon"></i> -->

                                            <label>{{ trans('message.so_dien_thoai') }}</label>

                                            <input class="form-control" type="text" name="phone" placeholder="">

                                            <span class="fr-error" id="error_phone"></span>

                                        </div>

                                        <div class="form-group">

                                            <!-- <i class="fas fa-phone-alt icon"></i> -->

                                            <label>{{ trans('message.ngay_thang_nam_sinh') }}</label>

                                            <input class="form-control" type="date" name="dateOfBirth" placeholder="">

                                            <span class="fr-error" id="error_date"></span>

                                        </div>

                                        <div class="form-group">

                                            <!-- <i class="fas fa-envelope icon"></i> -->

                                            <label>{{ trans('message.trinh_do') }}</label>

                                            <input class="form-control" type="text" name="level" placeholder="">

                                            <span class="fr-error" id="error_level"></span>

                                        </div>

                                        <div class="form-group">

                                            <!-- <i class="fas fa-envelope icon"></i> -->

                                            <label>{{ trans('message.kinh_nghiem') }}</label>

                                            <input class="form-control" type="text" name="experience" placeholder="">

                                            <span class="fr-error" id="error_experience"></span>

                                        </div>

                                        <div class="form-group upload-file">

                                            <label>{{ trans('message.tai_cv_cua_ban') }}</label>

                                            <div class="button-upload">

                                                <!-- <div class="text">

                                                    <span class="btn">{{ trans('message.chon_tep') }}</span>

                                                </div> -->

                                                

                                                <input type="file" id="file" name="myfile">

                                            </div>

                                        </div>

                                        <span class="fr-error" id="error_myfile"></span>

                                        <div class="form-group submit">

                                            <div class="button">

                                                <input type="hidden" name="id_recruitment" value="{{ $data->id }}">

                                                <button class="btn btn-submit-cv">{{ trans('message.gui_cv') }}</button>

                                            </div>

                                        </div>	

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </article>

    </div>

@stop

@section('script')

	<script>

		$(document).ready(function($) {

            $('.page-recruitment').addClass('active');

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                }

            });

            $('.btn-submit-cv').click(function(e){

				e.preventDefault();

                $('.loadingcover').show();

                var url = $('#frm_recruitment').attr('action');

				var data = new FormData($('#frm_recruitment')[0]);

				$.ajax({

					type: 'POST',

					url: url,

                    data: data,

                    dataType: "json",

                    contentType: false,

			        processData: false,

					success:function(data){

                        console.log(data);

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

						if(data.message_date){

							$('.fr-error').css('display', 'block');

							$('#error_date').html(data.message_date);

						} else {

							$('#error_date').html('');

                        }

                        if(data.message_level){

							$('.fr-error').css('display', 'block');

							$('#error_level').html(data.message_level);

						} else {

							$('#error_level').html('');

                        }

                        if(data.message_experience){

							$('.fr-error').css('display', 'block');

							$('#error_experience').html(data.message_experience);

						} else {

							$('#error_experience').html('');

                        }

                        if(data.message_myfile){

							$('.fr-error').css('display', 'block');

							$('#error_myfile').html(data.message_myfile);

						} else {

							$('#error_myfile').html('');

						}

						if (data.success) {

							$('#frm_recruitment')[0].reset();

							toastr["success"](data.success, "Thông báo");

						}

						$('.loadingcover').hide();

					}

				});

			});

		});

	</script>

@endsection

