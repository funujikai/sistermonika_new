@extends('layouts.layout')
@section('main_container')
  <div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            @if(Session::has('message'))
            <div class="msg-save-success">
              <i class="fa fa-floppy-o" aria-hidden="true" style="font-size: 17px">
                <span id="garis-tegak">|</span>
              </i>
              {{ Session::get('message') }}
              <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
            </div>
            @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Users</h2>
                      <a type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal_add_user">Tambah User</a>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="table_user" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>User ID</th>
                          <th>Nama User</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Status</th>
                          <th width="15%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getUsers as $k => $user)
                          <tr>
                            <td >{{ $k+1 }}</td>
                            <td id="username">{{ $user->username }}</td>
                            <td id="nama">{{ $user->nama }}</td>
                            <td id="email">{{ $user->email }}</td>
                            <td id="role">{{ $user->role_name }}</td>
                            <td id="status">{{ $user->status_name }}</td>
                            <td class="text-center">
                              <div class="btn-group">
                                <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                @if($accessuser->update==1)
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_edit_user"
                                    onclick="modal_ubah_user('{{ $user->id }}',
                                                         	'{{ $user->role_id }}')">UBAH</a>
                                  </li>
                                  @if($user->status_user==1)
                                    <li>
                                      <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_deactivate_user"
                                      onclick="modal_deactivate_user('{{ $user->id }}')">NONAKTIFKAN</a>
                                    </li>
                                  @endif
                                @endif
                                @if($user->status_user!=1&&$accessuser->delete==1)
                                <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_activate_user"
                                    onclick="modal_activate_user('{{ $user->id }}')">AKTIFKAN</a>
                                  </li>
                                @endif
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
    $('#table_user').DataTable({

      "columnDefs": [
        { "width": "20%", "targets": 2 }
      ]
    });
  });

  function modal_ubah_user(user_id,role_id) {
  	$('#user_edit_id').val(user_id);
	
    $('#sipp_edit_wilayah').val(wilayah.trim()).selectpicker('refresh').change();
    setTimeout(function(){ 
      $('#sipp_edit_cabang').val(cabang.trim()).selectpicker('refresh').change();
      setTimeout(function(){ 
        $('#sipp_edit_unit').val(unit.trim()).selectpicker('refresh');
      },1000);
    },1000);
    $('#sipp_edit_role').val(role_id);
  }

  function modal_activate_user(user_id){
    $('#user_activate_id').val(user_id);
  }

  function modal_deactivate_user(user_id){
    $('#user_deactivate_id').val(user_id);
  }

  function change_wilayah(id){
    var wilayah=$('#'+id).val();
    $.ajax({
      url: "list_cabang",
      type: "GET",
      data: {wilayah : wilayah,unit_bisnis:1},
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();	
        var obj = $.parseJSON(msg);
        if (id == 'sipp_wilayah') {
          $("#sipp_cabang").html(obj.content);
          $("#sipp_cabang").selectpicker('refresh');
        }
        if (id == 'sipp_edit_wilayah') {
          $("#sipp_edit_cabang").html(obj.content);
          $("#sipp_edit_cabang").selectpicker('refresh');
        }
      }
    });			
  }
  function change_cabang(id){
    var cabang = $('#'+id).val();
    $.ajax({
      url: "list_unit",
      type: "GET",
      data: {cabang : cabang,unit_bisnis:1},
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();	
        var obj = $.parseJSON(msg);
        if (id == 'sipp_cabang') {
          $("#sipp_unit").html(obj.content);
          $("#sipp_unit").selectpicker('refresh');
        }
        if (id == 'sipp_edit_cabang') {
          $("#sipp_edit_unit").html(obj.content);
          $("#sipp_edit_unit").selectpicker('refresh');
        }
      }
    });			
  }

</script>

@endsection

@section('modal-content')
  @include('modals.add_user')
  @include('modals.edit_user')
  @include('modals.confirm_active_user')
  @include('modals.confirm_deactive_user')
@endsection