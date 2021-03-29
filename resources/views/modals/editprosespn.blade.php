<div class="modal fade" id="modal_editstatusnotaris" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Ubah Pengikatan <label class='title-form'></label></h4>
			</div>
			</style>
			<form class="form-horizontal form-label-left" action="{{ route('EditProsesPN') }}" method="POST">
				<div class="modal-body">
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	<select class="selectpicker form-control" id="pn_status_edit" name="pn_status_edit" data-live-search="true" style="width:100%" required>
		                          <option value=""> --Pilih Status-- </option> 
		                    </select>
                        </div>
                    </div>
					
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Status <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="tanggal_status_edit" name="tanggal_status_edit" class="datepicker form-control" required autocomplete="off">
                        </div>
                    </div>
					
					<div class="form-group margin-40 kendala">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Kendala <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" id="pn_kendala_edit" name="pn_kendala_edit" data-live-search="true" style="width:100%" required>
		                          <option value=""> --Pilih Status-- </option> 
		                          @foreach($getKendala as $getData)
		                          <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
		                          @endforeach
		                    </select>
						</div>
					</div>

					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea id="pn_keterangan_edit" name="pn_keterangan_edit" class="form-control" maxlength="160" style="width:100%; text-transform:uppercase" rows="4"></textarea>
						</div>
					</div>
					
					<div class="form-group margin-40 rekomendasi">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Rekomendasi <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" id="pn_rekomendasi_edit" name="pn_rekomendasi" data-live-search="true" style="width:100%" required>
		                          <option value=""> --Pilih Rekomendasi-- </option> 
		                          @foreach($getStatusRekomendasi as $getData)
		                          <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
		                          @endforeach
		                    </select>
						</div>
					</div>

				</div>
				<div class="modal-footer">
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="detail_id_edit" name="detail_id_edit">
                    <a type="button" data-dismiss="modal" class="btn btn-warning pull-left">Batal</a>
            		<button class="btn btn-primary pull-right" data-target="modal_konfirmasi_simpan" data-toggle="modal">Ubah</button>
				</div>
		    </form>
		</div>
	</div>
</div>

<script type="text/javascript">
 
  $(document).ready(function() {
    $(":input").inputmask();
	
	 $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
      });
  });
  
</script>