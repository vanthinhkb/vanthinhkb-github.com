<h3 class="manage__title">
    {{ trans('message.nhap_thong_tin_ca_nhan') }}
</h3>
<div class="row form-group">
    <div class="col-12 col-sm-3 col-md-3 col-lg-2">
        <label for="">{{ trans('message.ho_ten') }}</label>
    </div>
    <div class="col-12 col-sm-9 col-md-9 col-lg-10">
        <input type="text" name="name" value="{{ @$account->name }}" class="form-control input__text">
    </div>
</div>
<div class="row form-group">
    <div class="col-12 col-sm-3 col-md-3 col-lg-2">
        <label for="">
            {{ trans('message.gioi_tinh') }}
        </label>
    </div>
    <div class="col-12 col-sm-9 col-md-9 col-lg-10">
        <div class="sex__group">
            <label for="sex__1">
                <input type="radio" class="sex__input" name="sex" value="1" id="sex__1" {{ @$account->sex == 1 ? "checked" : ''}}>
                <span class="cheked__sex"></span>
                {{ trans('message.nam') }}
            </label>
            <label for="sex__2">
                <input type="radio" class="sex__input" name="sex" value="2" id="sex__2" {{ @$account->sex == 2 ? "checked" : ''}}>
                <span class="cheked__sex"></span>
                {{ trans('message.nu') }}
            </label>
            <label for="sex__3">
                <input type="radio" class="sex__input" name="sex" value="0" id="sex__3" {{ @$account->sex == 0 ? "checked" : ''}}>
                <span class="cheked__sex"></span>
                {{ trans('message.khac') }}
            </label>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-12 col-sm-3 col-lg-2">
        <label for="">
            {{ trans('message.ngay_sinh') }}
        </label>
    </div>
    <div class="col-12 col-sm-9 col-lg-10">
        <div class="birth__group">
            <select class="form-control input__text" name="day">
                <option value="0">
                    {{ trans('message.day') }}
                </option>
                <?php
                for ($i = 1; $i <= 31; $i++) {
                ?>
                    <option {{ @$account->day == $i ? 'selected' : '' }} value="<?= $i; ?>">
                        <?= $i; ?>
                    </option>
                <?php }
                ?>
            </select>
            <select class="form-control input__text" name="month">
                <option value="0">
                    {{ trans('message.month') }}
                </option>
                <?php
                for ($k = 1; $k <= 12; $k++) {
                ?>
                    <option {{ @$account->month == $k ? 'selected' : '' }} value="<?= $k; ?>">
                        <?= $k; ?>
                    </option>
                <?php }
                ?>
            </select>
            <select class="form-control input__text" name="year">
                <option value="0">
                    {{ trans('message.year') }}
                </option>
                <?php
                for ($h = getdate()['year']; $h >= 1966; $h--) {

                ?>
                    <option {{ @$account->year == $h ? 'selected' : '' }} value="<?= $h ?>">
                        <?= $h; ?>
                    </option>
                <?php }
                ?>
            </select>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-12 col-sm-3 col-lg-2">
        <label for="">
            {{ trans('message.dia_chi') }}
        </label>
    </div>
    <div class="col-12 col-sm-9 col-lg-10">
        <input type="text" class="form-control input__text" name="address" value="{{ @$account->address }}">
    </div>
</div>
<div class="row form-group">
    <div class="col-12 col-sm-3 col-lg-2">
        <label for="">
            {{ trans('message.so_dien_thoai') }}
        </label>
    </div>
    <div class="col-12 col-sm-9 col-lg-10">
        <input type="text" class="form-control input__text" name="phone" value="{{ @$account->phone }}">
    </div>
</div>
<input type="hidden" name="id_account" value="{{ @$account->id }}">