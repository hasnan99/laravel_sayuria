<!doctype html>
<html class="no-js" lang="en">

@extends('layout')

@section('content')
	
	<body>
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
		
		
	
		<!--welcome-hero start -->
		<header id="home" class="welcome-hero">

			<div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">

				<!--/.carousel-inner -->
				<div class="carousel-inner" role="listbox">
					<!-- .item -->
					<div class="item active">
						<div class="single-slide-item slide1">
							<div class="container">
								<div class="welcome-hero-content">
									<div class="row">
										<div class="col-sm-5">
											<div class="single-welcome-hero">
												<div class="welcome-hero-img">
													<img src="asset/images/foto_beranda1.png" alt="slider image">
												</div><!--/.welcome-hero-txt-->
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
										<div class="col-sm-7">
											<div class="single-welcome-hero">
												<div class="welcome-hero-txt">
													<h2>Platform Terbaik Untuk Menyediakan Kebutuhan Sayuran Anda</h2>
													<p>
														Lebih dari 50 macam sayuran tersedia di Sayuria, <br>
														dipetik langsung dari lahan perkebunan dengan  <br>
														standar terbaik se-Indonesia. Tunggu apa lagi! <br>
														Jelajahi Sayuria sekarang!
													</p>
												</div><!--/.welcome-hero-txt-->
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
									</div><!--/.row-->
								</div><!--/.welcome-hero-content-->
							</div><!-- /.container-->
						</div><!-- /.single-slide-item-->

					</div><!-- /.item .active-->

				</div><!-- /.carousel-inner-->

			</div><!--/#header-carousel-->

			<!-- top-area Start -->
			<div class="top-area">
				<div class="header-area">
					<!-- Start Navigation -->
				    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy sticked"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

				        <!-- Start Top Search -->
						<form action="{{route('cari')}}">
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
				                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
				                            <span class="lnr lnr-cart"></span>
											<span class="badge badge-bg-1">3</span>
				                        </a>
				                        <ul class="dropdown-menu cart-list s-cate">
				                            <li class="single-cart-list">
				                                <a href="#" class="photo"><img src="asset/images/collection/wortel.png" class="cart-thumb" alt="image" /></a>
				                                <div class="cart-list-txt">
				                                	<h6><a href="#">Wortel</a></h6>
				                                	<p>2 x - <span class="price">Rp, 7,300</span></p>
				                                </div><!--/.cart-list-txt-->
				                                <div class="cart-close">
				                                	<span class="lnr lnr-cross"></span>
				                                </div><!--/.cart-close-->
				                            </li><!--/.single-cart-list -->
				                            <li class="single-cart-list">
				                                <a href="#" class="photo"><img src="asset/images/collection/daun-bawang.png" class="cart-thumb" alt="image" /></a>
				                                <div class="cart-list-txt">
				                                	<h6><a href="#">daun bawang <br> konvensional</a></h6>
				                                	<p>4 x - <span class="price">Rp. 2,200</span></p>
				                                </div><!--/.cart-list-txt-->
				                                <div class="cart-close">
				                                	<span class="lnr lnr-cross"></span>
				                                </div><!--/.cart-close-->
				                            </li><!--/.single-cart-list -->
				                            <li class="single-cart-list">
				                                <a href="#" class="photo"><img src="asset/images/collection/edamame.png" class="cart-thumb" alt="image" /></a>
				                                <div class="cart-list-txt">
				                                	<h6><a href="#">Edamame</a></h6>
				                                	<p>1 x - <span class="price">Rp. 15,100</span></p>
				                                </div><!--/.cart-list-txt-->
				                                <div class="cart-close">
				                                	<span class="lnr lnr-cross"></span>
				                                </div><!--/.cart-close-->
				                            </li><!--/.single-cart-list -->
				                            <li class="total">
				                                <span>Total: Rp. 34,500</span>
				                                <button class="btn-cart pull-right" onclick="window.location.href='{{route('keranjang')}}'">view cart</button>
				                            </li>
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
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
											@php($profile = auth()->user()->profile)
											<img src="{{"storage/$profile"}}" alt="{{ auth()->user()->name }}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
											{{ auth()->user()->username }}
										</a>
										<div class="dropdown-menu dropdown-menu-end ">
											<ul style="color: black !important"  >
												<li><a class="dropdown-item" href="{{route('profile')}}">profile</a></li>
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
				                <a class="navbar-brand" href="{{route('beranda')}}" style="align:Left;">SAYURIA</a>

				            </div><!--/.navbar-header-->
				            <!-- End Header Navigation -->

				            <!-- Collect the nav links, forms, and other content for toggling -->
				            <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
				                <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
				                    <li class=" scroll active"><a href="{{route('beranda')}}">home</a></li>
				                    <li class="scroll"><a href="{{route('produk')}}">produk</a></li>
				                    <li class="scroll"><a href="#feature">tentang kami</a></li>
				                </ul><!--/.nav -->
				            </div><!-- /.navbar-collapse -->
				        </div><!--/.container-->
				    </nav><!--/nav-->
				    <!-- End Navigation -->
				</div><!--/.header-area-->
			    <div class="clearfix"></div>

			</div><!-- /.top-area-->
			<!-- top-area End -->

		</header><!--/.welcome-hero-->
		<!--welcome-hero end -->

		<!--sayur-populer start -->
		<section id="sayur-populer" class="sayur-populer" >
			<div class="container" >
			  <div class="section-header" >
				<h2>List Sayuran Terpopuler</h2>
			  </div><!--/.section-header-->
			  <div class="sayur-populer-content">
				<div class="row">
				  @foreach($data as $sayur)
				  <a href="detail/{{$sayur['id']}}">
				  <div class="col-sm-6 col-md-4 col-lg-4" >
					<div class="single-sayur-populer"  >
					  <div class="single-sayur-populer-bg">
						
						<img src="asset/images/collection/{{$sayur->gambar}}" alt="sayur-populer images">
						<div class="single-sayur-populer-bg-overlay"></div>
						<div class="sayur-populer-cart">
						  <p>
							<span class="lnr lnr-cart"></span>
							<a href="#">add <span>to </span> cart</a>
						  </p>
						  <p class="arrival-review pull-right">
							<span class="lnr lnr-heart"></span>
							<span class="lnr lnr-frame-expand"></span>
						  </p>
						</div>
					  </div>
					  <h4><a href="#">{{$sayur->nama_sayur}}</a></h4>
					  <p class="description">{{$sayur->deskripsi}}</p>
					  <p class="arrival-product-price">@currency($sayur->harga_sayur)</p>
					</div>
				  </div>
				  @endforeach
					</a>
				  <div >
					<a href="{{route('produk')}}" style="position:absolute; margin-top: 650px">See more produk</a>
				  </div>
				</div>
			  </div>
			</div><!--/.container-->
		  </section><!--/.sayur-populer-->


		
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->
        
    </body>
	
</html>