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
                    <h2>Data User Role</h2>
                      @if($accessuser->insert==1)
                        <a type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal_add_role">Tambah User Role</a>
                      @endif
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="table_user" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Nama Role</th>
                          <th>Status</th>
                          <th width="15%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getUserRole as $getData)
                          <tr>
                            <td id="role_name">{{ $getData->role_name }}</td>
                            <td id="role_status" class="text-center">{{ $getData->status_name }}</td>
                            <td class="text-center">
                              <div class="btn-group">
                                <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                               
                                @if($accessuser->update==1)
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_edit_role"
                                    onclick="modal_ubahuserrole('{{ $getData->id }}',
                                                          '{{ $getData->role_name }}','{{$getData->PIC}}','{{$getData->head}}','{{$getData->scope}}')">UBAH</a>
                                  </li>
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_edit_module"
                                    onclick="modal_edit_module('{{ $getData->id }}')">UBAH MODULE</a>
                                  </li>
                                  @if($getData->status!=1) 
                                    <li>
                                      <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_activate_role"
                                      onclick="modal_activate_role('{{ $getData->id }}')">AKTIFKAN</a>
                                    </li>
                                  @endif
                                @endif
                                @if($getData->status==1&&$accessuser->delete==1) 
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_deactivate_role"
                                    onclick="modal_deactivate_role('{{ $getData->id }}')">NONAKTIFKAN</a>
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
    $('#table_user').DataTable();
  });

  function modal_ubahuserrole(role_id, role_name, pic, head, scope) {
    $('#role_edit_id').val(role_id);
    $('#role_edit_name').val(role_name);
    $('#scope_edit').val(scope).selectpicker('refresh');
    $('#PIC_edit,#head_edit,#need_cabang_edit,#need_unit_edit').iCheck('uncheck');
    if(pic==1)
      $('#PIC_edit').iCheck('check');
    if(head==1)
      $('#head_edit').iCheck('check');
  }

  function modal_edit_module(role_id) {
    $('#module_header_id').val(role_id);
    $.ajax({
      type: "get",
      url: "getModuleRole",
      data: "header_id="+role_id,
      success: function(data) {
        $.each(data.content,function(key,value){
          $("#read_"+value.menu_id).iCheck((value.read==0)?'uncheck':'check');
          $("#insert_"+value.menu_id).iCheck((value.insert==0)?'uncheck':'check');
          $("#update_"+value.menu_id).iCheck((value.update==0)?'uncheck':'check');
          $("#delete_"+value.menu_id).iCheck((value.delete==0)?'uncheck':'check');
          $("#detail_"+value.menu_id).iCheck((value.detail==0)?'uncheck':'check');
        });
      }
    });
  }

  function modal_konfirmasi_hapus_userrole(role_id){
    $('#role_delete_id').val(role_id);
  }

  function modal_activate_role(role_id){
    $('#role_activate_id').val(role_id);
  }

  function modal_deactivate_role(role_id){
    $('#role_deactivate_id').val(role_id);
  }

</script>

@endsection

@section('modal-content')
  @include('modals.addrole')
  @include('modals.editrole')
  @include('modals.editmodule')
  @include('modals.confirmdeleterole')
  @include('modals.confirmactivaterole')
  @include('modals.confirmdeactivaterole')
@endsection