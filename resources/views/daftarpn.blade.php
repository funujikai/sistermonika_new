@extends('layouts.layout')
@section('main_container')
<style>
  div.tooltip{
    position:absolute;
  }
</style>
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <div class="row">
        <div class="col-sm-12">
          <h3>
            Daftar Jaminan Notaris
          </h3>
        </div>
        <div class="col-sm-2 col-sm-offset-10 text-right">
          <a class='pencarian-detail' data-toggle="collapse" data-target="#search"><span>Pencarian Detail</span></a>
        </div>
      </div>
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
              <div class='row search-field'>
                <div class='col-md-12 col-sm-12 col-xs-12 collapse' id="search">
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Wilayah</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="cari_wilayah" name="cari_wilayah" class="selectpicker form-control" data-live-search="true" onChange="change_wilayah('cari_wilayah')" style="width:100%" @if(Session::has('SIPP_kode_wilayah')) disabled @endif>
                          <option value=""> --Pilih Wilayah-- </option>  
                          @foreach($getCabang as $getData) 
                            <option value="{{ $getData->kode }}" @if(Session::has('SIPP_kode_wilayah')&&Session::get('SIPP_kode_wilayah')==$getData->kode) selected @endif> {{ $getData->nama }} </option>
                          @endforeach                      
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="cari_cabang" name="cari_cabang" class="selectpicker form-control" data-live-search="true" onChange="change_cabang('cari_cabang')" style="width:100%" @if(Session::has('SIPP_kode_cabang')) disabled @endif>
                          <option value=""> --Pilih Cabang-- </option>
                          @if(Session::has('SIPP_kode_cabang')) 
                            <option value="{{Session::get('SIPP_kode_cabang')}}" selected> {{Session::has('SIPP_cabang')}} </option>
                          @endif               
                        </select>
                      </div>
                    </div>
          
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="cari_unit" name="cari_unit" class="selectpicker form-control" data-live-search="true" style="width:100%" @if(Session::has('SIPP_kode_unit')) disabled @endif>
                          <option value=""> --Pilih Unit-- </option> 
                          @if(Session::has('SIPP_kode_unit')) 
                            <option value="{{Session::get('SIPP_kode_unit')}}" selected> {{Session::has('SIPP_unit')}} </option>
                          @endif    
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mulai Tanggal <span class='type-search-date'></span></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input id="cari_mulai" name="cari_mulai" class="datepicker form-control" style="text-transform:uppercase">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sampai Tanggal <span class='type-search-date'></span></label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input id="cari_sampai" name="cari_sampai" class="datepicker form-control" style="text-transform:uppercase">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="cari_status" name="cari_status" class="selectpicker form-control" data-live-search="true" style="width:100%">
                            <option value="1"> --Pilih Status-- </option>   
                            <option value="1"> Aktif </option>   
                            <option value="0"> Non-Aktif </option>   
                          </select>
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
              </div>
              <br>
              <br>
              <br>
              <ul class="nav nav-tabs">
                <li><a  class="type-tab-content" data-toggle="tab" href="#unmapped_debitur" onclick="gettable('unmapped');$('.type-search-date').html('Pencairan')">Unmapped</a></li>
                <li class="active"><a  class="type-tab-content" id='mapped_data' data-toggle="tab" href="#laporan_notaris" onclick="gettable('mapped');$('.type-search-date').html('Order')">Mapped</a></li>
              </ul>
              <div class="tab-content">
                <div id="unmapped_debitur" class="tab-pane fade">
                  <br><br>
                  <table id="table_upmapped_debitur" class="table table-striped table-bordered" style='overflow-y: hidden !important;'>
                    <thead>
                      <tr>
                        <th class="text-center">Id Nasabah</th>
                        <th class="text-center">No Rekening</th>
                        <th class="text-center">Nasabah</th>
                        <th class="text-center">Plafond</th>
                        <th class="text-center">Wilayah</th>
                        <th class="text-center">Cabang</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Proses</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <div id="laporan_notaris" class="tab-pane fade in active">
                  <br><br>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-group-datatable" data-process='true'>Show</button>
                    <button type="button" class="btn btn-primary btn-group-datatable" data-process='false'>Hide</button>
                  </div>
				  <div class="btn-group" style="float:right;">                  
                    <a id="laporan_notaris_to_excell" type="button" class="btn btn-primary" href="download_laporan_notaris" target="_blank" >Notaris to Excell</a>
                  </div>	
                  <br><br>
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="table_daftarpp" class="table table-striped table-bordered table-responsive" style='overflow-y: hidden !important;width:100%;'>
                        <thead>
                          <tr>
                            <th class="text-center" rowspan='2'>ID Nasabah</th>
                            <th class="text-center" rowspan='2'>No Rekening</th>
                            <th class="text-center" rowspan='2'>Cabang</th>
                            <th class="text-center" rowspan='2'>Unit</th>
                            <th class="text-center" rowspan='2'>Nasabah</th>
                            <th class="text-center" rowspan='2'>Jenis Agunan</th>
                            <th class="text-center" rowspan='2'>Notaris</th>
                            <th class="text-center" rowspan='2'>No Covernote</th>
                            <th class="text-center" rowspan='2'>Tgl Covernote Awal</th>
                            <th class="text-center" rowspan='2'>Tgl Batas Covernote</th>
                            <th class="text-center" rowspan='2'>Pengikatan Pembiayaan</th>
                            <th class="text-center" colspan='2'>Penyelesaian Pengikatan Pembiayaan</th>
                            <th class="text-center" rowspan='2'>Status</th>
                            <th class="text-center" rowspan='2'>Pengikatan Agunan</th>
                            <th class="text-center" colspan='2'>Penyelesaian Pengikatan Agunan</th>
                            <th class="text-center" rowspan='2'>Status</th>
                            <th class="text-center" rowspan='2'>Lama Proses (hari)</th>
							<th class="text-center" rowspan='2'>Catatan Jaminan Pencairan</th>
							<th class="text-center" rowspan='2'>Catatan Jaminan Agunan</th>
                            <th class="text-center" rowspan='2'>Kendala</th>
                            <th class="text-center" rowspan='2'>Rekomendasi</th>
                            <th class="text-center" rowspan='2'>Perpanjangan</th>
                            <th class="text-center" rowspan='2'>Status Updated</th>
                            <th class="text-center" rowspan='2'>Proses</th>
                          </tr>
                          <tr>
                            <th>Jatuh Tempo</th>
                            <th>Realisasi</th>
                            <th>Jatuh Tempo</th>
                            <th>Realisasi</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- End div x_content -->
          </div> <!-- End div x_panel -->
        </div> <!-- End div modal row -->
      </div> <!-- End div modal body -->
    </div> <!-- End div class = "" -->
  </div> <!-- End div right col -->

@section('modal-content')
  @include('modals.addprosespn')
  @include('modals.editpn')
  @include('modals.notejaminanberjalan')
  @include('modals.perpanjangcn')
  @include('modals.konfirmasihapusdebitur')
  @include('modals.editprosespn')
  @include('modals.deleteprosespn')
  @include('modals.deletepn')
  @include('modals.dokumencn')
@endsection

<script type="text/javascript">
	var table = '';
  function convertToNumberingScheme(number) {
      var baseChar = ("A").charCodeAt(0),
          letters  = "";
      do {
        number -= 1;
        letters = String.fromCharCode(baseChar + (number % 26)) + letters;
        number = (number / 26) >> 0; // quick `floor`
      } while(number > 0);
      return letters;
    }
  $(document).ready(function() {
    $('body').removeClass('nav-md').addClass('nav-sm');
    $('.plafond').autoNumeric('init');
	$('.type-search-date').html('Pencairan');
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
	@if(Session::has("SIPP_kode_wilayah"))
		$('#cari_wilayah').val("{{Session::get('SIPP_kode_wilayah')}}").selectpicker('refresh').change();
	@endif
	@if(Session::has("SIPP_kode_cabang"))
    setTimeout(() => {
      $('#cari_cabang').val("{{Session::get('SIPP_kode_cabang')}}").selectpicker('refresh').change();  
    }, 500);
	@endif
	@if(Session::has("SIPP_kode_unit"))
    setTimeout(() => {
      $('#cari_unit').val("{{Session::get('SIPP_kode_unit')}}").selectpicker('refresh').change();  
    }, 1000);
	@endif
	gettable('mapped');
    $('#cari_wilayah,#cari_cabang,#cari_unit,#cari_mulai,#cari_sampai,#cari_status').on('change',function(){
		if(table=='mapped'){
			$('#table_daftarpp').DataTable().settings()[0].jqXHR.abort();
			$('#table_daftarpp').DataTable().ajax.reload();
		}else{
			$('#table_upmapped_debitur').DataTable().settings()[0].jqXHR.abort();
			$('#table_upmapped_debitur').DataTable().ajax.reload();
		}
    });
    $('.btn-reset-search').on('click',function(){
      $(this).closest('.search-field').find("input, textarea,select").val("");
      $(this).closest('.search-field').find(".selectpicker").val("").selectpicker('refresh');
      $('#table_daftarpp').DataTable().ajax.reload();
      $('#table_upmapped_debitur').DataTable().ajax.reload();      
    });
    $('.btn-group-datatable').on('click',function(e){
      e.preventDefault();
      var status = $(this).data('process');
      $('#table_daftarpp').DataTable().column(0).visible(status);
      $('#table_daftarpp').DataTable().column(1).visible(status);
      $('#table_daftarpp').DataTable().column(10).visible(status);
      $('#table_daftarpp').DataTable().column(14).visible(status);
      $('#table_daftarpp').DataTable().column(19).visible(status);
    });
    $('.btn-group-datatable[data-process=false]').click();   
    $('#mapped_data').on('click',function(){    
      setTimeout(function(){ 
        $('#table_daftarpp').DataTable().columns.adjust().responsive.recalc();
      },500);
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
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });

    // Function to make modal after modal works perfectly
    $(document).on('show.bs.modal', '.modal', function () {
      var zIndex = 1040 + (10 * $('.modal:visible').length);
      $(this).css('z-index', zIndex);
      setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
      }, 0);
    });
    $(document).on('hidden.bs.modal', '.modal', function () {
      $('.modal:visible').length && $(document.body).addClass('modal-open');
    });
    // End unction to make modal after modal works perfectly
    $('#modal_addprosespn').on('hidden.bs.modal', function() {
      $(this).find('form')[0].reset();
    });

    $('#modal_editpn').on('hidden.bs.modal', function() {
      if( $("#col_jenis_pengurusan_lainnya_edit").html() != undefined ){
        $("#col_jenis_pengurusan_lainnya_edit").remove();
      }
    });
	// $('.disabled-on-submit').on('click',function(){
		// $(this).prop('disabled',true);
	// });
	$('#pn_nama_notaris_edit').select2({
		minimumInputLength: 2,
		ajax: {
			url: 'search_notaris',
			dataType: 'json',
			type: "GET",
			quietMillis: 50,
			data: function (term) {
				return {
					term: term
				};
			},
			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
						return {
							text: item.text,
							id: item.id
						}
					})
				};
			}
		}
	});
	
	
	
  });

  $(".closed").on("click", function() {
    $(".msg-save-success").remove();
  });
  function convertDate(dt) {
    var newFormat = "";
    // a mapping of month name and numerical value
    var monthMapping = {
      jan:'01',
      feb: '02',
      mar: '03',
      apr: '04',
      may: '05',
      jun: '06',
      jul: '07',
      aug: '08',
      sep: '09',
      oct: '10',
      nov: '11',
      dec: '12'
    }
    // split the input string into three pieces
    var splitDt = dt.split(" ");
    // from the first piece get the numerical month value from the above obhect
    var month = monthMapping[splitDt[1].toLowerCase()];
    var date = parseInt(splitDt[0], 10)
    var year = splitDt[2]
    return year+'-'+month+'-'+date;
  }
  function DateDiff(date1, date2) {
      var datediff = date1.getTime() - date2.getTime();
      return (datediff / (24*60*60*1000));
  }
  function modal_editpn(
    type              
    ,header_id
    ,lap_tanggal_order
    ,lap_notaris_header_wilayah
    ,lap_notaris_header_cabang
    ,lap_notaris_header_unit
    ,id_debitur
    ,no_rekening
    ,lap_notaris_header_debitur
    ,plafond
    ,lap_notaris_header_notaris
    ,nama_notaris
    ,no_agunan
    ,m_jenis_agunan_id
    ,covernote
    ,masa_berlaku
    ,m_pengurusan_pencairan_id
    ,tanggal_pencairan
    ,m_pengurusan_agunan_id
    ,tanggal_agunan
    ,pengikatan_lainnya
  ) {
    $('#pn_header_id_edit').val(header_id);
    $('#pn_tanggal_order').val(lap_tanggal_order);
      @if(Session::has('SIPP_kode_wilayah'))
        $('#pn_wilayah_edit').removeAttr('disabled').selectpicker('refresh');
      @endif
      @if(Session::has('SIPP_kode_cabang'))
        $('#pn_cabang_edit').removeAttr('disabled').selectpicker('refresh');
      @endif
      @if(Session::has('SIPP_kode_unit'))
        $('#pn_unit_edit').removeAttr('disabled').selectpicker('refresh');
      @endif
	  
	  $('#pn_nama_notaris_edit').prop('required',false);
    if(type=='unmapped'){
      @if(Session::has('SIPP_kode_wilayah'))
        $('#pn_wilayah_edit').prop('disabled',true).selectpicker('refresh');
      @endif
      @if(Session::has('SIPP_kode_cabang'))
        $('#pn_cabang_edit').prop('disabled',true).selectpicker('refresh');
      @endif
      @if(Session::has('SIPP_kode_unit'))
        $('#pn_unit_edit').prop('disabled',true).selectpicker('refresh');
      @endif
	  $('#pn_nama_notaris_edit').prop('required',true);
    }
    $('#pn_wilayah_edit').val(lap_notaris_header_wilayah.trim()).selectpicker('refresh').change();
    setTimeout(function(){ 
      $('#pn_cabang_edit').val(lap_notaris_header_cabang.trim()).selectpicker('refresh').change();
      setTimeout(function(){ 
        $('#pn_unit_edit').val(lap_notaris_header_unit.trim()).selectpicker('refresh');
        // $('#pn_nama_notaris_edit').val(lap_notaris_header_notaris).selectpicker('refresh');
      },1000);
    },1000);
	$('#pn_nama_notaris_edit').html('<option selected=selected value="'+lap_notaris_header_notaris+'">'+nama_notaris+'</option>').trigger('change');
    $('#pn_id_debitur_edit').val(id_debitur);
    $('#pn_no_rekening_edit').val(no_rekening);
    $('#pn_nama_debitur_edit').val(lap_notaris_header_debitur);
    $('#pn_plafond').val(plafond);
    // $('#pn_nama_notaris_edit').val(lap_notaris_header_notaris);
    $('#pn_no_agunan').val(no_agunan);
    $('#pn_jenis_agunan').val(m_jenis_agunan_id).selectpicker('refresh');
    $('#pn_covernote').val(covernote);
    $('#pn_masa_berlaku').val(masa_berlaku);
    $('#pn_pencairan').val(m_pengurusan_pencairan_id).selectpicker('refresh');
    $('#pn_tanggal_pencairan').val(tanggal_pencairan);
    if(m_pengurusan_agunan_id!='')
      $('#pn_agunan').val(m_pengurusan_agunan_id.split(',')).selectpicker('refresh');
    $('#pn_tanggal_agunan').val(tanggal_agunan);
    if(pengikatan_lainnya==1)
      $('#pengikatan_lainnya').iCheck('check');

  }

  function modal_perpanjangan_cn(header_id) {
    $("#header_id_cn").val(header_id);
  }
  function modal_addprosespn(header_id,type) {
    $("#header_id").val(header_id);
    $("#tipe_pengikatan").val(type);
    $('.rekomendasi').show().find('select').prop('required',true);
    $('.kendala').show().find('select').prop('required',true);
	$('.alasan_kendala').show().find('select').prop('required',true);
    if(type==1){
      $('.rekomendasi').hide().find('select').removeAttr('required');
      $('.kendala').hide().find('select').removeAttr('required');
	  $('.alasan_kendala').hide().find('select').removeAttr('required');
      $('.title-form').html('Pembiayaan');
    }else{
      $('.title-form').html('Agunan');
    }
    $.ajax({
      type: "get",
      url: "get_status_pengikatan",
      data: {tipe_pengikatan:type},
      dataType:'json',
      success: function(data) {
        $("#pn_status").html(data.content);
        $("#pn_status").selectpicker('refresh');
      }
    });
  }
  function submit_order(header_id){
    $("#header_id_catatan_jaminan_submit").val(header_id);
  }
  function unsubmit_order(header_id){
    $("#header_id_catatan_jaminan_unsubmit").val(header_id);
  }
  function dokumencn(document){
    PDFObject.embed(document, "#dokumencn");
  }
  function modal_notejaminanberjalan(header_id, status_submit) {
    $("#header_id_catatan_jaminan").val(header_id);
    $.ajax({
      type: "get",
      url: "GetNoteNotarisBerjalan",
      data: "header_id="+header_id,
      success: function(data) {
        var obj = $.parseJSON(data);
        $("#pencairan #tbody_trace").html(obj.content[1]);
        $("#agunan #tbody_trace").html(obj.content[2]);
        // hide/show colom aksi pada modal jaminan berjalan
        if (status_submit == 1) {
          $('.col_aksi_jaminanberjalan').css('display', 'none');
        } else {
          $('.col_aksi_jaminanberjalan').show();
        }
        if($('.row-trace-pn').html() == undefined) {
          $("#submit").hide();
        } else {
          $("#submit").show();
        }
        // end
      }
    });
    // menghilangkan button submit pada modal jaminan berjalan setelah proses submit dilakukan
    if (status_submit == 1) {
      $("#submit").remove();
    }
    // end
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
        if (id == 'cari_wilayah') {
          $("#cari_cabang").html(obj.content);
          $("#cari_cabang").selectpicker('refresh');
        }
        if (id == 'pn_wilayah_edit') {
          $("#pn_cabang_edit").html(obj.content);
          $("#pn_cabang_edit").selectpicker('refresh');
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
        if (id == 'cari_cabang') {
          $("#cari_unit").html(obj.content);
          $("#cari_unit").selectpicker('refresh');
        }
        if (id == 'pn_cabang_edit') {
          $("#pn_unit_edit").html(obj.content);
          $("#pn_unit_edit").selectpicker('refresh');
          $("#pn_nama_notaris_edit").html(obj.notaris);
          // $("#pn_nama_notaris_edit").selectpicker('refresh');
        }
      }
    });			
  }

  function modal_editstatusnotaris(lap_notaris_detail_id,tipe_pengikatan) {
    $('.rekomendasi').show().find('select').prop('required',true);
    $('.kendala').show().prop('required',true);
    if(tipe_pengikatan==1){
      $('.rekomendasi').hide().find('select').prop('required',false);
      $('.kendala').hide().find('select').prop('required',false);
      $('.title-form').html('Pencairan');
    }else{
      $('.title-form').html('Agunan');
    }
    $.ajax({
      type: 'GET',
      url: 'GetDetailNotaris',
      data: {lap_notaris_detail_id : lap_notaris_detail_id,tipe_pengikatan:tipe_pengikatan},
      cache: false,
      success: function(msg) {
        var obj = $.parseJSON(msg);
        $('#pn_rekomendasi_edit').val(obj.content[0].rekomendasi).selectpicker('refresh')
        $("#pn_status_edit").html(obj.status);
        $("#pn_status_edit").selectpicker('refresh');
        $('#pn_status_edit').val(obj.content[0].id_status_jaminan).selectpicker('refresh');
        $('#tanggal_status_edit').val(dateFormat(obj.content[0].lap_notaris_detail_tanggal, "yyyy-mm-dd"));
        $('#pn_kendala_edit').val(obj.content[0].id_kendala).selectpicker('refresh');
        $('#pn_keterangan_edit').val(obj.content[0].keterangan);
        $('#detail_id_edit').val(obj.content[0].lap_notaris_detail_id);
      }
    });
  }

  function modal_deletestatusnotaris(lap_notaris_detail_id) {
    $.ajax({
      type: 'GET',
      url: 'GetDetailNotaris',
      data: {lap_notaris_detail_id : lap_notaris_detail_id},
      cache: false,
      success: function(msg) {
        var obj = $.parseJSON(msg);
        $('#detail_id_delete').val(obj.content[0].lap_notaris_detail_id);
      }
    });
  }
  function modal_deletedebitur(nasabahid,no_rekening,namanasabah){
    $('#nasabahid').val(nasabahid);
    $('#nomor_rekening').val(no_rekening);
    $('#nm_nasabah').val(namanasabah);
    $('#label-debitur').html(nasabahid+' | '+no_rekening+' | '+namanasabah);
  }
  function modal_deletepn(id){
    $('#delete_header_id').val(id);
  }
  function gettable(type){
	table = type;
	if(type=='mapped'){
		$('#table_daftarpp').DataTable().destroy();
		if ($.fn.DataTable.isDataTable( '#table_upmapped_debitur' ) ) {
			$('#table_upmapped_debitur').DataTable().settings()[0].jqXHR.abort();
		}
		$('#table_daftarpp').DataTable({
		  dom: "Bfrtip",
		  lengthMenu: [
			  [ 10, 25, 50,5000,10000],
			  [ '10', '25', '50','5000','10000']
		  ],
		  buttons: [
			{
			  extend: "pageLength",
			  className: "btn-sm"
			},
			{
			  extend: 'excelHtml5',
			  title: 'DAFTAR JAMINAN MAPPED NOTARIS',
			  customize: function ( xlsx ){
				var sheet = xlsx.xl.worksheets['sheet1.xml'];
				function Addrow(index,data) {
					msg='<row r="'+index+'">'
					for(i=0;i<data.length;i++){
						var k=data[i].k;
						var v=data[i].v;
						var s=data[i].s;
						msg += '<c t="inlineStr" r="' + k + index + '" s="'+s+'">';
						msg += '<is>';
						msg +=  '<t>'+v+'</t>';
						msg+=  '</is>';
						msg+='</c>';
					}
					msg += '</row>';
					return msg;
				}
				var html = sheet.childNodes[0].childNodes[1].innerHTML;
				var r1 = Addrow(($(html).length+3), [
					{ k: 'A', v: 'Disampaikan oLeh: ', s:'0'}
					, { k: 'B', v: 'Diverifikasi oleh: ', s:'0' }
					, { k: 'C', v: 'Disetujui Oleh: ', s:'0' }
					, { k: 'D', v: 'Disetujui Oleh: ', s:'0' }]);
				var r2 = Addrow(($(html).length+4), [
					{ k: 'A', v: 'Legal Cabang', s:'100'}
					, { k: 'B', v: 'Kepala Keuangan dan Operasional Cabang', s:'100' }
					, { k: 'C', v: 'Pemimpin Cabang', s:'100' }
					, { k: 'D', v: 'Kepala Divisi Legal', s:'100' }]);
				html+=r1;
				html+=r2;
				sheet.childNodes[0].childNodes[1].innerHTML =  html;
				$('row:last c').attr('ht',100);
				$('row:last c').attr('customHeight', 1);
			  },
			  exportOptions: {
				columns: ['th:not(:last-child,:eq(21))']
			  },
			  className: "btn-sm"
			},
			{
			  extend: "pdfHtml5",
			  title: 'DAFTAR JAMINAN MAPPED NOTARIS', 
			  customize: function(doc) {
				doc.defaultStyle.fontSize = 8; //<-- set fontsize to 9 instead of 10 
				doc.styles.tableHeader.fontSize = 9;
				doc.content[0].text = 'Laporan Daftar Jaminan Notaris';
			  },
			  exportOptions: {
				columns: [19,'th:not(:last-child,:eq(21))']
			  },
			  orientation: 'landscape',
			  pageSize: 'A2',
			  tableHeader: {
				fontSize: 9,
			  },
			  className: "btn-sm"
			},
		  ],
		  "paging": true,
		  'scrollX':true,
		  'scrollY':'500px',
		  "processing": true,
		  "serverSide": true,
		  retrieve: true,
		  "ajax": {
			'url' : 'list_notaris',
			'datatype' : 'json',
			'type':'POST',
			'data' : function(d){
				d._token='{{ csrf_token() }}';d.type='laporan_notaris';d.wilayah=$('#cari_wilayah').val();d.cabang=$('#cari_cabang').val();d.unit=$('#cari_unit').val();d.mulai=$('#cari_mulai').val();d.selesai=$('#cari_sampai').val();d.status=$('#cari_status').val();
				if($('#table_daftarpp').DataTable().settings()[0].jqXHR!=null){
					$('#table_daftarpp').DataTable().settings()[0].jqXHR.abort();
				}
			}
		  },
		  'rowCallback': function(row, data, index){
			var cell = 0;
			var date =  new Date();
			if(data[18]>14&&data[17].toLowerCase()=='proses notaris'){
			  cell = 14;
			  if($(row).find('td').length>19){
				cell = cell+4;
			  }
			  $(row).find('td:eq('+cell+')').css({'background':'red','color':'black'});
			}
			if(data[21]=='generated'){
			  cell = 16;
			  if($(row).find('td').length>19){
				cell = cell+4;
			  }
			  $(row).find('td:eq('+cell+')').css({'background':'red','color':'black'}); 
			}
			if(data[26]>1){ 
				$(row).find('td:eq(2)').css({'background':'#79e768','color':'black'}); 
			}			  			
			if(DateDiff(new Date(convertDate(data[9])),date)<=30){
			  $(row).find('td:eq(7)').css({'background':'#ffff00','color':'black'}); 
			  if(DateDiff(new Date(convertDate(data[9])),date)<0){
				$(row).find('td:eq(7)').css({'background':'#5BC0DE','color':'white'});
			  }else if(DateDiff(new Date(convertDate(data[9])),date)<=7){
				$(row).find('td:eq(7)').css({'background':'red','color':'black'});
			  }
			}
		  }
		});
	}else{
		
		$('#table_upmapped_debitur').DataTable().destroy();
		if ($.fn.DataTable.isDataTable( '#table_daftarpp' ) ) {
			$('#table_daftarpp').DataTable().settings()[0].jqXHR.abort();
		}
		$('#table_upmapped_debitur').DataTable({
		  dom: "Bfrtip",
		  lengthMenu: [
			  [ 10, 25, 50,5000,10000 ],
			  [ '10', '25', '50','5000','10000']
		  ],
		  buttons: [
			{
			  extend: "pageLength",
			  className: "btn-sm"
			},
			{
			  extend: 'excelHtml5',
			  title: 'DAFTAR JAMINAN UNMAPPED NOTARIS',
			  exportOptions: {
				columns: 'th:not(:last-child)'
			  },
			  className: "btn-sm"
			},
			{
			  extend: "pdfHtml5",
			  title: 'DAFTAR JAMINAN UNMAPPED NOTARIS', 
			  exportOptions: {
				columns: 'th:not(:last-child)'
			  },
			  orientation: 'landscape',
			  pageSize: 'A2',
			  tableHeader: {
				fontSize: 9,
			  },
			  className: "btn-sm"
			},
		  ],
		  "paging": true,
		  "responsive": true,
		  "processing": true,
		  "serverSide": true,
		  retrieve: true,
		  "ajax": {
			'url' : 'list_notaris',
			'datatype' : 'json',
			'type':'POST',
			'data' : function(d){
				d._token='{{ csrf_token() }}';d.type='unmapped_debitur';d.wilayah=$('#cari_wilayah').val();d.cabang=$('#cari_cabang').val();d.unit=$('#cari_unit').val();d.mulai=$('#cari_mulai').val();d.selesai=$('#cari_sampai').val();												
				if($('#table_upmapped_debitur').DataTable().settings()[0].jqXHR!=null){
					$('#table_upmapped_debitur').DataTable().settings()[0].jqXHR.abort();
				}
			}
		  }
		});
	}
  }
</script>

@endsection
