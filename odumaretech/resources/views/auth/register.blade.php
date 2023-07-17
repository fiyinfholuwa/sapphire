
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
	<meta name="description" content="OdumareTech" />
	
	<!-- OG -->
	<meta property="og:title" content="OdumareTech" />
	<meta property="og:description" content="OdumareTech" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="{{asset('frontend/assets/images/synta_logo.png')}}" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/images/synta_logo.png')}}" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>OdumareTech - Register</title>
	
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
	
</head>
<body id="bg">
<div class="page-wraper">
	<div id="loading-icon-bx"></div>
	<div class="account-form">
		<div class="account-head" style="background-image:url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtCGvqpUBttDjgfkm3QC4hfmzSYvSKCN65sg&usqp=CAU);">
			<a href="index.html"><img src="assets/images/synta_logo.png" alt=""></a>
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Sign Up <span>Now</span></h2>
					<p>Login Your Account <a href="{{route('login')}}">Click here</a></p>
				</div>	
				<form class="contact-bx" method="post" action="{{route('register')}}">
                    @csrf
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>First Name</label>
									<input name="first_name" type="text" value="{{old('first_name')}}" required="" class="form-control">
								</div>
                                <span style="color:red; font-weight:bold;">
                                    @error('first_name')
                                    {{$message}}
                                    @enderror
                                    </span>
							</div>
						</div>
                        <div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Last Name</label>
									<input name="last_name" type="text" value="{{old('last_name')}}" required="" class="form-control">
								</div>
                                <span style="color:red; font-weight:bold;">
                                    @error('last_name')
                                    {{$message}}
                                    @enderror
                                    </span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Email Address</label>
									<input name="email" type="email" value="{{old('email')}}" required="" class="form-control">
								</div>
                                <span style="color:red; font-weight:bold;">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                    </span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Your Password</label>
									<input name="password" required type="password" class="form-control" required="">
								</div>
                                <span style="color:red; font-weight:bold;">
                                    @error('password')
                                    {{$message}}
                                    @enderror
                                    </span>
							</div>
						</div>

                        <div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Confirmation Password</label>
									<input required name="password_confirmation" type="password" class="form-control" required="">
								</div>
                                
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group form-forget">
								<div class="custom-control custom-checkbox">
									<input required type="checkbox"  class="custom-control-input" id="customControlAutosizing">
									<label class="custom-control-label" for="customControlAutosizing">Subscribe to our mail list</label>
								</div>
								<!-- <a href="forget-password.html" class="ml-auto">Forgot Password?</a> -->
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button name="submit" type="submit" value="Submit" class="btn button-md">Sign Up</button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
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
