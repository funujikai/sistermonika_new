@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <h3>
      Daftar Notaris
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
              <!--form method='get'>
                <div class='row'>
                  <div class='col-md-12 col-sm-12 col-xs-12'>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" align="right">Wilayah</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="cari_wilayah" name="cari_wilayah" class="selectpicker form-control" data-live-search="true" onChange="change_wilayah()" style="width:100%">
                            <option value=""> --Pilih Wilayah-- </option>  
                            @foreach($getWilayah as $getData) 
                              <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option>
                            @endforeach                      
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" align="right">Cabang</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="cari_cabang" name="cari_cabang" class="selectpicker form-control" data-live-search="true" onChange="change_cabang()" style="width:100%">
                            <option value=""> --Pilih Cabang-- </option>               
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class='col-md-1 col-sm-1 col-md-offset-9 col-sm-offset-9 col-xs-12'>
                          <Br><Br>
                          <button type="sbumit" class="btn btn-default btn-block">Cari</button>
                        </div>
                      </div>
                      
                  </div>
                </div>
              </form-->
              <br>
              @if($accessuser->insert==1)
                <div class="row">
                  <div class='col-md-1 col-sm-1 col-xs-2'>
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_addnotaris">Tambah</button>
                  </div>
                </div>
              @endif
              <br>
              <br>
              <table id="table_daftarpp" class="table table-striped table-bordered" style='overflow-y: hidden !important;'>
                <thead>
                  <tr>
                    <th class="text-center">Nama</th>
                    <th class="text-center">No KTP</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Telp/HP</th>
                    <th class="text-center">No Anggota INI</th>
                    <th class="text-center">No Anggota IPPAT</th>
                    <th class="text-center">Wilayah Kerja</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Proses</th>
                  </tr>
                </thead>
                  @foreach($getNotaris as $key=>$value)
                    <tr>
                      <td>{{$value->nama_notaris}}</td>
                      <td>{{$value->no_ktp}}</td>
                      <td>{{$value->alamat}}</td>
                      <td>{{$value->telpon.'/'.$value->no_hp}}</td>
                      <td>{{$value->no_anggota_inni}}</td>
                      <td>{{$value->no_anggota_ippat}}</td>
                      <td>{{$value->wilker_ppat}}</td>
                      <td>{{$value->email}}</td>
                      <td>
                        <div class="btn-group"> 
                          <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">Proses<span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                              @if($accessuser->update==1)
                                <li>
                                  <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_editnotaris" data-backdrop="static" onclick="modal_edit('{{trim($value->id)}}','{{trim($value->nama_notaris)}}','{{trim($value->no_ktp)}}','{{trim($value->alamat)}}','{{trim($value->telpon)}}','{{trim($value->no_hp)}}','{{trim($value->no_anggota_inni)}}','{{trim($value->no_anggota_ippat)}}','{{trim($value->wilker_ppat)}}','{{trim($value->email)}}')">Ubah Notaris</a>
                                </li>
                              @endif
                              @if($accessuser->delete==1)
                                <li>
                                  <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_deletenotaris" data-backdrop="static" onclick="modal_delete('{{trim($value->id)}}')">Non Aktifkan</a>
                                </li>
                              @endif
                            </ul>
                          </a>
                        </div>
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
  @include('modals/addnotaris')
  @include('modals/editnotaris')
  @include('modals/deletenotaris')
@endsection

<script type="text/javascript">
  $(document).ready(function() {
    $('body').removeClass('nav-md').addClass('nav-sm');
    $('#table_daftarpp').DataTable();
  });
  function change_wilayah(){
    var wilayah=$('#cari_wilayah').val();
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
        $("#cari_cabang").html(obj.content);
        $("#cari_cabang").selectpicker('refresh');
      }
    });			
  }
  function modal_edit(
    id,
    nama_notaris,
    no_ktp,
    alamat,
    telepon,
    handphone,
    nomor_inni,
    nomor_ippat,
    wilayah_kerja,
    email
  ){
    $('#edit_header_id').val(id);
    $('#edit_nama_notaris').val(nama_notaris);
    $('#edit_no_ktp').val(no_ktp);
    $('#edit_alamat').val(alamat);
    $('#edit_telepon').val(telepon.replace('-',''));
    $('#edit_handphone').val(handphone.replace('-',''));
    $('#edit_nomor_inni').val(nomor_inni);
    $('#edit_nomor_ippat').val(nomor_ippat);
    $('#edit_wilayah_kerja').val(wilayah_kerja);
    $('#edit_email').val(email);
  }
  function modal_delete(id){
    $('#delete_header_id').val(id);
  }

</script>

@endsection
