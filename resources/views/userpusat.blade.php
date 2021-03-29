@extends('layouts.layout')
@section('main_container')
  <div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data User Pusat</h2>
                      <a type="button" class="btn btn-round btn-success pull-right" data-toggle="modal" data-target="#modal_tambahuserpusat">Tambah User</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="table_user" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Inisial</th>
                          <th>Email</th>
                          <th>Divisi</th>
                          <th>Role</th>
                          <th width="15%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getUser as $getData)
                          <tr>
                            <td>{{ $getData->nama }}</td>
                            <td>{{ $getData->username }}</td>
                            <td>{{ $getData->inisial }}</td>
                            <td>{{ $getData->email }}</td>
                            <td>{{ $getData->kode_divisi }}</td>
                            <td>{{ $getData->role }}</td>
                            <td>
                              <div class="btn-group">
                                <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_ubahuserpusat"
                                    onclick="modal_ubahuserpusat('{{ $getData->user_id }}',
                                                          '{{ $getData->username }}',
                                                          '{{ $getData->inisial }}',
                                                          '{{ $getData->nama }}',
                                                          '{{ $getData->email }}',
                                                          '{{ $getData->kode_divisi }}',
                                                          '{{ $getData->role_id }}')">UBAH</a>
                                  </li>
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_konfirmasihapususerpusat"
                                    onclick="modal_konfirmasihapususerpusat('{{ $getData->user_id }}',
                                                          '{{ $getData->nama}}')">HAPUS</a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table_user').DataTable();
  });

  function modal_ubahuserpusat(user_id, username, inisial, nama, email, kode_divisi, role_id) {
    $('#pusat_ubahuserid').val(user_id);
    $('#pusat_ubahusername').val(username);
    $('#pusat_ubahinisial').val(inisial);
    $('#pusat_ubahnama').val(nama);
    $('#pusat_ubahemail').val(email);
    $('#pusat_ubahdivisi').val(kode_divisi);
    $('#pusat_ubahrole').val(role_id);
    $('#pusat_ubahrole').selectpicker('refresh');
  }

  function modal_konfirmasihapususerpusat(user_id, nama) {
    $('#pusat_hapususerid').val(user_id);
    $('#pusat_hapusnama').html(nama);
  }

</script>

@endsection

@section('modal-content')
  @include('modals.tambahuserpusat')
  @include('modals.ubahuserpusat')
  @include('modals.konfirmasihapususerpusat')
@endsection