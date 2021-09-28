$(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $('.btn_registration').click(function(e) {
        e.preventDefault();

        $('.loadingcover').show();

        var data = $("#frm_registration").serialize();

        $.ajax({
            type: 'POST',
            url: urlRegistration,
            dataType: "json",
            data: data,
            success: function(data) {
                if (data.message_name) {
                    $('.fr-error').css('display', 'block');
                    $('#error_name_dk').html(data.message_name);
                } else {
                    $('#error_name_dk').html('');
                }
                if (data.message_email) {
                    $('.fr-error').css('display', 'block');
                    $('#error_email_dk').html(data.message_email);
                } else {
                    $('#error_email_dk').html('');
                }
                if (data.message_phone) {
                    $('.fr-error').css('display', 'block');
                    $('#error_phone_dk').html(data.message_phone);
                } else {
                    $('#error_phone_dk').html('');
                }
                if (data.message_password) {
                    $('.fr-error').css('display', 'block');
                    $('#error_password').html(data.message_password);
                } else {
                    $('#error_password').html('');
                }
                if (data.message_re_password) {
                    $('.fr-error').css('display', 'block');
                    $('#error_re_password').html(data.message_re_password);
                } else {
                    $('#error_re_password').html('');
                }
                if (data.success) {
                    $('#frm_registration')[0].reset();
                    $('.art-popups-dang-ky').removeClass('active');
                    $('.art-popups-dang-nhap').addClass('active');
                    toastr["success"](data.success, data.notification);
                }
                if (data.warning) {
                    toastr["warning"](data.warning, data.notification);
                }

                $('.loadingcover').hide();

            }
        });

    });

    $('.btn_password').click(function(e) {
        e.preventDefault();

        var data = $("#frm_password").serialize();

        $.ajax({
            type: 'POST',
            url: urlPassword,
            dataType: "json",
            data: data,
            success: function(data) {
                if (data.message_old_password) {
                    $('.fr-error').css('display', 'block');
                    $('.error_old_password').html(data.message_old_password);
                } else {
                    $('.error_old_password').html('');
                }
                if (data.message_new_password) {
                    $('.fr-error').css('display', 'block');
                    $('.error_new_password').html(data.message_new_password);
                } else {
                    $('.error_new_password').html('');
                }
                if (data.message_re_password) {
                    $('.fr-error').css('display', 'block');
                    $('.error_re_password').html(data.message_re_password);
                } else {
                    $('.error_re_password').html('');
                }

                if (data.success) {
                    $('#frm_password')[0].reset();
                    toastr["success"](data.success, data.notification);
                }

            }
        });

    });

    $('.btn__search').click(function(e) {
        e.preventDefault();

        var data = $("#frm_manage_order").serialize();

        $.ajax({
            type: 'GET',
            url: urlManageOrder,
            dataType: "json",
            data: data,
        }).done(function(data) {
            $('.search-order').html(data);
        });

    });

    $('.btn_forget_pass').click(function(e) {
        e.preventDefault();

        $(this).addClass('btn-loadingcover');

        var data = $("#frm_forgetPass").serialize();

        $.ajax({
            type: 'POST',
            url: urlForgetPass,
            dataType: "json",
            data: data,
            success: function(data) {
                if (data.message_forgetpass) {
                    $('.fr-error').css('display', 'block');
                    $('.error_email_reset').html(data.message_forgetpass);
                }
                if (data.success_forgetpass) {
                    $('#frm_forgetPass')[0].reset();
                    $('.art-popups-quen-pass').removeClass('active');
                    toastr["success"](data.success_forgetpass, data.success);
                }
                if (data.error_forgetpass) {
                    toastr["error"](data.error_forgetpass, data.error);
                }

                $('.btn_off_forget').removeClass('btn-loadingcover');
            }
        });

    });

});