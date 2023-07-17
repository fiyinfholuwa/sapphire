@extends('frontend.app')
@section('title')
Contact Us
@endsection
@section('content')

<div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(https://img.freepik.com/free-vector/abstract-technology-particle-background_52683-25766.jpg?w=740&t=st=1689522194~exp=1689522794~hmac=3ef985596ecd568c61237b819557c75dc2241c4a93c5c675d8d8bbe88e942641);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Contact Us</h1>
				 </div>
            </div>
        </div>

	
        <!-- inner page banner -->
        <div class="page-banner contact-page section-sp2">
            <div class="container">
                <div class="row">
					<div class="col-lg-5 col-md-5 m-b30">
						<div class="text-white contact-info-bx">
							<h2 class="m-b10 title-head">Contact <span>Information</span></h2>
							<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
							<div class="widget widget_getintuch">	
								<ul>
									
									<li><i class="ti-mobile"></i>+447784927399</li>
									<li><i class="ti-email"></i>contact@dumaretech.com</li>
								</ul>
							</div>
							<h5 class="m-t0 m-b20">Follow Us</h5>
							<ul class="list-inline contact-social-bx">
								<li><a target="_blank" href="https://www.facebook.com/profile.php?id=100094441748614" class="btn outline radius-xl"><i class="fa fa-facebook"></i></a></li>
								<!-- <li><a href="#" class="btn outline radius-xl"><i class="fa fa-twitter"></i></a></li> -->
								<li><a target="_blank" href="https://www.linkedin.com/company/odumaretech/" class="btn outline radius-xl"><i class="fa fa-linkedin"></i></a></li>
								<li><a target="_blank" href="https://www.instagram.com/odumaretech/" class="btn outline radius-xl"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-7 col-md-7">
						<form class="contact-bx" method="post" action="{{route('contact.save')}}">
							@csrf
						<div class="ajax-message"></div>
							<div class="heading-bx left">
								<h2 class="title-head">Get In <span>Touch</span></h2>
								<!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page</p> -->
							</div>
							<div class="row placeani">
								<div class="col-lg-6">
									<div class="form-group">
										<div class="input-group">
											<label>Your Name</label>
											<input name="name" type="text" required class="form-control">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<div class="input-group"> 
											<label>Your Email Address</label>
											<input name="email" type="email" class="form-control" required >
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<div class="input-group">
											<label>Your Phone</label>
											<input name="phone" type="text" required class="form-control ">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<div class="input-group">
											<label>Subject</label>
											<input name="subject" type="text" required class="form-control">
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<div class="input-group">
											<label>Type Message</label>
											<textarea name="message" rows="4" class="form-control" required ></textarea>
										</div>
									</div>
								</div>
								
								<div class="col-lg-12">
									<button  type="submit" class="btn button-md"> Send Message</button>
								</div>
							</div>
						</form>
					</div>
				</div>
            </div>
		</div>
        <!-- inner page banner END -->
    </div>
    <!-- Content END-->
@endsection