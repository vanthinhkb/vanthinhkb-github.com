<div class="art-popups art-popups-dang-nhap">
	<div class="popups-box">
		<div class="popups-content">
			<div class="title-box title-popup">
				<h3 class="title"><span>{{ trans('message.dang_nhap') }}</span></h3>
			</div>
			<div class="popup-content">
				<form class="contacts-form" id="frm_login">
					<div class="form-content">
						<div class="form-group">
							<input class="form-control" type="text" name="username" placeholder="{{ trans('message.email_phone') }}">
							<span class="fr-error" id="error_name_login"></span>
						</div>	
						<div class="form-group">
							<input class="form-control" type="password" name="password" placeholder="{{ trans('message.mat_khau') }}">
							<span class="fr-error" id="error_password_login"></span>
						</div>

						<div class="form-group">
							<div class="button">
								<button class="btn btn_login">{{ trans('message.dang_nhap') }}</button>
								<a href="javascript:0" title="Đăng ký" class="btn popups-title-dang-ky">Đăng ký</a>
								<p><a href="#" title="{{ trans('message.quen_mat_khau') }}" class="popups-title-quen-pass">{{ trans('message.quen_mat_khau') }}</a></p>
							</div>
						</div>	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>