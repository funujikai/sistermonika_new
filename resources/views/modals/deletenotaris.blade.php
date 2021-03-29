<div class="modal fade" id="modal_deletenotaris" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Ubah Notaris</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-label-left" action="{{ route('DeleteNotaris') }}" method="POST">
                    <div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Apakah Anda Yakin untuk Menonaktifkan Notaris Tersebut?</label>
                    </div>
					<hr>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="delete_header_id" name="header_id">
	                    <a type="button" data-dismiss="modal" class="btn btn-default btn-default pull-left">Batal</a>
	            		<button class="btn btn-default btn-info pull-right" data-target="modal_konfirmasi_simpan" data-toggle="modal">Ubah</button>
	                </div>
		        </form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#edit_no_ktp").inputmask({'mask':'9999999999999999'});
    // $("#edit_telepon,#edit_nomor_fax").inputmask({'mask':'021999999999'});
    // $("#edit_handphone").inputmask({'mask':'089999999999'});
	
  });
	
</script>