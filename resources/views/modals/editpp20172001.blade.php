<div class="modal fade modal_editpp" id="modal_editpp" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Ubah Data Perkara</h4>
			</div>
			</style>
			<form class="form-horizontal form-label-left" action="{{ url('P_EditPP') }}" method="POST" id="form-editstatusperkara">
			<div class="modal-body">
					<div class="form-group margin-40" id="div-id-kronologis-pp">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" onChange="change_cabang()" id="pp_cabang_edit" name="pp_cabang_edit" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Cabang-- </option> 
								@foreach($getCabang as $getData) 
		                         <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
		                        @endforeach
		                    </select>
						</div>
					</div>

					<div class="form-group margin-40 div-status-perkara-sp">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12 div-status-perkara-sp-2">
                          	<select class="selectpicker form-control" id="pp_unit_edit" name="pp_unit_edit" data-live-search="true" style="width:100%" required>
		                        <option value=""> --Pilih Unit-- </option> 
     		               </select>
                        </div>
                    </div>
					
					<div class="form-group margin-40" id="div_jenis_hukum_edit">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Hukum <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	<select class="selectpicker form-control" name="pp_jenis_hukum_edit" id="pp_jenis_hukum_edit" data-live-search="true" style="width:100%" required>
		                        <option value=""> --Pilih Jenis Hukum-- </option> 
		                        @foreach($getJenisHukum as $getData) 
		                          <option value="{{ $getData->kode }}" style="text-transform:uppercase"> {{ $getData->nama }} </option> 
		                        @endforeach
			                </select>
                        </div>
                    </div>
					
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Pelapor <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input id="pp_pelapor_edit" name="pp_pelapor_edit" style="text-transform:uppercase" class="form-control" required>
						</div>
					</div>

					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Terlapor <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input id="pp_terlapor_edit" name="pp_terlapor_edit" style="text-transform:uppercase" class="form-control" required>
						</div>
					</div>

					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">PIC</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="pp_pic_edit" id="pp_pic_edit" data-live-search="true" style="width:100%">
			                  <option value=""> --Pilih PIC-- </option> 
			                  @foreach($getUserPIC as $getData) 
			                  <option value="{{ $getData->idsdm }}" style="text-transform:uppercase"> {{ $getData->nama }} </option> 
			                  @endforeach
			                </select>
						</div>
					</div>

					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi Keuangan</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" class="form-control has-feedback-left estimasi-kerugian" id="pp_estimasi_kerugian_edit" name="pp_estimasi_kerugian_edit" data-a-dec="," data-a-sep=".">
		                    <i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
						</div>
					</div>
			</div>
			<div class="modal-footer">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" id="pp_header_id_edit" name="pp_header_id_edit">
				{{-- <input type="hidden" id="jenis_hukum" name="jenis_hukum"> --}}
                <a type="button" data-dismiss="modal" class="btn btn-default pull-left">Batal</a>
        		<button class="btn btn-primary pull-right" id="btn-simpan-sp">Ubah</button>
			</div>
	        </form>
		</div>
	</div>
</div>

<script type="text/javascript">
 //  $(document).ready(function() {
 //    $(":input").inputmask();
	
	// $('.datepicker').datepicker({
 //          format: 'yyyy-mm-dd',
 //          autoclose: true
 //      });

 //  });
  
  
  function list_status_perkara(){
		
		var jenis_hukum=$('#jenis_hukum').val();
		
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
               $("#status_perkara").html(obj.content);
			   $("#status_perkara").selectpicker('refresh');
			}
		});	
	}

	$('#status_perkara').on('change', function() {
		var putusan = $('#status_perkara').val();
	
		if (putusan == 9 || putusan == 19) {
			var hasil_putusan = '';
				hasil_putusan += '<div class="form-group margin-40 div-hasil-putusan-sp">';
				hasil_putusan += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Hasil <span class="required">*</span></label>';
				hasil_putusan += '<div class="col-md-9 col-sm-9 col-xs-12">';
				hasil_putusan += '<select class="selectpicker form-control" id="sp_status_wol" name="sp_status_wol" data-live-search="true" style="width:100%" required>';
				hasil_putusan += '<option value=""> --Pilih Status-- </option>';
				hasil_putusan += '<option value="1"> KALAH </option>';
				hasil_putusan += '<option value="2"> MENANG </option>';
				hasil_putusan += '</select>';
				hasil_putusan += '</div>';
			$('.div-status-perkara-sp').after(hasil_putusan);
			$('#sp_status_wol').selectpicker('refresh');
		} else {
			$('.div-hasil-putusan-sp').remove();
		};

		if (putusan == 12) {
			$('#btn-simpan-sp').attr({
				'data-toggle' : 'modal',
				'data-target' : '#modal_cabutgugatan'
			});


			$('#btn-simpan-sp').click(function() {
				event.preventDefault();
				var kronologis = $('#kronologis').val();
				var tanggal_perkara = $('#tanggal_perkara').val();
				var kendala = $('#kendala').val();
				var sp_komentar = $('#sp_komentar').val();
				var header_id = $('#header_id').val();
				$('#kronologis_cabutgugatan').val(kronologis);
				$('#status_perkara_cabutgugatan').val(putusan);
				$('#tanggal_perkara_cabutgugatan').val(tanggal_perkara);
				$('#kendala_cabutgugatan').val(kendala);
				$('#sp_komentar_cabutgugatan').val(sp_komentar);
				$('#header_id_cabutgugatan').val(header_id);
			});
		} else {
			$('#btn-simpan-sp').removeAttr('data-toggle data-target');
			$('#form-editstatusperkara').attr({
				'action' : '{{ url('P_TambahStatusPerkara') }}',
				'method' : 'POST'
			});
		};
	})
	
	</script>