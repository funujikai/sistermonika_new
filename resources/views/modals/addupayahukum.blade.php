<div class="modal fade modal_addstatusperkara" id="modal_addupayahukum" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Tambah Kronologis Perkara</h4>
			</div>
			<form class="form-horizontal form-label-left" action="{{ url('P_TambahUpayaHukum') }}" method="POST" id="form-addupayahukum" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upaya Hukum<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control" name="upaya_hukum_upayahukum" required id="upaya_hukum_upayahukum" data-live-search="true" style="width:100%">
							<option value=""> --Pilih Upaya Hukum-- </option> 
						</select>
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rangkaian Proses Hukum <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control rangkaian_proses" name="rangkaian_proses_upayahukum" id="rangkaian_proses_upayahukum" required data- live-search="true" style="width:100%">
							<option value=""> --Pilih Rangkaian Proses Hukum-- </option> 
						</select>
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Pelaksanaan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="tanggal_pelaksanaan_upayahukum" name="tanggal_pelaksanaan" class="form-control datepicker" required type='text' autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40 status_proses">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class='no_perkara'>No Laporan Polisi</span> <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<input required id="nomor_perkara_upayahukum" name="nomor_perkara" class="form-control" required type='text' autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Laporan Penanganan <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="keterangan_upayahukum" id="keterangan_upayahukum" class="form-control" required style="width:100%; text-transform:uppercase" rows="4" required></textarea>
						</div>
					</div>
					<div class="form-group margin-40 status_proses">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">kedudukan perseroan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<input required id="kedudukan_perseroan_upayahukum" name="lembaga_hukum_upayahukum" class="form-control" required type='text' autocomplete="off">
						</div>
                    </div>
					<div class="form-group margin-40 status_proses">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id='lbl-penggugat-upaya-hukum'>Pemohon <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<input required id="pemohon_upayahukum" data-role="tagsinput"  name="pemohon_upayahukum" class="form-control" required type='text'>						
							<span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>
						</div>
                    </div>
					<div class="form-group margin-40 status_proses">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id='lbl-tergugat-upaya-hukum'>Termohon <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<input required id="termohon_upayahukum" data-role="tagsinput"  name="termohon_upayahukum" class="form-control" required type='text'>
							 <span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>						
						</div>
                    </div>
					<div class="form-group margin-40 status_proses">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id='lbl-turut_tergugat-upaya-hukum'>Turut Termohon </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<input required id="turut_termohon_upayahukum" data-role="tagsinput"  name="turut_termohon_upayahukum" class="form-control" type='text'>
							<span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>						
						</div>
                    </div>
					<div class="form-group margin-40 need_result">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Putusan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control" name="status_putusan_upayahukum" id="status_putusan_upayahukum" data-live-search="true" style="width:100%" required>
							<option value=""> --Pilih Status Putusan-- </option> 
						</select>
                        </div>
                    </div>
					<div class="form-group margin-40 need_result">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Amar Putusan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<textarea id="amar_putusan_upayahukum" name="amar_putusan_upayahukum" class="form-control" required></textarea>
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upaya Hukum Selanjutnya<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control" name="upaya_hukum_upayahukum_selanjutnya" required id="upaya_hukum_upayahukum_selanjutnya" data-live-search="true" style="width:100%">
							<option value=""> --Pilih Upaya Hukum-- </option> 
						</select>
                        </div>
                    </div>
					<div class="form-group margin-40 need_agenda">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Agenda Selanjutnya <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control rangkaian_proses_upayahukum_selanjutnya" name="rangkaian_proses_upayahukum_selanjutnya" required id="rangkaian_proses_upayahukum_selanjutnya" data-live-search="true" style="width:100%">
							<option value=""> --Pilih Agenda-- </option> 
						</select>
                        </div>
                    </div>

					<div class="form-group margin-40 need_agenda">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Agenda Selanjutnya</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="tanggal_pelaksanaan_upayahukum_selanjutnya" name="tanggal_pelaksanaan_upayahukum_selanjutnya" class="form-control datepicker" type='text' autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dokumen</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="dokumen" name="dokumen" class="form-control" type='file'>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="header_id_upayahukum" name="header_id">
						<input type="hidden" id="status_proses" name="status_proses">
						<input type="hidden" id="jenis_perdata_upayahukum" name="jenis_perdata">
						<input type="hidden" class="type_input" name="type_input">
						<input type="hidden" class="detail_id" name="detail_id">
	                </div>
				</div>
				<div class="modal-footer">
					<a type="button" data-dismiss="modal" class="btn btn-warning pull-left">Batal</a>
					<button class="btn btn-primary pull-right disabled-on-submit" id="btn-simpan-sp-add">Simpan</button>
				</div>
		    </form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#rangkaian_proses_upayahukum,#rangkaian_proses_upayahukum_selanjutnya').on('change',function(){
			if($(this).attr('id').replace('rangkaian_proses','')!='_upayahukum_selanjutnya'){
				$('.need_result,.status_proses').hide();
				$('.need_result,.status_proses').find('input[id]:hidden,select[id]:hidden,textarea[id]:hidden').removeAttr('required');
				$('#status_proses').val($(this).find(':selected').data('status_proses'));
				if($(this).find(':selected').data('need_result')==1){
					$('.need_result').show();
					$('.need_result').find('input[id]:hidden,select[id]:hidden,textarea[id]:hidden').attr('required',true);
				}
				if($(this).find(':selected').data('status_proses')==1){
					$('.status_proses').show();
					$('.status_proses').find('input[id]:hidden,select[id]:hidden,textarea[id]:hidden').attr('required',true);
				}
			}
			$('#turut_termohon_upayahukum').removeAttr('required');
		});
		$('#upaya_hukum_upayahukum_selanjutnya,#upaya_hukum_upayahukum').on('change',function(){
			$('.need_agenda').show();
			if($(this).find('option:selected').data('need_agenda')==0){
				list_status_perkara(
					''
					,''
					,''
					,''
					,$(this).val()
					,$(this).attr('id').replace('upaya_hukum','')
				);				
				$('.rangkaian_proses_upayahukum_selanjutnya').prop('required',true);
			}
			if($(this).find('option:selected').data('need_agenda')==1&&$(this).attr('id')=='upaya_hukum_upayahukum_selanjutnya'){
				$('.need_agenda').hide();
				$('.rangkaian_proses_upayahukum_selanjutnya').removeAttr('required');
			}
			if($(this).attr('id')=='upaya_hukum_upayahukum'){
				$('#lbl-penggugat-upaya-hukum').html($(this).find('option:selected').data('penggugat')+' <span class="required">*</span>');
				$('#lbl-tergugat-upaya-hukum').html($(this).find('option:selected').data('tergugat')+' <span class="required">*</span>');
				if($(this).find('option:selected').data('turut_tergugat')!='-'){
					$('#lbl-turut_tergugat-upaya-hukum').html($(this).find('option:selected').data('turut_tergugat'));
				}
			}
		});
  	});
</script>