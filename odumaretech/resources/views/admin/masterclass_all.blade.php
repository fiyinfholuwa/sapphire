@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
            
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Free Master Class Attendees  <a class="btn btn-info btn-sm text-white" href="{{route('masterclass.export')}}">Export CSV</a></h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Intrested In</th>
                                                    <th>Gender</th>
                                                    <th>Career</th>
                                                    <th>Location</th>
												
												</tr>
											</thead>
											
                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($attendees as $attendee)
                                           
											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$attendee->first_name}}</td>
                                                <td>{{$attendee->last_name}}</td>
                                                <td>{{$attendee->email}}</td>
                                                <td>{{$attendee->intrested_in}}</td>
                                                <td>{{$attendee->gender}}</td>
                                                <td>{{$attendee->career}}</td>
                                                <td>{{$attendee->location}}</td>
                                                
                                                </td>
                                            
											</tr>
											
                                            @endforeach
                                    
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

				
            </div>

@endsection