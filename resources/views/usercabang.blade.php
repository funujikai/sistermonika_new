@extends('layouts.layout')
@section('main_container')
  <div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data User Cabang</h2>
                      <a type="button" class="btn btn-round btn-success pull-right" data-toggle="modal" data-target="#modal_tambahusercabang">Tambah User</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="table_user" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Cabang</th>
                          <th>Password</th>
                          <th>Role</th>
                          <th width="15%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getUserCabang as $getData)
                          <tr>
                            <td>{{ $getData->username }}</td>
                            <td>{{ $getData->password }}</td>
                            <td>{{ $getData->role }}</td>
                            <td>
                              <div class="btn-group">
                                <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_ubahusercabang"
                                    onclick="modal_ubahusercabang('{{ $getData->user_id }}',
                                                          '{{ $getData->username }}',
                                                          '{{ $getData->password }}',
                                                          '{{ $getData->role_id }}')">UBAH</a>
                                  </li>
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_konfirmasihapususercabang"
                                    onclick="modal_konfirmasihapususercabang('{{ $getData->user_id }}',
                                                          '{{ $getData->username}}')">HAPUS</a>
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

  function modal_ubahusercabang(user_id, username, password, role_id) {
    $('#cabang_ubahuserid').val(user_id);
    $('#cabang_ubahusername').val(username);
    $('#cabang_ubahpassword').val(password);
    $('#cabang_ubahrole').val(role_id);
    $('#cabang_ubahrole').selectpicker('refresh');
  }

  function modal_konfirmasihapususercabang(user_id, username) {
    $('#cabang_hapususerid').val(user_id);
    $('#cabang_hapususername').html(username);
  }

</script>

@endsection

@section('modal-content')
  @include('modals.tambahusercabang')
  @include('modals.ubahusercabang')
  @include('modals.konfirmasihapususercabang')
@endsection