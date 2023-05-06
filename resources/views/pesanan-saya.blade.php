<title> Pesanan Saya </title>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

@extends('layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--welcome-hero start -->
<header >
    <style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20%;
            margin-bottom: 20%;
		}
		th, td {
            align-text: center;
			padding: 8px;
            
			text-align: left;
			color: black;
		}
		.total {
			font-weight: bold;
		}
        nav{
            background-color:#7CC644; 
        }
	</style>
	
</header><!--/.welcome-hero-->
<body>
    <table id="keranjang" border="1px">
		<tr>
            <th>Nama Sayur</th>
            <th>Nama Penerima</th>
            <th>quantity</th>
            <th>Status</th>
            <th>Metode Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Alamat</th>
            <th>Bukti</th>
		</tr>
		<tr>
            @foreach($order as $details)
            <th>{{$details->item_sayur->nama_sayur}}</th>
            <th>{{$details->nama_penerima}}</th>
            <th>{{$details->quantity}}</th>
            <th>{{$details->status}}</th>
            <th>{{$details->metode_pembayaran}}</th>
            <th>{{$details->status_pembayaran}}</th>
            <th>{{$details->alamat}}</th>
            <th><img src="{{$details->bukti}}"> </th>
        </tr>
        @endforeach

	</table>
</body>
<!--welcome-hero end -->
@endsection
