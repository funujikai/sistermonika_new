@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3 class="col-md-9 col-sm-9 col-xs-12">History Hukum Perkara</h3>
            <div class="clearfix"></div>
            <div class="input-group col-md-3 col-sm-3 col-xs-3 pull-right">
              <a class="collapse-link pull-right pencarian-detail"><span> &nbsp&nbsp Pencarian Detail</span>
                  </div><div class="clearfix"></div>
                </div></a>
                <div class="x_content" style="display: none;">
              <form class="form-horizontal form-label-left" novalidate>
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
			        </form>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          @if(Session::has('messageSubmitScs'))
          <div class="msg-save-success">
            <i class="fa fa-paper-plane-o" aria-hidden="ture" style="font-size: 17px">
              <span id="garis-tegak">|</span>
            </i>
            {{ Session::get('messageSubmitScs') }}
            <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
          </div>
          @endif
		  
		<ul class="nav nav-tabs" id='tabs-perkara'>
			@foreach($getJenisHukum as $key=>$value)
				<li @if($key==0) class='active' @endif><a class="type-tab-content" data-key='{{$key}}' data-type='{{$value->kode}}' data-toggle="tab" href="#{{str_replace(' ','',$value->nama)}}">{{$value->nama}}</a></li>
			@endforeach
		</ul>
		<div class="tab-content">
		@foreach($getJenisHukum as $key=>$value)
		<div id="{{str_replace(' ','',$value->nama)}}" class="tab-pane fade @if($key==0) in active @endif">
			<div class="x_panel">
				<div class="x_content">
					<table id="table_daftarpp_{{str_replace(' ','',$value->nama)}}" class="table table-striped table-bordered table-responsive" style='overflow-y: hidden !important;width:100%;'>
						<thead>
							<tr>
                <th rowspan='2'>Unit Bisnis</th>
                <th rowspan='2'>Wilayah</th>
                <th rowspan='2'>Cabang</th>
                <th rowspan='2'>Unit</th>
                <th rowspan='2'>PIC</th>
                <th rowspan='2'>No Perkara</th>
                <th rowspan='2'>Tanggal Regis</th>
                @IF($value->penggugat=='-')
                  <th rowspan='2'>Penggugat/Pembanding/Pemohon Kasasi/Pemohon PK</th>
                @ELSE
                  <th rowspan='2'>{{$value->penggugat}}</th>
                @ENDIF
                @IF($value->tergugat=='-')
                  <th rowspan='2'>Tergugat/Terbadngin/Termohon Kasasi/Termohon PK</th>
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
								<th rowspan='2'>Tanggal Status</th>
								<th rowspan='2'>Status Akhir</th>
								<th rowspan='2'>Lama Proses</th>
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
				</div>
			</div> <!-- end div col -->
		</div> <!-- end div col -->
		@endforeach
        </div> <!-- end div row -->
	  </div>
	</div>
  </div>
</div>
@section('modal-content')
  @include('modals.tracelaporan')
  @include('modals.scheduleagenda')
  @include('modals.hapusperkara')
@endsection
<script type="text/javascript">
  $(document).ready(function() {
    $('body').removeClass('nav-md').addClass('nav-sm');
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
	$('#cari_unit_bisnis,#cari_wilayah,#cari_cabang,#cari_area,#cari_unit,#cari_jenis_perdata,#cari_dasar_perdat,#cari_mulai,#cari_sampai').on('change',function(){
		$('#table_daftarpp_'+$('.type-tab-content').closest('li.active').find('a').attr('href').replace('#','')).DataTable().ajax.reload();
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
			$('#table_daftarpp_'+$(this).attr('href').replace('#','')).DataTable(
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
              title: 'HISTORY HUKUM PERKARA '+html.toUpperCase(),
              exportOptions: {
                columns: 'th:not(:last-child)'
              },
              className: "btn-sm"
            },
            {
              extend: "pdfHtml5",
              title: 'HISTORY HUKUM PERKARA '+html.toUpperCase(), 
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
          'scrollX':true,
          'scrollY':'250px',
					"processing": true,
					"serverSide": true,
					retrieve: true,
					"ajax": {
						'url' : 'list_perkara',
						'datatype' : 'json',
						'type':'POST',
            'data':function(d){
              d._token='{{ csrf_token() }}';
              d.type='laporan_closed';
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
        $('#table_daftarpp_'+$('.type-tab-content').closest('li.active').find('a').attr('href').replace('#','')).DataTable().columns.adjust().responsive.recalc();
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
	  $('.btn-reset-search').click();
	  $('#cari_unit_bisnis').val('');
	  $('#cari_unit_bisnis').change();
	  @if(Session::has("SIPP_kode_wilayah"))
		$('#cari_wilayah').val("{{Session::get('SIPP_kode_wilayah')}}").selectpicker('refresh').change();
	  @endif
	});
		$('.type-tab-content[data-key=0]').click();
    $(".closed").on("click", function() {
      $(".msg-save-success").remove();
    });
	
    $('#hidden_id').on('change',function(){
      $('#table_tracelaporan').DataTable().ajax.reload();  
    });
  });
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
  // function hapus_perkara(header_id){ //FZL
  // console.log('masuk nih');
    // $.ajax({
      // url: "deleteperkarahistory",
      // type: "POST",
      // data: {header_id : header_id},
      // cache: false,
      // beforeSend: function() {
        // $(".loading_ajax").show(); 
      // },
      // success: function(msg){
        // $(".loading_ajax").hide();  
      // }
    // });  
  // }  
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
</script>

    @endsection

