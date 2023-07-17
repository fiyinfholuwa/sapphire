@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Instructors</h4>
                    <div class="bg-white p-3   align-items-center">
                


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Instructor ID</th>
                                    <th>Action</th>
        
                                </tr>
                            </thead>
                           
                            <tbody>
                            <?php $i = 1; ?>
                             @foreach($users as $user)
                             <tr>
                             
                             <td>{{$i++;}}</td>
                             <td>{{$user->first_name}}</td>
                             <td>{{$user->last_name}}</td>
                             <td>{{$user->email}}</td>
                             <td>{{$user->student_id}}</td>
                             <td>
                             <a href="{{route('instructor.edit', $user->id)}}" ><i style="color:blue;" class="fa fa-edit"></i></a>    
                            <a href="#" data-toggle="modal" data-target="#instructor_{{$user->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                            </td>
                            @include('admin.modal.deleteInstructor')
                             
                             @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection