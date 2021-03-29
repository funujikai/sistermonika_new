@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <h3>
      Daftar Wilayah
      </h3>
    </div>
    <div class="clearfix"></div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          @if(Session::has('message'))
          <div class="msg-save-success">
            <i class="fa fa-floppy-o" aria-hidden="ture" style="font-size: 17px">
              <span id="garis-tegak">|</span>
            </i>
            {{ Session::get('message') }}
            <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
          </div>
          @endif
          @if(Session::has('messageSubmitScs'))
          <div class="msg-save-success">
            <i class="fa fa-paper-plane-o" aria-hidden="ture" style="font-size: 17px">
              <span id="garis-tegak">|</span>
            </i>
            {{ Session::get('messageSubmitScs') }}
            <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
          </div>
          @endif
          <div class="x_panel">
            <div class="x_content">
              <form method='get'>
              <div class='row'>
                <div class='col-md-12 col-sm-12 col-xs-12'>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" align="right">Wilayah</label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <select id="cari_wilayah" name="cari_wilayah" class="selectpicker form-control" data-live-search="true" style="width:100%">
                        <option value=""> --Pilih Wilayah-- </option>  
                        @foreach($getWilayah as $getData) 
                          <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option>
                        @endforeach                      
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <Br><Br>
              <div class='row'>
                <div class='col-md-1 col-sm-1 col-md-offset-9 col-sm-offset-9 col-xs-12'>
                  <div class="form-group">
                    <button type="sbumit" class="btn btn-default btn-block">Cari</button>
                  </div>
                </div>
              </div>
              <br>
              </form>
              @if($accessuser->insert==1)
                <div class="row">
                  <div class='col-md-1 col-sm-1 col-xs-2'>
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_addwilayah">Tambah</button>
                  </div>
                </div>
              @endif
              <br>
              <br>
              <table id="table_daftarpp" class="table table-striped table-bordered" style='overflow-y: hidden !important;'>
                <thead>
                  <tr>
                    <th class="text-center">Wilayah</th>
                    <th class="text-center">Cabang</th>
                    <th class="text-center">Proses</th>
                  </tr>
                </thead>
                  @foreach($getCabang as $key=>$value)
                    <tr>
                      <td>{{$value->wilayah}}</td>
                      <td>{{$value->nama}}</td>
                      <td>
                        @if($accessuser->update==1||$accessuser->delete==1)
                          <div class="btn-group"> 
                            <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">Proses<span class="caret"></span> </a>
                              <ul class="dropdown-menu">
                                @if($accessuser->update==1)
                                <li>
                                  <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_editwilayah" data-backdrop="static" onclick="modal_edit({{$value->id}},'{{trim($value->wilayah)}}','{{trim($value->kode)}}','{{trim($value->nama)}}')">Edit Wilayah</a>
                                </li>
                                @endif
                                @if($accessuser->delete==1&&$value->id!=0)
                                <li>
                                  <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_deletewilayah" data-backdrop="static" onclick="modal_delete({{$value->id}},'{{trim($value->wilayah)}}','{{trim($value->kode)}}','{{trim($value->nama)}}')">Hapus Wilayah</a>
                                </li>
                                @endif
                              </ul>
                            </a>
                          </div>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                <tbody>
                </tbody>
              </table>
            </div>
          </div> <!-- End div x_content -->
        </div> <!-- End div x_panel -->
      </div> <!-- End div modal row -->
    </div> <!-- End div modal body -->
  </div> <!-- End div class = "" -->
</div> <!-- End div right col -->

@section('modal-content')
  @include('modals/addwilayah')
  @include('modals/editwilayah')
  @include('modals/deletewilayah')
@endsection

<script type="text/javascript">
  $(document).ready(function() {
    $('body').removeClass('nav-md').addClass('nav-sm');
    $('#table_daftarpp').DataTable();
  });
  function modal_edit(id,wilayah,kode_cabang,cabang){
    $('#edit_wilayah_id').val(id);
    $('#add_wilayah').val(wilayah);
    $('#cabang_edit').val(cabang);
    $('#kode_cabang_edit').val(kode_cabang);
  }
  function modal_delete(id,wilayah,kode_cabang,cabang){
    $('#delete_wilayah_id').val(id);
  }
</script>

@endsection
