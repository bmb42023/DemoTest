
@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                </ol>
            </nav>
        </div>

    </div>
 
  <div class="card">
							<div class="card-body p-4">
								<h5 class="mb-4">Add Category </h5>
								<form  id="myForm"   action=" {{route('store.category')}}"   method="post"    class="row g-3">
                                @csrf
									
                                <div class=" form-group col-md-6">
										<label for="input1" class="form-label">Category  Name</label>
										<input type="text" name="category_name"     class="form-control" id="input1" >
									</div>
                                    <div class="col-md-6">
</div>
                                    <div class="form-group   col-md-6">
										<label for="input2" class=" form-label">Category Image</label>
										<input type="file"  name="image" class="form-control" id="image" >
                                       
									</div>
									<div class="col-md-6">
                                    <img id="showImage"   src="{{ url('Upload/no_image.jpg')}}" 
                                    alt="Admin" class="  rounded-circle p-1 bg-primary" width="80">
                                     </div>   

							      <!--   $dd($request)  -->
                                    <div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="submit" class="btn btn-primary px-4">Save</button>
										</div>
									</div>
									
									
									
								</form>
							</div>
						</div> 

    
    
  
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                category_name: {
                    required : true,
                }, 
                image: {
                    required : true,
                }, 
                
            },
            
            messages :{
                category_name: {
                    required : 'Please Enter Category_Name',
                }, 
                image: {
                    required : 'Please Select  image',
                },    

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

<script type="text/javascript">
$(document).ready(function(){
  
$('#image').change(function(e){
    var reader = new FileReader();
    reader.onload = function(e){
        $('#showImage').attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
    console.log(event.target.files[0].name);
});


 });

</script>

@endsection







