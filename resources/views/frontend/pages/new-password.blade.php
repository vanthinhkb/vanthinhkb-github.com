@extends('frontend.master')
@section('main')
<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12" style="margin: auto; padding-top: 15px">
	<div class="contacts-box">
		<div class="content">
			<div class="contact-title text-center">
				<h3 class="title text-center">Xác nhận thay đổi mật khẩu</h3>
			</div>
			<div class="contacts-content">
			<form action="{{ route('home.new-password') }}" method="POST" style="margin-bottom: 50px">
				@csrf
				<input type="text" name="token" value="{{ $result->token }}" hidden="">
				<div class="form-group">
					<label for="">Mật khẩu mới:</label>
					<input type="password" value="{!! old('password') !!}" name="password" class="form-control" style="border: 1px solid #C4C4C4; padding: 0px 10px">
				</div>
				<div class="form-group">
					<label for="">Nhập lại mật khẩu mới:</label>
					<input type="password" value="{!! old('confirm') !!}" name="confirm" class="form-control" style="border: 1px solid #C4C4C4; padding: 0px 10px">
				</div>
				 
				<button style="padding: 7px 15px;margin-top: 10px" type="submit" class="btn btn-sm btn-danger btn-block">Xác nhận</button>
			</form>
		</div>
		</div>
	</div>
</div>
@endsection