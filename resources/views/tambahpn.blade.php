@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">

  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <h3>
        Tambah Jaminan Notaris
      </h3>
    </div>
    <div class="clearfix"></div>


    <form id="form_penjaminan_notaris_tambah" class="form-horizontal form-label-left" enctype="multipart/form-data" action="{{ route('PostPN') }}" method="POST">
      <div class="modal-body">
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
          <div class="x_panel">
            <div class="x_content">
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Order<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type='text' class="datepicker form-control" id="pn_tanggal_order" name="pn_tanggal_order" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Wilayah<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="selectpicker form-control" onChange="change_wilayah()" id="pn_wilayah" name="pn_wilayah" data-live-search="true" style="width:100%" required>
                    <option value=""> --Pilih Wilayah-- </option> 
                    @foreach($getCabang as $getData) 
                    <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Cabang<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="selectpicker form-control" onChange="change_cabang()" id="pn_cabang" name="pn_cabang" data-live-search="true" style="width:100%" required>
                    <option value=""> --Pilih Cabang-- </option> 
                    
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Unit<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="selectpicker form-control" id="pn_unit" name="pn_unit" data-live-search="true" style="width:100%" required>

                    <option value=""> --Pilih Unit-- </option> 

                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Debitur<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input name="pn_nama_debitur" style="text-transform:uppercase" class="form-control" required>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Plafond<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control has-feedback-left plafond" name="pn_plafond" data-a-dec="," data-a-sep="." required>
                  <i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Notaris<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="pn_nama_notaris" id="pn_nama_notaris" style="text-transform:uppercase" class="selectpicker form-control" required>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">No. Agunan<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input name="pn_no_agunan" style="text-transform:uppercase" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis Surat Agunan<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="selectpicker form-control" id="pn_jenis_agunan" name="pn_jenis_agunan" data-live-search="true" style="width:100%" required>
                    <option value=""> --Pilih Jenis Surat Agunan-- </option> 
                    @foreach($getJenisAgunan as $getData) 
                      <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">No. Covernote<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input name="pn_covernote" style="text-transform:uppercase" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Masa Berlaku<span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type='text' class="datepicker form-control" id="pn_masa_berlaku" name="pn_masa_berlaku" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Pengiktatan pencairan<span class="required"> *</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select class="selectpicker form-control" id="pn_pencairan" name="pn_pencairan" data-live-search="true" style="width:100%" required>
                    <option value=""> -- Pilih Pembiyaan -- </option> 
                    @foreach($getPencairan as $value)
                      <option value="{{$value->kode}}">{{$value->nama}}</option>  
                    @endforeach 
                  </select>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <input name="pn_tanggal_pencairan" style="text-transform:uppercase" class="datepicker form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Pengiktatan Agunan<span class="required"> *</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select class="selectpicker form-control" multiple id="pn_agunan" name="pn_agunan[]" data-live-search="true" style="width:100%" required>
                    <option value=""> -- Pilih Agunan -- </option>
                    @foreach($getAgunan as $value)
                      <option value="{{$value->kode}}" data-pengikatan="{{$value->pengikatan_lain}}">{{$value->nama}}</option>  
                    @endforeach 
                  </select>                
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <input name="pn_tanggal_agunan" style="text-transform:uppercase" class="datepicker form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <font size='2'>
                  <p>
                    <input type="checkbox" class="flat" id='pengikatan_lainnya' name="pengikatan_lainnya" value="1"/> Pengikatan Lainnya</span>                
                  </p>
                  </font>
                </div>
              </div>

              <hr>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button class="btn btn-default btn-primary pull-right">Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(":input").inputmask();
    $('.plafond').autoNumeric('init');
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    $('#pn_agunan').on('change',function(){
      $('#pengikatan_lainnya').iCheck('uncheck');
      $('#pn_agunan option:selected').each(function(){
        var value =$(this).data('pengikatan');
        if(value==1){
          $('#pengikatan_lainnya').iCheck('check');
          return false;
        }
        $('#pengikatan_lainnya').iCheck('uncheck');
      });
    });
  });
  
  $(".closed").on("click", function() {
    $(".msg-save-success").remove();
  });


  function change_wilayah(){
    var wilayah=$('#pn_wilayah').val();
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
        $("#pn_cabang").html(obj.content);
        $("#pn_cabang").selectpicker('refresh');
      }
    });			
  }
  function change_cabang(){
    var cabang=$('#pn_cabang').val();
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
        $("#pn_unit").html(obj.content);
        $("#pn_unit").selectpicker('refresh');
        
        $("#pn_nama_notaris").html(obj.notaris);
        $("#pn_nama_notaris").selectpicker('refresh');
        
      }
    });			
  }
</script>

@endsection