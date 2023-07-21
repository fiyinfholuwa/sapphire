@extends('instructor.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Manage Final Project</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('project.final.add')}}" method="post">
                               @csrf
                           @if($project_final !=null)
                           <div class="form-group">
                                <label for="email2">Project Title</label>
                                <input type="text" class="form-control" id="email2" required value="{{$project_final->title}}" name="title" placeholder="Enter Project Title ">
                                <small style="color:red; font-weight:500">
                                @error('title')
                                {{$message}}
                                @enderror
                                </small>
                               
                            </div>
                            <div class="form-group">
                            <label for="email2">Project Category</label>
                                <select class="form-control" name="course_id" id="validationCustom02"  required>
                                <option disabled selected >Select Project Category</option>
                                @foreach($courses as $course)
                                <option value="{{$course->id}}" {{$project_final->course_id ==$course->id ? "selected" : ""}} >{{$course->title}}</option>
                                @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label for="email2">Project Description</label>
                                <textarea class="form-control" name="description" row="6" placeholder="Project Description">{{$project_final->description}}</textarea>
                                <small style="color:red; font-weight:500">
                                </small>
                            </div>
                            <input type="hidden" name="id" value="{{$project_final->id}}"/>
                        
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Update Project</button>
                
                        </div>
                           @else
                           <div class="form-group">
                                <label for="email2">Project Title</label>
                                <input type="text" class="form-control" id="email2" required name="title" placeholder="Enter Project Title ">
                                <small style="color:red; font-weight:500">
                                @error('title')
                                {{$message}}
                                @enderror
                                </small>
                               
                            </div>
                            <div class="form-group">
                            <label for="email2">Project Category</label>
                                <select class="form-control" name="course_id" id="validationCustom02"  required>
                                <option disabled selected >Select Project Category</option>
                                @foreach($courses as $course)
                                <option value="{{$course->id}}" >{{$course->title}}</option>
                                @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label for="email2">Project Description</label>
                                <textarea class="form-control" name="description" row="6" placeholder="Project Description"></textarea>
                                <small style="color:red; font-weight:500">
                                </small>
                            </div>
                        
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add Project</button>
                
                        </div>
                           @endif
                           </form>
                    </div>
                    
                </div>

                <div class="col-md-12">
                <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Preview Project</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
                                            <tr>
													<th>S/N</th>
													<th>Title</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
													
												</tr>
											</thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            @if($project_final != null)
                                            <td>{{$i++;}}</td>
                                            <td>{{$project_final->title}}</td>
                                            <td>{{$project_final->course_name->title}}</td>
                                            <td>{{$project_final->description}}</td>
                                            @else

                                            @endif
											
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