<div class="modal modal-konfirmasi fade" id="modal_konfirmasidebitur" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Pesan</h4>
			</div>
			<form class="form-horizontal form-label-left" enctype="multipart/form-data" action="{{ route('deletedaftardebitur') }}" method="POST">
			<div class="modal-body">
				<p class="text-konfirmasi">Apakah anda yakin untuk menghilangkan debitur <strong id='label-debitur'></strong>? Data debitur tidak dapat diubah lagi setelah proses ini dilakukan.</p>
				<div class="form-group margin-40">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Alasan <span class="required">*</span></label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<textarea id="alasan" style="text-transform:uppercase"  name="alasan" class="form-control" placeholder="Alasan" required></textarea>
					</div>
				</div>
				<div class="row">
	                <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="hidden" id="nasabahid" name="nasabahid">
						<input type="hidden" id="nm_nasabah" name="nm_nasabah">
						<input type="hidden" id="nomor_rekening" name="nomor_rekening">
	                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                </div>
				</div>
			</div>
			<div class="modal-footer">
                <a type="button" data-dismiss="modal" class="btn btn-primary pull-left">Tidak</a>
        		<button class="btn btn-default btn-warning pull-right btn-ya disabled-on-submit">Ya</button>
			</div>
			</form>
		</div>
	</div>
</div>
