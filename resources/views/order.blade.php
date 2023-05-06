<!doctype html>
<html class="no-js" lang="en">
	<?php
	use App\Http\Controllers\KeranjangController;
	$jumlah=KeranjangController::list_item();
	?>
	
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
        <link rel="stylesheet" href="order/css/font-awesome.min.css">

        <!--linear icon css-->
		<link rel="stylesheet" href="order/css/linearicons.css">

		<!--animate.css-->
        <link rel="stylesheet" href="order/css/animate.css">

        <!--owl.carousel.css-->
        <link rel="stylesheet" href="order/css/owl.carousel.min.css">
		<link rel="stylesheet" href="order/css/owl.theme.default.min.css">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="order/css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="order/css/bootsnav.css" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="order/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="order/css/responsive.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		
    </head>
	
	<body>
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
		
		
	
		<!--welcome-hero start -->
		<nav class="navbar navbar-default">
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
		</nav>

		<div class="row">
			<div class="col-75">
			  <div class="container">
				<form action="orderplace" method="POST">
					@csrf
				  <div class="row">
					<div class="col-50">
					  <h3>Data Penerima</h3>
					  <label for="fname"><i class="fa fa-user"></i> Nama Penerima</label>
					  <input type="text" id="fname" name="name"  value="{{ auth()->user()->nama_depan }} {{ auth()->user()->nama_belakang }} ">
					  <label for="adr"><i class="fa fa-address-card-o"></i> Alamat</label>
					  <input type="text" id="adr" name="alamat"  value="{{ auth()->user()->alamat}}">
					  <label for="city"><i class="fa fa-institution"></i> Kota</label>
					  <input type="text" id="city" name="city" placeholder="Bandung">
					  <div class="row">
						<div class="col-50">
						  <label for="state">Provinsi</label>
						  <input type="text" id="state" name="state" placeholder="Jawa Barat">
						</div>
						<div class="col-50">
						  <label for="zip">Kode Pos</label>
						  <input type="text" id="zip" name="zip" placeholder="40287">
						</div>
					  </div>
					</div>
                    
					<div class="col-50">
					  <h3>Payment</h3>
					  <label for="fname">Metode Pembayaran</label>
					  <div class="icon-container">
						<input type="radio" id="COD" name="payment" value="COD">
						<label for="COD"><i class='fa fa-truck' style='font-size:36px'></i> COD</label>
						<input type="radio" id="TFB" name="payment" value="TFB">
						<label for="TFB"><i class="fa fa-bank" style="font-size:36px"></i> Transfer Bank</label>
					  </div>
					</div>
		  
				  </div>
				  <input type="submit" value="Bayar" class="btn">
				</form>
			  </div>
			</div>
		  
			<div class="col-25">
			  <div class="container">
				<h4>Ringkasan pembayaran
				  <span class="price" style="color:black">
					<i class="fa fa-shopping-cart"></i>
					<b>{{$jumlah}}</b>
				  </span>
				</h4>
				<p><a href="#">Total Belanja</a> <span class="price">@currency($total)</span></p>
				<p><a href="#">Biaya Pengiriman</a> <span class="price">Rp. 15,000</span></p>
				<p><a href="#">Biaya Layanan</a> <span class="price">Rp. 2,500</span></p>
				<hr>
				<p>Total Tagihan <span class="price" style="color:black"><b>@currency($total+15000+2500)</b></span></p>
			  </div>
			</div>
		  </div>
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

		
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="order/js/jquery.js"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="order/js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="order/js/bootsnav.js"></script>

		<!--owl.carousel.js-->
        <script src="order/js/owl.carousel.min.js"></script>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		
        
        <!--Custom JS-->
        <script src="order/js/custom.js"></script>
        
    </body>
	
</html>