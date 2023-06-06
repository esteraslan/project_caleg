@extends('layouts.app')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0">Data Relawan</h1>
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
              <h3 class="card-title">List Data Relawan</h3>
              <div class="card-tools">
                <button class="btn btn-primary btn-sm" id="btn_add"><i class="fa fa-plus"></i> Add</button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>NIK / No KTP</th>
                      <th>Organisasi</th>
                      <th>No Telepon</th>
                      <th>Status</th>
                      <th>Action</th>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title1">Tambah Data Relawan</h4>
        <h4 class="modal-title" id="title2">Edit Data Relawan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <div class="col-12" id="alert"></div>
            <label class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
              <input type="hidden" id="id" class="form-control" required>
              <input type="text" id="nama" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">NIK / No KTP :</label>
            <div class="col-sm-4">
              <input type="text" id="nik" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">Jenis Kelamin :</label>
            <div class="col-sm-4 mb-2">
              <select style="width: 100%;" id="jenis_kelamin" class="form-control form-control-sm select2" required>
                <option value="" selected>-pilih-</option>
                <option value="1">Laki-laki</option>
                <option value="2">Perempuan</option>
              </select>
            </div>

            <label class="col-sm-2 col-form-label">Tempat Lahir :</label>
            <div class="col-sm-4 mb-2">
              <input type="text" id="tmp_lahir" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">Tanggal Lahir :</label>
            <div class="col-sm-4 mb-2">
              <input type="date" id="tgl_lahir" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">Organisasi :</label>
            <div class="col-sm-10 mb-2">
              <input type="text" id="organisasi" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">No Telepon:</label>
            <div class="col-sm-4">
              <input type="number" id="no_hp" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">Status :</label>
            <div class="col-sm-4">
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
                    url: "{{ route('relawan.list') }}"
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'organisasi',
                        name: 'organisasi'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'sts',
                        name: 'sts',
                        render: function(data) {
                          if(data == 1){
                            return 'Aktif';
                          }else{
                            return 'Tidak Aktif';
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
          $("#nik").val('');
          $("#jenis_kelamin").val('').trigger('change');
          $("#tmp_lahir").val('');
          $("#tgl_lahir").val('');
          $("#organisasi").val('');
          $("#no_hp").val('');
          $("#sts").val('').trigger('change');
      }

      $(document).on("click", ".Save", function () {
        $("#alert").html('');
        $("#alert").show();
        if(validasi()){
          $.ajax({
              type: 'POST',
              url: "{{route('relawan.store')}}",
              data: {
                      nama: nama.value,
                      nik: nik.value,
                      jenis_kelamin: jenis_kelamin.value,
                      tmp_lahir: tmp_lahir.value,
                      tgl_lahir: tgl_lahir.value,
                      organisasi: organisasi.value,
                      no_hp: no_hp.value,
                      sts: sts.value,
                      _token: '{{csrf_token()}}'
                  },
              success: function(result) { 
                  if(result.success){
                      $("#alert").html('<div class="alert alert-success"><i class="fa fa-check"></i> '+result.msg+'</div>');
                      list();
                      clear();
                      setTimeout(() => { $("#alert").hide(); }, 1500);
                  }else{
                      $("#alert").html('<div class="alert alert-danger"><i class="fa fa-warning"></i> '+result.msg+'</div>');
                      setTimeout(() => { $("#alert").hide(); }, 1500);
                  }
              }
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
              url: "{{route('relawan.edit')}}",
              data: {
                      id: id,
                      _token: '{{csrf_token()}}'
                  },
              success: function(result) { 
                  if(result.success){
                    $('#myModal2').modal({ backdrop: 'static', keyboard: false, show: true });
                    $("#id").val(result.id);
                    $("#nama").val(result.name);
                    $("#nik").val(result.nik);
                    $("#jenis_kelamin").val(result.jenis_kelamin).trigger('change');
                    $("#tmp_lahir").val(result.tmp_lahir);
                    $("#tgl_lahir").val(result.tgl_lahir);
                    $("#organisasi").val(result.organisasi);
                    $("#no_hp").val(result.no_hp);
                    $("#sts").val(result.sts).trigger('change');
                  }else{
                      SweetAlert.fire({
                          icon: 'warning', title: 'Warning', text: result.msg, showConfirmButton: false, timer: 1500
                      });
                  }
              }
              });
      });

      $(document).on("click", ".Update", function () {
        if(validasi()){
          $.ajax({
              type: 'POST',
              url: "{{route('relawan.update')}}",
              data: {
                      id: id.value,
                      nama: nama.value,
                      nik: nik.value,
                      jenis_kelamin: jenis_kelamin.value,
                      tmp_lahir: tmp_lahir.value,
                      tgl_lahir: tgl_lahir.value,
                      organisasi: organisasi.value,
                      no_hp: no_hp.value,
                      sts: sts.value,
                      _token: '{{csrf_token()}}'
                  },
              success: function(result) { 
                  if(result.success){
                    list();
                    clear();
                    $('#myModal2').modal('hide');
                    SweetAlert.fire({
                        icon: 'success', title: 'Success', text: result.msg, showConfirmButton: false, timer: 1500
                    });
                  }else{
                    clear();
                    $('#myModal2').modal('hide');
                    SweetAlert.fire({
                        icon: 'error', title: 'Error', text: result.msg, showConfirmButton: false, timer: 1500
                    });
                  }
              }
          });
        }
      });

      function validasi(){
          if(nama.value != '' && nik.value != '' && jenis_kelamin.value != ''&& tmp_lahir.value != ''
          && tgl_lahir.value != ''&& organisasi.value != ''&& no_hp.value != ''&& sts.value != ''){
              return true;
          }else{
              SweetAlert.fire({
                  icon: 'error', title: 'Error', text: 'Semua kolom tidak boleh kosong.', showConfirmButton: false, timer: 1500
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
              url: "{{route('relawan.destroy')}}",
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
