@extends('layouts.app')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0">Data TPS</h1>
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
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Kabupaten</th>
                      <th>Kecamatan</th>
                      <th>Desa</th>
                      <th>Nama TPS</th>
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
        <h4 class="modal-title" id="title1">Tambah Data TPS</h4>
        <h4 class="modal-title" id="title2">Edit Data TPS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <div class="col-12" id="alert"></div>
            <label class="col-sm-2 col-form-label">Kabupaten :</label>
            <div class="col-sm-4">
              <select style="width: 100%;" id="kab" class="form-control form-control-sm select2" required>
                <option value="" selected>- pilih -</option>
                <option value="3215">Karawang</option>
                <option value="3214">Purwakarta</option>
              </select>
            </div>

            <label class="col-sm-2 col-form-label">Kecamatan :</label>
            <div class="col-sm-4">
              <select style="width: 100%;" id="kec" class="form-control form-control-sm select2" required>
              </select>
            </div>

            <label class="col-sm-2 col-form-label">Kelurahan :</label>
            <div class="col-sm-4 mb-2">
              <select style="width: 100%;" id="desa" class="form-control form-control-sm select2" required>
              </select>
            </div>

            <label class="col-sm-2 col-form-label">Dusun :</label>
            <div class="col-sm-4 mb-2">
              <input type="text" id="nm_kp" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">RT :</label>
            <div class="col-sm-4 mb-2">
              <input type="text" id="no_rt" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">RW :</label>
            <div class="col-sm-4 mb-2">
              <input type="text" id="no_rw" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-2 col-form-label">Nama TPS:</label>
            <div class="col-sm-4">
              <input type="hidden" id="id" class="form-control" required>
              <input type="text" id="nama" class="form-control form-control-sm" required>
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
                    url: "{{ route('tps.list') }}"
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
                        data: 'kab',
                        name: 'kab'
                    },
                    {
                        data: 'kec',
                        name: 'kec'
                    },
                    {
                        data: 'desa',
                        name: 'desa'
                    },
                    {
                        data: 'nm_tps',
                        name: 'nm_tps'
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

      $(document).on("change", "#kab", function () {
          if(this.value != ''){
            getKec();
          }else{
            getKec();
            $("#kec").val('').trigger('change');
          }
      });

      function getKec(){
        var html = '';
          $.ajax({
            url: "{{route('tps.getkec')}}",
            type: "GET",
            data: {id: kab.value},
            success: function (result) {
              html += '<option value="" selected>-- Select --</option>';
              $.each(result.data, function (key, value) {
                  html += '<option value="'+value.code+'"> '+value.name+' </option>';
              });
              document.getElementById("kec").innerHTML = html;
            }
          });
      }

      $(document).on("change", "#kec", function () {
          if(this.value != ''){
            getKel();
          }else{
            getKel();
            $("#desa").val('').trigger('change');
          }
      });

      function getKel(){
        var html = '';
          $.ajax({
            url: "{{route('tps.getkel')}}",
            type: "GET",
            data: {id: kec.value},
            success: function (result) {
              html += '<option value="" selected>-- Select --</option>';
              $.each(result.data, function (key, value) {
                  html += '<option value="'+value.code+'"> '+value.name+' </option>';
              });
              document.getElementById("desa").innerHTML = html;
            }
          });
      }

      $(document).on("click", ".close", function () {
        clear();
      });

      function clear(){
          $("#id").val('');
          $("#nama").val('');
          $("#kab").val('').trigger('change');
          $("#kec").val('').trigger('change');
          $("#desa").val('').trigger('change');
          $("#no_rt").val('');
          $("#no_rw").val('');
          $("#nm_kp").val('');
          $("#sts").val('').trigger('change');
      }

      $(document).on("click", ".Save", function () {
        $("#alert").html('');
        $("#alert").show();
        if(validasi()){
          $.ajax({
              type: 'POST',
              url: "{{route('tps.store')}}",
              data: {
                      nama: nama.value,
                      kab: kab.value,
                      kec: kec.value,
                      desa: desa.value,
                      nm_kp: nm_kp.value,
                      no_rt: no_rt.value,
                      no_rw: no_rw.value,
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
              url: "{{route('tps.edit')}}",
              data: {
                      id: id,
                      _token: '{{csrf_token()}}'
                  },
              success: function(result) { 
                  if(result.success){
                      $('#myModal2').modal({ backdrop: 'static', keyboard: false, show: true });
                      $("#id").val(result.id);
                      $("#nama").val(result.name);
                      $("#kab").val(result.id_kab).trigger('change');
                      setTimeout(() => { 
                        $("#kec").val(result.id_kec).trigger('change'); 
                      }, 1500); 
                      setTimeout(() => { 
                        $("#desa").val(result.id_kel).trigger('change'); 
                      }, 2500); 
                      $("#nm_kp").val(result.nm_kp);
                      $("#no_rt").val(result.no_rt);
                      $("#no_rw").val(result.no_rw);
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
              url: "{{route('tps.update')}}",
              data: {
                      id: id.value,
                      nama: nama.value,
                      kab: kab.value,
                      kec: kec.value,
                      desa: desa.value,
                      nm_kp: nm_kp.value,
                      no_rt: no_rt.value,
                      no_rw: no_rw.value,
                      sts: sts.value,
                      _token: '{{csrf_token()}}'
                  },
              success: function(result) { 
                  if(result.success){
                    list();
                    $('#myModal2').modal('hide');
                    SweetAlert.fire({
                        icon: 'success', title: 'Success', text: result.msg, showConfirmButton: false, timer: 1500
                    });
                  }else{
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
          if(nama.value != '' && kab.value != '' && kec.value != ''&& desa.value != ''
          && nm_kp.value != ''&& no_rt.value != ''&& no_rw.value != ''&& sts.value != ''){
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
              url: "{{route('tps.destroy')}}",
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
