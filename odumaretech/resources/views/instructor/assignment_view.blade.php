@extends('instructor.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Assignment</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('assignment.add')}}" method="post" enctype="multipart/form-data">
                               @csrf
                           <div class="form-group">
                                <label for="email2">Assignment Title</label>
                                <input type="text" class="form-control" id="email2" required name="title" placeholder="Enter  Assignment Title">
                                <small style="color:red; font-weight:500">
                                @error('title')
                                {{$message}}
                                @enderror
                                </small>
                               
                            </div>
                            <div class="form-group">
                            <label for="email2">Assignment Category</label>
                                <select class="form-control" name="course_id" id="validationCustom02"  required>
                                <option disabled selected >Select Assignment Category</option>
                                @foreach($courses as $course)
                                <option value="{{$course->id}}" >{{$course->title}}</option>
                                @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label for="email2">Assignment Description</label>
                                <textarea class="form-control" name="description" row="6" placeholder="Assignment Description"></textarea>
                                <small style="color:red; font-weight:500">
                                </small>
                            </div>
                        
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add Assignment</button>
                
                        </div>
                        </form>
                    </div>
                    
                </div>
                
            </div>

@endsection