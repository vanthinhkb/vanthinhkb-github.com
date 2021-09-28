<div class="art-popups art-popups-dang-ky">
	<div class="popups-box">
		<div class="popups-content">
			<div class="title-box title-popup">
				<h3 class="title"><span>{{ trans('message.dang_ky') }}</span></h3>
			</div>
			<div class="popup-content">
				<form class="contacts-form" id="frm_registration">
					<div class="form-content">
						<div class="form-group">
							<input class="form-control" type="text" name="name" placeholder="{{ trans('message.ho_ten') }}">
							<span class="fr-error" id="error_name_dk"></span>
						</div>	
						<div class="form-group">
							<input class="form-control" type="text" name="email" placeholder="Email">
							<span class="fr-error" id="error_email_dk"></span>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="phone" placeholder="{{ trans('message.so_dien_thoai') }}">
							<span class="fr-error" id="error_phone_dk"></span>
						</div>
						<div class="form-group">
							<input class="form-control" type="password" name="password" placeholder="{{ trans('message.mat_khau') }}">
							<span class="fr-error" id="error_password"></span>
						</div>
						<div class="form-group">
							<input class="form-control" type="password" name="re_password" placeholder="{{ trans('message.nhap_lai_mat_khau') }}">
							<span class="fr-error" id="error_re_password"></span>
						</div>

						<div class="form-group form-button">
							<div class="button">
								<button class="btn btn_registration">{{ trans('message.dang_ky') }}</button>
							</div>
							<div class="button">
								<button class="btn popups-title-dang-nhap">{{ trans('message.dang_nhap') }}</button>
							</div>
						</div>	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>