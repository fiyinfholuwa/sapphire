@extends('frontend.app')

@section('title')
FAQ
@endsection
@section('content')
<div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(https://img.freepik.com/free-vector/abstract-technology-particle-background_52683-25766.jpg?w=740&t=st=1689522194~exp=1689522794~hmac=3ef985596ecd568c61237b819557c75dc2241c4a93c5c675d8d8bbe88e942641);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Frequently Asked Questions</h1>
				 </div>
            </div>
        </div>

        <!-- contact area -->
        <div class="content-block">
            <!-- Your Faq -->
			
            <!-- Our Services -->
            <div class="section-area section-sp1">
                <div class="container">
					<div class="row">
						<div class="col-lg-8 col-md-12">
							<div class="heading-bx left">
								<h2 class="m-b10 title-head">Asked <span> Questions</span></h2>
							</div>
							
							<div class="ttr-accordion m-b30 faq-bx" id="accordion1">
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse" href="#faq1" class="collapsed" data-parent="#faq1">
											What is OdumareTech? </a> </h6>
									</div>
									<div id="faq1" class="acod-body collapse">
										<div class="acod-content">OdumareTech is a tech platform that focuses on practical, hands-on learning. Through real-world projects and industry collaboration, we prepare students for their first professional role, equipping them with practical expertise and confidence.</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse" href="#faq2" class="collapsed" data-parent="#faq2">
											What are the courses offered by OdumareTech?</a> </h6>
									</div>
									<div id="faq2" class="acod-body collapse">
										<div class="acod-content">We offer a wide range of courses including but not limited to  Data Science, Data Analytics, and Web development.</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse"  href="#faq3" class="collapsed"  data-parent="#faq3">
											What teaching methods or instructional approaches do you employ?</a> </h6>
									</div>
									<div id="faq3" class="acod-body collapse">
										<div class="acod-content">At OdumareTech, we employ Lectures and Presentations, Practical Application and Hands-on Projects, Collaborative Learning, Interactive Workshops and Demos, Feedback and Assessments, Guest Speakers and Industry Insights, Online Resources and Learning Materials.</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse"  href="#faq4" class="collapsed"  data-parent="#faq4">
											What is the course duration? </a> </h6>
									</div>
									<div id="faq4" class="acod-body collapse">
										<div class="acod-content">The course runs for a period of 16 weeks over the weekend.</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse"  href="#faq5" class="collapsed"  data-parent="#faq5">
											Having trouble logging in to the learning platform? </a> </h6>
									</div>
									<div id="faq5" class="acod-body collapse">
										<div class="acod-content">Kindly send a mail to academy@odumaretech.com for assistance.</div>
									</div>
								</div>
                                <div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse"  href="#faq6" class="collapsed"  data-parent="#faq6">
											What is the cost of the courses? </a> </h6>
									</div>
									<div id="faq6" class="acod-body collapse">
										<div class="acod-content">Course cost vary. Kindly have a look at your preference course in the course icon.</div>
									</div>
								</div>

                                <div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse"  href="#faq7" class="collapsed"  data-parent="#faq7">
                                            What are the payment options available?</a> </h6>
									</div>
									<div id="faq7" class="acod-body collapse">
										<div class="acod-content">We accept payment in two instalment. You can reach out to finance@odumaretech.com for more details.</div>
									</div>
								</div>

                                <div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse"  href="#faq8" class="collapsed"  data-parent="#faq8">
											Can my employer sponsor or reimburse the cost of the training? </a> </h6>
									</div>
									<div id="faq8" class="acod-body collapse">
										<div class="acod-content">Yes, we can provide you with evidence of payment that can be presented to your sponsor.</div>
									</div>
								</div>

                                <div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> 
											<a data-toggle="collapse"  href="#faq9" class="collapsed"  data-parent="#faq9">
											Can I get a refund if I change my mind? </a> </h6>
									</div>
									<div id="faq9" class="acod-body collapse">
										<div class="acod-content">The policy varies, kindly check the refund policy icon or send details to finance@odumaretech.com for details.</div>
									</div>
								</div>


							</div>
							
						</div>
						<div class="col-lg-4 col-md-12">
							<div class="bg-dark text-white contact-info-bx">
								<h2 class="m-b10 title-head">Contact <span>Information</span></h2>
								
								<div class="widget widget_getintuch">	
									<ul>
										<li><i class="ti-mobile"></i>+447784927399</li>
										<li><i class="ti-email"></i>info@dumaretech.com</li>
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
					</div>
					
                </div>
            </div>
            <!-- Your Faq End -->
		
        </div>
		<!-- contact area END -->
    </div>

@endsection