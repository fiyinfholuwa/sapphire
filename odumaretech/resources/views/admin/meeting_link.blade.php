@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Manage Meeting Link</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('meeting.link.add')}}" method="post">
                               @csrf
                           @if($meeting_link !=null)
                           <div class="form-group">
                                <label for="email2">Meeting Link</label>
                                <input type="text" class="form-control" id="email2" value="{{$meeting_link->link}}" required name="link" placeholder="Enter Meeting Class Link">
                                <small style="color:red; font-weight:500">
                                @error('link')
                                {{$message}}
                                @enderror
                                </small>
                                <input type="hidden" name="id" value="{{$meeting_link->id}}"/>
                            </div>
                        
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Update Meeting Link</button>
                
                        </div>
                           @else
                           <div class="form-group">
                                <label for="email2">Meeting Link</label>
                                <input type="text" class="form-control" id="email2"  required name="link" placeholder="Enter Meeting Link">
                                
                                <small style="color:red; font-weight:500">
                                @error('link')
                                {{$message}}
                                @enderror
                                </small>
                               
                            </div>
                        
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add Meeting Link</button>
                
                        </div>
                           @endif
                           </form>
                    </div>
                    
                </div>

                <div class="col-md-7">
                <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Check Meeting Link</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <td>S/N</td>
													<th>Meeting Link</th>
										
												</tr>
											</thead>
                                            <tbody>
                                            <?php $i = 1; ?>
										
											<tr>
                                            <td>{{$i;}}</td>
                                           <td> @if($meeting_link != null)
                                            <a target="_blank" class="btn btn-info" href="{{$meeting_link->link}}">View meeting link</a>
                                            @else
                                            No Meeting Link Found
                                            @endif
                                            </td>  
                                                
											</tr>
										
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

					</div>
                    
                </div>
            </div>

@endsection