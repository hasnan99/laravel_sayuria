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
                  <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.order')}}">order</a>
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
          <h3 align="center">Data Order</h3>
          <br/>
          <br />
              <table class="table table-striped table-bordered order_datatable"> 
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama Penerima</th>
                        <th>Nama Sayur</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Alamat</th>
                        <th>Bukti</th>
                        <th width="180px">Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
          </div>
      </div>
   
      <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" id="sample_form" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <div class="form-group">
                    <label>Nama Penerima : </label>
                    <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" disabled />
                </div>
                <div class="form-group">
                  <label>Nama Sayur : </label>
                  <input type="text" name="nama_sayur" id="nama_sayur" class="form-control" disabled />
              </div>
              <div class="form-group">
                <label>Quantity : </label>
                <input type="text" name="quantity" id="quantity" class="form-control" disabled />
            </div>
            <div class="form-group">
              <label>status : </label><br>
              <select id="status" name="status">
                <option value="Pending">Pending</option>
                <option value="pengantaran">pengantaran</option>
                <option value="Selesai">Selesai</option>
              </select>
            </div>
            <div class="form-group">
              <label>Metode Pembayaran : </label>
              <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="form-control" disabled />
            </div>
            <div class="form-group">
              <label>Status Pembayaran : </label><br>
              <select id="status_pembayaran" name="status_pembayaran">
                <option value="Pending">Pending</option>
                <option value="verifikasi">Di Verifikasi</option>
              </select>
            </div>
            <div class="form-group">
              <label>Alamat : </label>
              <input type="text" name="alamat" id="alamat" class="form-control" disabled />
            </div>
                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" name="action_button" id="action_button" value="Add" class="btn btn-info" />
            </div>
        </form>  
        </div>
        </div>
    </div>
   
  </div>

</body>
     
<script type="text/javascript">
 $(document).ready(function() {
    var table = $('.order_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.order') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama_penerima', name: 'nama_penerima'},
            {data: 'nama_sayur', name: 'nama_sayur'},
            {data: 'quantity', name: 'quantity'},
            {data: 'status', name: 'status'},
            {data: 'metode_pembayaran', name: 'metode_pembayaran'},
            {data: 'status_pembayaran', name: 'status_pembayaran'},
            {data: 'alamat', name: 'alamat'},
            {data: 'bukti', name: 'bukti',render:function(data,type,full,meta){
              return '<img src="http://127.0.0.1:8000/' + data + '" height="50"/>';
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#sample_form').on('submit', function(event){
        event.preventDefault(); 
        var action_url = '';
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('admin.order.update') }}";
        }
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: action_url,
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data) {
                console.log('success: '+data);
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if(data.success){
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#sample_form')[0].reset();
                    $('.order_datatable').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    });

    $(document).on('click', '.edit', function(event){
        event.preventDefault(); 
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url :"order/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            success:function(data)
            {
                console.log('success: '+data);
                $('#nama_penerima').val(data.result.nama_penerima);
                $('#nama_sayur').val(data.result.item_sayur.nama_sayur);
                $('#quantity').val(data.result.quantity);
                $('#status').val(data.result.status);
                $('#metode_pembayaran').val(data.result.metode_pembayaran);
                $('#status_pembayaran').val(data.result.status_pembayaran);
                $('#alamat').val(data.result.alamat);
                $('#hidden_id').val(id);
                $('.modal-title').text('Edit Order');
                $('#action_button').val('Update');
                $('#action').val('Edit'); 
                $('.editpass').hide(); 
                $('#formModal').modal('show');
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        })
    });

  });
</script>
</html>