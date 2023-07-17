@extends('frontend.app')
@section('title')
About Us
@endsection
@section('content')

<div class="page-content">
        <!-- Page Heading Box ==== -->
        <div class="page-banner ovbl-dark" style="background-image:url(https://img.freepik.com/free-vector/abstract-technology-particle-background_52683-25766.jpg?w=740&t=st=1689522194~exp=1689522794~hmac=3ef985596ecd568c61237b819557c75dc2241c4a93c5c675d8d8bbe88e942641);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">About Us</h1>
				 </div>
            </div>
        </div>
		<!-- Page Heading Box END ==== -->
		<!-- Page Content Box ==== -->
		<div class="content-block">
            <!-- About Us ==== -->
			<div class="section-area section-sp1">
                <div class="container">
					 <div class="row">
						<div class="col-lg-4 col-md-6 col-sm-6 m-b30">
							<div class="feature-container">
								<div class="feature-md text-white m-b20">
									<a href="#" class="icon-cell"><img src="assets/images/icon/icon1.png" alt=""/></a> 
								</div>
								<div class="icon-content">
									<h5 class="ttr-tilte">Our Mission</h5>
									<p>Our mission is to empower individuals with tech knowledge, skills, and practical experience for personal and professional growth. Through a supportive and innovative learning approach, we strive to level the playing field, providing equitable opportunities for all to learn, develop, and flourish.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6 m-b30">
							<div class="feature-container">
								<div class="feature-md text-white m-b20">
									<a href="#" class="icon-cell"><img src="assets/images/icon/icon2.png" alt=""/></a> 
								</div>
								<div class="icon-content">
									<h5 class="ttr-tilte">Our Vision</h5>
									<p>Our vision is to build a compassionate world where everyone is free to pursue their passions, live fulfilling lives, and reach their full potential. We want to see everyone have equitable access to education, training, and practical experience in the society.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6 m-b30">
							<div class="feature-container">
								<div class="feature-md text-white m-b20">
									<a href="#" class="icon-cell"><img src="assets/images/icon/icon3.png" alt=""/></a> 
								</div>
								<div class="icon-content">
									<h5 class="ttr-tilte">Our Values</h5>
									<p>Empowerment, Compassion, Innovation, Collaboration, Excellence and Inclusivity, Diversity, Creativity, Passion, Continuous improvement.</p>
								</div>
							</div>
						</div>
						
					</div>
				</div>
            </div>
			<!-- About Us END ==== -->
            <!-- Our Story ==== -->
			<div class="section-area bg-gray section-sp1 our-story">
				<div class="container">
					<div class="row align-items-center d-flex">
						<div class="col-lg-5 col-md-12 heading-bx">
							<h2 class="m-b10">About Us</h2>
							<h5 class="fw4">At OdumareTech, our unwavering commitment lies in your success.</h5>
							<p> We are not just another tech company; we are your dedicated ally on the path to excellence. We go beyond theoretical concepts. We believe in the power of practical application, which is why we provide you with hands-on projects and real-world case studies. Your journey with us culminates in a prestigious certification that validates your comprehensive skills and expertise. We understand that practical experience is invaluable, which is why we offer you the unique opportunity to join our exclusive Research and Innovation department and acquire the practical skills necessary to flourish in your domain. Even after you complete our program, our commitment to your success remains unwavering. We offer ongoing drop-in sessions where our team provides guidance, interview tips, and valuable insights, maximizing your chances of securing your first job in the competitive tech market.</p>
						</div>
						<div class="col-lg-7 col-md-12 heading-bx p-lr">
							<div class="video-bx">
								<img src="https://global.ariseplay.com/amg/www.thisdaylive.com/uploads/Technology.jpg" alt=""/>
								<!-- <a href="https://www.youtube.com/watch?v=x_sJzVe9P_8" class="popup-youtube video"><i class="fa fa-play"></i></a> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Our Story END ==== -->
			<!-- Our Status ==== -->
			<div class="section-area section-sp1 ovpr-dark bg-fix online-cours" style="background-image:url(https://www.techrepublic.com/wp-content/uploads/2021/11/tech-worker.jpg')}});">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center text-white">
							<!-- <h2>Online Courses To Learn</h2> -->
							<h5>Our Achievements</h5>
						</div>
					</div>
					<div class="mw800 m-auto">
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<div class="cours-search-bx m-b30">
									<div class="icon-box">
										<h3><i class="ti-user"></i><span class="counter">2000</span>+</h3>
									</div>
									<span class="cours-search-text">Over 2000 students taught</span>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="cours-search-bx m-b30">
									<div class="icon-box">
										<h3><i class="ti-book"></i><span class="counter">80</span>%</h3>
									</div>
									<span class="cours-search-text">80% Employability.</span>
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="cours-search-bx m-b30">
									<div class="icon-box">
										<h3><i class="ti-layout-list-post"></i><span class="counter">20</span>+</h3>
									</div>
									<span class="cours-search-text">In partnership with 20+ companies.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- About Content END ==== -->
			<!-- Testimonials ==== -->
			<div class="section-area section-sp2">
				<div class="container">
					<div class="row">
						<div class="col-md-12 heading-bx left">
							<h2 class="title-head text-uppercase">what people <span>say</span></h2>
							<!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page</p> -->
						</div>
					</div>
					<div class="testimonial-carousel owl-carousel owl-btn-1 col-12 p-lr0">
						@if(count($testimonials) > 0)
                        @foreach($testimonials as $test)
						<div class="item">
							<div class="testimonial-bx">
								<div class="testimonial-thumb">
									<img src="{{$test->image}}" alt="">
								</div>
								<div class="testimonial-info">
									<h5 class="name">{{$test->name}}</h5>
									<p>{{$test->title}}</p>
								</div>
								<div class="testimonial-content">
									<p>{{$test->content}}</p>
								</div>
							</div>
						</div>
                        @endforeach
                        @else
                        <div><h3 class="text-danger">No Testimonial yet</h3></div>
                        @endif
					</div>
				</div>
			</div>
			<!-- Testimonials END ==== -->
		</div>
		<!-- Page Content Box END ==== -->
    </div>
@endsection