<div class="modal fade" id="modal_tracelaporan" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-xl my-modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Catatan Perkara Berjalan</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#resume">Resume</a></li>
					<li><a data-toggle="tab" href="#riwayat_perkara">Riwayat Perkara</a></li>
				</ul>
				<div class="tab-content">
					<div id="resume" class="tab-pane fade in active">
						<br>
						<div class="row">
							<div class="col-sm-12">
								<table id="table_resume" class="table table-striped table-bordered table-responsive">
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Tanggal Pendaftaran</td>
										<td id='tgl_pendaftaran'></td>
									</tr>
									<tr>
										<td class='no_perkara' style="color:#000" width="20%" bgcolor='#adeaea'>No Laporan Polisi</td>
										<td id='nmr_regis'></td>
									</tr>
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Nama Lembaga Hukum</td>
										<td id='nm_lembaga'></td>
									</tr>
									<tr class='jenis_hukum_2'>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Klasifikasi Pidana</td>
										<td id='klsfks_pidana'></td>
									</tr>
									<tr class='jenis_hukum_2'>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Delik Pidana</td>
										<td id='dlk_pidana'></td>
									</tr>
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Kedudukan Perseroan</td>
										<td id="kddkn_perseroan"></td>
									</tr>
									<tr id='tr_plapor'>
										<td style="color:#000" width="20%" bgcolor='#adeaea' id='td_plapor'>Pelapor</td>
										<td id='plapor'></td>
									</tr>
									<tr id='tr_trlapor'>
										<td style="color:#000" width="20%" bgcolor='#adeaea' id='td_trlapor'>Terlapor</td>
										<td id='trlapor'></td>
									</tr>
									<tr id='tr_trt_trlapor'>
										<td style="color:#000" width="20%" bgcolor='#adeaea' id='td_trt_trlapor'>Turut Terlapor</td>
										<td id='trt_trlapor'></td>
									</tr>
									<tr class='jenis_hukum_1 jenis_hukum_4 jenis_hukum_3'>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Petitum</td>
										<td id='pttm'></td>
									</tr>
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Rangkaian Proses Hukum</td>
										<td id='rdh'></td>
									</tr>
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Laporan</td>
										<td id='lprn'></td>
									</tr>
									<tr>
										<td colspan='2' style="color:#000" width="100%" bgcolor='#adeaea'>Nilai Sengketa</td>
									</tr>
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Outstanding</td>
										<td id='outs'></td>
									</tr>									
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Materil</td>
										<td id='mtrl'></td>
									</tr>
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Immateril</td>
										<td id='immtrl'></td>
									</tr>
									<tr>
										<td style="color:#000" width="20%" bgcolor='#adeaea'>Dwangsom</td>
										<td id='dwngsm'></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row" id='ptsn'>
							<div class="col-sm-12">
								<h2>Putusan</h2>
								<ul class="nav nav-tabs">
									<li class="active" id='tab_putusan_0'><a data-toggle="tab" href="#putusan">Putusan</a></li>
									<li id='tab_putusan_1'><a data-toggle="tab" href="#banding">Banding</a></li>
									<li id='tab_putusan_2'><a data-toggle="tab" href="#kasasi">Kasasi</a></li>
									<li id='tab_putusan_3'><a data-toggle="tab" href="#peninjauan_kembali">Peninjauan Kembali</a></li>
									<li id='tab_putusan_4'><a data-toggle="tab" href="#keberatan">Keberatan</a></li>
								</ul>
								
								<div class="tab-content">
									<div id="putusan" class="tab-pane fade in active">
										<br>
										<table id="table_resume" class="table table-striped table-bordered table-responsive">
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Tanggal Putusan</td>
												<td id='tgl_putusan_0'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Status Putusan</td>
												<td id='sts_putusan_0'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Nilai Ganti Kerugian</td>
												<td id='nm_lmbg_0'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Amar Putusan</td>
												<td id='amr_ptsn_0'></td>
											</tr>
										</table>
									</div>
									<div id="banding" class="tab-pane fade">
										<br>
										<table id="table_resume" class="table table-striped table-bordered table-responsive">
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Tanggal Putusan</td>
												<td id='tgl_putusan_1'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Status Putusan</td>
												<td id='sts_putusan_1'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Nilai Ganti Kerugian</td>
												<td id='nm_lmbg_1'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Amar Putusan</td>
												<td id='amr_ptsn_1'></td>
											</tr>
										</table>
									</div>
									<div id="kasasi" class="tab-pane fade">
										<br>
										<table id="table_resume" class="table table-striped table-bordered table-responsive">
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Tanggal Putusan</td>
												<td id='tgl_putusan_2'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Status Putusan</td>
												<td id='sts_putusan_2'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Nilai Ganti Kerugian</td>
												<td id='nm_lmbg_2'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Amar Putusan</td>
												<td id='amr_ptsn_2'></td>
											</tr>
										</table>
									</div>
									<div id="peninjauan_kembali" class="tab-pane fade">
										<br>
										<table id="table_resume" class="table table-striped table-bordered table-responsive">
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Tanggal Putusan</td>
												<td id='tgl_putusan_3'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Status Putusan</td>
												<td id='sts_putusan_3'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Nilai Ganti Kerugian</td>
												<td id='nm_lmbg_3'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Amar Putusan</td>
												<td id='amr_ptsn_3'></td>
											</tr>
										</table>
									</div>
									<div id="keberatan" class="tab-pane fade">
										<br>
										<table id="table_resume" class="table table-striped table-bordered table-responsive">
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Tanggal Putusan</td>
												<td id='tgl_putusan_4'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Status Putusan</td>
												<td id='sts_putusan_4'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Nilai Ganti Kerugian</td>
												<td id='nm_lmbg_4'></td>
											</tr>
											<tr>
												<td style="color:#000" width="20%" bgcolor='#adeaea'>Amar Putusan</td>
												<td id='amr_ptsn_4'></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<button class='btn btn-block btn-primary' id='btn-print'><i class="fa fa-print" aria-hidden="true"></i> Print</button>
							</div>
						</div>
					</div>
					<div id="riwayat_perkara" class="tab-pane fade">
						<br>
						<input type='hidden' id='hidden_id' value='1'>
						<table id="table_tracelaporan" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th rowspan='2' class='jenis_hukum_1 jenis_hukum_3 jenis_hukum_4'>No Perkara</th>
									<th rowspan='2' class='jenis_hukum_2'>Tempus</th>
									<th rowspan='2' id='head-pelapor'>Pelapor</th>
									<th rowspan='2' id='head-terlapor'>Terlapor/Tersangka/Terdakwa/Terpidana</th>
									<th rowspan='2' class='jenis_hukum_2'>Klasifikasi Perkara</th>
									<th rowspan='2'>Kedudukan Perseroan</th>
									<th colspan='4'>Nilai Sengketa</th>
									<th rowspan='2'>Status Perkara</th>
									<th rowspan='2'>Tanggal Status</th>
									<th rowspan='2'>Keterangan</th>
									<th rowspan='2' class='col-aksi'>Aksi</th>
								</tr>
								<tr>
									<th>Outstanding</th>
									<th>Materil</th>
									<th>Immateril</th>
									<th>Dwangsom</th>
								</tr>
							</thead>
							<tbody id="tbody_trace">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>