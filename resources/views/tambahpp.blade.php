@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">

  {{-- <div class=""> --}}
  <div class="clearfix"></div>
  <div class="modal-header">
    <h3>
      Tambah Penelusuran Perkara
    </h3>
  </div>
  <div class="clearfix"></div>

  <form id="form_form_survey_tambah" class="form-horizontal form-label-left" enctype="multipart/form-data" action="{{ url('P_TambahPP') }}" method="POST">
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
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Unit Bisnis<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker form-control" id="pp_unit_bisnis" name="pp_unit_bisnis" data-live-search="true" style="width:100%" required>
                  <option value=""> --Pilih Unit Bisnis-- </option> 
                  @foreach($getUnitBisnis as $getData) 
                  <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Registrasi Perkara<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type='text' class="form-control datepicker" id="pp_tanggal_perkara" name="pp_tanggal_perkara" required autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Wilayah<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker form-control" onChange="change_wilayah()" id="pp_wilayah" name="pp_wilayah" data-live-search="true" style="width:100%" required @if(Session::has('SIPP_kode_wilayah')) disabled @endif>
                  <option value=""> --Pilih Wilayah-- </option> 
                  @foreach($getWilayah as $getData) 
                        <option value="{{ $getData->kode }}" @if(Session::has('SIPP_kode_wilayah')&&Session::get('SIPP_kode_wilayah')==$getData->kode) selected @endif> {{ $getData->nama }} </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" id='label-cabang'>Cabang<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker form-control" onChange="change_cabang()" id="pp_cabang" name="pp_cabang" data-live-search="true" style="width:100%" required>
					        <option value=""> --Pilih Cabang-- </option> 
                </select>
              </div>
            </div>
            <div class="form-group need_mekaar">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Area<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker form-control" id="pp_area" onChange="change_area()"  name="pp_area" data-live-search="true" style="width:100%" required>
                  <option value=""> --Pilih Area-- </option> 
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" id='label-unit'>Unit<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker form-control" id="pp_unit" name="pp_unit" data-live-search="true" style="width:100%" required>
                  <option value=""> --Pilih Unit-- </option> 
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis Hukum<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker form-control" name="pp_jenis_hukum" id="pp_jenis_hukum" data-live-search="true" style="width:100%" required>
                  <option value=""> --Pilih Jenis Hukum-- </option> 
                    @foreach($getJenisHukum as $getData) 
                      <option value="{{ $getData->kode }}" data-penggugat='{{$getData->penggugat}}' data-tergugat='{{$getData->tergugat}}' data-turut_tergugat='{{$getData->turut_tergugat}}' style="text-transform:uppercase"> {{ $getData->nama }} </option> 
                    @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Lembaga Hukum <span class="required">*</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input name="pp_pengadilan" style="text-transform:uppercase" id='pp_pengadilan' class="form-control" required autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" id='nomor_laporan'>No Laporan Polisi</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input name="pp_nomor_perkara" style="text-transform:uppercase" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="form-group jenis_hukum_1">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis Gugatan Perdata<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker form-control" name="pp_jenis_perdata" id="pp_jenis_perdata" data-live-search="true" style="width:100%" required>
  	              <option value=""> --Pilih Jenis Gugatan Perdata-- </option> 
                  @foreach($getJenisPerdata as $getData)
                    <option value="{{ $getData->kode }}" data-penggugat='{{$getData->penggugat}}' data-tergugat='{{$getData->tergugat}}' data-turut_tergugat='{{$getData->turut_tergugat}}' style="text-transform:uppercase"> {{ $getData->nama }} </option> 
                  @endforeach
                </select>    
              </div>
            </div>
            <div class="form-group jenis_hukum_1 jenis_hukum_3 jenis_hukum_4">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Dasar Gugatan Hukum<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12" id="for-margin">
                <select class="selectpicker form-control" name="pp_dasar_perdata" id="pp_dasar_perdata" data-live-search="true" style="width:100%" required>
  	              <option value=""> --Pilih Dasar Gugatan Hukum-- </option> 
                </select>    
              </div>
            </div>
            <div class="form-group jenis_hukum_2">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Klasifikasi Perkara<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12" id="for-margin">
                <select class="selectpicker form-control" name="pp_klasifikasi_perkara" id="pp_klasifikasi_perkara" data-live-search="true" style="width:100%" required>
  	              <option value="0"> --Pilih Klasifikasi Perkara-- </option> 
                    @foreach($getklasifikasiperkara as $getData)
                      <option value="{{ $getData->kode }}" style="text-transform:uppercase"> {{ $getData->nama }} </option> 
                    @endforeach
                </select>    
              </div>
            </div>
            <div class="form-group jenis_hukum_2">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Delik Pidana<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12" id="for-margin">
                <select class="selectpicker form-control" name="pp_delik_pidana[]" multiple id="pp_delik_pidana" data-live-search="true" style="width:100%" required>
  	              <option value="0"> --Pilih Delik Pidana-- </option> 
                    @foreach($getPerkaraPidana as $getData)
                      <option value="{{ $getData->kode }}" data-instansi='{{$getData->need_instansi}}' data-tempus='{{$getData->need_tampus}}' data-lainnya='{{$getData->need_lainnya}}' style="text-transform:uppercase"> {{ $getData->nama }} </option> 
                    @endforeach
                </select>    
              </div>
            </div>
            <div class="form-group jenis_hukum_2 need_lainnya">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Delik Lainnya</label>
              <div class="col-md-9 col-sm-9 col-xs-12" id="for-margin">
                <input name="pp_pidana_lainnya" style="text-transform:uppercase" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="form-group jenis_hukum_1 jenis_hukum_3 jenis_hukum_4">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Petitum</label>
              <div class="col-md-9 col-sm-9 col-xs-12" id="for-margin">
                <textarea name="pp_petitum" style="text-transform:uppercase" class="form-control" id='pp_petitum' required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Kedudukan Perseroan<span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12" id="for-margin">
                <input name="pp_kedudukan_perseroan" style="text-transform:uppercase" class="form-control" required autocomplete="off">
              </div>
            </div>
            <div class='penggugat'>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" id='penggugat'>Penggugat <span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input name="pp_pelapor" id='pp_pelapor' style="text-transform:uppercase" data-role="tagsinput"  class="form-control" required='required'>
                  <span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>
                </div>
              </div>
            </div>
            <div class='tergugat'>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" id='tergugat'>Tergugat <span class="required"> *</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input name="pp_terlapor" id='pp_terlapor' data-role="tagsinput" style="text-transform:uppercase" class="form-control" required>
                  <span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>
                </div>
              </div>
            </div>
            <div class='turut_tergugat'>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" id='turut_tergugat'>Turut Tergugat </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input name="pp_turut_tergugat" id='pp_turut_tergugat' data-role="tagsinput" style="text-transform:uppercase" class="form-control">
                  <span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>
                </div>
              </div>
            </div>
            <div class="form-group jenis_hukum_2 need_tempus">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Tempus <span class="required"> *</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type='text' class="form-control datepicker" id="pp_tempus" name="pp_tempus" required autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">PIC</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="pp_pic" id="pp_pic" autocomplete="off">
              </div>
            </div>
            <div class="form-group has-feedback">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Nilai Sengketa</label>
            </div>
			<div class="form-group has-feedback">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Outstanding</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control has-feedback-left estimasi-kerugian" name="pp_outstanding" data-a-dec="," data-a-sep="." autocomplete="off">
                <i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
              </div>
            </div>			
			
            <div class="form-group has-feedback">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Materil</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control has-feedback-left estimasi-kerugian" name="pp_materil" data-a-dec="," data-a-sep="." autocomplete="off">
                <i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
              </div>
            </div>
            <div class="form-group has-feedback">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Immateril</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control has-feedback-left estimasi-kerugian" name="pp_immateril" data-a-dec="," data-a-sep="." autocomplete="off">
                <i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
              </div>
            </div>
            <div class="form-group has-feedback">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Dwangsom</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control has-feedback-left estimasi-kerugian" name="pp_dwangsom" data-a-dec="," data-a-sep="." autocomplete="off">
                <i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
              </div>
            </div>
            <div class="form-group has-feedback">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Dokumen Upload</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" class="form-control has-feedback-left estimasi-kerugian" name="pp_dokumen">
              </div>
            </div>
            <hr>
            @if($accessuser->insert==1) 
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-primary pull-right disabled-on-submit">Simpan</button>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var data_gugatan = {};
    $('[class*=jenis_hukum_],.need_mekaar').hide();
    CKEDITOR.replace('pp_petitum');
    $('input[data-role=tagsinput]').on('change', function(event) {
    });
    $(":input").inputmask();
    $('.estimasi-kerugian').autoNumeric('init');
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    $('#pp_unit_bisnis').on('change',function(){
      if($(this).find(':selected').text().trim()=='Mekaar'){
        $('#label-cabang').html('Region <span class="required"> *</span>');
        $('#label-unit').html('Cabang <span class="required"> *</span>');
        $('.need_mekaar').show().find('select').attr('required','true').selectpicker('refresh');
      }else{
        $('#label-cabang').html('Cabang <span class="required"> *</span>');
        $('#label-unit').html('Unit <span class="required"> *</span>');
        $('.need_mekaar').hide().find('select').removeAttr('required').selectpicker('refresh');
      }
	  change_wilayah();
    });	
    $('#pp_jenis_hukum').on('change', function() {
      $('[class*=jenis_hukum_]').hide();
      $('[class*=jenis_hukum_]').find('input[name*=pp_],select[name*=pp_]').removeAttr('required');
      $('.jenis_hukum_'+$(this).val()).show();
      $('.jenis_hukum_'+$(this).val()).find('input[name*=pp_],select[name*=pp_]').attr('required',true);
      
      if($(this).find(':selected').data('penggugat')!='-'){
        $('#penggugat').html($(this).find(':selected').data('penggugat')+'<span class="required"> *</span>');
        $('#tergugat').html($(this).find(':selected').data('tergugat')+'<span class="required"> *</span>');
        if($(this).find(':selected').data('turut_tergugat')!=''){
          $('.turut_tergugat').show();
          $('#turut_tergugat').html($(this).find(':selected').data('turut_tergugat')+'<span class="required"> *</span>');
        }else{
          $('.turut_tergugat').hide();
          $('.turut_tergugat').find('input').removeAttr('required');
        }
      }
      if($(this).val()==2){
        $('#nomor_laporan').html('No Laporan Polisi');
      }else{
        $('#nomor_laporan').html('No Perkara');
      }
      $('.need_lainnya,.need_tempus').hide();
    });
    $('#pp_delik_pidana').on('change', function() {
      $('.need_tempus').hide().find('input[name*=pp_],select[name*=pp_]').removeAttr('required');
      $('#pp_pengadilan').removeAttr('readonly');
      $('.need_lainnya').hide().find('input[name*=pp_],select[name*=pp_]').removeAttr('required');
      $('#pp_delik_pidana option:selected').each(function(){
        var value =$(this).data('instansi');
        if(value==0){
          $('#pp_pengadilan').attr('readonly',true);
          return false;
        }
      });
      $('#pp_delik_pidana option:selected').each(function(){
        var value =$(this).data('lainnya');
        if(value==1){
          $('.need_lainnya').show().attr('required',true);
          return false;
        }
      });
      $('#pp_delik_pidana option:selected').each(function(){
        var value =$(this).data('tempus');
        if(value==1){
          $('.need_tempus').show().attr('required',true);
          return false;
        }
      });
    });
    $('#pp_jenis_perdata,#pp_jenis_hukum').on('change',function(){
      var val = $('#pp_jenis_hukum').val();
      if(val !=2){
        $.ajax({
          url: "list_dasar_gugatan",
          type: "GET",
          cache: false,
          data:{
            jenis_perdata:$('#pp_jenis_perdata').val(),
            jenis_hukum:$('#pp_jenis_hukum').val()
          },
          beforeSend: function() {
            $(".loading_ajax").show(); 
          },
          success: function(msg){
            $(".loading_ajax").hide();	
            var obj = $.parseJSON(msg);
            $("#pp_dasar_perdata").html(obj.content);
            $("#pp_dasar_perdata").selectpicker('refresh');
          }
        });	
      }
    });
    if($('#pp_wilayah').val()!='')
      change_wilayah();
    if($('pp_cabang').val()!='')
      change_cabang();
  
	
	// $('.disabled-on-submit').on('click',function(){
		// $(this).prop('disabled',true);
	// });
  });
  
  function change_wilayah(){
    var wilayah=$('#pp_wilayah').val();
    var unit_bisnis=$('#pp_unit_bisnis').val();
    if(wilayah!=''){
      $.ajax({
        url: "list_cabang",
        type: "GET",
        data: {wilayah : wilayah,unit_bisnis:unit_bisnis},
        cache: false,
        beforeSend: function() {
          $(".loading_ajax").show(); 
        },
        success: function(msg){
          $(".loading_ajax").hide();	
          var obj = $.parseJSON(msg);
          $("#pp_cabang").html(obj.content);
          $("#pp_cabang").selectpicker('refresh');
        }
      });		
    }	
  }
  function change_cabang(){
    var cabang=$('#pp_cabang').val();
    var unit_bisnis=$('#pp_unit_bisnis').val();
    if(cabang!=''){
      $.ajax({
        url: "list_unit",
        type: "GET",
        data: {cabang : cabang,unit_bisnis:unit_bisnis},
        cache: false,
        beforeSend: function() {
          $(".loading_ajax").show(); 
        },
        success: function(msg){
          $(".loading_ajax").hide();	
            var obj = $.parseJSON(msg);
          if(unit_bisnis==1){
            $("#pp_unit").html(obj.content);
            $("#pp_unit").selectpicker('refresh');
          }else{
            $("#pp_area").html(obj.content);
            $("#pp_area").selectpicker('refresh');
          }
        }
      });	
    }
  }
  function change_area(){
    var cabang=$('#pp_area').val();
    var unit_bisnis=$('#pp_unit_bisnis').val();
    if(cabang!=''){
      $.ajax({
        url: "list_area",
        type: "GET",
        data: {area : cabang,unit_bisnis:2},
        cache: false,
        beforeSend: function() {
          $(".loading_ajax").show(); 
        },
        success: function(msg){
          $(".loading_ajax").hide();	
          var obj = $.parseJSON(msg);
          $("#pp_unit").html(obj.content);
          $("#pp_unit").selectpicker('refresh');
        }
      });	
    }
  }
  var counting = (function(){
    var counters = 0;
    return function(){
      return counters++;
    }
  })();
  function tambah_aktor(type){
    var counter = counting();
    var html = '<div class="form-group" id="add-'+type+'-'+counter+'">'+$('.'+type+' .form-group').first().html()+'</div>';
    html = html.replace('<button type="button" class="btn btn-success btn-block" onclick="tambah_aktor(\''+type+'\')"><i class="fa fa-plus" aria-hidden="true"></i></button>','<button type="button" class="btn btn-danger btn-block remove-button" onclick="hapus_aktor(\''+type+'\','+counter+')"><i class="fa fa-minus" aria-hidden="true"></i></button>');
    $('.'+type).append(html);
  }
  function hapus_aktor(type,counter){
    $('#add-'+type+'-'+counter).remove();
  }
  
</script>

@endsection