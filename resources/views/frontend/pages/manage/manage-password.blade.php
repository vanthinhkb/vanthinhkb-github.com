<h3 class="manage__title">
    {{ trans('message.cap_nhat_mat_khau') }}
</h3>
<div class="row form-group">
    <div class="col-12 col-sm-4 col-md-3 col-lg-3">
        <label for="">
            {{ trans('message.mat_khau') }}
        </label>
    </div>
    <div class="col-12 col-sm-8 col-md-9 col-lg-9">
        <input type="password" class="form-control input__text" name="old_password">
        <span class="fr-error error_old_password" id="error_old_password"></span>
    </div>
</div>
<div class="row form-group">
    <div class="col-12 col-sm-4 col-md-3 col-lg-3">
        <label for="">
            {{ trans('message.mat_khau_moi') }}
        </label>
    </div>
    <div class="col-12 col-sm-8 col-md-9 col-lg-9">
        <input type="password" class="form-control input__text" name="new_password">
        <span class="fr-error error_new_password" id="error_new_password"></span>
    </div>
</div>
<div class="row form-group">
    <div class="col-12 col-sm-4 col-md-3 col-lg-3">
        <label for="">
            {{ trans('message.nhap_lai_mat_khau') }}
        </label>
    </div>
    <div class="col-12 col-sm-8 col-md-9 col-lg-9">
        <input type="password" class="form-control input__text" name="re_password">
        <span class="fr-error error_re_password" id="error_re_password"></span>
    </div>
</div>
<input type="hidden" name="id_account" value="{{ @$account->id }}">