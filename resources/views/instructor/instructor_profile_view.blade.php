@extends('instructor.instructor_dashboard')
@section('instructor')
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Instructor  Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Instructor  Profile</li>
                </ol>
            </nav>
        </div>
        @if (isset($notification))
            <p class="text text-primary">{{$notification['message']}}</p>
        @endif
        
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                    <form method="POST" action="{{route('instructor.profile.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{(!empty($profileData->photo))? url('upload/instructor_image/'.$profileData->photo):url('upload/no_image.jpg')}}" alt="Admin" class="showImage rounded-circle p-1 bg-primary" width="110">
                              
                                <div class="mt-3">
        <h4>{{$profileData->name}}</h4>
        <p class="text-secondary mb-1">Role is {{$profileData->username}}</p>
        <p class="text-muted font-size-sm">{{$profileData->email}}</p>
        <button class="btn btn-primary">Follow</button>
        <button class="btn btn-outline-primary">Message</button>
    </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                                    <span class="text-secondary">https://bmb.com</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="name" required class="form-control" value="{{$profileData->name}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="email" name="email" required class="form-control" value="{{$profileData->email}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="username" class="form-control" value="{{$profileData->username}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text"  name ="phone"  class="form-control" value="{{$profileData->phone}}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="address" class="form-control" value="{{$profileData->address}}" />
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Profile Image</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <!--     fhv17.1. javascript   select image -->
                                    <input type="file" name="photo" class="form-control"  id="image"/>
                                 </div>
                                     <div class="col-sm-3"></div>
                                     <div class="col-sm-9 text-secondary">
                                        <!--     fhv17.2. javascript   select image give id  image showed here -->
               <img id="showImage"   src="{{(!empty($profileData->photo))? url('Upload/instructor_image/'.$profileData->photo):
                                        url('Upload/no_image.jpg')}}" alt="Admin" class="showImage rounded-circle p-1 bg-primary" width="80">
                                        
                                    </div>

                               <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                                    <p>Web Design</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Website Markup</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>One Page</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Mobile Template</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Backend API</p>
                                    <div class="progress" style="height: 5px">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> 
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  
$('#image').change(function(e){
    var reader = new FileReader();
    reader.onload = function(e){
        $('.showImage').attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
    console.log(event.target.files[0].name);
});


 });

</script>

@endsection
