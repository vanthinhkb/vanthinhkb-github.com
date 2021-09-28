<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{url('/')}}{{ @$site_info->favicon }}">
    @if (isset($site_info->index_google))
    <meta name="robots" content="{{ $site_info->index_google == 1 ? 'index, follow' : 'noindex, nofollow' }}">
    @else
    <meta name="robots" content="noindex, nofollow">
    @endif
    {!! SEO::generate() !!}
	<meta name="facebook-domain-verification" content="0z69o4w4vnfq1dw7vfbxql7qm6x1si" />
    <meta name='revisit-after' content='1 days' />
    <meta name="copyright" content="GCO" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="geo.region" content="VN" />
    <meta name="geo.position" content="10.764338, 106.69208" />
    <meta name="geo.placename" content="Hà Nội" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="canonical" href="{{ \Request::fullUrl() }}">
    
    <!--link css-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/UTMNeoSansIntel.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/mobilemenu.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/slick.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/all.fontawesome.min.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/styles.min.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/customs.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/reponsive.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/toastr.min.css">

    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/datepicker.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/bs__tab.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/page__custome.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/customs_2.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/reponsives_2.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/style-custom.css">

    
    @if (!empty($site_info->ticktok))
    <!-- Ticktok -->
    <script>
        (function() {

				var ta = document.createElement('script'); ta.type = 'text/javascript'; ta.async = true;

				ta.src = 'https://analytics.tiktok.com/i18n/pixel/sdk.js?sdkid={{ $site_info->ticktok }}';

				var s = document.getElementsByTagName('script')[0];

				s.parentNode.insertBefore(ta, s);

			})();

		</script>
    @endif
    @if (!empty($site_info->google_analytics))
    <!-- Google Analysis -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', '{{ $site_info->google_analytics }}', 'auto');

			ga('send', 'pageview');

		</script>
    @endif
    @if (!empty($site_info->google_tag_manager))
    <!-- Google Tag Manager -->
			
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','{{ $site_info->google_tag_manager }}');</script>
   
    <!-- End Google Tag Manager -->
    @endif
   <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-187251912-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-187251912-1');
</script>

</head>

<body>
	 @if (!empty($site_info->google_tag_manager))
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $site_info->google_tag_manager }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	 @endif

   <div class="loadingcover" style="display: none;">
        <p class="csslder">
            <span class="csswrap">
                <span class="cssdot"></span>
                <span class="cssdot"></span>
                <span class="cssdot"></span>
            </span>
        </p>
    </div>
    @include('frontend.teamplate.header')
    <main class="main-site">
        <div class="main-container">
            @yield('main')
        </div>
    </main>
    @include('frontend.teamplate.footer')
    
    <div class="art-popups art-popups-agency">
        <div class="popups-box">
            <div class="popups-content">
                <div class="title-box title-popup">
                    <h3 class="title"><span>{{ trans('message.dang_ky_lam_dai_ly') }}</span></h3>
                </div>
                @if (Auth::guard('customer')->check())
                <?php
                    @$account = DB::table('account')->select()->where('id',Auth::guard('customer')->user()->id)->where('status', 1)->first();
                ?>
                @endif
                <div class="popup-content">
                    <form class="contacts-form" id="frm_register_agency">
                        <div class="form-content">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" value="{{ @$account->name }}" placeholder="{{ trans('message.ho_ten') }}">
                                <span class="fr-error" id="error_name_register"></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" value="{{ @$account->email }}" placeholder="Email">
                                <span class="fr-error" id="error_email_register"></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="phone" value="{{ @$account->phone }}" placeholder="{{ trans('message.so_dien_thoai') }}">
                                <span class="fr-error" id="error_phone_register"></span>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" type="text" name="content" placeholder="{{ trans('message.noi_dung') }}" rows="6"></textarea>
                                <span class="fr-error" id="error_content_register"></span>
                            </div>
                            <div class="form-group">
                                <div class="button">
                                    <button class="btn btn-send-require">{{ trans('message.gui_yeu_cau') }}</button>
                                    <input type="hidden" name="type" value="register">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="back-to-top">
        <i class="far fa-chevron-up icon" aria-hidden="true"></i>
    </div>
    <div class="society__group">

        <div class="chats-both-box">
            <ul>
                <li>
                    <a class="phone__link" href="tel:{{ $site_info->hotline }}" target="_blank" title="phone" rel="nofollow">
                        <i class="fas fa-phone-alt"></i>
                    </a>
                </li>
                <li>
                    <a class="chats__link" href="{{ $site_info->link_zalo }}" target="_blank" title="Zalo" rel="nofollow">
                        <img src="{{ url('/uploads/images/icon__zalo_f.png') }}" alt="Zalo">
                    </a>
                </li>
            </ul>
        </div>
          @if (!empty($site_info->facebook_pixel))
        <!-- Facebook Pixel -->
        <script>
        ! function(f, b, e, v, n, t, s)

        {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?

                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };

            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';

            n.queue = [];
            t = b.createElement(e);
            t.async = !0;

            t.src = v;
            s = b.getElementsByTagName(e)[0];

            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',

            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '{{ $site_info->facebook_pixel }}');

        fbq('track', 'PageView');
        </script>
        @endif
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $site_info->facebook_pixel }}&ev=PageView&noscript=1" /></noscript>
        @if (!empty($site_info->facebook_chat))
        <div id="fb-root"></div>
        <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v9.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
        @endif
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5b7a9787f31d0f771d83f68c/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    </div>
    <!--Link js-->
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/slick.min.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/mobilemenu.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/bs__tab.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/main.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/toastr.min.js"></script>

    <div class="popups-title popups-title-regis">
		<a href="#" class="btn">
			<img src="{{ url('/uploads/images/title-dang-ky.png') }}" alt="Đăng ký">
		</a>
    </div>

    @include('frontend.components.popups-login')
    @include('frontend.components.popups-registration')
    @include('frontend.components.popups-forgetpassword')
    @include('frontend.components.notification')
    
    @yield('script')
    <script type="text/javascript">
        var urlLogin = "{{ route('home.login') }}";
        var urlRegistration = "{{ route('home.post-registration') }}";
        var urlContactAll = "{{ route('home.post-contact-all') }}";
        var urlForgetPass = "{{ route('home.send-forgot-password') }}";
        // var urlNotification = "{{ route('home.notifications') }}";
        $(document).ready(function() {

            toastr.options = {

                "closeButton": false,

                "debug": false,

                "newestOnTop": false,

                "progressBar": false,

                "positionClass": "toast-top-right",

                "preventDuplicates": false,

                "onclick": null,

                "showDuration": "300",

                "hideDuration": "1000",

                "timeOut": "5000",

                "extendedTimeOut": "1000",

                "showEasing": "swing",

                "hideEasing": "linear",

                "showMethod": "fadeIn",

                "hideMethod": "fadeOut"

            }

            $('.btn-send-require').click(function(e) {

                e.preventDefault();

                $('.loadingcover').show();

                var data = $("#frm_register_agency").serialize();

                $.ajax({

                    type: 'POST',

                    url: "{{ route('home.post-contact') }}",

                    dataType: "json",

                    data: data,

                    success: function(data) {

                        console.log(data);

                        if (data.message_name) {

                            $('.fr-error').css('display', 'block');

                            $('#error_name_register').html(data.message_name);

                        } else {

                            $('#error_name_register').html('');

                        }

                        if (data.message_email) {

                            $('.fr-error').css('display', 'block');

                            $('#error_email_register').html(data.message_email);

                        } else {

                            $('#error_email_register').html('');

                        }

                        if (data.message_phone) {

                            $('.fr-error').css('display', 'block');

                            $('#error_phone_register').html(data.message_phone);

                        } else {

                            $('#error_phone_register').html('');

                        }

                        if (data.message_content) {

                            $('.fr-error').css('display', 'block');

                            $('#error_content_register').html(data.message_content);

                        } else {

                            $('#error_content_register').html('');

                        }

                        if (data.success) {

                            $('.art-popups-agency').removeClass('active');

                            $('#frm_register_agency')[0].reset();

                            // toastr["success"](data.success, "Thông báo");

                            window.location.href = "{{ route('home.page-thanks') }}";

                        }

                        $('.loadingcover').hide();

                    }

                });

            });

            $('.btn_login').click(function(e) {
                e.preventDefault();

                $('.loadingcover').show();

                var data = $("#frm_login").serialize();

                $.ajax({
                    type: 'POST',
                    url: urlLogin,
                    dataType: "json",
                    data: data,
                    success: function(data) {
                        if (data.message_username) {
                            $('.fr-error').css('display', 'block');
                            $('#error_name_login').html(data.message_username);
                        } else {
                            $('#error_name_login').html('');
                        }
                        if (data.message_password) {
                            $('.fr-error').css('display', 'block');
                            $('#error_password_login').html(data.message_password);
                        } else {
                            $('#error_password_login').html('');
                        }
                        if (data.success) {
                            $('#frm_login')[0].reset();
                            window.location.href = "{{ url()->current() }}";
                        }
                        if (data.info) {
                            toastr["error"](data.info, "Cảnh báo");
                        }

                        $('.loadingcover').hide();

                    }
                });

            });

            $('.btn_all').click(function(e) {
                e.preventDefault();

                $(this).addClass('btn-loadingcover');

                var data = $("#frm_contact_all").serialize();

                $.ajax({
                    type: 'POST',
                    url: urlContactAll,
                    dataType: "json",
                    data: data,
                    success: function(data) {
                        if (data.message_name) {
                            $('.fr-error').css('display', 'block');
                            $('#error_name').html(data.message_name);
                        } else {
                            $('#error_name').html('');
                        }
                        if (data.message_email) {
                            $('.fr-error').css('display', 'block');
                            $('#error_email').html(data.message_email);
                        } else {
                            $('#error_email').html('');
                        }
                        if (data.message_phone) {
                            $('.fr-error').css('display', 'block');
                            $('#error_phone').html(data.message_phone);
                        } else {
                            $('#error_phone').html('');
                        }
                        if (data.message_content) {
                            $('.fr-error').css('display', 'block');
                            $('#error_content').html(data.message_content);
                        } else {
                            $('#error_content').html('');
                        }

                        if (data.success) {
                            $('#frm_contact_all')[0].reset();
                            window.location.href = "{{ route('home.page-thanks') }}";
                        }

                        $('.btn-off').removeClass('btn-loadingcover');

                    }
                });

            });

        });
    </script>

    @if(Session::has('message'))
        <script type='text/javascript'>
            toastr["{!! Session::get('level') !!}"]("{!! Session::get('message') !!}")
        </script>
    @endif
    @if (!empty($site_info->facebook_chat))
    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="{{ $site_info->facebook_chat }}" theme_color="#50b73f" logged_in_greeting="Hichem VN xin chào! Chúng tôi có thể giúp gì cho bạn?" logged_out_greeting="Hichem VN xin chào! Chúng tôi có thể giúp gì cho bạn?"></div>
    @endif
    <script>
    </script>
</body>

</html>