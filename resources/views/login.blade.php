<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <style>
  body {
  background-color:  #7CC644; /* fallback for old browsers */
  }
  table{
    background-color:white;
    margin-left: auto;
    margin-right: auto;
    margin-top:150px;
  }
  h4{
    text-align: center;
  }
  p{
    text-align: center;
  }
  #input{
    background-color:#D6D6D6;
  }
  ::placeholder{
    color:black;
    font-weight: bold;
  }
  .colom_form{
    width:50%;
    
  }
  .login{
    width:60%;
    margin-left:100px;
  }
  .btn_login{
    margin-top:30px;
    background-color:#D6D6D6;
    margin: 0 auto;
    display: block;
    border-radius: 10px;
    border: none;
    width:40%;
    height: 40px;
  }
  a{
    color:black;
    text-decoration: none;
    font-weight: bold;
  }
  </style>
</head>
<body>
  <div class="mt-5">
    @if (session('success'))
    <div class="alert alert-success">
      <p>{{ session('success') }}</p>
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @endif
  </div>
  <table>
     <tr>
      <td>
      <img src="asset/fotologin.png" class="img-fluid" >
      </td>
      <td class="colom_form">
        <h4>Login</h4>
        <p>Selamat Datang! Silakan login agar Anda <br> dapat melakukan aktivitas belanja di <br>Sayuria
        <form class=login action="{{route('login.post')}}" method="POST">
        @csrf 
        <input type="text" class="form-control" id="input" placeholder="Username atau Email" name="login_id"><br>
        @error('login_id')
          <span class="text-danger">{{$message}}</span>
        @enderror
        <input type="password" id="input" class="form-control" placeholder="Password" name=password><br>
        @error('password')
        <span class="text-danger">{{$message}}</span>
      @enderror
        <input type="submit" value="Masuk" class="btn_login"><br>
        <p>Belum memiliki akun? <a href="{{ route('register') }}">Registrasi</a>
        </form>
      </td>
     </tr>
  </table>
</body>
</html>

