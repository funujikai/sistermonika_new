<div class="modal fade" id="modal_notejaminanberjalan" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Catatan Jaminan Berjalan</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal form-label-left">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#pencairan">Pencairan</a></li>
						<li><a data-toggle="tab" href="#agunan">Agunan</a></li>
					</ul>
					
					<div class="tab-content">
						<div id="pencairan" class="tab-pane fade in active">
							<br>
							<table class="table table-striped table-bordered dt-responsive table-fixed nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="8%">Tanggal Status</th>
										<th width="15%">Status Jaminan</th>
										<th width="35%">Kendala</th>
										<th width="27%">Keterangan</th>
										<th width="15%" class="col_aksi_jaminanberjalan">Aksi</th>
									</tr>
								</thead>
								<tbody id="tbody_trace">
								</tbody>
							</table>
  						</div>
						<div id="agunan" class="tab-pane fade">
							<br>
							<table class="table table-striped table-bordered dt-responsive table-fixed nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="8%">Tanggal Status</th>
										<th width="15%">Status Jaminan</th>
										<th width="35%">Kendala</th>
										<th width="27%">Keterangan</th>
										<th width="15%" class="col_aksi_jaminanberjalan">Aksi</th>
									</tr>
								</thead>
								<tbody id="tbody_trace">
								</tbody>
							</table>
  						</div>
  					</div>
                </div>
			</div>
			<div class="modal-footer">
	            <div class="text-right">
	            	{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
	                <a type="button" data-dismiss="modal" class="btn btn-warning pull-left">Close</a>
	                <!--a type="button" class="btn btn-success btn-default pull-right" id="submit"  data-toggle="modal" data-target="#modal_konfirmasi_simpan">Submit</a-->
	            </div>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-konfirmasi fade" id="modal_konfirmasi_simpan" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Pesan Konfirmasi</h4>
			</div>
			<form class="form-horizontal form-label-left" action="{{ route('SubmitCatatanNotaris') }}" method="POST">
				<div class="modal-body">
					<p class="text-konfirmasi">
						Apakah anda yakin untuk melakukan submit? Data tersebut tidak dapat diubah lagi setelah proses ini dilakukan.
					</p>
					<div class="row">
		                <div class="col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" id="header_id_catatan_jaminan_submit" name="header_id_catatan_jaminan">
		                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                </div>
					</div>
				</div>
				<div class="modal-footer">
                    <a type="button" data-dismiss="modal" class="btn btn-primary pull-left">Tidak</a>
            		<button class="btn btn-warning pull-right btn-ya disabled-on-submit">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal modal-konfirmasi fade" id="modal_konfirmasi_unsimpan" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Pesan Konfirmasi</h4>
			</div>
			<form class="form-horizontal form-label-left" action="{{ route('unSubmitCatatanNotaris') }}" method="POST">
				<div class="modal-body">
					<p class="text-konfirmasi">
						Apakah anda yakin untuk melakukan unsubmit? Data Tersebut tidak dapat diubah lagi setelah proses ini dilakukan.
					</p>
					<div class="row">
		                <div class="col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" id="header_id_catatan_jaminan_unsubmit" name="header_id_catatan_jaminan">
		                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                </div>
					</div>
				</div>
				<div class="modal-footer">
                    <a type="button" data-dismiss="modal" class="btn btn-primary pull-left">Tidak</a>
            		<button class="btn btn-warning pull-right btn-ya disabled-on-submit">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>
