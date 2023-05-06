<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile Saya</title>
   <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

</head>
@extends('layout')

@section('content')
<body>
    <div class="row d-flex justify-content-center" style=" position: relative; margin-top: 10%;" id="div-body">
        <div class="container mt-4 text-center" >
            <form method="POST" id="profile_setup_frm" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            @php($profile = auth()->user()->profile)
                            <img class="rounded-circle mt-5" height="250" width="250" src="
                            @if($profile == null) {{ ("asset/images/avatar.jpg") }}  
                            @else {{ ("storage/$profile") }} 
                            @endif" id="image_preview_container">
                            <span class="font-weight-bold">
                                <input type="file" name="profile" id="profile_image"  class="form-control">
                            </span>
                        </div>
                    </div>
                    <div class="col-md-8 border-right">
                        <h4 class="text-center" style="align-items: center ;">Profile Saya</h4>
                        <div class="p-3 py-5">
                            <div class="row" id="res"></div>
                            <div class="row mt-2"> 
                                <div class="col-md-6">
                                    <label class="labels">Nama Depan</label>
                                    <input type="text" name="nama_depan" class="form-control" placeholder="first name" value="{{ auth()->user()->nama_depan }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Nama Belakang</label>
                                    <input type="text" name="nama_belakang" class="form-control" placeholder="first name" value="{{ auth()->user()->nama_belakang }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Email</label>
                                    <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ auth()->user()->username }}" placeholder="Username">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Alamat</label>
                                    <textarea name="alamat" class="form-control">{{ auth()->user()->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="mt-5 text-center"><button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                        </div>
                    </div>
                </div>   
            </form>
        </div>
    </div>
<script>
   $(document).ready(function(){
 $("#profile_image").change(function(){
     let reader = new FileReader();
     reader.onload = (e) => {
         $("#image_preview_container").attr('src', e.target.result);
     }
     reader.readAsDataURL(this.files[0]);
 })

 $("#profile_setup_frm").submit(function(e){
     e.preventDefault();
     var formData = new FormData(this);
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $("#btn").attr("disabled", true);
     $("#btn").html("Updating...");
     $.ajax({
         type:"POST",
         url: this.action,
         data: formData,
         cache:false,
         contentType: false,
         processData: false,
         success: (response) => {
             if (response.code == 400) {
                 let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                 $("#res").html(error);
                 $("#btn").attr("disabled", false);
                 $("#btn").html("Save Profile");
             }else if(response.code == 200){
                 let success = '<span class="alert alert-success">'+response.msg+'</span>';
                 $("#res").html(success);
                 $("#btn").attr("disabled", false);
                 $("#btn").html("Save Profile");
                 $('#myDiv').load(' #myDiv');
                 $("#div-body").load(location.href+" #div-body>*",""); 
                 $("#div-nav").load(location.href+" #div-nav>*",""); 
             }
         }
     })
 })
})
</script>
<script src="asset/js/jquery.js"></script>
        
<!--modernizr.min.js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

<!--bootstrap.min.js-->
<script src="/asset/js/bootstrap.min.js"></script>

<!-- bootsnav js -->
<script src="asset/js/bootsnav.js"></script>

<!--owl.carousel.js-->
<script src="asset/js/owl.carousel.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>


<!--Custom JS-->
<script src="asset/js/custom.js"></script>
</body>
</html> 