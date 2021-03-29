<div class="modal fade" id="modal_edit_role" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Edit User Role</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-label-left" action="{{ route('UpdateUserRole') }}" method="POST">
					<input type="hidden" id="role_edit_id" name="role_edit_id">
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Role <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="role_edit_name" type="text" name="role_edit_name" class="form-control" placeholder="Role Name" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">PIC </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        	<div class="checkbox">
	                        	<label>
	                        		<input id="PIC_edit" type="checkbox" name="PIC" class="flat" value="1">
	                        	</label>
                        	</div>
                        </div>
                    </div>					
                    <div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Head </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        	<div class="checkbox">
	                        	<label>
	                        		<input id="head_edit" type="checkbox" name="head" class="flat" value="1">
	                        	</label>
                        	</div>
                        </div>
                    </div>						
                    <div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ambil Data HRIS </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	<select id="scope_edit" name="scope" class="form-control">
                          	 	<option value="">-- Pilih Batas HRIS --</option>
								<option value="Wilayah">Wilayah</option>
								<option value="Cabang">Cabang</option>
								<option value="Unit">Unit</option>
                          	</select>
                        </div>
                    </div>					
					<hr>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="header_id" name="header_id">
	                    <a type="button" data-dismiss="modal" class="btn btn-default btn-default pull-left">Batal</a>
	            		<button class="btn btn-default btn-info pull-right" data-target="modal_konfirmasi_simpan" data-toggle="modal">Simpan</button>
	                </div>
		        </form>
			</div>
		</div>
	</div>
</div>
