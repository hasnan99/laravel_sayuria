<Title> Tentang Kami | Sayuria</Title>
@extends('layout')

@section('content')
<!-- About Us Fill Start -->
<section class="aboutus">
	<h1>Tentang Kami</h1>
	<div class="container">
		<div class="text">
			<p>
                Sayuria  merupakan platform untuk membeli sayuran kesukaan Anda. 
				Lebih dari 50 jenis sayuran segar yang berasal dari berbagai daerah
				di Indonesia tersedia di sini. Cukup dengan menekan tombol-tombol 
				dalam aplikasi ini, Anda bisa mendapatkan semua sayuran yang 
				Anda inginkan!
			</p>
            <div class="button">
			    <a href="{{route('beranda')}}">Berbelanja Sekarang</a>
		    </div>
        </div>
	    <img src="/asset/images/Gambar belanjaan.png" alt="Gambar Orang Belanja">
    </div>
</section><!-- /.ab-->
<!-- About Us Fill End -->
@endsection
