@extends('layouts.app')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0">Data Pendukung</h1>
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
              <h3 class="card-title">List Data Legislatif</h3>
              <div class="card-tools">
                <button class="btn btn-primary btn-sm" id="btn_add"><i class="fa fa-plus"></i> Add</button>
                <button class="btn btn-primary btn-sm" id="btn_export"><i class="fa fa-plus"></i>Export</button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-hover">
                <thead>
                    <tr>
                      <th width="50">#</th>
                      <th>Photo KTP</th>
                      <th>Nama Pendukung</th>
                      <th>Nama Relawan</th>
                      <th>NIK / NO KTP</th>
                      <th>NO KK</th>
                      <th>Alamat</th>
                      <th>Keterangan</th>
                      <th>Jenis Kelamin</th>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title1">Tambah Data Pendukung</h4>
        <h4 class="modal-title" id="title2">Edit Data Pendukung</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <div class="col-12" id="alert"></div>
            <label class="col-sm-3 col-form-label">Nama Pendukung :</label>
            <div class="col-sm-9">
                <input type="hidden" id="iddata" class="form-control" required>
                <input type="text" id="nama" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-3 col-form-label">Nama Relawan :</label>
                <div class="col-sm-9 mb-2">
                <select style="width: 100%;" id="id_relawan" class="form-control form-control-sm select2" required>
                </select>
            </div>


            <label class="col-sm-3 col-form-label">NIK / NO KTP :</label>
            <div class="col-sm-4">
                <input type="text" id="no_ktp" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-1 col-form-label">NO KK:</label>
            <div class="col-sm-4">
                <input type="number" id="no_kk" class="form-control form-control-sm" required>
            </div>

            <label class="col-sm-3 col-form-label">Alamat :</label>
            <div class="col-sm-9 mb-2">
                <textarea id="alamat" cols="35" rows="3" class="form-control form-control-sm" required></textarea>
            </div>

            <label class="col-sm-3 col-form-label">Keterangan :</label>
            <div class="col-sm-9">
                <textarea id="keterangan" cols="35" rows="3" class="form-control form-control-sm" required></textarea>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-9">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Jenis Kelamin :</label>
              <div class="col-sm-8 mb-2">
                  <select style="width: 100%;" id="jenis_kelamin" class="form-control form-control-sm select2" required>
                      <option value="" selected>- pilih -</option>
                      <option value="1">Laki-laki</option>
                      <option value="2">Perempuan</option>
                  </select>
              </div>
              <label class="col-sm-4 col-form-label">Upload Foto KTP :</label>
              <div class="col-sm-8">
                  <input type="file" id="gambar" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <img id="imageView" src="{{ asset('dist/img/bg_upload.png'); }}" alt="your image" width="100%" class="img-thumbnail" />
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
          upload();
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
                    url: "{{ route('pendukung.list') }}"
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
                          return '<img src="dist/img/pendukung/'+data+'" width="50" height="60" class="img-thumbnail"/>';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
    data: 'relawan_name',
    name: 'relawan_name',
    render: function(data, type, row) {
        if (data) {
            return data;
        }
        return row.id_relawan;
    }
},

                    {
                        data: 'no_ktp',
                        name: 'no_ktp'
                    },
                    {
                        data: 'no_kk',
                        name: 'no_kk'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        render: function(data) {
                          if(data == 1){
                            return 'Laki - Laki';
                          }else{
                            return 'Perempuan';
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
      function upload(){
          gambar.onchange = evt => {
              const [file] = gambar.files
              if (file) {
                  imageView.src = URL.createObjectURL(file)
              }
          }
      }
  
      $(document).on("click", "#btn_add", function () {
          $('#myModal2').modal({ backdrop: 'static', keyboard: false, show: true });
          $(".Save").show();
          $("#title1").show();
          $(".Update").hide();
          $("#title2").hide();
      });

      function getrelawan() {
    var html = '';
    $.ajax({
        url: "{{ route('pendukung.getrelawan') }}",
        type: "GET",
        success: function (result) {
            html += '<option value="" selected>-- Select --</option>';
            $.each(result.data, function (key, value) {
                html += '<option value="' + value.id + '"> ' + value.name + ' </option>';
            });
            $('#id_relawan').html(html);
        }
    });
}

// Panggil fungsi getrelawan saat halaman dimuat
$(document).ready(function () {
    getrelawan();
});


      $(document).on("click", ".close", function () {
        clear();
      });

      function clear(){
          $('#id').val('');
          $("#id_pendukung").val('');
          $("#nama").val('');
          $("#no_ktp").val('');
          $("#no_kk").val('');
          $('#alamat').val('');
          $('#keterangan').val('');
          $('#jenis_kelamin').val('');
          $("#id_relawan").val('').trigger('change');
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
              fd.append('id_relawan', id_relawan.value);
              fd.append('nama', nama.value);
              fd.append('no_ktp', no_ktp.value);
              fd.append('no_kk', no_kk.value);
              fd.append('alamat', no_ktp.value);
              fd.append('keterangan', no_kk.value);
              fd.append('jenis_kelamin',jenis_kelamin.value);
              fd.append('gambar', files[0]);
              fd.append('_token', '{{csrf_token()}}');
              // Hide alert 
              $('#responseMsg').hide();
              // AJAX request 
              if(validasi()){
                $.ajax({
                    url: "{{route('pendukung.store')}}",
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
              url: "{{route('pendukung.edit')}}",
              data: {
                      id: id,
                      _token: '{{csrf_token()}}'
                  },
              success: function(result) { 
                  if(result.success){
                      $('#myModal2').modal({ backdrop: 'static', keyboard: false, show: true });
                      $("#iddata").val(result.id)
                      $("#nama").val(result.nama);
                      $("#no_ktp").val(result.no_ktp);
                      $("#no_kk").val(result.no_kk);
                      $("#alamat").val(result.alamat);
                      $("#keterangan").val(result.keterangan);
                      $("#jenis_kelamin").val(result.jenis_kelamin);
                      $("#id_relawan").val(result.id_relawan).trigger('change');
                      imageView.src = '{{asset('dist/img/pendukung')}}/'+result.gambar;
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
  fd.append('id_relawan', id_relawan.value);
  fd.append('nama', nama.value);
  fd.append('no_ktp', no_ktp.value);
  fd.append('no_kk', no_kk.value);
  fd.append('alamat', no_ktp.value);
  fd.append('keterangan', no_kk.value);
  fd.append('jenis_kelamin',jenis_kelamin.value);
  fd.append('gambar', files[0]);
  fd.append('_token', '{{csrf_token()}}');
  // Hide alert 
  $('#responseMsg').hide();
  
  // AJAX request 
  if(validasi()){
    $.ajax({
        url: "{{route('pendukung.update')}}",
        method: 'POST', // Menggunakan metode POST
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
  if(nama.value != '' && no_ktp.value != ''){
      return true;
  }else{
      SweetAlert.fire({
          icon: 'error', title: 'Error', text: 'Kolom Nama, Nik', showConfirmButton: false, timer: 1500
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
              url: "{{route('pendukung.destroy')}}",
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
