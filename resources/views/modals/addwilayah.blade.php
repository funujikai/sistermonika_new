<div class="modal fade" id="modal_addwilayah" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Tambah Wilayah</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-label-left" action="{{ route('AddWilayah') }}" method="POST">
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Wilayah <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="add_wilayah" style="text-transform:uppercase" type="text" name="wilayah" class="form-control" placeholder="Wilayah" required>
                        </div>
                    </div>
                    <div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<select id="cabang" name="cabang[]" multiple class="selectpicker form-control" data-live-search="true" onChange="change_cabang()" style="width:100%">
								<option value=""> --Pilih Cabang-- </option>               
								@foreach($getCabang as $getData) 
									<option value="{{ $getData->kode }}"> {{ $getData->nama }} </option>
								@endforeach                 
							</select>                        
						</div>
                    </div>
					
					<hr>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                    <a type="button" data-dismiss="modal" class="btn btn-default btn-default pull-left">Batal</a>
	            		<button class="btn btn-default btn-info pull-right" data-target="modal_konfirmasi_simpan" data-toggle="modal">Simpan</button>
	                </div>
		        </form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
  //   $(":input").inputmask();
	
	 // $('.datepicker').datepicker({
  //         format: 'yyyy-mm-dd',
  //         autoclose: true
  //     });
  });
	
</script>