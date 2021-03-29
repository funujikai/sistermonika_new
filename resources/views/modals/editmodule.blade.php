<div class="modal fade" id="modal_edit_module" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Edit User Role</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-label-left" action="{{ route('UpdateModuleUser') }}" method="POST">
					@foreach($getmenus as $key=>$value)
						<div class="form-group">
							<label class="col-md-2 col-sm-2 col-xs-12"> {{$value->nama_menu}} <span class="required">*</span></label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="checkbox">
									<label>
										<input id="read_{{$value->id}}" type="checkbox" name="read_{{$value->id}}" class="flat" value='1'> Read
									</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="checkbox">
									<label>
										<input id="insert_{{$value->id}}" type="checkbox" name="insert_{{$value->id}}" class="flat" value='1'> Insert
									</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="checkbox">
									<label>
										<input id="update_{{$value->id}}" type="checkbox" name="update_{{$value->id}}" class="flat" value='1'> Update
									</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="checkbox">
									<label>
										<input id="delete_{{$value->id}}" type="checkbox" name="delete_{{$value->id}}" class="flat" value='1'> Delete
									</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="checkbox">
									<label>
										<input id="detail_{{$value->id}}" type="checkbox" name="detail_{{$value->id}}" class="flat" value='1'> Detail
									</label>
								</div>
							</div>
						</div>
						<br>
					@endforeach
					<hr>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="module_header_id" name="header_id">
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