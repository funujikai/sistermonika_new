<div class="modal modal-konfirmasi fade" id="modal_cabutgugatan" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Pesan</h4>
			</div>
			<form class="form-horizontal form-label-left" enctype="multipart/form-data" action="{{ route('CabutGugatanPerkara') }}" method="POST">
			<div class="modal-body">
				<p class="text-konfirmasi">Apakah anda yakin untuk mencabut gugatan perkara ini? Data perkara tidak dapat diubah lagi setelah proses ini dilakukan.</p>
				<div class="row">
	                <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="hidden" id="kronologis_cabutgugatan" name="kronologis_cabutgugatan">
						<input type="hidden" id="status_perkara_cabutgugatan" name="status_perkara_cabutgugatan">
						<input type="hidden" id="tanggal_perkara_cabutgugatan" name="tanggal_perkara_cabutgugatan">
						<input type="hidden" id="kendala_cabutgugatan" name="kendala_cabutgugatan">
						<input type="hidden" id="sp_komentar_cabutgugatan" name="sp_komentar_cabutgugatan">
						<input type="hidden" id="header_id_cabutgugatan" name="header_id_cabutgugatan">
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
