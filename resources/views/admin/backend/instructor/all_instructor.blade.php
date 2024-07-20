@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<style>
    .large-checkbox{
        transfrom:scale(1.5);
    }
    </style>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Instructor</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <!--end breadcrumb-->
    
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Instructor Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $allinstructor as $key=> $item)
                            
                        
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>
                                @if($item->status==1)
                                <span class = 'btn btn-success'>Active</span>
                                @else
                                <span class = 'btn btn-danger'>Inactive</span>
                                @endif
                            </td>
                            <td>
<div class="form-check-danger form-check form-switch">
        <input type="checkbox"    id="flexSwitchCheckCheckedDanger"  class="form-check-input  status-toggle large-checkbox"   
            data-user-id = "{{ $item->id }}" {{$item->status ? 'checked' : ''}}>
        </input>

            <!-- "{{$item->id}}"   {{ $item->status ? 'checked' : ''}}  -->
        
        <label class="form-check-label" for="flexSwitchCheckCheckedDanger"></label>
</div>
                          </td>
                        </tr>
                        @endforeach  
                    </tbody>
                    <tfoot>
                        <tr>
                            
                            <th>Total</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    
    
</div>
<script>
$(document).ready(function(){
    $(.status-toggle).on('change',function(){
        console.log('Checkbox status changed');
        var userId = $(this).data('user-id');
        var ischecked = $(this).is(:'checked');
        
        // now will send ajax request
        $.ajax({
            url:"{{route('update.user.status')}}"
            Method: "POST",
            data: {
                user_Id : userId,
                is_checked : ischecked ? 1: 0,
                  _token : "{{csrf_token ()}}"
               // _token : $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                toastr.success(response.message);
        },
            error:function(xhr, status, error){
                console.error(error);
                toastr.error('Error updating user status');
            }
        })
    })
})
</script>
@endsection