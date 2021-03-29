@extends('layouts.layout')
@section('main_container')
<style>
.scroll tbody{
    overflow-y: auto;
    height: 200px;
    position: absolute;
    width: 99.3%;
}
#table_agenda{
      height:200px;
}
#table_notaris_nasabah{
      height:418px;
}
#table_notaris_nasabah tbody{
      height:288px;
}
.click-detail,.cursor-pointer{
      cursor:pointer;
}

</style>
<!-- Page Content -->
      <div class="right_col" role="main" style='margin-left:0px '>
            <div class="clearfix"></div>
            <div class="col-sm-12 col-xs-12">
                  <h1 class="text-center">Dashboard</h1>
            </div>
            <div class="clearfix"></div>
            <section id="content-header">  
                  <div class="x_panel">  
                        <ul class="nav nav-tabs nav-justified">
                              <li class="active"><a class='type-tab-content'  data-toggle="tab" href="#litigasi">Litigasi</a></li>
                              <li><a class='type-tab-content' data-toggle="tab" href="#notaris">Notaris</a></li>
                        </ul>
                        <div class="tab-content">    
                              <div id="litigasi" class="tab-pane fade in active">
                                    <br>
                                    <br>
                                    <div class="row">
                                          <div class="col-sm-12">
                                                <div class="col-sm-2 form-group">
                                                      <select class="form-control selectpicker" id="years" multiple>
                                                            @for($year = date('Y');$year>=2012;$year--)
                                                                  <option>{{$year}}</option>
                                                            @endfor
                                                      </select>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-sm-12">
                                                <br>
                                                <p class='text-center'>TOTAL PERKARA</p>
                                                <div class="panel panel-info">
                                                      <div class="panel-heading click-detail" data-type='litigasi' data-perkara='all' style='height:75px;background:#367385;border-color:#367385;color:#bde5f1;'>
                                                            <h1 class='text-center' id='grand_total'>0</h1>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-sm-12">
                                                <div class="row">
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>PERDATA</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading click-detail" data-type='litigasi' data-perkara='5' style='height:40px;'>                                                            
                                                                        <h1 class='text-center' id='total_5' style='margin-top:-10px;'>0</h1>
                                                                  </div>
																  <div class="panel-heading click-detail" data-type='litigasi' data-perkara='1' style='height:40px;background:#FF7F7F;'>                                                            
                                                                        <h1 class='text-center' id='total_1' style='margin-top:-10px;'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>PIDANA</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading click-detail" data-type='litigasi' data-perkara='6' style='height:40px;'>
                                                                        <h1 class='text-center' id='total_6' style='margin-top:-10px;'>0</h1>
                                                                  </div>
																  <div class="panel-heading click-detail" data-type='litigasi' data-perkara='2' style='height:40px;background:#FF7F7F;'>                                                            
                                                                        <h1 class='text-center' id='total_2' style='margin-top:-10px;'>0</h1>
                                                                  </div>																  
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>PHI</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading click-detail" data-type='litigasi' data-perkara='7' style='height:40px;'>
                                                                        <h1 class='text-center' id='total_7' style='margin-top:-10px;'>0</h1>
                                                                  </div>
																  <div class="panel-heading click-detail" data-type='litigasi' data-perkara='3' style='height:40px;background:#FF7F7F;'>                                                            
                                                                        <h1 class='text-center' id='total_3' style='margin-top:-10px;'>0</h1>
                                                                  </div>																  
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>TUN</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading click-detail" data-type='litigasi' data-perkara='8' style='height:40px;'>
                                                                        <h1 class='text-center' id='total_8' style='margin-top:-10px;'>0</h1>
                                                                  </div>
																  <div class="panel-heading click-detail" data-type='litigasi' data-perkara='4' style='height:40px;background:#FF7F7F;'>                                                            
                                                                        <h1 class='text-center' id='total_4' style='margin-top:-10px;'>0</h1>
                                                                  </div>																  
                                                            </div>
                                                      </div>
                                                </div>												
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-sm-12">
                                                <div class="row">
                                                      <div class="col-sm-8">
                                                      <table  style='width:100% !important;' class="table table-striped table-bordered">
                                                            <thead>
                                                                  <tr>
                                                                        <th class="text-center" colspan='3'>PERDATA</th>
                                                                        <th class="text-center" colspan='3'>PIDANA</th>
                                                                        <th class="text-center" colspan='3'>PHI</th>
                                                                        <th class="text-center" colspan='3'>TUN</th>
                                                                  </tr>
                                                            </thead>
                                                            <tbody>
                                                                  <tr>
                                                                        <th class="text-center">GUGATAN</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_1_0_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_1_0_1">0</th>
                                                                        <th class="text-center">PENYELIDIKAN</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_2_1_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_2_1_1">0</th>
                                                                        <th class="text-center">GUGATAN</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_3_0_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_3_0_1">0</th>
                                                                        <th class="text-center">GUGATAN</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_4_0_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_4_0_1">0</th>
                                                                  </tr>
                                                                  <tr>
                                                                        <th class="text-center">BANDING</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_1_1_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_1_1_1">0</th>
                                                                        <th class="text-center">PENYIDIKAN</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_2_2_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_2_2_1">0</th>
                                                                        <th class="text-center">KASASI</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_3_2_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_3_2_1">0</th>
                                                                        <th class="text-center">BANDING</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_4_1_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_4_1_1">0</th>
                                                                  </tr>
                                                                  <tr>
                                                                        <th class="text-center">KASASI</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_1_2_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_1_2_1">0</th>
                                                                        <th class="text-center">PENUNTUTAN</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_2_3_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_2_3_1">0</th>
                                                                        <th class="text-center">P.K</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_3_3_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_3_3_1">0</th>
                                                                        <th class="text-center">KASASI</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_4_2_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_4_2_1">0</th>
                                                                  </tr>
                                                                  <tr>
                                                                        <th class="text-center">P.K</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_1_3_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_1_3_1">0</th>
                                                                        <th class="text-center">PEMERIKSAAN PENGADILAN</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_2_0_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_2_0_1">0</th>
                                                                        <th class="text-center">-</th>
                                                                        <th style="background:#66ff66" class="text-center">-</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center">-</th>
                                                                        <th class="text-center">P.K</th>
                                                                        <th style="background:#66ff66" class="text-center" id="total_4_3_0">0</th>
                                                                        <th style="background:#ff7f7f;color:white" class="text-center" id="total_4_3_1">0</th>
                                                                  </tr>
                                                            </tbody>
                                                      </table>
                                                      </div>
                                                      <div class="col-sm-4">
                                                            <div class="row">
                                                                  <div class="col-sm-6">
                                                                        <div class="row">
                                                                              <div class="col-sm-12" id='pie-perkara'>
                                                                                    <canvas id="canvas1" style="margin: 15px 10px 10px 0;height:"></canvas>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  <div class="col-sm-6">
                                                                        <div class="row">
                                                                              <div class="col-sm-12">
                                                                                    <p class="urutan_prcn_ke_1"><i class="fa fa-square"></i> PERDATA</p>
                                                                                    <p class="urutan_prcn_ke_2"><i class="fa fa-square"></i> PIDANA</p>
                                                                                    <p class="urutan_prcn_ke_3"><i class="fa fa-square"></i> PHI</p>
                                                                                    <p class="urutan_prcn_ke_4"><i class="fa fa-square"></i> TUN</p>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-sm-12">
                                                <h2>Agenda Litigasi</h2>
                                                <table  style='width:100% !important;' id="table_agenda" class="table table-striped table-bordered">
                                                      <thead>
                                                            <tr>
                                                                  <th class="text-center" style="width:20%">CABANG</th>
                                                                  <th class="text-center" style="width:20%">TANGGAL</th>
                                                                  <th class="text-center" style="width:20%">NO. REGISTRASI</th>
                                                                  <th class="text-center" style="width:20%">TEMPAT</th>
                                                                  <th class="text-center" style="width:20%">AGENDA</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody class='tracking-pembina'></tbody>
                                                </table>
                                          </div>
                                    </div>
                              </div>
                              <div id="notaris" class="tab-pane fade">
                                    <div class="row">
                                          <div class="col-sm-12">
                                                <br>
                                                <br>
                                                <div class="row">
                                                      <div class="col-sm-12">
                                                            <div class="col-sm-2 form-group">
                                                                  <select class="form-control" id="year">
                                                                        @for($year = date('Y');$year>=2012;$year--)
                                                                              <option>{{$year}}</option>
                                                                        @endfor
                                                                  </select>
                                                            </div>
                                                      </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="row">
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>Nasabah</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading" style='height:75px;'>
                                                                        <h1 class='text-center' id='total_debitur'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>Order</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading click-detail" data-type='notaris' data-submit='all' style='height:75px;'>                                                            
                                                                        <h1 class='text-center' id='total_order'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">															
															<div class="row">
																  <div class="col-sm-6">				
																		<p class='text-center'>Belum Selesai</p>														
																		<div class="panel panel-info">
																			<div class="panel-heading click-detail" data-type='notaris' data-submit='0'  style='height:75px;'>
																				<h1 class='text-center' id='total_order_0'>0</h1>
																			</div>
																		</div>
																  </div>
																  <div class="col-sm-6">
																		<p class='text-center'>Akumulasi Belum Selesai</p>
																		<div class="panel panel-info">
																			<div class="panel-heading click-detail" data-type='notaris' data-submit='0'  style='height:75px;'>
																				<h1 class='text-center' id='total_order_all_0'>0</h1>
																			</div>
																		</div>
																  </div>
															</div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>Selesai</p>
                                                            <div class="panel panel-danger">
                                                                  <div class="panel-heading click-detail" data-type='notaris' data-submit='1' style='height:75px;'>                                                            
                                                                        <h1 class='text-center' id='total_order_1'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                                <div class="row notaris-hide-false">
                                                      <div class="col-sm-3">
														<p class='text-center'>Proses Notaris</p>
														<div class="panel panel-info">
															  <div class="panel-heading click-detail" data-type='notaris' data-submit='0' data-status='8' style='height:75px;'>                                                            
																	<h1 class='text-center total_status_8'>0</h1>
															  </div>
														</div>
                                                      </div>
                                                      <div class="col-sm-3">
														<p class='text-center'>Proses BPN</p>
														<div class="panel panel-info">
															  <div class="panel-heading click-detail" data-type='notaris' data-submit='0' data-status='9' style='height:75px;'>                                                            
																	<h1 class='text-center total_status_9'>0</h1>
															  </div>
														</div>
                                                      </div>
                                                      <div class="col-sm-3">		
														<p class='text-center'>Close Notaris</p>
														<div class="panel panel-info">
															  <div class="panel-heading click-detail" data-type='notaris' data-submit='0' data-status='10' style='height:75px;'>                                                            
																	<h1 class='text-center total_status_10'>0</h1>
															  </div>
														</div>
                                                      </div>
                                                      <div class="col-sm-3">
														<p class='text-center'>Close Cabang</p>
														<div class="panel panel-default">
															  <div class="panel-heading click-detail" data-type='notaris' data-submit='0' data-status='11' style='height:75px;'>                                                            
																	<h1 class='text-center total_status_11'>0</h1>
															  </div>
														</div>
                                                      </div>
                                                </div>
                                                <div class="row notaris-hide-true">
                                                      <div class="col-sm-4">
														<p class='text-center'>Proses Notaris</p>
														<div class="panel panel-info">
															  <div class="panel-heading click-detail" data-type='notaris' data-submit='0' data-status='8' style='height:75px;'>                                                            
																	<h1 class='text-center total_status_8'>0</h1>
															  </div>
														</div>
                                                      </div>
                                                      <div class="col-sm-4">
														<p class='text-center'>Proses BPN</p>
														<div class="panel panel-info">
															  <div class="panel-heading click-detail" data-type='notaris' data-submit='0' data-status='9' style='height:75px;'>                                                            
																	<h1 class='text-center total_status_9'>0</h1>
															  </div>
														</div>
                                                      </div>
                                                      <div class="col-sm-4">		
														<p class='text-center'>Close Notaris</p>
														<div class="panel panel-info">
															  <div class="panel-heading click-detail" data-type='notaris' data-submit='0' data-status='10' style='height:75px;'>                                                            
																	<h1 class='text-center total_status_10'>0</h1>
															  </div>
														</div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-sm-6">
                                                <div class="row">
                                                      <div class="col-sm-12">
                                                            <div class="row">
                                                                  <div class="col-sm-6">
																	<div class="row">
																		<div class="col-sm-12">
																			<h2>Daftar Kendala</h2>
																			<table  style='width:100% !important;' id="table_notaris_kendala" class="table table-striped table-bordered">
																				  <thead>
																						<tr>
																							<th class="text-center">Kendala</th>
																							<th class="text-center">Total</th>
																						</tr>
																				  </thead>
																				  <tbody></tbody>
																				  <tfoot>
																						<tr>
																							  <td class="text-center">Total</td>
																							  <td><button id='t_kendala' onclick="detail('kendala','','','')" class='btn btn-primary'>0</button></td>
																						</tr>
																				  </tfoot>
																			</table>
																		</div>
																	</div>
																  </div>
                                                                  <div class="col-sm-6">
                                                                        <div class="row">
                                                                              <div class="col-sm-12">
                                                                                    <div class="row">
                                                                                          <div class="col-sm-12">
                                                                                                <h2>Daftar Rekomendasi</h2>
                                                                                                <table id="table_notaris_rekomendasi" class="table table-striped table-bordered table-responsive" style='overflow-y: hidden !important;width:100%;'>
                                                                                                      <thead>
                                                                                                            <tr>
                                                                                                                  <th class="text-center">Rekomendasi</th>
                                                                                                                  <th class="text-center">Total</th>
                                                                                                            </tr>
                                                                                                      </thead>
                                                                                                      <tbody></tbody>
                                                                                                      <tfoot>
                                                                                                            <tr>
                                                                                                                        <td class="text-center">Total</td>
                                                                                                                        <td><button id='t_rekomendasi' onclick="detail('rekomendasi','','','')" class='btn btn-primary'>0</button></td>
                                                                                                            </tr>
                                                                                                      </tfoot>
                                                                                                </table>
                                                                                          </div>
                                                                                    </div>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="col-sm-6">
                                                <div class="row">
                                                      <div class="col-sm-12">
                                                            <h2><span class='click-detail hide-button'>Daftar Notaris Rekanan</span></h2>
															<table  style='width:100% !important;' id="table_notaris_nasabah" class="table table-striped table-bordered">
                                                                  <thead>
                                                                        <tr>
                                                                                    <th rowspan='3' class="text-center">Wilayah</th>
                                                                                    <th rowspan='3' class="text-center">Cabang</th>
                                                                                    <th colspan='3' class="text-center">Pekerjaan Notaris</th>
                                                                                    <th rowspan='2' colspan='2' class="text-center">Covernote</th>
                                                                        </tr>
                                                                        <tr>
                                                                                    <th rowspan='2' class="text-center cursor-pointer" title="Notaris Yang Bekerja di Cabang Tersebut">Notaris</th>
                                                                                    <th colspan='2' class="text-center">Proses</th>
                                                                        </tr>
                                                                        <tr>
                                                                                    <th class="text-center cursor-pointer" title="Total pekerjaan dari proses yang berjalan berdasarkan jatuh tempo pengikatan agunan dengan tanggal hari ini yang belum lewat">Lancar</th>
                                                                                    <th class="text-center cursor-pointer" title="Total pekerjaan dari proses yang berjalan berdasarkan jatuh tempo pengikatan agunan dengan tanggal hari ini yang sudah lewat">Terlambat</th>
                                                                                    <th class="text-center cursor-pointer" title="Total pekerjaan dari proses yang berjalan berdasarkan hari ini dengan masa berlaku covernote yang belum lewat">Aktif</th>
                                                                                    <th class="text-center cursor-pointer" title="Total pekerjaan dari proses yang berjalan berdasarkan hari ini dengan masa berlaku covernote yang sudah lewat">Expired</th>
                                                                        </tr>
                                                                  </thead>
                                                                  <tbody></tbody>
                                                                  <tfoot>
                                                                        <tr>
                                                                              <td colspan="2" class="text-center">Total</td>
                                                                              <td id='t_notaris'></td>
                                                                              <td><button onclick="detail('notaris','','proses','habis')" id='t_lancar' class='btn btn-primary'>0</button></td>
                                                                              <td><button onclick="detail('notaris','','proses','active')" id='t_terlambat' class='btn btn-primary'>0</button></td>
                                                                              <td><button onclick="detail('notaris','','cn','habis')" id='t_aktif' class='btn btn-primary'>0</button></td>
                                                                              <td><button onclick="detail('notaris','','cn','active')" id='t_expired' class='btn btn-primary'>0</button></td>
                                                                        </tr>
                                                                  </tfoot>
                                                            </table>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>
      </div>
</div> <!-- End Page Content -->
<div class="modal fade" id="modal_litigasi" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog" style="width:80%">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Daftar Perkara</h4>
			</div>
			<div class="modal-body">
                        <div class="row">
                              <div class="col-sm-12">
                                    <table  style='overflow-y: hidden !important;width:100% !important;' id="table_detail_litigasi" class="table table-striped table-bordered">
                                          <thead>
                                                <tr>
                                                      <th class="text-center">Tanggal Regis</th>
                                                      <th class="text-center">Unit Bisnis</th>
                                                      <th class="text-center">Wilayah</th>
                                                      <th class="text-center">Cabang</th>
                                                      <th class="text-center">Unit</th>
                                                      <th class="text-center">Jenis Hukum</th>
                                                      <th class="text-center">No Perkara</th>
                                                      <th class="text-center">PIC</th>
                                                      <th class="text-center">Kedudukan Perseroan</th>
                                                      <th class="text-center">Proses</th>
                                                </tr>
                                          </thead>
                                          <tbody></tbody>
                                    </table>
                              </div>
                        </div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_notaris" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog" style="width:95%">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Daftar Jaminan Notaris</h4>
			</div>
			<div class="modal-body">
			<!-- <button class="btn btn-default" onclick="fnExcelReport();"> Export ke Excel </button> -->
				<div class="row">
					  <div class="col-sm-12">
							<table   id="table_detail_notaris" class="table table-striped table-bordered table-responsive">							
								  <thead>
										<tr>
											  <th rowspan='3' class="text-center">Cabang</th>
											  <th rowspan='3' class="text-center">Unit</th>
											  <th rowspan='3' class="text-center">Nasabah</th>
											  <th rowspan='3' class="text-center">Kol</th>
											  <th rowspan='3' class="text-center">Jenis Agunan</th>
											  <th rowspan='3' class="text-center">Notaris</th>
											  <th rowspan='3' class="text-center">No Covernote</th>
											  <th rowspan='3' class="text-center">Total Perpanjangan</th>
											  <th colspan='4' class="text-center">Tanggal</th>
											  <th rowspan='3' class="text-center">Status</th>
											  <th rowspan='3' class="text-center">Rekomendasi</th>
											  <th rowspan='3' class="text-center">Kendala</th>
											  <th rowspan='3' class="text-center">Ket</th>
											  <th colspan='3' rowspan='2' class="text-center">Notaris</th>
											  <th rowspan='3' class="text-center">Proses</th>
										</tr>
										<tr>
											  <th colspan='2' class="text-center">Covernote</th>
											  <th colspan='2' class="text-center">Pengikatan Agunan</th>
										</tr>
										<tr>
											  <th class="text-center">Awal</th>
											  <th class="text-center">Batas</th>
											  <th class="text-center">Jatuh Tempo</th>
											  <th class="text-center">Realisasi</th>
											  
											  <th class="text-center">Jumlah</th>
											  <th class="text-center">Selesai</th>
											  <th class="text-center">Terlambat</th>
										</tr>
								  </thead>
								  <tbody></tbody>
							</table>
					  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_list_notaris" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog" style="width:95%">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Daftar Jaminan Notaris</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					  <div class="col-sm-12">
							<table  style='overflow-y: hidden !important;width:100% !important;' id="table_detail_notaris" class="table table-striped table-bordered table-responsive">
								  <thead>
										<tr>
											  <th class="text-center">Nama Notaris</th>
											  <th class="text-center">Cabang</th>
											  <th class="text-center">Total Pekerjaan</th>
											  <th class="text-center"></th>
										</tr>
								  </thead>
								  <tbody></tbody>
							</table>
					  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/moment/moment.min.js"></script>
<script src="js/chartjs/chart.min.js"></script>
<script src="js/echart/echarts-all.js"></script>
<script src="js/echart/green.js"></script>
<script>
	$(document).ready(function(){		
            	
		
		
            $('.urutan_prcn_ke_1').children().css('color','#D9EDF7');
            $('.urutan_prcn_ke_2').children().css('color','#49A9EA');
            $('.urutan_prcn_ke_3').children().css('color','pink');
            $('.urutan_prcn_ke_4').children().css('color','red');
            $('.selectpicker').val('{{date("Y")}}').selectpicker('refresh');
            $('#year,#years').on('change',function(){
                  var href = $('.type-tab-content').closest('li.active').find('a').attr('href');
                  $('.type-tab-content[href='+href+']').click();
            });
			
            var timeout = setInterval( function(){   
                  var href = $('.type-tab-content').closest('li.active').find('a').attr('href');
                  var list = ['#litigasi','#notaris'];
                  var index = (list.indexOf(href)+1)%2;
                  $('.type-tab-content[href='+href+']').click();
            }, 200000);
            var hidden_button = 'true';
			$('.hide-button').on('click',function(){
				hidden_button=((hidden_button=='false')?'true':'false');
				var href = $('.type-tab-content').closest('li.active').find('a').attr('href');
                $('.type-tab-content[href='+href+']').click();
			});
            $('.type-tab-content').on('click',function(){
                  window.stop();
                  $("#list_rank_ulamm,#list_rank_mekaar,#table_notaris_nasabah,#table_notaris_kendala,#table_notaris_rekomendasi").DataTable().destroy();
                  $("#pie-perkara").html('<canvas id="canvas1" style="margin: 15px 10px 10px 0;height:"></canvas>');
                  $('.urutan_prcn_ke_1').children().css('color','#D9EDF7');
                  $('.urutan_prcn_ke_2').children().css('color','#49A9EA');
                  $('.urutan_prcn_ke_3').children().css('color','pink');
                  $('.urutan_prcn_ke_4').children().css('color','red');
				  $('[class*=notaris-hide-]').hide();
                  if($(this).attr('href')=='#litigasi'){					  					  					  					  					  					  			
                        $.ajax({
                              url: "detail_data_dashboard",
                              type: "get",
                              cache: false,
                              'data' :{
                                    type :'litigasi',
                                    year:$('#years').val().join()
                              },
                              beforeSend: function() {
                                    $(".loading_ajax").show(); 
                              },
                              success: function(msg){
                                    $('#grand_total').html(msg.total);
                                    $.each(msg.detail,function(key,value){
                                          $.each(value,function(keys,values){
                                                for(var i=0;i<2;i++){
                                                      if ($('#total_'+key+'_'+keys+'_'+i).length) {
                                                            $('#total_'+key+'_'+keys+'_'+i).html('<span class="pull-right  text-center" style="height:15px;width:15px">'+values[i]+'</span>');
                                                      }
                                                }
                                          });
                                    });
                                    $.each(msg.header,function(key,value){
                                          if ($('#total_'+key).length) {
                                                $('#total_'+key).html(msg.header[key]);
                                          }
                                    });
                              }
                        });	
						$("#list_rank_mekaar").DataTable({
							  'responsive':true,
							  'scrollY': "175px",
							  'scrollCollapse':true,
							  "bScrollCollapse": true,
							  aaSorting: [[2, 'desc']],
							  "columnDefs": [
								{ "orderable": false, "targets": [0,1] }
							  ],
							  paging:false,
							  searching:false,  
							  "processing": true,
							  "serverSide": true,
							  retrieve: true,
							  "scrollX": true,
							  "ajax": {
									'url' : 'list_rank',
									'datatype' : 'json',
									'type':'get',
									'data':{
										tab:'litigasi',
										unit_bisnis:2,
										year:$('#years').val().join()
									}
							  }
						});
						$("#list_rank_ulamm").DataTable({
							  'responsive':true,
							  'scrollY': "175px",
							  'scrollCollapse':true,
							  "bScrollCollapse": true,
							  aaSorting: [[2, 'desc']],
							  "columnDefs": [
								{ "orderable": false, "targets": [0,1] }
							  ],
							  paging:false,
							  searching:false,  
							  "processing": true,
							  "serverSide": true,
							  retrieve: true,
							  "scrollX": true,
							  "ajax": {
									'url' : 'list_rank',
									'datatype' : 'json',
									'type':'get',
									'data':{
										tab:'litigasi',
										unit_bisnis:1,
										year:$('#years').val().join()
									}
							  }
						});
                        $.ajax({
                              url: "get_dashboard_pie",
                              type: "get",
                              cache: false,
                              'data' :{
                                    type :'litigasi',
                                    year:$('#years').val().join()
                              },
                              beforeSend: function() {
                                    $(".loading_ajax").show(); 
                              },
                              success: function(msg){
                                    canvas1(msg);
                              }
                        });	
                  }else{					  
					  
						$('[class*=notaris-hide-'+hidden_button+']').show();
						var notaris =0,lancar=0,terlambat=0,aktif=0,expired=0,kendala=0,rekomendasi=0;
						$("#table_notaris_kendala").DataTable({
							  'responsive':true, 
							  'scrollY': "295px",
							  'scrollCollapse':true,
							  "bScrollCollapse": true,
							  aaSorting: [[0, 'asc']],
							  "columnDefs": [
								{ "orderable": false, "targets": [1] }
							  ],
							  paging:false,
							  searching:false,  
							  "processing": true,
							  "serverSide": true,
							  retrieve: true,
							  "scrollX": true,
							  "ajax": {
									'url' : 'get_kendala_list',
									'datatype' : 'json',
									'type':'get',
									'data':{
										year:$('#year').val(),
										hidden_button:hidden_button
									}
							  },
							  'rowCallback': function(row, data, index){
								  kendala+=parseInt($(data[1]).text());
								  $('tfoot #t_kendala').html(kendala);
							  }
						});
						$("#table_notaris_rekomendasi").DataTable({
							  'responsive':true,
							  'scrollY': "300px",
							  'scrollCollapse':true,
							  "bScrollCollapse": true,
							  aaSorting: [[0, 'asc']],
							  "columnDefs": [
								{ "orderable": false, "targets": [1] }
							  ],
							  paging:false,
							  searching:false,  
							  "processing": true,
							  "serverSide": true,
							  retrieve: true,
							  "scrollX": true,
							  "ajax": {
									'url' : 'get_rekomendasi_list',
									'datatype' : 'json',
									'type':'get',
									'data':{
										year:$('#year').val(),
										hidden_button:hidden_button
									}
							  },
							  'rowCallback': function(row, data, index){
								  rekomendasi+=parseInt($(data[1]).text());
								  $('tfoot #t_rekomendasi').html(rekomendasi);
							  }
						});
						        
						lancar=0;
                        $("#table_notaris_nasabah").DataTable({
                              'scrollY': "220px",
                              'scrollCollapse':true,
							  aaSorting: [[0, 'asc']],
							  "columnDefs": [
								{ "orderable": false, "targets": [1,2,3,4,5,6] }
							  ],
                              paging:false,
                              searching:false,  
                              "processing": true,
                              "serverSide": true,
                              retrieve: true,
                              "scrollX": true,
                              "ajax": {
                                    'url' : 'list_notaris_khusus',
                                    'datatype' : 'json',
                                    'type':'get',
                                    'data' : {
                                          // "_token":'{{ csrf_token() }}',
                                          type:'laporan_notaris_for_dashboard',
                                          tipe:'wilayah',
                                          year:$('#year').val()
                                    }
                              },
							  'rowCallback': function(row, data, index){
								  notaris+=parseInt(data[2]);
								  lancar+=parseInt($(data[3]).text());
								  terlambat+=parseInt($(data[4]).text());
								  aktif+=parseInt($(data[5]).text());
								  expired+=parseInt($(data[6]).text());
								  $('tfoot #t_notaris').html(notaris);
								  $('tfoot #t_lancar').html(lancar);
								  $('tfoot #t_terlambat').html(terlambat);
								  $('tfoot #t_aktif').html(aktif);
								  $('tfoot #t_expired').html(expired);
							  }
                        });
                        $.ajax({
                              url: "detail_data_dashboard",
                              type: "get",
                              cache: false,
                              'data' :{
                                    type:'notaris',
                                    year:$('#year').val()
                              },
                              beforeSend: function() {
                                    $(".loading_ajax").show(); 
                              },
                              success: function(msg){
                                    $('#total_debitur').html(msg.total_debitur);
                                    $('#total_order').html(msg.total);
                                    $.each(msg.header,function(key,value){
                                          $('#total_order_'+key).html(value);
                                    });
                                    $.each(msg.status,function(key,value){
                                          $('.total_status_'+key).html(value);
                                    });
                              }
                        });	   
				  }
				setTimeout(function(){ 
					  $('#table_notaris_kendala,#table_notaris_rekomendasi,#table_notaris_nasabah,#list_rank_ulamm,#list_rank_ulamm').DataTable().columns.adjust().responsive.recalc();
				},500);
				
                  // var href = $('.type-tab-content').closest('li.active').find('a').attr('href');
                  // $('.type-tab-content[href='+href+']').click();
                  clearTimeout(timeout);
                  timeout = setInterval( function(){   
                        var href = $('.type-tab-content').closest('li.active').find('a').attr('href');
                        var list = ['#litigasi','#notaris'];
                        var index = (list.indexOf(href)+1)%2;
                        $('.type-tab-content[href='+href+']').click();
                  }, 200000);
            }); 
            $('.type-tab-content[href=#litigasi]').click(); 
            $("#table_agenda").DataTable({
				  'responsive':true,
                  'scrollY': "175px",
                  'scrollCollapse':true,
                  "bScrollCollapse": true,
				  aaSorting: [[1, 'asc']],
				  "columnDefs": [
					{ "orderable": false, "targets": [0,2,3,4] }
				  ],
                  paging:false,
                  searching:false,  
                  "processing": true,
                  "serverSide": true,
                  retrieve: true,
                  "scrollX": true,
                  "ajax": {
                        'url' : 'list_agenda_dashboard',
                        'datatype' : 'json',
                        'type':'get'
                  }
            });
			setTimeout(function(){ 
				  $('#table_agenda').DataTable().columns.adjust().responsive.recalc();
                  },500);
                  
            $('.click-detail').on('click',function(){
                  var type = $(this).data('type');
                  var data={
                        type:type,
                        order:{
                              0:{
                                    column:'0',
                                    dir:'asc'
                              }
                        }                         
                  };
                  if(type=='litigasi'){
                        data.year=$('#years').val().join();
                        data.jenis_hukum=$(this).data('perkara');
                  }else{
                        data.year=$('#year').val();
                        data.submit=$(this).data('submit');
                        if($(this).data('status')){
                              data.status=$(this).data('status');
                        }
                  }				
  
                  ajax(type,data);				  			
				  
            });
      });
      
      function canvas1(msg){
            new Chart(document.getElementById("canvas1"), {
                  type: 'pie',
                  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                  data: {
                        labels: [
                        "PERDATA",
                        "PIDANA",
                        "TUN",
                        "PHI"
                        ],
                        datasets: [{
                              data: [
                                    msg.pie.perdata
                                    ,msg.pie.pidana
                                    ,msg.pie.phi
                                    ,msg.pie.tun
                              ],
                              backgroundColor: [
                              "#D9EDF7",
                              '#49A9EA',
                              'red',
                              "pink"
                              ],
                              hoverBackgroundColor: [
                              "#D9EDF7",
                              '#49A9EA',
                              'red',
                              "pink"
                              ]
                        }]
                  },
                  options: {
                        legend: false,
                        responsive: true
                  }
            });
      }
      function canvas2(msg){
            new Chart(document.getElementById("canvas2"), {
                  type: 'pie',
                  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                  data: {
                        labels: [
                        "Proses",
                        "Selesai",
                        "Proses Terlambat"
                        ],
                        datasets: [{
                              data: [
                                    msg.pie.proses
                                    ,msg.pie.selesai
                                    ,msg.pie.proses_telat
                              ],
                              backgroundColor: [
                              "#D9EDF7",
                              "pink",
                              '#49A9EA'
                              ],
                              hoverBackgroundColor: [
                              "#D9EDF7",
                              "pink",
                              '#49A9EA'
                              ]
                        }]
                  },
                  options: {
                        legend: false,
                        responsive: true
                  }
            });
      }
      function detail(type,kode_unit,category='',proses=''){
            var data={
                  type:type,
                  order:{
                        0:{
                              column:'0',
                              dir:'asc'
                        }
                  }                         
            };
            if(type=='litigasi'){
                  data.year=$('#years').val().join();
                  data.unit=kode_unit;
            }else{
                  data.year=$('#year').val();
                  data.unit=kode_unit;
				  if(type!='notaris'){
					  data.submit=0;
				  }
                  if(category!=''){
                        data.category=category;
                  }
                  if(proses!=''){
                        data.proses=proses;
                  }
            }
            ajax(type,data);
      }
      function ajax(type,data){	
	  		 
            $('#modal_'+((type=='kendala'||type=='rekomendasi')?'notaris':type)).modal('show');
            // $('#table_detail_'+((type=='kendala'||type=='rekomendasi')?'notaris':type)+' tbody').html('');

            // $.ajax({
            //       url: "list_detail_transaction",
            //       type: "get",
            //       cache: false,
            //       'data' :data,
            //       beforeSend: function() {
            //             $(".loading_ajax").show(); 
            //       },
            //       success: function(msg){
            //             var html='';
            //             $.each(msg.data,function(key,value){
            //                   html+='<tr>';
            //                   for(var i=0;i<value.length;i++){
            //                         html+='<td>'+value[i]+'</td>';
            //                   }
            //                   html+='</tr>';
            //             });                        
            //             $('#table_detail_'+((type=='kendala'||type=='rekomendasi')?'notaris':type)+' tbody').html(html);
            //       }
            // });
            var columns = [];

            type = (type=='kendala'||type=='rekomendasi') ? 'notaris' : type;
            if (type=='notaris'){
            columns = [
                        { "data": "0" }
                        ,{ "data": "1" }
                        ,{ "data": "2" }
                        ,{ "data": "3" }
                        ,{ "data": "4" }
                        ,{ "data": "5" }
                        ,{ "data": "6" }
                        ,{ "data": "7" }
                        ,{ "data": "8" }
                        ,{ "data": "9" }
                        ,{ "data": "10" }
                        ,{ "data": "11" }
                        ,{ "data": "12" }
                        ,{ "data": "13" }
                        ,{ "data": "14" }
                        ,{ "data": "15" }
                        ,{ "data": "16" }
                        ,{ "data": "17" }
                        ,{ "data": "18" }
                        ,{ "data": "19" }
                  ];
            }else{
                  columns = [
                        { "data": "0" }
                        ,{ "data": "1" }
                        ,{ "data": "2" }
                        ,{ "data": "3" }
                        ,{ "data": "4" }
                        ,{ "data": "5" }
                        ,{ "data": "6" }
                        ,{ "data": "7" }
                        ,{ "data": "8" }
                        ,{ "data": "9" }
                  ];
            }

            $("#table_detail_"+type).DataTable().destroy();

            $("#table_detail_"+type).DataTable({            
                  dom: 'Bfrtip',
                  buttons: [
                  'excel'
                  ],
                  // responsive: true,
                  "ajax": {
                        "url" : 'list_detail_transaction',
                        "data" : data,
                        "type" :'GET'   
                  },              
                  columns: columns,
            });	

            $("#table_detail_"+type+"_wrapper").addClass("table-responsive");
      }
	  


      





/*FZL sementara*/
// function fnExcelReport()
// {
//     var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
//     var textRange; var j=0;
//     tab = document.getElementById('table_detail_notaris'); // id of table

//     for(j = 0 ; j < tab.rows.length ; j++) 
//     {     
//         tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
//         //tab_text=tab_text+"</tr>";
//     }

//     tab_text=tab_text+"</table>";
//     tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
//     tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
//     tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

//     var ua = window.navigator.userAgent;
//     var msie = ua.indexOf("MSIE "); 

//     if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
//     {
//         txtArea1.document.open("txt/html","replace");
//         txtArea1.document.write(tab_text);
//         txtArea1.document.close();
//         txtArea1.focus(); 
//         sa=txtArea1.document.execCommand("SaveAs",true,"data_dashboard.xls");
//     }  
//     else                 //other browser not tested on IE 11
//         sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

//     return (sa);
// }
	  
</script>


@endsection






