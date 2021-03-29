<div class="modal fade modalpp" id="modal_editpp" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Ubah Data Perkara</h4>
			</div>
			<form class="form-horizontal form-label-left" action="{{ url('P_EditPP') }}" method="POST" id="form-editstatusperkara" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Bisnis <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" id="pp_unit_bisnis" name="pp_unit_bisnis" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Unit Bisnis-- </option> 
								@foreach($getUnitBisnis as $getData) 
								<option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
								@endforeach
							</select>						
						</div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Registrasi Perkara <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type='text' class="form-control datepicker" id="pp_tanggal_perkara" name="pp_tanggal_perkara" required autocomplete="off">
						</div>
					</div>
					<div class="form-group margin-40" >
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Wilayah <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" onChange="change_wilayah('pp_wilayah')" id="pp_wilayah" name="pp_wilayah" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Wilayah-- </option> 
								@foreach($getWilayah as $getData) 
		                         <option value="{{ $getData->nama }}"> {{ $getData->nama }} </option> 
		                        @endforeach
		                    </select>
						</div>
					</div>
					<div class="form-group margin-40" >
						<label class="control-label col-md-3 col-sm-3 col-xs-12" id='label-cabang'>Cabang <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" onChange="change_cabang('pp_cabang')" id="pp_cabang" name="pp_cabang" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Cabang-- </option> 
		                    </select>
						</div>
					</div>
					<div class="form-group margin-40 need_mekaar" >
						<label class="control-label col-md-3 col-sm-3 col-xs-12" id='label-cabang'>Area <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" onChange="change_area('pp_area')" id="pp_area" name="pp_area" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Area-- </option> 
		                    </select>
						</div>
					</div>

					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id='label-unit'>Unit <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	<select class="selectpicker form-control" id="pp_unit" name="pp_unit" data-live-search="true" style="width:100%" required>
		                        <option value=""> --Pilih Unit-- </option> 
     		               </select>
                        </div>
                    </div>
					
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Hukum <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	<select class="selectpicker form-control" name="pp_jenis_hukum" id="pp_jenis_hukum" data-live-search="true" style="width:100%" required>
		                        <option value=""> --Pilih Jenis Hukum-- </option> 
		                        @foreach($getJenisHukum as $getData) 
									<option value="{{ $getData->kode }}" data-penggugat='{{$getData->penggugat}}' data-tergugat='{{$getData->tergugat}}' data-turut_tergugat='{{$getData->turut_tergugat}}' style="text-transform:uppercase"> {{ $getData->nama }} </option> 
		                        @endforeach
			                </select>
                        </div>
                    </div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Lembaga Hukum <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input name="pp_pengadilan" style="text-transform:uppercase" id='pp_pengadilan' class="form-control" required autocomplete="off">
						</div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"><span class='no_perkara'>No Laporan Polisi</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
						<input name="pp_nomor_perkara" id="pp_nomor_perkara" style="text-transform:uppercase" class="form-control" autocomplete="off">
						</div>
					</div>
					<div class="form-group margin-40 input_jenis_hukum_1">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Gugatan Perdata</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="pp_jenis_perdata" id="pp_jenis_perdata" data-live-search="true" style="width:100%" required>
								<option value=""> --Pilih Jenis Gugatan Perdata-- </option> 
								@foreach($getJenisPerdata as $getData)
									<option value="{{ $getData->kode }}" data-penggugat='{{$getData->penggugat}}' data-tergugat='{{$getData->tergugat}}' data-turut_tergugat='{{$getData->turut_tergugat}}' style="text-transform:uppercase"> {{ $getData->nama }} </option> 
								@endforeach
							</select>    
						</div>
					</div>
					<div class="form-group margin-40 input_jenis_hukum_1 input_jenis_hukum_3 input_jenis_hukum_4">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Dasar Gugatan Perdata</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="pp_dasar_perdata" id="pp_dasar_perdata" data-live-search="true" style="width:100%" required>
  	             				<option value=""> --Pilih Dasar Gugatan Hukum-- </option> 
                			</select>    
						</div>
					</div>
					<div class="form-group margin-40 input_jenis_hukum_2">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Klasifikasi Perkara</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="pp_klasifikasi_perkara" id="pp_klasifikasi_perkara" data-live-search="true" style="width:100%" required>
								<option value="0"> --Pilih Klasifikasi Perkara-- </option> 
								@foreach($getklasifikasiperkara as $getData)
									<option value="{{ $getData->kode }}" style="text-transform:uppercase"> {{ $getData->nama }} </option> 
								@endforeach
							</select>   
						</div>
					</div>
					<div class="form-group margin-40 input_jenis_hukum_2">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Delik Pidana</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" name="pp_delik_pidana[]" multiple id="pp_delik_pidana" data-live-search="true" style="width:100%" required>
								<option value="0"> --Pilih Delik Pidana-- </option> 
								@foreach($getPerkaraPidana as $getData)
									<option value="{{ $getData->kode }}" data-instansi='{{$getData->need_instansi}}' data-tempus='{{$getData->need_tampus}}' data-lainnya='{{$getData->need_lainnya}}' style="text-transform:uppercase"> {{ $getData->nama }} </option> 
								@endforeach
							</select> 
						</div>
					</div>
					<div class="form-group margin-40 input_jenis_hukum_2 need_lainnya">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Delik Lainnya</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input name="pp_pidana_lainnya" id='pp_pidana_lainnya' style="text-transform:uppercase" class="form-control" autocomplete="off">
						</div>
					</div>
					<div class="form-group margin-40 input_jenis_hukum_1 input_jenis_hukum_3 input_jenis_hukum_4">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Petitum</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="pp_petitum" style="text-transform:uppercase" class="form-control" id='pp_petitum' required></textarea>
						</div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Kedudukan Perseroan</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input name="pp_kedudukan_perseroan" id="pp_kedudukan_perseroan" style="text-transform:uppercase" class="form-control" required autocomplete="off">
						</div>
					</div>
					<div class='penggugat'>
						<div class="form-group margin-40">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" id='penggugat'>Penggugat <span class="required">*</span></label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input name="pp_pelapor[]" id='pp_pelapor_1' data-role='tagsinput' style="text-transform:uppercase" class="form-control" required>
                  				<span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>
							</div>
						</div>
					</div>

					<div class='tergugat'>
						<div class="form-group margin-40">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" id='tergugat'>Tergugat <span class="required">*</span></label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input name="pp_terlapor" id='pp_terlapor_1' data-role='tagsinput' style="text-transform:uppercase" class="form-control" required>
								<span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>							
							</div>
						</div>
					</div>
					<div class='turut_tergugat'>
						<div class="form-group margin-40">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" id='turut_tergugat'>Turut Tergugat</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input name="pp_turut_tergugat" id='pp_turut_tergugat_1' data-role='tagsinput' style="text-transform:uppercase" class="form-control">
								<span class="label label-primary" style='font-size:12px;'>Gunakan "," untuk menambahkan input</span>							
							</div>
						</div>
					</div>

					<div class="form-group margin-40 input_jenis_hukum_2 need_tempus">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Tempus </label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type='text' class="form-control datepicker" id="pp_tempus" name="pp_tempus" required autocomplete="off">
						</div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">PIC</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input class="form-control" name="pp_pic" id="pp_pic" autocomplete="off">
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Nilai Sengketa</label>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Outstanding</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" class="form-control has-feedback-left estimasi-kerugian" name="pp_outstanding" id="pp_outstanding" data-a-dec="," data-a-sep="." autocomplete="off">
               				<i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
						</div>
					</div>					
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Materil</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" class="form-control has-feedback-left estimasi-kerugian" name="pp_materil" id="pp_materil" data-a-dec="," data-a-sep="." autocomplete="off">
               				<i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
						</div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Immateril</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" class="form-control has-feedback-left estimasi-kerugian" name="pp_immateril" id="pp_immateril" data-a-dec="," data-a-sep="." autocomplete="off">
							<i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
						</div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Dwangsom</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" class="form-control has-feedback-left estimasi-kerugian" name="pp_dwangsom" id="pp_dwangsom" data-a-dec="," data-a-sep="." autocomplete="off">
               				<i class="form-control-feedback left" aria-hidden="true" style="font-style: normal !important;">Rp</i>
						</div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Dokumen Upload</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="file" class="form-control has-feedback-left estimasi-kerugian" name="pp_dokumen">
						</div>
					</div>
			</div>
			<div class="modal-footer">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" id="pp_header_id" name="pp_header_id">
                <a type="button" data-dismiss="modal" class="btn btn-default pull-left">Batal</a>
        		<button class="btn btn-primary pull-right disabled-on-submit" id="btn-simpan-sp">Ubah</button>
			</div>
	        </form>
		</div>
	</div>
</div>

