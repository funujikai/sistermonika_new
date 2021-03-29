<div class="modal fade modal_editpn" id="modal_editpn" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Ubah Data Penjaminan Notaris</h4>
			</div>
			<form class="form-horizontal form-label-left" action="{{ url('P_EditPN') }}" method="POST" id="form-editstatusperkara">
			<div class="modal-body">
					<div class="form-group margin-40" id="div-id-kronologis-pn">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Order <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type='text' class="datepicker form-control" id="pn_tanggal_order" name="pn_tanggal_order" required>
						</div>
					</div>
					<div class="form-group margin-40" id="div-id-kronologis-pn">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Wilayah <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" onChange="change_wilayah('pn_wilayah_edit')" id="pn_wilayah_edit" name="pn_wilayah_edit" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Wilayah-- </option> 
								@foreach($getCabang as $getData) 
		                         	<option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
		                        @endforeach
		                    </select>
						</div>
					</div>
					<div class="form-group margin-40" id="div-id-kronologis-pn">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" onChange="change_cabang('pn_cabang_edit')" id="pn_cabang_edit" name="pn_cabang_edit" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Cabang-- </option>  
		                    </select>
						</div>
					</div>

					<div class="form-group margin-40 div-status-perkara-sp">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12 div-status-perkara-sp-2">
                          	<select class="selectpicker form-control" id="pn_unit_edit" name="pn_unit_edit" data-live-search="true" style="width:100%" required>
		                        <option value=""> --Pilih Unit-- </option> 
     		               </select>
                        </div>
                    </div>
					
					<div class="form-group margin-40" id="div_nama_debitur_edit">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Nasabah <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
		                  <input id="pn_id_debitur_edit" name="pn_id_debitur_edit" style="text-transform:uppercase" class="form-control" required autocomplete="off">
		                </div>
                    </div>
					
					<div class="form-group margin-40" id="div_nama_debitur_edit">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No Rekening <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
		                  <input id="pn_no_rekening_edit" name="pn_no_rekening_edit" style="text-transform:uppercase" class="form-control" required autocomplete="off">
		                </div>
                    </div>
					
					
					<div class="form-group margin-40" id="div_nama_debitur_edit">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Nasabah <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
		                  <input id="pn_nama_debitur_edit" name="pn_nama_debitur_edit" style="text-transform:uppercase" class="form-control" required autocomplete="off">
		                </div>
                    </div>
					
					<div class="form-group margin-40" id="div_nama_debitur_edit">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Plafond <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" class="form-control has-feedback-left plafond" name="pn_plafond" id="pn_plafond" data-a-dec="," data-a-sep="." required autocomplete="off">
                  			<i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
		                </div>
                    </div>
					
					<div class="form-group margin-40 non_sertifikat">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Notaris <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
		                  <select id="pn_nama_notaris_edit" name="pn_nama_notaris_edit" style="text-transform:uppercase" class="form-control"  data-live-search="true">
						  </select>
		                </div>
					</div>
					
					<div class="form-group margin-40 non_sertifikat"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12">No. Agunan <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
						<input name="pn_no_agunan" id="pn_no_agunan" style="text-transform:uppercase" class="form-control" required autocomplete="off">
		                </div>
					</div>
					
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Surat Agunan <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" id="pn_jenis_agunan" name="pn_jenis_agunan" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Jenis Surat Agunan-- </option> 
								@foreach($getJenisAgunan as $getData) 
								<option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
								@endforeach
							</select>
		                </div>
					</div>
					<div class="form-group margin-40 non_sertifikat">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">No. Covernote <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input name="pn_covernote" id="pn_covernote" style="text-transform:uppercase" class="form-control" required autocomplete="off">
		                </div>
					</div>
					<div class="form-group margin-40 non_sertifikat">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Masa Berlaku <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type='text' class="datepicker form-control" id="pn_masa_berlaku" name="pn_masa_berlaku" required autocomplete="off">
		                </div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Pengikatan Pembiyaan <span class="required">*</span></label>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<select class="selectpicker form-control" id="pn_pencairan" name="pn_pencairan" data-live-search="true" style="width:100%" required>
								<option value=""> -- Pilih Pembiyaan -- </option> 
								@foreach($getPencairan as $value)
									<option value="{{$value->kode}}">{{$value->nama}}</option>  
								@endforeach 
							</select>
						</div>
						<div class="col-md-5 col-sm-5 col-xs-12">
							<input name="pn_tanggal_pencairan" id="pn_tanggal_pencairan"  style="text-transform:uppercase" class="datepicker form-control" @if(Session::has('SIPP_kode_cabang')) readonly  @endif required autocomplete="off">
						</div>
					</div>
					<div class="form-group margin-40 non_sertifikat">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Pengikatan Agunan <span class="required">*</span></label>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<select class="selectpicker form-control" multiple id="pn_agunan" name="pn_agunan[]" data-live-search="true" style="width:100%" required>
								<option value=""> -- Pilih Agunan -- </option>
								@foreach($getAgunan as $value)
									<option value="{{$value->kode}}" data-pengikatan="{{$value->pengikatan_lain}}">{{$value->nama}}</option>  
								@endforeach 
							</select>                
						</div>
						<div class="col-md-5 col-sm-5 col-xs-12">
							<input name="pn_tanggal_agunan" id="pn_tanggal_agunan" style="text-transform:uppercase" class="datepicker form-control" @if(Session::has('SIPP_kode_cabang')) readonly  @endif required autocomplete="off">
						</div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
						<div class="col-md-5 col-sm-5 col-xs-12">
							<font size='2'>
								<p>
									<input type="checkbox" class="flat" id='pengikatan_lainnya' name="pengikatan_lainnya" value="1"/> Pengikatan Lainnya</span>                
								</p>
							</font>
						</div>
					</div>

			</div>
			<div class="modal-footer">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" id="pn_header_id_edit" name="pn_header_id_edit">
				{{-- <input type="hidden" id="jenis_hukum" name="jenis_hukum"> --}}
                <a type="button" data-dismiss="modal" class="btn btn-default pull-left">Batal</a>
        		<button class="btn btn-primary pull-right disabled-on-submit" id="btn-simpan-sp">Ubah</button>
			</div>
	        </form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$(".non_sertifikat").show();		
		$('#pn_nama_notaris_edit').prop('required',true);		
		$('#pn_covernote').prop('required',true);		
		$('#pn_no_agunan').prop('required',true);		
		$('#pn_masa_berlaku').prop('required',true);		
		$('#pn_agunan').prop('required',true);
	});


  $('#pn_jenis_agunan').on('change',function(){  
	if ($(this).val()==3){  //non_sertifikat
		$(".non_sertifikat").hide();			
		$('#pn_nama_notaris_edit').prop('required',false);		
		$('#pn_covernote').prop('required',false);		
		$('#pn_no_agunan').prop('required',false);		
		$('#pn_masa_berlaku').prop('required',false);		
		$('#pn_agunan').prop('required',false);						
	}else{
		$(".non_sertifikat").show();		
		$('#pn_nama_notaris_edit').prop('required',true);		
		$('#pn_covernote').prop('required',true);		
		$('#pn_no_agunan').prop('required',true);		
		$('#pn_masa_berlaku').prop('required',true);		
		$('#pn_agunan').prop('required',true);		
	}
  });
</script>