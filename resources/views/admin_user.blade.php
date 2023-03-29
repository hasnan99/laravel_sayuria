<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="background-color:  #7CC644">
          <a class="navbar-brand" href="#">Sayuria</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('admin')}}">Produk</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.user')}}">User</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                  {{$username}}
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('logout.admin')}}">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</header>
     
    <div class="container">
      <div class="row">
          <div class="col-12 table-responsive">
          <br/>
          <h3 align="center">Data User</h3>
          <br/>
          <br />
              <table class="table table-striped table-bordered user_datatable"> 
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th width="180px">Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
          </div>
      </div>
   
      <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
          <form method="post" id="sample_form" class="form-horizontal">
              <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
              </div>
          </form>  
          </div>
          </div>
      </div>
   
  </div>

</body>
     
<script type="text/javascript">
 $(document).ready(function() {
    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.user') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama_depan', name: 'nama_depan'},
            {data: 'nama_belakang', name: 'nama_belakang'},
            {data: 'email', name: 'email'},
            {data: 'username', name: 'username'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    var user_id;
    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });
 
    $('#ok_button').click(function(){
        $.ajax({
            url:"destroy/user/"+user_id,
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },
            success:function(data){
                setTimeout(function(){
                $('#confirmModal').modal('hide');
                $('.user_datatable').DataTable().ajax.reload();
                $('#ok_button').text('Ok')
                alert('Data Deleted');
                }, 2000);
            }
        })
    });
  });
</script>
</html>