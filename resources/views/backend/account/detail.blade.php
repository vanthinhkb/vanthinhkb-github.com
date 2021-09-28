@extends('backend.layouts.app')
@section('controller', 'Thông tin thành viên' )
@section('controller_route', route('account.index'))
@section('action', 'Thông tin thành viên')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
		<div class="box box-primary">
            <div class="box-body">
		       	@include('flash::message')
		       	
                   <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin thành viên</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Họ tên</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="{!! old('name', @$data->name) !!}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                               value="{!! old('email', @$data->email) !!}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                               value="{!! old('phone', @$data->phone) !!}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Giới tính</label>
                                        <input type="text" class="form-control" name="sex" id="sex"
                                               value="@if($data->sex == 1) Nam @elseif($data->sex == 2) Nữ @else Khác @endif" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Ngày sinh</label>
                                        <input type="text" class="form-control" name="sex" id="sex"
                                               value="{{$data->day}} - {{$data->month}} - {{$data->year}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <textarea name="address" class="form-control" rows="5" readonly>{{ $data->address }}</textarea>
                                    </div>
                                   
                                    {{-- <div class="form-group">
                                        <label class="text-danger">Trạng thái</label> <br>
                                        <input type="checkbox" name="status" value="1" id="active" checked>
                                        <label for="active" class="lbl">Đã xem</label>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<!-- </form> -->
			</div>
		</div>
	</div>
@stop