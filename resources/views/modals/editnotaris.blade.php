<div class="modal fade" id="modal_editnotaris" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Ubah Notaris</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-label-left" action="{{ route('EditNotaris') }}" method="POST">
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Notaris <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="edit_nama_notaris" style="text-transform:uppercase" type="text" name="nama_notaris" class="form-control" placeholder="Nama Notaris" required autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No KTP <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="edit_no_ktp" style="text-transform:uppercase" type="text" name="no_ktp" class="form-control" placeholder="No KTP" required autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <textarea id="edit_alamat" rows='4' style="text-transform:uppercase" type="text" name="alamat" class="form-control" placeholder="Nama Notaris" required></textarea>
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Telepon</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="edit_telepon" style="text-transform:uppercase" type="text" name="telepon" class="form-control" placeholder="Nomor Telepon" autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Handphone</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="edit_handphone" style="text-transform:uppercase" type="text" name="handphone" class="form-control" placeholder="Nomor Handphone" autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Anggota INI <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="edit_nomor_inni" style="text-transform:uppercase" type="text" name="nomor_inni" class="form-control" placeholder="No. Anggota INI" required autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Anggota IPPAT <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="edit_nomor_ippat" style="text-transform:uppercase" type="text" name="nomor_ippat" class="form-control" placeholder="No. Anggota IPPAT" required autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Wilayah Kerja <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="edit_wilayah_kerja" style="text-transform:uppercase" type="text" name="wilayah_kerja" class="form-control" placeholder="Wilayah Kerja" required autocomplete="off">
                        </div>
                    </div>
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id='edit_email' style="text-transform:uppercase" type="email" name="email" class="form-control" placeholder="E-mail" autocomplete="off">
                        </div>
                    </div>
					
					<hr>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="edit_header_id" name="header_id">
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
	
	 // $('.datepicker').datepicker({
  //         format: 'yyyy-mm-dd',
  //         autoclose: true
  //     });
  });
	
</script>