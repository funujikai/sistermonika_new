<div class="modal fade modal_addstatusperkara" id="modal_addstatusperkara" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Tambah Kronologis Perkara</h4>
			</div>
			<form class="form-horizontal form-label-left" action="{{ url('P_TambahStatusPerkara') }}" method="POST" id="form-addstatusperkara" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group margin-40 jenis_hukum_2">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Instansi Hukum <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="instansi" id="instansi" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Instansi Hukum-- </option> 
								@foreach($getHukumBerjalan as $key=>$value)
									<option value="{{$value->kode}}">{{$value->nama}}</option> 
								@endforeach
							</select>                        
						</div>
                    </div>
					<div class="form-group margin-40 jenis_hukum_2">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lembaga Hukum <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<input required id="lembaga_hukum" name="lembaga_hukum" class="form-control" required type='text' autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40 jenis_hukum_2">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Proses Hukum <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="proses_hukum" id="proses_hukum" required data-live-search="true" style="width:100%">
								<option value=""> --Pilih Proses Hukum-- </option> 
							</select>                        
						</div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rangkaian Proses Hukum <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control rangkaian_proses" name="rangkaian_proses" id="rangkaian_proses" required data- live-search="true" style="width:100%">
							<option value=""> --Pilih Rangkaian Proses Hukum-- </option> 
						</select>
                        </div>
                    </div>
					<div class="form-group margin-40 need_lainnya">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan Proses <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<input id="keterangan_proses" name="keterangan_proses" class="form-control" required type='text' autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Pelaksanaan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" class="form-control datepicker" required type='text' autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40" id="div-id-kronologis-pp">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Laporan Penanganan <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="keterangan" id="keterangan" class="form-control" required style="width:100%; text-transform:uppercase" rows="4" required></textarea>
						</div>
					</div>
					<div class="form-group margin-40 need_result">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Putusan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control" name="status_putusan" id="status_putusan" data-live-search="true" style="width:100%" required>
							<option value=""> --Pilih Status Putusan-- </option> 	
						</select>
                        </div>
                    </div>
					<div class="form-group margin-40 need_result">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Amar Putusan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<textarea id="amar_putusan" name="amar_putusan" class="form-control" required></textarea>
                        </div>
                    </div>
					<div class="form-group margin-40 jenis_hukum_2 not_need_result">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Instansi Selanjutnya <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="instansi_selanjutnya" id="instansi_selanjutnya" required data-live-search="true" style="width:100%">
								<option value=""> --Pilih Agenda Instansi-- </option> 
								@foreach($getHukumBerjalan as $key=>$value)
									<option value="{{$value->kode}}">{{$value->nama}}</option> 
								@endforeach
							</select>
                        </div>
                    </div>
					<div class="form-group margin-40 jenis_hukum_2 not_need_result">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Proses Hukum Selanjutnya <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="proses_hukum_selanjutnya" required id="proses_hukum_selanjutnya" data-live-search="true" style="width:100%">
								<option value=""> --Pilih Proses Hukum-- </option> 
							</select>                        
						</div>
                    </div>
					<div class="form-group margin-40 need_result selanjutnya">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upaya Hukum Selanjutnya<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control" name="upaya_hukum_selanjutnya" required id="upaya_hukum_selanjutnya" data-live-search="true" style="width:100%">
							<option value=""> --Pilih Upaya Hukum-- </option> 
						</select>
                        </div>
                    </div>
					<div class="form-group margin-40 need_agenda selanjutnya">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Agenda Selanjutnya <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select class="selectpicker form-control rangkaian_proses_selanjutnya" name="rangkaian_proses_selanjutnya" required id="rangkaian_proses_selanjutnya" data-live-search="true" style="width:100%">
							<option value=""> --Pilih Agenda-- </option> 
						</select>
                        </div>
                    </div>

					<div class="form-group margin-40 need_agenda selanjutnya">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Agenda Selanjutnya</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="tanggal_pelaksanaan_selanjutnya" name="tanggal_pelaksanaan_selanjutnya" class="form-control datepicker" type='text' autocomplete="off">
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
						<input type="hidden" id="header_id" name="header_id">
						<input type="hidden" id="jenis_perdata" name="jenis_perdata">
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
		$('#rangkaian_proses').on('change',function(){
			console.log($(this).find(':selected'));
			$('.need_agenda').show(); //FZL
			$('.need_result').hide();
			$('.need_result').find('input[id]:hidden,select[id]:hidden,textarea[id]:hidden').removeAttr('required');
			$('.not_need_result').show();
			var type = $('.type-tab-content').closest('li.active').find('a').data('type');
			$('[class*=jenis_hukum_]').hide();
			$('.jenis_hukum_'+type).show();
			if($(this).find(':selected').data('need_result')==1){
				$('.need_result').show();
				$('.need_result').find('input[id]:hidden,select[id]:hidden,textarea[id]:hidden').attr('required',true);
				$('.not_need_result').hide();
				list_upaya_hukum(
					$('#jenis_perdata').val()
					,'_selanjutnya'
					,1
				)
			} 
			
			if($(this).find(':selected').data('need_agenda')==0){
				$('.need_agenda').hide();
			}
			
			if($(this).find(':selected').data('not_need_result')==0){
				$('.not_need_result').hide();
			}
				
			list_status_perkara(type,'','',((type!=1)?'':$('#jenis_perdata').val()),'','_selanjutnya');
		});
		$('#status_putusan').on('change',function(){
			console.log($(this).val());
			if($(this).val()==13){ //tunda
				$('.selanjutnya').hide();
			}else{
				$('.selanjutnya').show();
			}
		});

		$('#upaya_hukum_selanjutnya').on('change',function(){
			$('.need_agenda').show();
			if($(this).val()!=0&&$(this).find('option:selected').data('need_agenda')==0){
				list_status_perkara(
					''
					,''
					,''
					,''
					,$(this).val()
					,$(this).attr('id').replace('upaya_hukum','')
				);
			}else if($(this).find('option:selected').data('need_agenda')==1){
				$('.need_agenda').hide();
			}
		});
		$('#proses_hukum,#proses_hukum_selanjutnya').on('change',function(){
			if($(this).val!=0){
				list_status_perkara(
					$('.type-tab-content').closest('li.active').find('a').data('type')
					,$('#instansi'+$(this).attr('id').replace('proses_hukum','')).val()
					,$(this).val()
					,$('#jenis_perdata').val()
					,''
					,$(this).attr('id').replace('proses_hukum','')
				);
			}
		});
		$('#instansi,#instansi_selanjutnya').on('change',function(){
			if($(this).val()!=0){
				$('#proses_hukum'+$(this).attr('id').replace('instansi','')).removeAttr('disabled');
				$('#proses_hukum'+$(this).attr('id').replace('instansi','')).attr('required',true).selectpicker('refresh');
				if($(this).val()==2){
					$('#proses_hukum'+$(this).attr('id').replace('instansi','')).attr('disabled',true).removeAttr('required').selectpicker('refresh');
				}
				list_proses_hukum($(this).val(),$(this).attr('id').replace('instansi',''))
				list_status_perkara(
					$('.type-tab-content').closest('li.active').find('a').data('type')
					,$(this).val()
					,$('#proses_hukum'+$(this).attr('id').replace('instansi','')).val()
					,$('#jenis_perdata').val()
					,''
					,$(this).attr('id').replace('instansi','')
				);
			}
		});
  	});
</script>