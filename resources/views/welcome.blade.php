<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body class="antialiased">
        <div class="col-md-4">
            @foreach($sayur as $sayur)
            <div class="product item">
                <a><img src="asset/images/collection/{{$sayur->gambar}}"height="300" width="300"></a>
            <div class="down-content">
                <a>{{$sayur->nama_sayur}}</a>
                
                <p>{{$sayur->deskripsi}}
                <h6>{{$sayur->harga_sayur}}</h6>
            </div>
            </div>
            @endforeach
        </div>
    </body>
</html>
