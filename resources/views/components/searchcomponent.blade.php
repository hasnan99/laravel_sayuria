<!doctype html>
<html class="no-js" lang="en">

    <head>
        
    </head>
@extends('layout')

@section('content')
	<body>
	
		<!--sayur-populer start -->
		<section id="sayur-populer" class="sayur-populer" >
			<div class="container" >
			  <div class="section-header" >
				<h2>Hasil Pencarian</h2>
			  </div><!--/.section-header-->
			  <div class="sayur-populer-content">
				<div class="row">
                @if(is_array($produk) || is_object($produk))
				  @foreach($produk as $sayur)
				  <div class="col-md-3 col-sm-4">
					<div class="single-sayur-populer">
						<div class="single-sayur-populer-bg">
							<img src="asset/images/collection/{{$sayur->gambar}}" alt="sayur-populer images">
								<div class="single-sayur-populer-bg-overlay"></div>
									<div class="sayur-populer-cart">
										<p>
											<span class="lnr lnr-cart"></span>
											<a href="{{route('addToKeranjang', $sayur->id)}}">add <span>to </span> cart</a>
											
										</p>
										<p class="arrival-review pull-right">
											<span>
												<a href="{{route('detail', $sayur->id)}}">+info</a>
											</span>
											<span class="lnr lnr-heart"></span>
											<span class="lnr lnr-frame-expand"></span>
										</p>
									</div>
						</div>
						<h4><a href="{{route('detail', $sayur->id)}}">{{$sayur->nama_sayur}}</a></h4>
						<p class="arrival-product-price">Harga: @currency($sayur->harga_sayur)</p>
						<p class="arrival-product-price">Stock: {{$sayur->stock}} </p>	
					</div>
				</div>
				  @endforeach
                  @else
                        <div style="text-align: center; margin-top: 50px;">
                            <h3>Maaf, Sayur yang Anda cari tidak ditemukan.</h3>
                            <p>Silakan coba kata kunci yang lain atau cari produk lainnya.</p>
                            <img src="asset/images/product_not_found.jpeg" alt="Gambar Produk Tidak Ditemukan" style="max-width: 400px;">
                        </div>
                  @endif
				</div>
			  </div>
			</div><!--/.container-->
		  </section><!--/.sayur-populer-->

		<!--newsletter strat -->
		<section id="newsletter"  class="newsletter" style="background-color:#7CC644;">
			<div class="container">
				<div class="hm-footer-details">
					<div class="row">
						<div class=" col-md-3 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4 style="color:black;">Address</h4>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-menu">
									<p style="color:black;">
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
									<a href="#">Tentang Kami</a>
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

		
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="asset/js/jquery.js"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
		
		<!-- bootsnav js -->
		<script src="asset/js/bootsnav.js"></script>

		<!--owl.carousel.js-->
        <script src="asset/js/owl.carousel.min.js"></script>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		
        
        <!--Custom JS-->
        <script src="asset/js/custom.js"></script>
        
    </body>
	
</html>