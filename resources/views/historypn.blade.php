@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3 class="col-md-9 col-sm-9 col-xs-12">History Jaminan Notaris</h3>
            <div class="clearfix"></div>
            <div class="input-group col-md-3 col-sm-3 col-xs-3 pull-right">
              <a class="collapse-link pull-right pencarian-detail"><span> &nbsp&nbsp Pencarian Detail</span>
                  </div><div class="clearfix"></div>
                </div></a>
                <div class="x_content" style="display: none;">
                  <form class="form-horizontal form-label-left" action="#" method="GET" novalidate>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Wilayah</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="cari_wilayah" name="cari_wilayah" class="selectpicker form-control" data-live-search="true" onChange="change_wilayah()" style="width:100%">
                          <option value=""> --Pilih Wilayah-- </option> 
                          @foreach($getCabang as $getData) 
                          <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option>
                          @endforeach               
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="cari_cabang" name="cari_cabang" class="selectpicker form-control" data-live-search="true" onChange="change_cabang()" style="width:100%">
                          <option value=""> --Pilih Cabang-- </option>               
                        </select>
                      </div>
                    </div>
          
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="cari_unit" name="cari_unit" class="selectpicker form-control" data-live-search="true" style="width:100%">
                          <option value=""> --Pilih Unit-- </option> 
                        </select>
                      </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Debitur</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input id="cari_debitur" name="cari_debitur" class="form-control" style="text-transform:uppercase">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Notaris</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input id="cari_notaris" name="cari_notaris" class="form-control" style="text-transform:uppercase">
                        </div>
                    </div>  
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Pengurusan</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="cari_jenis_pengurusan" name="cari_jenis_pengurusan" class="selectpicker form-control" data-live-search="true" style="width:100%">
                          <option value=""> --Pilih Jenis Pengurusan-- </option> 
                          @foreach($getJenisPengurusan as $getData)
                          <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-md-7 col-md-offset-3">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="send" type="submit" class="btn btn-dark pull-right">Cari</button>
                      </div>
                    </div>
                  </form>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <table id="table_daftarpp" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">Wilayah</th>
                    <th class="text-center">Cabang</th>
                    <th class="text-center">Unit</th>
                    <th class="text-center">Nama Debitur</th>
                    <th class="text-center">Nama Notaris</th>
                    <th class="text-center">Jenis Pengurusan</th>
                    <th class="text-center">Tanggal Status</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Lama Proses</th>
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
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $('body').removeClass('nav-md').addClass('nav-sm');
        
        $('#cari_debitur,#cari_notaris').keypress(function(){
          $('#table_daftarpp').DataTable().ajax.reload();
        });
        $('#cari_wilayah,#cari_cabang,#cari_unit,#cari_jenis_pengurusan').on('change',function(){
          $('#table_daftarpp').DataTable().ajax.reload();
        });
        $('#table_daftarpp').DataTable({
          "order": [[ 0, "desc" ]],
          "processing": true,
          "serverSide": true,
          retrieve: true,
          "ajax": {
            'url' : 'flaravel/siluman/public/list_notaris/laporan_notaris_submited/',
            'datatype' : 'json',
            'type':'GET',
            'data' : function(d){d.wilayah=$('#cari_wilayah').val();d.cabang=$('#cari_cabang').val();d.unit=$('#cari_unit').val();d.debitur=$('#cari_debitur').val();d.notaris=$('#cari_notaris').val();d.jenis_pengurusan=$('#cari_jenis_pengurusan').val();}
          }
        });
        $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });
      });

      function change_cari_cabang(){
        var cabang=$('#cari_cabang').val();
        
        $.ajax({
          url: "list_unit",
          type: "GET",
          data: {cabang : cabang},
          cache: false,
           beforeSend: function() {
                 $(".loading_ajax").show(); 
               },
          success: function(msg){
          $(".loading_ajax").hide();  
           var obj = $.parseJSON(msg);
                   $("#cari_unit").html(obj.content);
             $("#cari_unit").selectpicker('refresh');
          }
        });     
      }
      
  function change_wilayah(){
    var wilayah=$('#cari_wilayah').val();
    $.ajax({
      url: "list_cabang",
      type: "GET",
      data: {wilayah : wilayah},
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
  function change_cabang(){
    if ($('#cari_cabang').val() != '') {
      var cabang = $('#cari_cabang').val();
    } 
    $.ajax({
      url: "list_unit",
      type: "GET",
      data: {cabang : cabang},
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();	
        var obj = $.parseJSON(msg);
        if ($('#cari_cabang').val() != '') {
          $("#cari_unit").html(obj.content);
          $("#cari_unit").selectpicker('refresh');
        }
      }
    });			
  }
    </script>

    @endsection

