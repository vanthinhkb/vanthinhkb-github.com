<div class="art-popups art-popups-quen-pass">
	<div class="popups-box">
		<div class="popups-content">
			<div class="title-box title-popup">
				<h3 class="title"><span>{{ trans('message.quen_mat_khau') }}</span></h3>
			</div>
			<div class="popup-content">
				<form class="contacts-form" id="frm_forgetPass">
					<div class="form-content">
						<div class="form-group">
							<input class="form-control" type="text" name="email_reset" placeholder="Email">
							<span class="fr-error error_email_reset"></span>
						</div>	

						<div class="form-group">
							<div class="button">
								<p><a href="javascript:0" title="Quay lại" class="btn_forget_pass">{{ trans('message.gui_lai') }}</a> <img src="{{ url('/uploads/images/back.png') }}" alt="Back"></p>
								<button class="btn btn_forget_pass btn_off_forget">{{ trans('message.gui') }}</button>
							</div>
						</div>	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>