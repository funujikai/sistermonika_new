<div class="modal fade" id="modal_add_user" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Tambah User</h4>
			</div>
			</style>
			<div class="modal-body">
				<form class="form-horizontal form-label-left" action="{{ route('PostUserData') }}" method="POST">
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama User <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <select id="sipp_user" name="sipp_user" class="form-control selectpicker" data-live-search="true" >
                          	 	<option value="">-- Pilih User --</option>
                          	 	@foreach($getUserSipp as $user)
								<option value="{{ $user->Username }}">{{ $user->nama }}</option>
                          	 	@endforeach
                          	 </select>
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Role <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <select id="sipp_role" name="sipp_role" class="form-control" required>
                          	 	<option value="">-- Pilih Role --</option>
                          	 	@foreach($getRoles as $role)
								<option value="{{ $role->id }}">{{ $role->role_name }}</option>
                          	 	@endforeach
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

<script type="text/javascript">
  $(document).ready(function() {
  //   $(":input").inputmask();
	
	 // $('.datepicker').datepicker({
  //         format: 'yyyy-mm-dd',
  //         autoclose: true
  //     });
  });
	
</script>