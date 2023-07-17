<!DOCTYPE html>
<html lang="en">

<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content="SyntaxAI" />
	
	<!-- OG -->
	<meta property="og:title" content="SyntaxAI" />
	<meta property="og:description" content="SyntaxAI" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- F-AVICONS ICON ============================================= -->
	<link rel="icon" href="{{asset('frontend/assets/images/synta_logo.png')}}" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/images/synta_logo.png')}}" />
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>OdumareTech -  @yield('title')</title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="{{asset('frontend/assets/js/html5shiv.min.js')}}"></script>
	<script src="{{asset('frontend/assets/js/respond.min.js')}}"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/assets.css')}}">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/typography.css')}}">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/shortcodes/shortcodes.css')}}">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}">
	<link class="skin" rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/color/color-1.css')}}">
	
	<!-- REVOLUTION SLIDER CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendors/revolution/css/layers.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendors/revolution/css/settings.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendors/revolution/css/navigation.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" >
	<!-- REVOLUTION SLIDER END -->	
</head>
<style>
	* {
  user-select: text;
  -webkit-user-select: text;
  -moz-user-select: text;
  -ms-user-select: text;
}

</style>
<body id="bg">
<div class="page-wraper">
<div id="loading-icon-bx"></div>
	<!-- Header Top ==== -->
    <header class="header rs-nav header-transparent">
		<div class="top-bar">
			<div class="container">
				<div class="row d-flex justify-content-between">
					<div class="topbar-left">
					</div>
					<div class="topbar-right">
						<!-- <ul>
							<li><a href="{{route('login')}}">Login</a></li>
							<li><a href="{{route('register')}}">Register</a></li>
						</ul> -->
					</div>
				</div>
			</div>
		</div>
		<div class="sticky-header navbar-expand-lg">
            <div class="menu-bar clearfix">
                <div class="container clearfix">
					<!-- Header Logo ==== -->
					<div class="menu-logo">
						<a href="{{route('home')}}"><img  src="{{asset('frontend/assets/images/synta_logo.png')}}" alt=""></a>
					</div>
					<!-- Mobile Nav Button ==== -->
                    <button class="navbar-toggler collapsed menuicon justify-content-end" type="button" data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
					<!-- Author Nav ==== -->
                    <div class="secondary-menu">
                        <div class="secondary-inner">
                            <ul>
								<li><a href="https://www.facebook.com/profile.php?id=100094441748614" class="btn-link"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://www.instagram.com/odumaretech/" class="btn-link"><i class="fa fa-instagram"></i></a></li>
								<li><a href="https://www.linkedin.com/company/odumaretech/" class="btn-link"><i class="fa fa-linkedin"></i></a></li>
								<!-- Search Button ==== -->
								<li class="search-btn"><button id="quik-search-btn" type="button" class="btn-link"><i class="fa fa-search"></i></button></li>
							</ul>
						</div>
                    </div>
					<!-- Search Box ==== -->
                    <div class="nav-search-bar">
                        <form action="{{route('search')}}" method="get">
                            <input name="search" value="" type="text" class="form-control" placeholder="Search Course by title">
                            <!-- <span><i class="ti-search"></i></span> -->
							<button  type="submit" class=" mt-2 btn btn-info"><i class="ti-search"></i></button>
                        </form>
						<span id="search-remove"><i class="ti-close"></i></span>
                    </div>

					<!-- Navigation Menu ==== -->
                    <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
						<div class="menu-logo">
							<a href="{{route('home')}}"><img style="height:150px; width:200px;" src="{{asset('frontend/assets/images/synta_logo.png')}}" alt=""></a>
						</div>
                        <ul class="nav navbar-nav">	
							<li class="active"><a style="font-size:11px;" href="{{route('home')}}">Home</a></li>
							<li class=""><a style="font-size:11px;" href="{{route('course')}}">Our Courses</a></li>
							<li class=""><a style="font-size:11px;" href="{{route('about')}}">About</a></li>
							<li><a style="font-size:11px;" href="{{route('contact')}}">Contact Us</a></li>
							@if($masterclass != null || $masterclass != "")
							<li><a style="font-size:11px;" href="{{route('masterclass')}}">Free Master Class</a></li>
							@else
							@endif
							<li><a style="font-size:11px;" href="{{route('instructor')}}">Become an Instructor</a></li>

							@auth
							@if(Auth::check() && Auth::user()->user_type == "2")
							<li ><a style="font-size:11px;" href="{{route('admin.dashboard')}}">Dashboard</a></li>
							@elseif(Auth::check() && Auth::user()->user_type == "1")
							<li ><a style="font-size:11px;" href="{{route('instructor.dashboard')}}">Dashboard</a></li>
							@else
							@if($check_courses)
							<li ><a style="font-size:11px;" href="{{route('user.dashboard')}}">Dashboard</a></li>
							@else
							@endif
							@endif
							<li ><a style="font-size:11px;" href="{{route('logout')}}">Logout</a></li>
							@else
							<li><a style="font-size:11px;" href="{{route('login')}}">Login</a></li>
							<li><a style="font-size:11px;" href="{{route('register')}}">Register</a></li>
							@endauth
						</ul>
						<div class="nav-social-link">
							<a href="javascript:;"><i class="fa fa-facebook"></i></a>
							<a href="javascript:;"><i class="fa fa-google-plus"></i></a>
							<a href="javascript:;"><i class="fa fa-linkedin"></i></a>
						</div>
                    </div>
					<!-- Navigation Menu END ==== -->
                </div>
            </div>
        </div>
    </header>
    <!-- Header Top END ==== -->
    <!-- Content -->
    @yield('content')
    <!-- Content END-->
	<!-- Footer ==== -->
    <footer>
        <div class="footer-top">
			<div class="pt-exebar">
				<div class="container">
					<div class="d-flex align-items-stretch">
						<!-- <div class="pt-logo mr-auto">
							<a href="index.html"><img src="{{asset('frontend/assets/images/synta_logo.png')}}" alt=""/></a>
						</div>
						<div class="pt-social-link">
							<ul class="list-inline m-a0">
								<li><a href="#" class="btn-link"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" class="btn-link"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" class="btn-link"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#" class="btn-link"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
						<div class="pt-btn-join">
							<a href="#" class="btn ">Join Now</a>
						</div> -->
					</div>
				</div>
			</div>
            <div class="container">
                <div class="row">
					<div class="col-lg-3 col-md-12 col-sm-12 footer-col-4">
                        <div class="widget">
                            <!-- <h5 class="footer-title">Sign Up For A Newsletter</h5> -->
							<!-- <p class="text-capitalize m-b20">Nostrud aute sint Lorem dolore Lorem aute proident Lorem est incididunt.</p> -->
                            <!-- <div class="subscribe-form m-b20">
								<form class="subscription-form" action="" method="post">
									<div class="ajax-message"></div>
									<div class="input-group">
										<input name="email" required="required"  class="form-control" placeholder="Your Email Address" type="email">
										<span class="input-group-btn">
											<button name="submit" value="Submit" type="submit" class="btn"><i class="fa fa-arrow-right"></i></button>
										</span> 
									</div>
								</form>
							</div> -->
                        </div>
                    </div>
					<div class="col-12 col-lg-9 col-md-7 col-sm-12">
						<div class="row">
							<div class="col-4 col-lg-6 col-md-6 col-sm-4">
								<div class="widget footer_widget">
									<h5 class="footer-title">Quick Links</h5>
									<ul>
									<li><a href="{{route('home')}}">Home</a></li>
										<li><a href="{{route('about')}}">About Us</a></li>
										<li><a href="{{route('course')}}">Courses</a></li>
										<li><a href="{{route('contact')}}">Contact Us</a></li>
										<li><a href="{{route('innovation')}}">Research & Innovation</a></li>
										<li><a href="{{route('faq')}}">FAQs</a></li>
								
									</ul>
								</div>
							</div>
							<div class="col-4 col-lg-6 col-md-6 col-sm-4">
								<div class="widget footer_widget">
									<h5 class="footer-title">Policies</h5>
									<ul>
										<li><a href="{{route('terms')}}">Terms & Condition</a></li>
										<li><a href="{{route('privacy')}}">Privacy Policy</a></li>
										<li><a href="{{route('policy')}}">Refund Policy</a></li>
									</ul>
								</div>
							</div>
							
						</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">© 2023 OdumareTech. All right reserved.</div>
                </div>
            </div>
        </div>
    </footer>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=+447784927399&text=Hi%2C%20I%20would%20love%20to%20loosen%20my%20tech%20superpowers%21
" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
<style>
	.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
</style>
    <!-- Footer END ==== -->
    <button class="back-to-top fa fa-chevron-up" ></button>
</div>

<!-- External JavaScripts -->
<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/magnific-popup/magnific-popup.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/counter/waypoints-min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/counter/counterup.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/imagesloaded/imagesloaded.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/masonry/masonry.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/masonry/filter.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/owl-carousel/owl.carousel.js')}}"></script>
<script src="{{asset('frontend/assets/js/functions.js')}}"></script>
<script src="{{asset('frontend/assets/js/contact.js')}}"></script>
<!-- Revolution JavaScripts Files -->
<script src="{{asset('frontend/assets/vendors/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script>
jQuery(document).ready(function() {
	var ttrevapi;
	var tpj =jQuery;
	if(tpj("#rev_slider_486_1").revolution == undefined){
		revslider_showDoubleJqueryError("#rev_slider_486_1");
	}else{
		ttrevapi = tpj("#rev_slider_486_1").show().revolution({
			sliderType:"standard",
			jsFileLocation:"{{asset('frontend/assets/vendors/revolution/js/')}}",
			sliderLayout:"fullwidth",
			dottedOverlay:"none",
			delay:9000,
			navigation: {
				keyboardNavigation:"on",
				keyboard_direction: "horizontal",
				mouseScrollNavigation:"off",
				mouseScrollReverse:"default",
				onHoverStop:"on",
				touch:{
					touchenabled:"on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				}
				,
				arrows: {
					style: "uranus",
					enable: true,
					hide_onmobile: false,
					hide_onleave: false,
					tmp: '',
					left: {
						h_align: "left",
						v_align: "center",
						h_offset: 10,
						v_offset: 0
					},
					right: {
						h_align: "right",
						v_align: "center",
						h_offset: 10,
						v_offset: 0
					}
				},
				
			},
			viewPort: {
				enable:true,
				outof:"pause",
				visible_area:"80%",
				presize:false
			},
			responsiveLevels:[1240,1024,778,480],
			visibilityLevels:[1240,1024,778,480],
			gridwidth:[1240,1024,778,480],
			gridheight:[768,600,600,600],
			lazyType:"none",
			parallax: {
				type:"scroll",
				origo:"enterpoint",
				speed:400,
				levels:[5,10,15,20,25,30,35,40,45,50,46,47,48,49,50,55],
				type:"scroll",
			},
			shadow:0,
			spinner:"off",
			stopLoop:"off",
			stopAfterLoops:-1,
			stopAtSlide:-1,
			shuffle:"off",
			autoHeight:"off",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
	}
});	
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>


 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
      Toastify({ text: "{{ Session::get('message') }}", duration: 3000,
            style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
    }).showToast();
    break;

    case 'success':
      Toastify({ text: "{{ Session::get('message') }}", duration: 3000,
        style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
    }).showToast();
    break;

    case 'warning':
      Toastify({ text: "{{ Session::get('message') }}", duration: 3000,
            style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
    }).showToast();
    break;

    case 'error':
      Toastify({ text: "{{ Session::get('message') }}", duration: 3000,
            style: { background: "linear-gradient(to right, #ff0000, #ff0000)" }
    }).showToast();
    break; 
 }
 @endif 
</script>
</body>

</html>
