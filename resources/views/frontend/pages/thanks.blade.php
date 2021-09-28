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
<body class="page-body home-body">
    @if (!empty($site_info->google_tag_manager))
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $site_info->google_tag_manager }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	 @endif
	<div class="body-main">

		<!-- //////////////////////////////////////////////////////////// -->

		<main class="main-site page-site page-404-site page-thanks-site">
			<div class="main-container">

				<article class="art-banners">
					<div class="container">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="banners-box">
									<div class="banners-content">
										<div class="logos-box">
											<div class="logos-content">
												<a href="{{ url('/') }}" title="Công ty TNHH HiChem">
													<img src="{{ @$site_info->logo }}" alt="Công ty TNHH HiChem">
												</a>
											</div>
										</div>

										<h1><span>Thank you!</span></h1>

										<h2>Cảm ơn bạn đã cho chúng tôi cơ hội phục vụ</h2>

										<h3>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!</h3>

										<div class="button">
											<a href="{{ url('/') }}" class="btn">Quay về trang chủ</a>
										</div>
									</div>							
								</div>
							</div>
						</div>
				</article>

			</div>
		</main> <!-- main-site -->

		<!-- //////////////////////////////////////////////////////////// -->

	</div> <!-- body-main -->
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
        

    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/slick.min.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/mobilemenu.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/bs__tab.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/main.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom.js"></script>

</body>