@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Transactions</h4>
                    <div class="bg-white p-3   align-items-center">
                


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>ReferenceId</th>
                                    <th>Email</th>
                                    <th>Course Title</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
                           
                            <tbody>
                            <?php $i = 1; ?>
                             @foreach($payments as $pay)
                             <tr>
                             
                             <td>{{$i++;}}</td>
                             <td>{{$pay->referenceId}}</td>
                             <td>{{$pay->user_email}}</td>
                             <td>{{$pay->course_name->title}}</td>
                             <td>{{$pay->payment}}</td>
                             <td> @if($pay->status === "paid")
                                <span class="btn btn-success text-white btn-sm"> {{$pay->status}} </span>
                                @else
                                <span class="btn btn-warning text-white btn-sm"> {{$pay->status}} </span>
                                @endif
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