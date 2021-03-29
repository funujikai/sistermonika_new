<div class="modal modal-konfirmasi fade" id="modal_activate_role" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Pesan</h4>
			</div>
			<form class="form-horizontal form-label-left" enctype="multipart/form-data" action="{{ route('ActivateUserRole') }}" method="POST">
			<div class="modal-body">
				<p class="text-konfirmasi">Apakah anda yakin untuk mengaktifkan role ini?</p>
				<hr>
				<div class="row">
	                <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="hidden" id="role_activate_id" name="role_activate_id">
	                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                    <a type="button" data-dismiss="modal" class="btn btn-default pull-left">Tidak</a>
	            		<button class="btn btn-default btn-danger pull-right btn-ya">Ya</button>
	                </div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
