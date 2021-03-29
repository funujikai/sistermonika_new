@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    {{-- <div class="clearfix"></div> --}}
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Laporan Perkara</h3>
            <div class="clearfix"></div>
            <div class="input-group pull-right">
              <a class="collapse-link pull-right pencarian-detail"><span> &nbsp&nbsp Pencarian Detail</span>
              </div><div class="clearfix"></div>
            </div></a>
            <div class="x_content">
              <form class="form-horizontal form-label-left" novalidate>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Wilayah</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_wilayah" name="cari_wilayah" class="selectpicker form-control" data-live-search="true" style="width:100%" onChange="change_wilayah()">
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
                    <select id="cari_cabang" name="cari_cabang" class="selectpicker form-control" data-live-search="true" style="width:100%" onChange="change_cabang()">             
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_unit" name="cari_unit" class="selectpicker form-control" data-live-search="true" style="width:100%">

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Perkara</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="text" class="form-control" name="cari_perkara" id="cari_perkara" style="text-transform:uppercase">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cari_pelapor">Pelapor
                  </label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                      <input type="text" class="form-control" name="cari_pelapor" style="text-transform:uppercase">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cari_pelapor">Terlapor
                  </label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                      <input type="text" class="form-control" name="cari_terlapor" style="text-transform:uppercase">
                  </div>
                </div>
			        </form>
            </div>
          </div>
        </div>
		<div class="col-md-12 col-sm-12 col-xs-12">
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
							<table id="table_daftarpp_{{str_replace(' ','',$value->nama)}}" class="table table-striped table-bordered dt-responsive table-fixed" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="5%">Wilayah</th>
										<th width="5%">Cabang</th>
										<th width="5%">Unit</th>
										<th width="8%">Jenis Hukum</th>
										<th width="10%">Perkara</th>
										<th width="10%">Pelapor</th>
                    @IF($value->nama=='PERDATA')
                      <th width="10%">Penggugat</th>
                      <th width="10%">Tergugat</th>
                    @ELSE
                      <th width="10%">Pelapor</th>
                      <th width="10%">Terlapor</th>
                    @ENDIF
										<th width="10%">Tanggal Status</th>
										<th width="15%">Kendala</th>
										<th width="20%">Kronologis</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				@endforeach
			</div>
        </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
      $(document).ready(function() {
        $('body').removeClass('nav-md').addClass('nav-sm');

        $('#table_testing').DataTable({
          "order": []
        });

        $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });

		$('#cari_perkara').keypress(function(){
			$('#table_daftarpp_'+$('#tabs-perkara').find('li.active a').attr('href').replace('#','')).DataTable().ajax.reload();
		});
		$('#cari_wilayah,#cari_cabang,#cari_unit,#cari_perkara,#cari_statusid').on('change',function(){
			$('#table_daftarpp_'+$('#tabs-perkara').find('li.active a').attr('href').replace('#','')).DataTable().ajax.reload();
		});
		$('.type-tab-content').on('click',function(){
			var type = $(this).data('type');
			$('#table_daftarpp_'+$(this).attr('href').replace('#','')).DataTable({
				dom: "Bfrtip",
				lengthMenu: [
					[ 10, 25, 50, 100 ],
					[ '10 rows', '25 rows', '50 rows', '100 rows' ]
				],
				buttons: [
					{
						extend: "pageLength",
						className: "btn-sm"
					},
					{
						extend: "pdfHtml5",
						orientation: 'landscape',
						filename: 'Data export', 
						download: 'open',
						title: 'Laporan Perkara',
						className: "btn-sm"
					},
				],
				responsive: true,
				"processing": true,
				"serverSide": true,
				retrieve: true,
				"ajax": {
					'url' : 'list_perkara',
					'datatype' : 'json',
					'type':'POST',
					'data' : function(d){
							d._token='{{ csrf_token() }}';
							d.type='laporan_for_print';
							d.idperkara = type;
							d.wilayah=$('#cari_wilayah').val();
							d.cabang=$('#cari_cabang').val();
							d.unit=$('#cari_unit').val();
							d.perkara=$('#cari_perkara').val();
							d.pelapor=$('#cari_pelapor').val();
							d.terlapor=$('#cari_terlapor').val();
						}
				}
			});
		});
		$('.type-tab-content[data-key=0]').click();
		
        var handleDataTableButtons = function() {
          if ($("#table_daftarpp").length) {
            
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        TableManageButtons.init();


      });

      function change_cabang(){
    
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

      function list_cari_status_perkara(){

        var jenis_hukum=$('#cari_jenis_hukum').val();

        $.ajax({
          url: "list_status_perkara",
          type: "GET",
          data: {jenis_hukum : jenis_hukum},
          cache: false,
          beforeSend: function() {
            $(".loading_ajax").show(); 
          },
          success: function(msg){
            $(".loading_ajax").hide();  
            var obj = $.parseJSON(msg);
            $("#cari_perkara").html(obj.content);
            $("#cari_perkara").selectpicker('refresh');
          }
        });     
      }

      $('#cari_jenis_hukum').on('change', function() {
        var cari_jenis_hukum = $('#cari_jenis_hukum option:selected').text();
        $('#cari_jenis_hukum_text').val(cari_jenis_hukum);
      }); 


    </script>

    @endsection

   