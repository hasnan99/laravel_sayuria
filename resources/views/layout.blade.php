<!DOCTYPE html>
<html lang="en">
	<?php
	use App\Http\Controllers\KeranjangController;
	use App\Models\keranjang;
	?>
@if (!Auth::guest())
	<?php
	$jumlah=KeranjangController::list_item();
	$user_id = auth()->user()->id;
	$keranjang = keranjang::where('user_id', $user_id)->get();
	?>
@else
       
@endif
	
    <head>
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        
        <!-- title of site -->
        <title>Sayuria</title>

       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="asset/css/font-awesome.min.css">

        <!--linear icon css-->
		<link rel="stylesheet" href="asset/css/linearicons.css">

		<!--animate.css-->
        <link rel="stylesheet" href="asset/css/animate.css">

        <!--owl.carousel.css-->
        <link rel="stylesheet" href="asset/css/owl.carousel.min.css">
		<link rel="stylesheet" href="asset/css/owl.theme.default.min.css">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="asset/css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="asset/css/bootsnav.css" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="asset/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="asset/css/responsive.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="asset/js/jquery.js"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="asset/js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="asset/js/bootsnav.js"></script>

		<!--owl.carousel.js-->
        <script src="asset/js/owl.carousel.min.js"></script>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		
        
        <!--Custom JS-->
        <script src="asset/js/custom.js"></script>
    </head>
    <body>
        <!-- top-area Start -->
			<div class="top-area">
				<div class="header-area">
					<!-- Start Navigation -->
				    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy sticked"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

				        <!-- Start Top Search -->
						<form action = "{{route('cari')}}">
				        	<div class="top-search">
				            	<div class="container">
				                	<div class="input-group">
				                    	<span class="input-group-addon"><i class="fa fa-search"></i></span>
				                    	<input type="text" class="form-control" placeholder="Search" name="produk">
				                    	<span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
				                	</div>
				            	</div>
				        	</div>
						</form>
				        <!-- End Top Search -->

				        <div class="container">            
				            <!-- Start Atribute Navigation -->
				            <div class="attr-nav">
				                <ul>
									<li class="search">
				                		<a href="#"><span class="lnr lnr-magnifier"></span></a>
				                	</li><!--/.search-->
				                    <li class="dropdown">
										<a href="{{route('keranjang')}}" class="dropdown-toggle" data-toggle="dropdown" >
											@if(!Auth::guest())
											<span class="lnr lnr-cart"></span>
											<span class="badge badge-bg-1">{{$jumlah}}</span>
											@endif
										</a>    
										<ul class="dropdown-menu cart-list s-cate">
											@if (!Auth::guest())
											@php $total = 0 @endphp
											@foreach($keranjang as $cart)
											@php $total_per_sayur = $cart->item_sayur->harga_sayur * $cart->quantity @endphp
											@php $total += $total_per_sayur @endphp
											<li class="single-cart-list">
				                                <a href="#" class="photo"><img src="asset/images/collection/{{ $cart->item_sayur->gambar }}" class="cart-thumb" alt="image" /></a>
				                                <div class="cart-list-txt">
				                                	<h6><a href="#">{{$cart->item_sayur->nama_sayur}}</a></h6>
				                                	<p>{{$cart->quantity}} x -<span class="price">@currency($cart->item_sayur->harga_sayur)</span></p>
				                                </div><!--/.cart-list-txt-->
				                            </li><!--/.single-cart-list -->
											@endforeach
											<li class="total">
				                                <span>@currency($total)</span>
				                                <button class="btn-cart pull-right" href='{{route('keranjang')}}'>view cart</button>
				                            </li>
											@else
											@endif
											
										</ul>
				                        
				                    </li><!--/.dropdown-->

									@guest
									<li class="log">
										<a class="log" href="{{ route('login') }}">Login</a>
									</li>
									<li class="reg">
										<a class="reg" href="{{ route('register') }}">Register</a>
									</li>
									@endguest
									
									@auth
									<li class="nav-item dropdown" id="div-nav">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black" >
											@php($profile = auth()->user()->profile)
											<img src="{{"storage/$profile"}}" alt="{{ auth()->user()->name }}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
											{{ auth()->user()->username }}
										</a>
										<div class="dropdown-menu dropdown-menu-end ">
											<ul style="color: black "  >
												<li><a class="dropdown-item" href="{{route('profile')}}">profile</a></li>
												<li><a class="dropdown-item" href="{{route('pesanan-saya')}}">Pesanan Saya</a></li>
												<li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
											</ul>
										</div>
									  </li>
									@endauth
				                </ul>
				            </div><!--/.attr-nav-->
				            <!-- End Atribute Navigation -->

				            <!-- Start Header Navigation -->
				            <div class="navbar-header">
				                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
				                    <i class="fa fa-bars"></i>
				                </button>
				                <a class="navbar-brand" href="{{route('beranda')}}">SAYURIA</a>

				            </div><!--/.navbar-header-->
				            <!-- End Header Navigation -->

				            <!-- Collect the nav links, forms, and other content for toggling -->
				            <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
				                <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
				                    <li class="{{ Request::is('beranda')? 'active' : '' }}">
										<a href="{{ route('beranda') }}">home</a>
									</li>
				                    <li class="{{ Request::is('produk')? 'active' : '' }}">
										<a href="{{ route('produk') }}">produk</a>
									</li>
				                    <li >
										<a href="{{route('tentangKami')}}">tentang kami</a>
									</li>
				                </ul><!--/.nav -->
				            </div><!-- /.navbar-collapse -->
				        </div><!--/.container-->
				    </nav><!--/nav-->
				    <!-- End Navigation -->
				</div><!--/.header-area-->
			    <div class="clearfix"></div>

			</div><!-- /.top-area-->
			<!-- top-area End -->
			<div class="container">
   
				@if(session('success'))
					<div class="alert alert-success">
					  {{ session('success') }}
					</div> 
				@endif
			   
				@yield('content')
			</div>
			<!--newsletter strat -->
		<section id="newsletter"  class="newsletter"  style="background-color:#7CC644;">
			<div class="container">
				<div class="hm-footer-details">
					<div class="row">
						<div class=" col-md-3 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4>Address</h4>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-menu">
									<p>
										Jalan Komplek Permata Buah Batu <br>
										No. A12, Lengkong, Bojongsoang, <br>
										Kabupaten Bandung, Jawa Barat, <br>
										Indonesia. 40287 
									</p>
								</div><!--/.hm-foot-menu-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
						<div class=" col-md-3 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<a href="#">Tentang Kami</a>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-menu">
								</div><!--/.hm-foot-menu-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
						<div class=" col-md-3 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4>Kontak Kami</h4>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-menu">
									<p>
										+62 812 2248 4170 <br>
										sayuriaapp55@gmail.com
									</p>
								</div><!--/.hm-foot-menu-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
						<div class=" col-md-3 col-sm-6  col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4>Media Sosial</h4>
								</div>
								<div class="footer-social">
									<a href="https://id-id.facebook.com/" target="_blank"><i class="fa fa-facebook"></i>sayuria_app</a>	<br>
									<a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i>sayuria_app</a>
								</div>
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
					</div><!--/.row-->
				</div><!--/.hm-footer-details-->

			</div><!--/.container-->

		</section><!--/newsletter-->	
		<!--newsletter end -->
			@yield('scripts')
    </body>
</html>