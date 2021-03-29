@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3 class="col-md-9 col-sm-9 col-xs-12">Laporan Notaris</h3>
            <div class="clearfix"></div>
            <div class="input-group col-md-3 col-sm-3 col-xs-3 pull-right">
              <a class="pull-right pencarian-detail" data-toggle="collapse" data-target="#search">
                <span> &nbsp&nbsp Pencarian Detail</span>
              </a>
            </div>
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
              <div class="row form-gorup search-field collapse" id='search'>
                <div class="col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2 col-xs-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <label class="control-label">Wilayah</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <select id="cari_wilayah" name="cari_wilayah" class="selectpicker form-control" data-live-search="true" onChange="change_wilayah('cari_wilayah')" style="width:100%" @if(Session::has('SIPP_kode_wilayah')) disabled @endif>
                        <option value=""> --Pilih Wilayah-- </option> 
                        @foreach($getCabang as $getData) 
                          <option value="{{ $getData->kode }}" @if(Session::has('SIPP_kode_wilayah')&&Session::get('SIPP_kode_wilayah')==$getData->kode) selected @endif> {{ $getData->nama }} </option>
                        @endforeach               
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <label class="control-label">Cabang</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <select id="cari_cabang" name="cari_cabang" class="selectpicker form-control" data-live-search="true" onChange="change_cabang('cari_cabang')" style="width:100%" @if(Session::has('SIPP_kode_cabang')) disabled @endif>
                        <option value=""> --Pilih Cabang-- </option>  
                        @if(Session::has('SIPP_kode_cabang')) 
                          <option value="{{Session::get('SIPP_kode_cabang')}}" selected> {{Session::has('SIPP_cabang')}} </option>
                        @endif                
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <label class="control-label">Mulai Tanggal</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input id="cari_mulai" name="cari_mulai" class="datepicker form-control" style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <label class="control-label">Sampai Tanggal</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input id="cari_sampai" name="cari_sampai" class="datepicker form-control" style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <br>
                      <button style='margin-top:5px' type="reset" class='btn btn-block btn-default btn-reset-search'>Reset</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <ul class="nav nav-tabs">
                <li class="active"><a  class="type-tab-content" data-toggle="tab" href="#wilayah">Wilayah</a></li>
                <li><a  class="type-tab-content" data-toggle="tab" href="#notaris">Notaris</a></li>
              </ul>
              <div class="tab-content">
                <div id="wilayah" class="tab-pane fade in active">
                  <br><br>
                  <table class="table table-striped table-bordered"  id="table_daftarwilayah" data-type='wilayah' style='overflow-y: hidden !important;'>
                    <thead>
                      <tr>
                        <th class="text-center" rowspan='2'>Legal Wilayah</th>
                        <th class="text-center" rowspan='2'>Cabang</th>
                        <th class="text-center" rowspan='2'>Jml Notaris</th>
                        <th class="text-center" rowspan='2'>Jml Nasabah</th>
                        <th class="text-center" colspan='4'>Pengikatan Pembiayaan</th>
                        <th class="text-center" colspan='4'>Pengikatan Agunan</th>
                        <th class="text-center" colspan='2'>CN</th>
                        <th class="text-center" colspan='{{count($getAgunan)}}'>Rekap Posisi</th>
                        <th class="text-center" colspan='{{count($getKendala)}}'>Rekap Kendala</th>
                      </tr>
                      <tr>
                        <th class="text-center">Selesai tepat waktu</th>
                        <th class="text-center">Selesai terlambat</th>
                        <th class="text-center">Proses</th>
                        <th class="text-center">Proses terlambat</th>
                        <th class="text-center">Selesai tepat waktu</th>
                        <th class="text-center">Selesai terlambat</th>
                        <th class="text-center">Proses</th>
                        <th class="text-center">Proses terlambat</th>
                        <th class="text-center">Aktif</th>
                        <th class="text-center">Habis</th>
                        @for($i=0;$i<count($getAgunan);$i++)
                          <th class="text-center" title='{{$getAgunan[$i]->nama}}'>{{chr(97+$i)}}</th>
                        @endfor
                        @for($i=0;$i<count($getKendala);$i++)
                          <th class="text-center" title='{{$getKendala[$i]->nama}}'>{{chr(97+$i)}}</th>
                        @endfor
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <br><Br>
                </div>
                <div id="notaris" class="tab-pane fade">
                  <br><br>
                  <table  style='overflow-y: hidden !important;' id="table_daftarnotaris" data-type='notaris' class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" rowspan='2'>Nama Notaris</th>
                        <th class="text-center" rowspan='2'>Jumlah Nasabah</th>
                        <th class="text-center" colspan='4'>Pengikatan Pembiayaan</th>
                        <th class="text-center" colspan='4'>Pengikatan Agunan</th>
                        <th class="text-center" colspan='2'>CN</th>
                        <th class="text-center" colspan='{{count($getAgunan)}}'>Rekap Posisi</th>
                        <th class="text-center" colspan='{{count($getKendala)}}'>Rekap Kendala</th>
                        <th class="text-center" colspan='{{count($getStatusRekomendasi)}}'>Rekap Rekomendasi</th>
                      </tr>
                      <tr>
                        <th class="text-center">Selesai tepat waktu</th>
                        <th class="text-center">Selesai terlambat</th>
                        <th class="text-center">Proses</th>
                        <th class="text-center">Proses terlambat</th>
                        <th class="text-center">Selesai tepat waktu</th>
                        <th class="text-center">Selesai terlambat</th>
                        <th class="text-center">Proses</th>
                        <th class="text-center">Proses terlambat</th>
                        <th class="text-center">Aktif</th>
                        <th class="text-center">Habis</th>
                        @for($i=0;$i<count($getAgunan);$i++)
                          <th class="text-center" title='{{$getAgunan[$i]->nama}}'>{{chr(97+$i)}}</th>
                        @endfor
                        @for($i=0;$i<count($getKendala);$i++)
                          <th class="text-center" title='{{$getKendala[$i]->nama}}'>{{chr(97+$i)}}</th>
                        @endfor
                        @for($i=0;$i<count($getStatusRekomendasi);$i++)
                          <th class="text-center" title='{{$getStatusRekomendasi[$i]->nama}}'>{{chr(97+$i)}}</th>
                        @endfor
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <br><Br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@section('modal-content')
  @include('modals.detailcn')
@endsection
    <script type="text/javascript">
    
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
        @if(Session::has("SIPP_kode_wilayah"))
          $('#cari_wilayah').val("{{Session::get('SIPP_kode_wilayah')}}").selectpicker('refresh').change();
        @endif
        @if(Session::has("SIPP_kode_cabang"))
          setTimeout(() => {
            $('#cari_cabang').val("{{Session::get('SIPP_kode_cabang')}}").selectpicker('refresh').change();  
          }, 500);
        @endif
        $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });
        $('.datepicker').datepicker('setDate','today');
        $('body').removeClass('nav-md').addClass('nav-sm');
        
        $('.btn-reset-search').on('click',function(){
          $(this).closest('.search-field').find("input, textarea,select").val("");
          $(this).closest('.search-field').find(".selectpicker").val("").selectpicker('refresh');
          $('#table_daftar'+$('.type-tab-content').closest('li.active').find('a').attr('href').replace('#','')).DataTable().ajax.reload();
        });
        $('.type-tab-content').on('click',function(){
          var tipe = $(this).attr('href').replace('#','');
          $("#table_daftar"+tipe).DataTable({
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
                title: 'LAPORAN '+tipe.toUpperCase(), 
                customize: function ( xlsx ){
                  var sheet = xlsx.xl.worksheets['sheet1.xml'];
                  @foreach($getAgunan as $key=>$value)
                    $('row:eq(1) c[r^="'+convertToNumberingScheme({{$key}}+1+((tipe=='wilayah')?14:12))+'"] t', sheet).text('{{$value->nama}}');
                  @endforeach
                  @foreach($getKendala as $key=>$value)
                    $('row:eq(1) c[r^="'+convertToNumberingScheme({{$key}}+1+((tipe=='wilayah')?14:12)+{{count($getAgunan)}})+'"] t', sheet).text('{{$value->nama}}');
                  @endforeach
                  if(tipe!='wilayah'){
                    @foreach($getStatusRekomendasi as $key=>$value)
                      $('row:eq(1) c[r^="'+convertToNumberingScheme({{$key}}+1+((tipe=='wilayah')?14:12)+{{count($getAgunan)+count($getKendala)}})+'"] t', sheet).text('{{$value->nama}}');
                    @endforeach
                  }
                },
                className: "btn-sm"
              },
              {
                extend: "pdfHtml5",
                title: 'LAPORAN '+tipe.toUpperCase(), 
                customize: function(doc) {
                  doc.defaultStyle.fontSize = 5; //<-- set fontsize to 9 instead of 10 
                  doc.styles.tableHeader.fontSize = 6;
                  doc.content[0].text = 'Laporan Daftar Jaminan Notaris';
                  @foreach($getAgunan as $key=>$value)
                    doc.content[1].table.body[0][{{$key}}+((tipe=='wilayah')?14:12)].text='{{$value->nama}}';
                  @endforeach
                  @foreach($getKendala as $key=>$value)
                    doc.content[1].table.body[0][{{$key}}+((tipe=='wilayah')?14:12)+{{count($getAgunan)}}].text='{{$value->nama}}';
                  @endforeach
                  if(tipe!='wilayah'){
                    @foreach($getStatusRekomendasi as $key=>$value)
                      doc.content[1] .table.body[0][{{$key}}+((tipe=='wilayah')?14:12)+{{count($getAgunan)+count($getKendala)}}].text='{{$value->nama}}';
                    @endforeach
                  }
                },
                orientation: 'landscape',
                pageSize: 'folio',
                tableHeader: {
                  fontSize: 9,
                },
                className: "btn-sm"
              },
              // {
              //   extend: "print",
              //   className: "btn-sm"
              // },
            ],
            "processing": true,
            "serverSide": true,
            retrieve: true,
            "scrollX": true,
            "ajax": {
              'url' : 'list_notaris',
              'datatype' : 'json',
              'type':'POST',
              'data' : function(d){d._token='{{ csrf_token() }}';d.type='laporan_notaris_for_print';d.wilayah=$('#cari_wilayah').val();d.cabang=$('#cari_cabang').val();d.unit=$('#cari_unit').val();d.mulai=$('#cari_mulai').val();d.selesai=$('#cari_sampai').val();d.tipe=tipe;}
            }
          });
          $('#cari_wilayah,#cari_cabang,#cari_unit,#cari_mulai,#cari_sampai').on('change',function(){
            $('#table_daftar'+tipe).DataTable().ajax.reload();
          });
          setTimeout(function(){ 
            $('#table_daftar'+tipe).DataTable().columns.adjust().responsive.recalc();
          },500);
        });
        $('.type-tab-content[href=#wilayah]').click();
      });
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
            $("#cari_cabang").html(obj.content);
            $("#cari_cabang").selectpicker('refresh');
          }
        });			
      }
      function change_cabang(id){
        var cabang = $('#'+id).val();
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
            if (id == 'cari_cabang') {
              $("#cari_unit").html(obj.content);
              $("#cari_unit").selectpicker('refresh');
            }
          }
        });			
      }
      function modal_getdetail(type,detailid,searchtype){
        $.ajax({
          url: "get_detail_laporan_notaris",
          type: "GET",
          data: {
            type : type,
            detail : detailid,
            search : searchtype,
            to_mulai:$('#cari_mulai').val(),
            to_selesai:$('#cari_sampai').val()
          },
          cache: false,
          beforeSend: function() {
            $(".loading_ajax").show(); 
          },
          success: function(obj){
            $(".loading_ajax").hide();	
            $('#tbody_trace').html(obj.content);
          }
        });
      }
    </script>

    @endsection

