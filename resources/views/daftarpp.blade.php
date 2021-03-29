@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <div class="row">
        <div class="col-sm-12">
          <h3>
            Data Penelusuran Perkara Berjalan
          </h3>
        </div>
        <div class="col-sm-2 col-sm-offset-10 text-right">
          <a class='pencarian-detail' data-toggle="collapse" data-target="#search"><span>Pencarian Detail</span></a>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="modal-body">
      <div class="x_panel">
          <div class="x_content">
            <div class="row search-field">
              <div class="col-md-12 col-sm-12 col-xs-12 collapse" id="search">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Bisnis</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_unit_bisnis" name="cari_unit_bisnis" class="selectpicker form-control" data-live-search="true" style="width:100%">
                      <option value=""> --Pilih Unit Bisnis-- </option>  
                      @foreach($getUnitBisnis as $getData) 
                        <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option>
                      @endforeach                      
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Wilayah</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_wilayah" name="cari_wilayah" class="selectpicker form-control" data-live-search="true" onChange="change_wilayah('cari_wilayah')" style="width:100%" @if(Session::has('SIPP_kode_wilayah')) disabled @endif>
                      <option value=""> --Pilih Wilayah-- </option>  
                      @foreach($getWilayah as $getData) 
                        <option value="{{ $getData->kode }}" @if(Session::has('SIPP_kode_wilayah')&&Session::get('SIPP_kode_wilayah')==$getData->kode) selected @endif> {{ $getData->nama }} </option>
                      @endforeach                      
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" id='label-cabang'>Cabang</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_cabang" name="cari_cabang" class="selectpicker form-control" data-live-search="true" onChange="change_cabang('cari_cabang')" style="width:100%">
                      <option value=""> --Pilih Cabang-- </option>           
                    </select>
                  </div>
                </div>
                <div class="form-group need_mekaar">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" id='label-cabang'>Area</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="selectpicker form-control" id="cari_area" onChange="change_area('cari_area')"  name="cari_area" data-live-search="true" style="width:100%">
                      <option value=""> --Pilih Area-- </option>
                    </select>
                  </div>
                </div>
      
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" id='label-unit'>Unit</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_unit" name="cari_unit" class="selectpicker form-control" data-live-search="true" style="width:100%">
                      <option value=""> --Pilih Unit-- </option>     
                    </select>
                  </div>
                </div>
                <div class="form-group jenis_hukum_1">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Gugatan Perdata</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="selectpicker form-control" name="cari_jenis_perdata" id="cari_jenis_perdata" data-live-search="true" style="width:100%" required>
                      <option value=""> --Pilih Jenis Gugatan Perdata-- </option> 
                      @foreach($getJenisPerdata as $getData)
                        <option value="{{ $getData->kode }}" data-penggugat='{{$getData->penggugat}}' data-tergugat='{{$getData->tergugat}}' data-turut_tergugat='{{$getData->turut_tergugat}}' style="text-transform:uppercase"> {{ $getData->nama }} </option> 
                      @endforeach
                    </select>    
                  </div>
                </div>
                <div class="form-group jenis_hukum_1 jenis_hukum_3 jenis_hukum_4">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Dasar Gugatan Hukum</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="selectpicker form-control" name="cari_dasar_perdata" id="cari_dasar_perdata" data-live-search="true" style="width:100%" required>
                      <option value=""> --Pilih Dasar Gugatan Hukum-- </option> 
                    </select>    
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Mulai Tanggal</label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <input id="cari_mulai" name="cari_mulai" class="datepicker form-control" style="text-transform:uppercase">
                    </div>
                </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sampai Tanggal</label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <input id="cari_sampai" name="cari_sampai" class="datepicker form-control" style="text-transform:uppercase">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1 col-sm-1 col-md-offset-9 col-ms-offset-9 col-xs-12">
                      <br>
                      <button type="reset" class='btn btn-block btn-default btn-reset-search'>Reset</button>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                @if(Session::has('messageAddedScs'))
                <div class="msg-save-success">
                  <i class="fa fa-floppy-o" aria-hidden="ture" style="font-size: 17px">
                    <span id="garis-tegak">|</span>
                  </i>
                  {{ Session::get('messageAddedScs') }}
                  <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
                </div> <!-- End div msg-save-success -->
                @endif
                @if(Session::has('messageSubmitScs'))
                <div class="msg-save-success">
                  <i class="fa fa-paper-plane-o" aria-hidden="ture" style="font-size: 17px">
                    <span id="garis-tegak">|</span>
                  </i>
                  {{ Session::get('messageSubmitScs') }}
                  <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
                </div> <!-- End div msg-save-success -->
                @endif
              <ul class="nav nav-tabs">
              @foreach($getJenisHukum as $key=>$value)
                <li @if($key==0) class='active' @endif><a class="type-tab-content" data-key='{{$key}}' data-type='{{$value->kode}}' data-toggle="tab" href="#{{str_replace(' ','',$value->nama)}}">{{$value->nama}}</a></li>
              @endforeach
              </ul>
              <div class="tab-content">
                @foreach($getJenisHukum as $key=>$value)
                  <div id="{{str_replace(' ','',$value->nama)}}" class="tab-pane fade @if($key==0) in active @endif">
                    <br><br>
                    <table id="table_daftarpp_{{str_replace(' ','',$value->nama)}}" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th rowspan='2'>Unit Bisnis</th>
                          <th rowspan='2'>Wilayah</th>
                          <th rowspan='2'>Cabang</th>
                          <th rowspan='2'>Unit</th>
                          <th rowspan='2'>PIC</th>
                          @if($value->kode==2)
                            <th rowspan='2'>No Laporan Polisi</th>
                          @else
                            <th rowspan='2'>No Perkara</th>
                          @endif
                          <th rowspan='2'>Tanggal Regis</th>
                          @IF($value->penggugat=='-')
                            <th rowspan='2'>Penggugat/Pembanding/Pemohon Kasasi/Pemohon PK</th>
                          @ELSE
                            <th rowspan='2'>{{$value->penggugat}}</th>
                          @ENDIF
                          @IF($value->tergugat=='-')
                            <th rowspan='2'>Tergugat/Terbanding/Termohon Kasasi/Termohon PK</th>
                          @ELSE
                            <th rowspan='2'>{{$value->tergugat}}</th>
                          @ENDIF
                          @IF($value->turut_tergugat=='-')
                            <th rowspan='2'>Turut Tergugat/Turut Terbanding/Termohon Kasasi/Turut Termohon PK</th>
                          @ELSEIF($value->turut_tergugat!='')
                            <th rowspan='2'>{{$value->turut_tergugat}}</th>
                          @ENDIF
                          @if($value->nama=='PIDANA')
                            <th rowspan='2'>Klasifikasi Perkara</th>
                          @endif
                          <th rowspan='2'>Kedudukan Perseroan</th>
                          <th rowspan='2'>Tingkat Pemeriksaan</th>
                          <th colspan='4'>Nilai Sengketa</th>
                          <th rowspan='2'>Proses</th>
                        </tr>
                        <tr>
						  <th>Outstanding</th>
                          <th>Materil</th>
                          <th>Immateril</th>
                          <th>Dwangsom</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div> <!-- end div col -->
                @endforeach
				      </div> <!-- end div x_content -->
			      </div> <!-- end div x_panel -->
          </div> <!-- end div row -->
        </div>  <!-- end modal-body -->
	    </div> <!-- end div "" -->
	  </div> <!-- end div righ_col -->
  </div> <!-- end div "" -->
</div> <!-- end div righ_col -->

@section('modal-content')
  @include('modals.addstatusperkara')
  @include('modals.addupayahukum')
  @include('modals.editpp')
  @include('modals.tracelaporan')
  @include('modals.editstatusperkara')
  @include('modals.deletestatusperkara')
  @include('modals.selesaiperkara')
  @include('modals.konfirmasicabutgugatan')
  @include('modals.hapusperkara')
  @include('modals.scheduleagenda')
@endsection

<script type="text/javascript">
$(document).ready(function() {
    $('body').removeClass('nav-md').addClass('nav-sm');
    $(":input").inputmask();
    CKEDITOR.replace('pp_petitum');
	CKEDITOR.replace('keterangan');
	CKEDITOR.replace('keterangan_upayahukum');
    $('.estimasi-kerugian').autoNumeric('init');
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    $('.btn-reset-search').on('click',function(){
      $(this).closest('.search-field').find("input, textarea,select").val("");
      $(this).closest('.search-field').find(".selectpicker").val("").selectpicker('refresh');
      $('#table_daftarpp_'+$('.type-tab-content').closest('li.active').find('a').attr('href').replace('#','')).DataTable().ajax.reload();
    });
    $('#cari_unit_bisnis,#pp_unit_bisnis').on('change',function(){
      if($(this).find(':selected').text().trim()=='Mekaar'){
        $('#label-cabang').html('Region'+(($(this).attr('id').replace('_unit_bisnis','')=='pp')?'<span class="required"> *</span>':''));
        $('#label-unit').html('Cabang'+(($(this).attr('id').replace('_unit_bisnis','')=='pp')?'<span class="required"> *</span>':''));
        $('.need_mekaar').show().find('select').attr('required','true').selectpicker('refresh');
      }else{
        $('#label-cabang').html('Cabang'+(($(this).attr('id').replace('_unit_bisnis','')=='pp')?'<span class="required"> *</span>':''));
        $('#label-unit').html('Unit'+(($(this).attr('id').replace('_unit_bisnis','')=='pp')?'<span class="required"> *</span>':''));
        $('.need_mekaar').hide().find('select').removeAttr('required').selectpicker('refresh');
      }
	  change_wilayah($(this).attr('id').replace('unit_bisnis','')+'wilayah');
    });	
    
    $('#pp_jenis_hukum').on('change', function() {
      $('[class*=input_jenis_hukum_]').hide();
      $('[class*=input_jenis_hukum_]').find('input[name*=pp_],select[name*=pp_]').removeAttr('required');
      $('.input_jenis_hukum_'+$(this).val()).show();
      $('.input_jenis_hukum_'+$(this).val()).find('input[name*=pp_],select[name*=pp_]').attr('required',true);
      
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
		$('#pp_pidana_lainnya').attr('required',true);
      }else{
        $('#nomor_laporan').html('No Perkara');
		$('#pp_pidana_lainnya').removeAttr('required');
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
    
    $('#pp_jenis_perdata').on('change', function() {
      if($(this).val()!=''){
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
      }
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
    $('.type-tab-content').on('click',function(){
      var type = $(this).data('type');
      var href = $(this).attr('href').replace('#','');
      var html = $(this).html();
	  
      $('[class*=jenis_hukum_],.need_mekaar').hide();
      $('.jenis_hukum_'+type).show();
      $('.need_lainnya,.need_tempus').hide();
      $('#cari_dasar_perdata option').filter(function() {
        return $.trim(this.value).length > '0';
      }).remove();
      $('#cari_jenis_perdata,#cari_dasar_perdata').val('').selectpicker('refresh');
      $('#form-addstatusperkara').find('input[id]:hidden,select[id]:hidden').removeAttr('required');
	  
      if(type==2){
        $('.no_perkara').html('No Laporan Polisi');
      }else{
        $('.no_perkara').html('No Perkara');
      }
      $.ajax({
        url: "list_status_putusan",
        type: "GET",
        data: {
          jenis_hukum : type
        },
        cache: false,
        beforeSend: function() {
          $(".loading_ajax").show(); 
        },
        success: function(msg){
          $(".loading_ajax").hide();	
          var obj = $.parseJSON(msg);
          $("[id*=status_putusan]").html(obj.content).selectpicker('refresh');
        }
      });	
      $('#table_daftarpp_'+href).DataTable(
        {
          dom: "Bfrtip",
          lengthMenu: [
              [ 10, 25, 50, -1 ],
              [ '10', '25', '50', 'All' ]
          ],
          buttons: [
            {
              extend: "pageLength",
              className: "btn-sm"
            },
            {
              extend: 'excelHtml5',
              title: 'DATA PENELURUSAN PERKARA BERJALAN '+html.toUpperCase(),
              className: "btn-sm",
              exportOptions: {
                columns: 'th:not(:last-child)'
              }
            },
            {
              extend: "pdfHtml5",
              title: 'DATA PENELURUSAN PERKARA BERJALAN '+html.toUpperCase(), 
              orientation: 'landscape',
              pageSize: 'folio',
              tableHeader: {
                fontSize: 9,
              },
              exportOptions: {
                columns: 'th:not(:last-child)'
              },
              className: "btn-sm"
            },
            // {
            //   extend: "print",
            //   className: "btn-sm"
            // },
          ],
          'scrollX': true,
          'scrollY': '250px',
          "processing": true,
          "serverSide": true,
          retrieve: true,
          "ajax": {
            'url' : 'list_perkara',
            'datatype' : 'json',
            'type':'post',
            'data':function(d){
              d._token='{{ csrf_token() }}';
              d.type='laporan';
              d.idperkara = type;
              d.unit_bisnis = $('#cari_unit_bisnis').val();
              d.wilayah = $('#cari_wilayah').val();
              d.cabang = $('#cari_cabang').val();
              d.area = $('#cari_area').val();
              d.unit = $('#cari_unit').val();
              d.mulai = $('#cari_mulai').val();
              d.selesai = $('#cari_sampai').val();
              d.jenis_perkara = $('#cari_jenis_perdata').val();
              d.dasar_perkara = $('#cari_dasar_perdata').val();
            }
          }
        }
      );
      setTimeout(function(){ 
        $('#table_daftarpp_'+href).DataTable().columns.adjust().responsive.recalc();
      },500);
	  
    var column = [];
    column[1]=[0,2,3,5,6,7,8,9,10,11];
    column[3]=[0,2,3,5,6,7,8,9,10,11];
    column[4]=[0,2,3,5,6,7,8,9,10,11];
    column[2]=[1,2,3,4,5,6,7,8,9,10,11];
	$('#table_tracelaporan').DataTable({
		  dom: "Bfrtip",
		  lengthMenu: [
			  [ 10, 25, 50, -1 ],
			  [ '10', '25', '50', 'All' ]
		  ],
		  buttons: [
			{
			  extend: "pageLength",
			  className: "btn-sm"
			},
			{
			  extend: 'excelHtml5',
			  title: 'DATA CATATAN PERKARA BERJALAN '+$('.type-tab-content').closest('li.active').find('a').attr('href').replace('#',''),
			  className: "btn-sm",
			  exportOptions: {
				columns: column[$('.type-tab-content').closest('li.active').find('a').data('type')]
			  }
			},
			{
			  extend: "pdfHtml5",
			  title: 'DATA CATATAN PERKARA BERJALAN '+$('.type-tab-content').closest('li.active').find('a').attr('href').replace('#',''), 
			  orientation: 'landscape',
			  pageSize: 'folio',
			  tableHeader: {
				fontSize: 9
			  },
			  exportOptions: {
				columns: column[$('.type-tab-content').closest('li.active').find('a').data('type')]
			  },
			  className: "btn-sm"
			},
		  ],
		  'responsive':true,
		  "processing": true,
		  "serverSide": true,
		  retrieve: true,
		  "ajax": {
			'url' : 'list_tracelaporan',
			'datatype' : 'json',
			'type':'get',
			'data':function(d){
			  d.header_id=$('#hidden_id').val();
			}
		  }
		}
	  );
	  setTimeout(function(){
		  $('.btn-reset-search').click();
		  $('#cari_unit_bisnis').val('');
		  $('#cari_unit_bisnis').change();
		  @if(Session::has("SIPP_kode_wilayah"))
			$('#cari_wilayah').val("{{Session::get('SIPP_kode_wilayah')}}").selectpicker('refresh').change();
		  @endif
	  },500);
    });
		$('#cari_unit_bisnis,#cari_wilayah,#cari_cabang,#cari_area,#cari_unit,#cari_jenis_perdata,#cari_dasar_perdat,#cari_mulai,#cari_sampai').on('change',function(){
			$('#table_daftarpp_'+$('.type-tab-content').closest('li.active').find('a').attr('href').replace('#','')).DataTable().ajax.reload();
		});
    $("#cari_jenis_perdata").on('change',function(){
      ubahdasargugatan('cari',$(this).val(),$('.type-tab-content').closest('li.active').find('a').data('type'));
    });
    $('.type-tab-content[data-key=0]').click();

    $(document).on('show.bs.modal', '.modal', function () {
      var zIndex = 1040 + (10 * $('.modal:visible').length);
      $(this).css('z-index', zIndex);
      setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
      }, 0);
    });
    $(".closed").on("click", function() {
      $(".msg-save-success").remove();
    });
    $('#btn-print').on('click',function(){
      var win = window.open('{{url("/download_resume")}}?header_id='+$('#hidden_id').val(), '_blank');
      if (win) {
        win.focus();
      }
    });
    $('#hidden_id').on('change',function(){
      $('#table_tracelaporan').DataTable().ajax.reload();  
    });
	// $('.disabled-on-submit').on('click',function(){
		// $(this).prop('disabled',true);
	// });
});
  function modal_tracelaporan(header_id, status_submit, status_selesai_perkara) { 
    for ( var i=0 ; i<12 ; i++ ) {
      $('#table_tracelaporan').DataTable().column( i ).visible(true);
    }
    setTimeout(function(){
      $('#hidden_id').val(header_id).change(); 
      setTimeout(function(){
        if($('.type-tab-content').closest('li.active').find('a').data('type')=='2'){
          var status = $(this).data('process');
          $('#table_tracelaporan').DataTable().column( 0 ).visible(false);
          $('.no_perkara').html('No Laporan Polisi');
        }else{
          $('#table_tracelaporan').DataTable().column( 1 ).visible(false);
          $('#table_tracelaporan').DataTable().column( 4 ).visible(false);
          $('.no_perkara').html('No Perkara')
        }
      }, 500);
    }, 500);
    $.ajax({
      type:"get",
      url:"TraceLaporan",
      data:"header_id="+header_id,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(data){
        $(".loading_ajax").hide(); 
        var html = "";
        var obj = $.parseJSON(data);
        var datas = obj.data;
        $('#tgl_pendaftaran').html(datas.laporan_tanggal_perkara);
        $('#nmr_regis').html(datas.no_perkara);
        $('#nm_lembaga').html(datas.pengadilan);
        $('#dlk_pidana').html(datas.delok_pidana);
        $('#klsfks_pidana').html(datas.nama_klasifikasi);
        $('#kddkn_perseroan').html(datas.kedudukan_perseroan);
        $('#plapor').html(datas.laporan_header_pelapor);
        $('#trlapor').html(datas.laporan_header_terlapor);
        $('#trt_trlapor').html(datas.turut_tergugat);
        $('#pttm').html(datas.petitum);
		$('#outs').html(number_format(parseInt(datas.outstanding.replace('.0000')),0));
        $('#mtrl').html(number_format(parseInt(datas.materil.replace('.0000')),0));
        $('#immtrl').html(number_format(parseInt(datas.immateril.replace('.0000')),0));
        $('#dwngsm').html(number_format(parseInt(datas.dwangsom.replace('.0000')),0));
        $('#rdh').html(datas.m_parameter_name);
        $('#lprn').html(datas.keterangan);
        $('[id*=tab_putusan_]').hide();
        $('#head-pelapor,#td_plapor').html(datas.lbl_penggugat);
        $('#head-terlapor,#td_trlapor').html(datas.lbl_tergugat);
        $('#td_trt_trlapor').html(datas.lbl_turut_tergugat);
        if(obj.putusan.length>0)$('#ptsn').show();
        else $('#ptsn').hide();
        var list = [];
        var laporan_detail_id=[];
        $.each(obj.putusan,function(key,value){
          var upaya_hukum_id = (value.m_upaya_hukum_id==null)?'0':value.m_upaya_hukum_id;
          $('#tgl_putusan_'+upaya_hukum_id).html(value.tanggal_pelaksanaan);
          $('#sts_putusan_'+upaya_hukum_id).html(value.nama_status_putusan);
          var materil = value.materil.replace('.0000');
          var immateril = value.immateril.replace('.0000');
          var dwangsom = value.dwangsom.replace('.0000');
          $('#nm_lmbg_'+upaya_hukum_id).html(((materil=='undefined')?0:parseInt(materil))+((immateril=='undefined')?0:parseInt(immateril))+((dwangsom=='undefined')?0:parseInt(dwangsom)));
          $('#amr_ptsn_'+upaya_hukum_id).html(value.amar_putusan);
          list.push(parseInt(upaya_hukum_id));
          laporan_detail_id.push(parseInt(value.laporan_detail_id));
        });
        for(var i = 0;i<=5;i++){
          if(list.indexOf(i)>=0){
            $('#tab_putusan_'+i).show();
          }
        }
      }
    });
  }
  function ubahdasargugatan(type,jenis_hukum,jenis_perdata){
    if(jenis_hukum!=2){
        $.ajax({
          url: "list_dasar_gugatan",
          type: "GET",
          cache: false,
          data:{
            jenis_perdata:jenis_perdata,
            jenis_hukum:jenis_hukum
          },
          beforeSend: function() {
            $(".loading_ajax").show(); 
          },
          success: function(msg){
            $(".loading_ajax").hide();	
            var obj = $.parseJSON(msg);
            $("#"+type+"_dasar_perdata").html(obj.content);
            $("#"+type+"_dasar_perdata").selectpicker('refresh');
          }
        });	
      }
  }
  function change_wilayah(id){
    var wilayah = $('#'+id).val();
    var unit_bisnis=$('#'+id.replace('wilayah','')+'unit_bisnis').val();
    $.ajax({
      url: "list_cabang",
      type: "GET",
      data: {
        wilayah : wilayah,
        unit_bisnis:unit_bisnis
      },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();	
        var obj = $.parseJSON(msg);
        if (id == 'cari_wilayah') {
          $("#cari_cabang").html(obj.content);
          $("#cari_cabang").selectpicker('refresh');
        }
        if (id == 'pp_wilayah') {
          $("#pp_cabang").html(obj.content);
          $("#pp_cabang").selectpicker('refresh');
        }
      }
    });			
  }
  function change_area(id){
    var cabang = $('#'+id).val();
    var unit_bisnis=2;
    if(cabang!=''){
      $.ajax({
        url: "list_area",
        type: "GET",
        data: {area : cabang,unit_bisnis:unit_bisnis},
        cache: false,
        beforeSend: function() {
          $(".loading_ajax").show(); 
        },
        success: function(msg){
          $(".loading_ajax").hide();	
          var obj = $.parseJSON(msg);
          if (id == 'cari_area') {
            $("#cari_unit").html(obj.content);
            $("#cari_unit").selectpicker('refresh');
          }
          if (id == 'pp_area') {
            $("#pp_unit").html(obj.content);
            $("#pp_unit").selectpicker('refresh');
          }
        }
      });	
    }
  }
  function change_cabang(id){
    var cabang = $('#'+id).val();
    var unit_bisnis=$('#'+id.replace('cabang','')+'unit_bisnis').val();
    $.ajax({
      url: "list_unit",
      type: "GET",
      data: {
        cabang : cabang,
        unit_bisnis:unit_bisnis
      },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();	
        var obj = $.parseJSON(msg);
        if (id == 'cari_cabang') {
          if(unit_bisnis==1){
            $("#cari_unit").html(obj.content);
            $("#cari_unit").selectpicker('refresh');
          }else{
            $("#cari_area").html(obj.content);
            $("#cari_area").selectpicker('refresh');
          }
        }
        if (id == 'pp_cabang') {
          if(unit_bisnis==1){
            $("#pp_unit").html(obj.content);
            $("#pp_unit").selectpicker('refresh');
          }else{
            $("#pp_area").html(obj.content);
            $("#pp_area").selectpicker('refresh');
          }
        }
      }
    });			
  }
  function list_status_perkara(jenis_hukum,hukum_berjalan,proses_hukum,jenis_perdata,upaya_hukum,selector){	
    $.ajax({
      url: "list_status_perkara",
      type: "GET",
      data: {
          jenis_hukum : jenis_hukum,
          hukum_berjalan:hukum_berjalan,
          jenis_perdata:jenis_perdata,
          upaya_hukum:upaya_hukum,
          proses_hukum:proses_hukum
        },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();  
        var obj = $.parseJSON(msg);
        $("#rangkaian_proses"+selector).html(obj.content);
        $("#rangkaian_proses"+selector).selectpicker('refresh');
      }
    }); 
  }

  function list_proses_hukum(hukum_berjalan,selector){
    $.ajax({
      url: "list_proses_hukum",
      type: "GET",
      data: {
          hukum_berjalan:hukum_berjalan
        },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();  
        var obj = $.parseJSON(msg);
        $("#proses_hukum"+selector).html(obj.content);
        $("#proses_hukum"+selector).selectpicker('refresh');
      }
    }); 
  }

  function list_upaya_hukum(jenis_perdata,selector,type){
    $.ajax({
      url: "list_upaya_hukum",
      type: "GET",
      data: {
          jenis_hukum:$('.type-tab-content').closest('li.active').find('a').data('type'),
          jenis_perdata:jenis_perdata,
          type:type
        },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();  
        var obj = $.parseJSON(msg);
        $("#upaya_hukum"+selector).html(obj.content);
        $("#upaya_hukum"+selector).selectpicker('refresh');
      }
    }); 
  }

  var counting = (function(){
    var counters = 0;
    return function(){
      return counters++;
    }
  })();
  function tambah_aktor(type,value){
    var counter = counting();
    var html = '<div class="form-group margin-40" id="add-'+type+'-'+counter+'">'+$('.'+type+' .form-group').first().html()+'</div>';
    html = html.replace('<button type="button" class="btn btn-success btn-block" onclick="tambah_aktor(\''+type+'\',\'\')"><i class="fa fa-plus" aria-hidden="true"></i></button>','<button type="button" class="btn btn-danger btn-block remove-button" onclick="hapus_aktor(\''+type+'\','+counter+')"><i class="fa fa-minus" aria-hidden="true"></i></button>');
    $('.'+type).append(html);
    $('#add-'+type+'-'+counter).find('input').val(value);
  }
  function hapus_aktor(type,counter){
    $('#add-'+type+'-'+counter).remove();
  }

  function modal_deletestatuspekara(laporan_detail_id) {
    $('#detail_id_delete').val(laporan_detail_id);
  }
  function modal_selesaikanperkara(header_id) {
    $('#header_id_selesaiperkara').val(header_id);
  }
  
  function modal_editpp(header_id) {
    $('[class*=input_jenis_hukum_]').hide();
    $('.input_jenis_hukum_'+$('.type-tab-content').closest('li.active').find('a').data('type')).show();
    $('.need_lainnya,.need_tempus').hide();
    $.ajax({
      url: "get_detail_header/laporan_header_perkara_pidana",
      type: "get",
      data: {
        '_token':"{{ csrf_token() }}",
        where:[
        {
          header_id:header_id,
          type:'laporan_header_id'
        },
        {
          header_id:'1',
          type:'m_aktif'
        }
        ]
      },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();  
        var value =[];
        $.each(msg,function(keys,values){
          value.push(values.m_perkara_pidana_id);
        });
        $('#pp_delik_pidana').val(value).selectpicker('refresh').change();
      }
    }); 
    $.ajax({
      url: "get_detail_header/laporan_header",
      type: "get",
      data: {
        '_token':"{{ csrf_token() }}",
        where:[
          {
            header_id:'',
            type:'isnull(laporan_parent_id,laporan_header_id) = '+header_id
          },
          {
            header_id:'1',
            type:'active'
          },
        ]
      },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();  
        var obj = msg[0];
        $('#pp_header_id').val(obj.laporan_header_id);
        $('#pp_unit_bisnis').val(obj.m_unit_bisnis).selectpicker('refresh').change();
        $('#pp_tanggal_perkara').val(obj.laporan_tanggal_perkara);
        $('#pp_wilayah').val(obj.laporan_header_wilayah).selectpicker('refresh').change();
        setTimeout(function(){
          $('#pp_cabang').val(obj.laporan_header_cabang).selectpicker('refresh').change();
          setTimeout(function(){
            if(obj.m_unit_bisnis==2){
              $('#pp_area').val(obj.laporan_header_area).selectpicker('refresh').change();
            }
            setTimeout(function(){
              $('#pp_unit').val(obj.laporan_header_unit).selectpicker('refresh');
            }, 500);
          }, 500);
        }, 500);
        $('#pp_jenis_hukum').val(obj.m_jenis_hukum_id).selectpicker('refresh').change();
        $('#pp_pengadilan').val(obj.pengadilan);
        $('#pp_nomor_perkara').val(obj.no_perkara);
        setTimeout(function(){
          $('#pp_jenis_perdata').val(obj.m_jenis_perdata_id).selectpicker('refresh').change();
          setTimeout(function(){
            $('#pp_dasar_perdata').val(obj.m_perkara_perdata_id).selectpicker('refresh');
          },500);
        },500);
        $("#pp_pelapor_1,pp_terlapor_1,pp_turut_tergugat_1").tagsinput('removeAll');
		var penggugat = obj.laporan_header_pelapor.split(',');
        if(penggugat.length>0){
          for(var i = 0;i<penggugat.length;i++){
            $('#pp_pelapor_1').tagsinput('add',penggugat[i]);
          }
        }
        var tergugat = obj.laporan_header_terlapor.split(',');
        if(tergugat.length>0){
          for(var i = 0;i<tergugat.length;i++){
            $('#pp_terlapor_1').tagsinput('add',tergugat[i]);
          }
        }
        var turut_tergugat = obj.turut_tergugat.split(',');
        if(turut_tergugat.length>0){
          for(var i = 0;i<turut_tergugat.length;i++){
            $('#pp_turut_tergugat_1').tagsinput('add',turut_tergugat[i]);
          }
        }
        $('#pp_klasifikasi_perkara').val(obj.m_klasifikasi_perkara_id).selectpicker('refresh');
        $('#pp_pidana_lainnya').val(obj.delik_lainnya);
        CKEDITOR.instances['pp_petitum'].setData(obj.petitum);
        $('#pp_kedudukan_perseroan').val(obj.kedudukan_perseroan);
        $('#pp_tempus').val(obj.tempus);
        $('#pp_pic').val(obj.laporan_header_pic).selectpicker('refresh');
		$('#pp_outstanding').val(obj.outstanding.replace('.0000',''));
        $('#pp_materil').val(obj.materil.replace('.0000',''));
        $('#pp_immateril').val(obj.immateril.replace('.0000',''));
        $('#pp_dwangsom').val(obj.dwangsom.replace('.0000',''));
      }
    }); 
  };
  function modal_addstatusperkara(header_id,jenis_hukum,jenis_perdata) {
    $('.type_input').val('insert');
    $('.detail_id').val('');
    $('#header_id').val(header_id);
    $('#jenis_perdata').val(jenis_perdata);
    $('.need_result,.need_lainnya').hide();
    list_status_perkara(jenis_hukum,'','',((jenis_hukum!=1)?'':jenis_perdata),'','');
  };
  function modal_addupayahukum(header_id,jenis_hukum,jenis_perdata) {
    $('.type_input').val('insert');
    $('.detail_id').val('');
    $('#header_id_upayahukum').val(header_id);
    $('#jenis_perdata_upayahukum').val(jenis_perdata);
    $('.need_result,.status_proses').hide();
    list_upaya_hukum(
      jenis_perdata,
      '_upayahukum',
      0
    )
    list_upaya_hukum(
      jenis_perdata,
      '_upayahukum_selanjutnya',
      1
    )
    $.ajax({
      url: "get_detail_header/laporan_header",
      type: "get",
      data: {
        '_token':"{{ csrf_token() }}",
        where:[
          {
            header_id:'',
            type:'isnull(laporan_parent_id,laporan_header_id) = '+header_id
          },
          {
            header_id:'1',
            type:'active'
          },
        ]
      },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();  
        var obj = msg[0];
        var penggugat = obj.laporan_header_pelapor.split(',');
        if(penggugat.length>0){
          for(var i = 0;i<penggugat.length;i++){
            $('#pemohon_upayahukum').tagsinput('add',penggugat[i]);
          }
        }
        var tergugat = obj.laporan_header_terlapor.split(',');
        if(tergugat.length>0){
          for(var i = 0;i<tergugat.length;i++){
            $('#termohon_upayahukum').tagsinput('add',tergugat[i]);
          }
        }
        var turut_tergugat = obj.turut_tergugat.split(',');
        if(turut_tergugat.length>0){
          for(var i = 0;i<turut_tergugat.length;i++){
            $('#turut_termohon_upayahukum').tagsinput('add',turut_tergugat[i]);
          }
        }
      }
    });
  };
  function modal_editstatusperkara(laporan_detail_id,jenis_hukum,jenis_perdata) {
    $('.type_input').val('update');
    $('.detail_id').val(laporan_detail_id);
    $('#header_id').val('');
    $('#jenis_perdata').val(jenis_perdata);
    $('.need_result,.need_lainnya').hide();
    list_status_perkara(jenis_hukum,'','',((jenis_hukum!=1)?'':jenis_perdata),'','');
    $.ajax({
      url: "get_detail_header/laporan_detail",
      type: "get",
      data: {
        '_token':"{{ csrf_token() }}",
        where:[
        {
          header_id:laporan_detail_id,
          type:'laporan_detail_id'
        },
        {
          header_id:'1',
          type:'m_aktif'
        }
        ]
      },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(data){
        $(".loading_ajax").hide();
        var msg = data[0];
        setTimeout(function(){        
          $('#instansi').val(msg.m_hukum_berjalan_id).selectpicker('refresh').change();
          $('#instansi_selanjutnya').val(msg.m_hukum_berjalan_selanjutnya_id).selectpicker('refresh').change();
          $('#upaya_hukum_selanjutnya').val(msg.m_upaya_hukum_selanjutnya).selectpicker('refresh').change();
          setTimeout(function(){
            $('#proses_hukum').val(msg.m_proses_hukum_id).selectpicker('refresh').change();
            $('#proses_hukum_selanjutnya').val(msg.m_proses_hukum_selanjutnya_id).selectpicker('refresh').change();
            setTimeout(function(){        
              $('#rangkaian_proses').val(msg.m_parameter_id).selectpicker('refresh').change();
              setTimeout(function(){
                $('#rangkaian_proses_selanjutnya').val(msg.agenda).selectpicker('refresh');
              }, 500);
            }, 500);
          }, 500);
        }, 500);
        $('#lembaga_hukum').val(msg.nama_lembaga);
        $('#keterangan_proses').val(msg.keterangan_parameter);
        $('#tanggal_pelaksanaan').val(msg.tanggal_pelaksanaan);
        $('#keterangan').val(msg.keterangan);
        $('#status_putusan').val(msg.m_status_akhir).selectpicker('refresh');
        $('#amar_putusan').val(msg.amar_putusan);
        $('#tanggal_pelaksanaan_selanjutnya').val(msg.tanggal_agenda);
      }
    }); 
  }
  function modal_editupayahukum(laporan_detail_id,jenis_hukum,jenis_perdata) {
    $('.type_input').val('update');
    $('.detail_id').val(laporan_detail_id);
    $('#header_id_upayahukum').val('');
    $('#jenis_perdata_upayahukum').val(jenis_perdata);
    $('.need_result,.status_proses').hide();
    $.ajax({
      url: "get_detail_header/laporan_detail as a",
      type: "get",
      data: {
        '_token':"{{ csrf_token() }}",
        join:[
          {
            table:"laporan_header as b",
            table_a_compare:'a.laporan_header_child_id',
            operator:'=',
            table_b_compare:'b.laporan_header_id'
          }
        ],
        where:[
          {
            header_id:laporan_detail_id,
            type:'laporan_detail_id'
          },
          {
            header_id:'1',
            type:'m_aktif'
          }
        ]
      },
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(data){
        $(".loading_ajax").hide();
        var msg = data[0];
		list_upaya_hukum(
		  jenis_perdata,
		  '_upayahukum',
		  0
		)
		list_upaya_hukum(
		  jenis_perdata,
		  '_upayahukum_selanjutnya',
		  1
		)
        setTimeout(function(){
          $('#upaya_hukum_upayahukum').val(msg.m_upaya_hukum_id).selectpicker('refresh').change();
          $('#upaya_hukum_upayahukum_selanjutnya').val(msg.m_upaya_hukum_selanjutnya).selectpicker('refresh').change();
          setTimeout(function(){        
            $('#rangkaian_proses_upayahukum').val(msg.m_parameter_id).selectpicker('refresh').change();          
            $('#rangkaian_proses_upayahukum_selanjutnya').val(msg.agenda).selectpicker('refresh').change();
          }, 500);
        }, 500);
        $('#tanggal_pelaksanaan_upayahukum').val(msg.tanggal_pelaksanaan);
        $('#nomor_perkara_upayahukum').val(msg.no_perkara);
        $('#keterangan_upayahukum').val(msg.keterangan);
        $('#kedudukan_perseroan_upayahukum').val(msg.kedudukan_perseroan);
        $('#pemohon_upayahukum').val(msg.laporan_header_pelapor);
        $('#termohon_upayahukum').val(msg.laporan_header_terlapor);
        $('#turut_termohon_upayahukum').val(msg.turut_tergugat);
        $('#status_putusan_upayahukum').val(msg.m_status_akhir);
        $('#amar_putusan_upayahukum').val(msg.amar_putusan);
        $('#tanggal_pelaksanaan_upayahukum_selanjutnya').val(msg.tanggal_agenda);
      }
    }); 
  }
  function modal_scheduleagenda(header_id){
    $.ajax({
      url: "list_schedule_agenda",
      type: "GET",
      data: {header_id : header_id},
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();  
        var data = msg.content;
        $('#calendar').fullCalendar('destroy');
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listYear'
          },
          defaultDate: new Date(),
          contentHeight: 800,
          navLinks: true,
          events:data
        });
      }
    });  
  }
  function number_format (number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
      if (('' + n).indexOf('e') === -1) {
        return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
      } else {
        var arr = ('' + n).split('e')
        var sig = ''
        if (+arr[1] + prec > 0) {
          sig = '+'
        }
        return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
      }
    }

    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || ''
      s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
  }
  function modal_hapusperkara(header_id,no_perkara){
    $('#hapus_header_id').val(header_id);
    $('#label-no-perkara').html(no_perkara);
  }
// =====================================================
  


</script>

@endsection

   