@extends('frontend.app')

@section('content')
<div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(https://img.freepik.com/free-vector/abstract-technology-particle-background_52683-25766.jpg?w=740&t=st=1689522194~exp=1689522794~hmac=3ef985596ecd568c61237b819557c75dc2241c4a93c5c675d8d8bbe88e942641);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Courses Details</h1>
				 </div>
            </div>
        </div>
		<!-- Breadcrumb row -->
		<div class="breadcrumb-row">
			<div class="container">
				<ul class="list-inline">
					<li><a href="{{route('home')}}">Home</a></li>
					<li>Courses Details</li>
				</ul>
			</div>
		</div>
		<!-- Breadcrumb row END -->
        <!-- inner page banner END -->
		<div class="content-block">
            <!-- About Us -->
			<div class="section-area section-sp1">
                <div class="container">
					 <div class="row d-flex flex-row-reverse">
						<div class="col-lg-4 col-md-4 col-sm-12 m-b30">
							<div class="course-detail-bx">
								<div class="course-price">
									@if($course->discount == 0 || $course->discount == null)
									
									@if($check_user_has_coupon)
									<h4 class="price">#{{number_format($course->price - ($course->price * $coupon_check->discount /100),00) }}</h4>
									@else
									<h4 class="price">#{{$course->price}}</h4>
									@endif
									@else

									@if($check_user_has_coupon)
									<del>#{{$course->price}}.00</del>
									<h4 class="price">#{{ number_format($course->price - ($course->price * $course->discount/100) - ($course->price * $coupon_check->discount /100) ,00)}}.00 </h4>
									@else
									<del>#{{$course->price}}.00</del>
									<h4 class="price">#{{ number_format($course->price - ($course->price * $course->discount/100),00)}}.00 </h4>
									@endif

									
									@endif
									
								</div>	
								<div class="course-buy-now">
									<form action="{{route('pay')}}" method="post">
										@csrf
									<h4>Choose Payment Gateway</h4>
									<label><img height="50px" width="100px" src="https://upload.wikimedia.org/wikipedia/commons/1/1f/Paystack.png"/></label>
									<input type="radio" value="paystack" name="payment" required/> </br>
									<label><img height="50px" width="100px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/1200px-Stripe_Logo%2C_revised_2016.svg.png"/></label>
									<input type="radio"  value="stripe" name="payment"/> </br>


									<h4>Payment Type</h4>
									<label>Full Payment </br> (Enjoy Discount and Coupon)</label>
									<input type="radio" value="full" name="payment_type" required/> </br>
									<label>Installment (70% of the Actual Cost)</label>
									<input type="radio"  value="partial" name="payment_type"/> </br>


									<input type="hidden" name="course_id" value="{{$course->id}}"/>
									
									@if(Auth::check())
									<input type="hidden" name="user_email" value="{{Auth::user()->email}}"/>
									@if($course->discount == 0 || $course->discount == null)
									@if($check_user_has_coupon)
									<input type="hidden" name="amount" value="{{$course->price - ($course->price * $coupon_check->discount /100)}}"/>
									@else
									<input type="hidden" name="amount" value="{{$course->price}}"/>
									@endif
									
									@else
									@if($check_user_has_coupon)
									<input type="hidden" name="amount" value="{{$course->price - ($course->price * $course->discount/100) - ($course->price * $coupon_check->discount /100)}}"/>
									@else
									<input type="hidden" name="amount" value="{{$course->price - ($course->price * $course->discount/100)}}"/>
									@endif
									
									@endif
									
									@if($has_pending)
									<button id="myBtn" type="button"  class="btn radius-xl text-uppercase">You Already Registered for a course.</button>
									@else
									<button id="myBtn" type="submit"  class="btn radius-xl text-uppercase">Enroll</button>
									@endif
									@else
									<a href="{{route('login')}}" class="btn radius-xl text-uppercase">Enroll</a>
									@endif
									</form>
								</div>
								<hr>
								
								<div class="cours-more-info">
									
									
									<div class="price categories">
										<span>Category</span>
										<h5 class="text-primary">{{$course->cat->name}}</h5>
									</div>
								</div>
								@if($coupon_check != null)
								<form method ="post" action="{{route('coupon.validate')}}">
									@csrf
										<div class="row mt-4">
											<div class="col-6">
												<input name="code" type="text" placeholder="Enter Coupon" class="form-control" />
												<input type="hidden" name="coupon_id" value="{{$coupon_check->id}}" placeholder="Enter Coupon" class="form-control" />
												<input type="hidden" name="course_id" value="{{$course->id}}" placeholder="Enter Coupon" class="form-control" />
											</div>
											<div class="col-3">
												@if(Auth::check())

												<input type="submit" class="btn btn-danger btn-sm" value="Apply Coupon" />
												@else
												<a href="{{route('login')}}" class="btn btn-info btn-sm">Apply Coupon</a>
												@endif
											</div>
										</div>
									</form>

								@endif
							</div>
						</div>
					
						<div class="col-lg-8 col-md-8 col-sm-12">
							<div class="courses-post">
								<div class="ttr-post-media media-effect">
									<a href="#"><img src="{{asset($course->image)}}" alt=""></a>
								</div>
								<div class="ttr-post-info">
									<div class="ttr-post-title ">
										<h2 class="post-title">{{$course->title}}</h2>
									</div>
									
								</div>
							</div>
							<div class="courese-overview" id="overview">
								<!-- <h4>Overview</h4> -->
								<div class="row">
									<div class="col-md-12 col-lg-4">
										<ul class="course-features">
											<li><i class="ti-book"></i> <span class="label">Lectures Schedules</span> <span class="value">{{$course->lecture}}</span></li>
											<!-- <li><i class="ti-help-alt"></i> <span class="label">Quizzes</span> <span class="value">1</span></li> -->
											<li><i class="ti-time"></i> <span class="label">Duration</span> <span class="value">{{$course->duration}} Weeks</span></li>
											<li><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span class="value">{{$course->level}}</span></li>
											<li><i class="ti-smallcap"></i> <span class="label">Language</span> <span class="value">{{$course->language}}</span></li>
											<!-- <li><i class="ti-user"></i> <span class="label">Students</span> <span class="value">32</span></li> -->
											<!-- <li><i class="ti-check-box"></i> <span class="label">Assessments</span> <span class="value">Yes</span></li> -->
										</ul>
									</div>
									<div class="col-md-12 col-lg-8">
										<h5 class="m-b5">Course Description</h5>
										<p>{{$course->description}}</p>
										<h5 class="m-b5">Certification</h5>
										<p>{{$course->certification}}</p>
										<h5 class="m-b5">Support</h5>
										<p>{{$course->support}}</p>
										<h5 class="m-b5">Experience</h5>
										<p>{{$course->experience}}</p>
									</div>
								</div>
							</div>
							
							
							
						</div>
						
					</div>
				</div>
            </div>
        </div>
		<!-- contact area END -->
		
    </div>

@endsection