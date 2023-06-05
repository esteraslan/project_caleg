@extends('layouts.app')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0">TPS</h1>
      </div>
      <div class="col-sm-6">
        
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">List Data TPS</h3>
              <div class="card-tools">
                <button class="btn btn-primary btn-sm" id="btn_add"><i class="fa fa-plus"></i> Add</button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-hover">
                <thead>
                    <tr>
                      <th width="50">#</th>
                      <th>Nama TPS</th>
                      <th>Alamat</th>
                      <th>Status</th>
                      <th width="70">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="myModal2">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title1">Tambah Data TPS</h4>
        <h4 class="modal-title" id="title2">Edit Data TPS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <div class="col-12" id="alert"></div>
            <label class="col-sm-3 col-form-label">Nama TPS:</label>
            <div class="col-sm-9">
                <input type="hidden" id="iddata" class="form-control" required>
                <input type="text" id="nama" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-3 col-form-label">Provinsi :</label>
            <div class="col-sm-9">
              <select style="width: 100%;" id="prov" class="form-control form-control-sm select2" required>
              </select>
            </div>

            <label class="col-sm-3 col-form-label">Kota/Kabupaten :</label>
            <div class="col-sm-9">
              <select style="width: 100%;" id="kab" class="form-control form-control-sm select2" required>
              </select>
            </div>

            <label class="col-sm-3 col-form-label">Kecamatan :</label>
            <div class="col-sm-9">
              <select style="width: 100%;" id="kec" class="form-control form-control-sm select2" required>
              </select>
            </div>

            <label class="col-sm-3 col-form-label">Desa/Kelurahan :</label>
            <div class="col-sm-9 mb-2">
              <select style="width: 100%;" id="desa" class="form-control form-control-sm select2" required>
              </select>
            </div>

            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
              <select style="width: 100%;" id="sts" class="form-control form-control-sm select2" required>
                <option value="" selected>- pilih -</option>
                <option value="1">Aktif</option>
                <option value="2">Tidak Aktif</option>
              </select>
            </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary Update">Update</button>
          <button type="button" class="btn btn-primary Save">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
      $(document).ready(function(){
          list();
      });

      function list(){
        var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: false,
                searching: true,
                bLengthChange: true,
                destroy: true,
                pageLength: 10,
                ajax: {
                    url: "{{ route('paslon.list') }}"
                },
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        render: function(data) {
                          return '<img src="dist/img/paslon/'+data+'" width="50" height="60" class="img-thumbnail"/>';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'partai',
                        name: 'partai'
                    },
                    {
                        data: 'sts',
                        name: 'sts',
                        render: function(data) {
                          if(data == 1){
                            return 'Calon Utama';
                          }else{
                            return 'Calon Lawan';
                          }
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function (data) {
                          return '<a href="#" id="btn_edit" title="Edit" data-id="'+data+'" class="btn btn-warning btn-sm">'+
                                    '<i class="fas fa-pencil-alt"></i>'+
                                '</a>'+
                                '<a href="#" id="btn_delete" title="Delete" data-id="'+data+'" class="btn btn-danger btn-sm ml-1">'+
                                    '<i class="far fa-trash-alt"></i>'+
                                '</a>';
                        }
                    }
                ],
                columnDefs: [{
                    "targets": [0],
                    "orderable": false,
                }],
                responsive: true,
                fixedColumns: true,
                oLanguage: {
                    sProcessing: '<img src="{{asset('dist/img/Hourglass.gif')}}">Loading . . .'
                }
        });
      }
  
      $(document).on("click", "#btn_add", function () {
          $('#myModal2').modal({ backdrop: 'static', keyboard: false, show: true });
          $(".Save").show();
          $("#title1").show();
          $(".Update").hide();
          $("#title2").hide();
      });

      $(document).on("click", ".close", function () {
        clear();
      });

      function clear(){
          $("#id").val('');
          $("#nama").val('');
          $("#partai").val('');
          $("#no_urut").val('');
          $("#sts").val('').trigger('change');
          $("#gambar").val('');
          imageView.src = "{{ asset('dist/img/bg_upload.png'); }}";
      }

      $(document).on("click", ".Save", function () {
          $('#myModalLoading').modal({ backdrop: 'static', keyboard: false, show: true });
          $('#myModal2').modal('hide');
          var files = $('#gambar')[0].files;
          if(files.length > 0){
              var fd = new FormData();
              // Append data 
              fd.append('nama', nama.value);
              fd.append('partai', partai.value);
              fd.append('no_urut', no_urut.value);
              fd.append('sts', sts.value);
              fd.append('gambar', files[0]);
              fd.append('_token', '{{csrf_token()}}');
              // Hide alert 
              $('#responseMsg').hide();
              // AJAX request 
              if(validasi()){
                $.ajax({
                    url: "{{route('paslon.store')}}",
                    method: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(result){
                        if(result.success){
                            list();
                            clear();
                            $("#myModalLoading").modal('hide');
                            SweetAlert.fire({
                                icon: 'success', title: 'Success', text: result.msg, showConfirmButton: false, timer: 1500
                            });
                        }else{
                            clear();
                            $("#myModalLoading").modal('hide');
                            SweetAlert.fire({
                                icon: 'error', title: 'Error', text: result.msg, showConfirmButton: false, timer: 50000
                            });
                        }
                    }
                });
              }
          }else{
              $("#myModalLoading").modal('hide');
              SweetAlert.fire({
                  icon: 'error', title: 'Error', text: 'Silahkan pilih file.', showConfirmButton: false, timer: 5000
              });
          }
      });

      $(document).on("click", "#btn_edit", function () {
          $(".Save").hide();
          $("#title1").hide();
          $(".Update").show();
          $("#title2").show();
          var id = $(this).data('id');
          $.ajax({
              type: 'GET',
              url: "{{route('paslon.edit')}}",
              data: {
                      id: id,
                      _token: '{{csrf_token()}}'
                  },
              success: function(result) { 
                  if(result.success){
                      $('#myModal2').modal({ backdrop: 'static', keyboard: false, show: true });
                      $("#iddata").val(result.id);
                      $("#nama").val(result.nama);
                      $("#partai").val(result.partai);
                      $("#no_urut").val(result.no_urut);
                      $("#sts").val(result.sts).trigger('change');
                      imageView.src = '{{asset('dist/img/paslon')}}/'+result.gambar;
                  }else{
                      SweetAlert.fire({
                          icon: 'warning', title: 'Warning', text: result.msg, showConfirmButton: false, timer: 1500
                      });
                  }
              }
              });
      });

      $(document).on("click", ".Update", function () {
          $('#myModalLoading').modal({ backdrop: 'static', keyboard: false, show: true });
          $('#myModal2').modal('hide');
          var files = $('#gambar')[0].files;
          var fd = new FormData();
          // Append data 
          fd.append('id', iddata.value);
          fd.append('nama', nama.value);
          fd.append('partai', partai.value);
          fd.append('no_urut', no_urut.value);
          fd.append('sts', sts.value);
          fd.append('gambar', files[0]);
          fd.append('_token', '{{csrf_token()}}');
          // Hide alert 
          $('#responseMsg').hide();
          // AJAX request 
          if(validasi()){
            $.ajax({
                url: "{{route('paslon.update')}}",
                method: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(result){
                    if(result.success){
                        list();
                        clear();
                        $("#myModalLoading").modal('hide');
                        SweetAlert.fire({
                            icon: 'success', title: 'Success', text: result.msg, showConfirmButton: false, timer: 1500
                        });
                    }else{
                        clear();
                        $("#myModalLoading").modal('hide');
                        SweetAlert.fire({
                            icon: 'error', title: 'Error', text: result.msg, showConfirmButton: false, timer: 50000
                        });
                    }
                }
            });
          }
      });

      function validasi(){
          if(nama.value != '' && partai.value != '' && no_urut.value != ''){
              return true;
          }else{
              SweetAlert.fire({
                  icon: 'error', title: 'Error', text: 'Kolom Nama, Partai & No Urut tidak boleh kosong.', showConfirmButton: false, timer: 1500
              });
          }
      }

      $(document).on("click", "#btn_delete", function () {
        var id = $(this).data('id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: "{{route('paslon.destroy')}}",
              data: {id: id, _token: '{{csrf_token()}}'},
              dataType: 'json',
              success: function(result) { 
                if(result.success){
                  SweetAlert.fire({
                    icon: 'success', title: 'Success', text: result.msg, showConfirmButton: false, timer: 1500
                  });
                }else{
                  SweetAlert.fire({
                    icon: 'error', title: 'Error', text: result.msg, showConfirmButton: false, timer: 1500
                  });
                }
                list();
              }
            });
          }
        })
      });
   </script>
@endpush

@push('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> 
@endpush
