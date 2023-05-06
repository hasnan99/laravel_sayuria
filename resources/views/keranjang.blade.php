
@extends('layout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="asset/css/keranjang.css">
<style>
	table {
		border-collapse: collapse;
		width: 100%;
		margin-bottom: 20px;
		margin-top: 200px;
	}
	th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}
	.total {
		font-weight: bold;
	}
</style>
<body>
	<table>
		<tr>
      <th>Gambar</th>
			<th>Produk</th>
			<th>Harga</th>
			<th>Jumlah (Kg)</th>
			<th>Total</th>
			<th></th>
		</tr>
		<tr>
		<form method="POST" action="{{route("updateKeranjang")}}">
			@csrf
			@php $total = 0 @endphp
            @foreach($keranjang as $details)
			@php $total_per_sayur = $details->item_sayur->harga_sayur * $details->quantity @endphp
            @php $total += $total_per_sayur @endphp
      <td><img src="asset/images/collection/{{ $details->item_sayur->gambar }}" alt="Produk 1" class="gmbar_prdk"></td>
			<td>{{ $details->item_sayur->nama_sayur }}</td>
			<td>@currency($details->item_sayur->harga_sayur) </td>
			<td>
				<input type="hidden" name="sayur_id[]" class="sayur_id" value="{{$details->sayur_id}}">
				<input type="number" name="quantity[]" class="quantity" value="{{ $details->quantity }}">
			</td>
			<td>@currency($total_per_sayur)</td>
			<td>
				<form>
					<a><button class="cart_remove" data-id="{{$details->id}}">Hapus</button><br></a>
				</form>
				<button>Update</button>
			</td>
		</tr>
		@endforeach
		<tr class="total">
			<td colspan="4">Total</td>
			<td>@currency($total)</td>
			<td></td>
		</tr>
	</form>
	</table>
	
	<h2>Checkout</h2>
	<form action="{{route('order-detail')}}">
		<label for="pengiriman">Pengiriman:</label>
		<select id="pengiriman">
			<option value="5000">Gosend</option>
			<option value="10000">Grab Express</option>
		</select>
		<br>
		<button type="submit" style="margin-left: 40%">Checkout</button>
	</form>
</body>
<script>
	$(document).ready(function() {
	  $(".cart_remove").click(function() {
		var id = $(this).data("id");
		$.ajax({
		  url: "removeFromKeranjang/"+id,
		  type: "GET",
		  success: function(data) {
			window.location.href = "{{route('keranjang')}}";
		  },
		  error: function(data) {
			console.log("Error:", data);
		  }
		});
	  });
	});
</script>
@endsection

