<title> Produk | Sayuria </title>

@extends('layout')

@section('content')
<!--welcome-hero start -->
<header id="produk" class="welcome-hero">
	<div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
		<img src="asset/images/produk-page.png" alt="sayuria image" class="imagediproduk">
	</div><!--/#header-carousel-->
</header><!--/.welcome-hero-->
<!--welcome-hero end -->

<!--sayur-populer start -->
<section id="sayur-populer" class="sayur-populer">
	<div class="container">
		<div class="sayur-populer-content">
			<div class="row">
				@foreach($data as $sayur)
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
			</div>
		</div>
	</div><!--/.container-->
</section><!--/.sayur-populer-->
<!--sayur-populer end -->
@endsection