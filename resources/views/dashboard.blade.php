@extends('layouts.layout')
@section('main_container')

<!-- Page Content -->
@if(Session::has('menus')) 
      <div class="right_col" role="main" >
@else
      <div class="right_col" role="main" style='margin-left:0px '>
@endif
            <div class="clearfix"></div>
            <div class="col-sm-12 col-xs-12">
                  <h1 class="text-center">Dashboard</h1>
            </div>
            <div class="clearfix"></div>
            <section id="content-header">  
                  <div class="x_panel">  
                        <div class="row">
                              @if(!Session::has('menus'))
                              <div class="col-sm-2 pull-right">
                                    <a href="{{url('/login')}}"><button class='btn btn-block btn-primary'>Login</button></a>
                              </div>
                              @endif
                        </div>  
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
                                                      <div class="panel-heading" style='height:75px;background:#367385;border-color:#367385;color:#bde5f1;'>
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
                                                                  <div class="panel-heading" style='height:75px;'>                                                            
                                                                        <h1 class='text-center' id='total_1'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>PIDANA</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading" style='height:75px;'>
                                                                        <h1 class='text-center' id='total_2'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>PHI</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading" style='height:75px;'>
                                                                        <h1 class='text-center' id='total_3'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>TUN</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading" style='height:75px;'>
                                                                        <h1 class='text-center' id='total_4'>0</h1>
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
                                                                  <th class="text-center">CABANG</th>
                                                                  <th class="text-center">TANGGAL</th>
                                                                  <th class="text-center">NO. REGISTRASI</th>
                                                                  <th class="text-center">TEMPAT</th>
                                                                  <th class="text-center">AGENDA</th>
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
                                                                  <div class="panel-heading" style='height:75px;'>                                                            
                                                                        <h1 class='text-center' id='total_order'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>Selesai</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading" style='height:75px;'>                                                            
                                                                        <h1 class='text-center' id='total_order_1'>0</h1>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-sm-3">
                                                            <p class='text-center'>Belum Selesai</p>
                                                            <div class="panel panel-info">
                                                                  <div class="panel-heading" style='height:75px;'>
                                                                        <div class="row">
                                                                              <div class="col-sm-6">
                                                                                    <h1 class='text-center' id='total_order_0'>0</h1>
                                                                              </div>
                                                                              <div class="col-sm-6">
                                                                                    <h1 class='text-center' id='total_order_all_0'>0</h1>
                                                                              </div>
                                                                        </div>
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
                                                                  <div class="col-sm-6" id='pie-notaris'>
                                                                        <canvas id="canvas2" style="margin: 15px 10px 10px 0;height:"></canvas>
                                                                        <div class="row">
                                                                              <div class="col-sm-12">
                                                                                    <p class="urutan_prcn_ke_1"><i class="fa fa-square"></i> Proses</p>
                                                                                    <p class="urutan_prcn_ke_2"><i class="fa fa-square"></i> Proses Terlambat</p>
                                                                                    <p class="urutan_prcn_ke_3"><i class="fa fa-square"></i> Selesai</p>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                                  <div class="col-sm-6">
                                                                        <div class="row">
                                                                              <div class="col-sm-12">
                                                                                    <div class="row">
                                                                                          <div class="col-sm-12">
                                                                                                <p class='text-center'>Proses BPN</p>
                                                                                                <div class="panel panel-info">
                                                                                                      <div class="panel-heading" style='height:75px;'>                                                            
                                                                                                            <h1 class='text-center' id='total_status_9'>0</h1>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-sm-12">
                                                                                                <p class='text-center'>Proses Notaris</p>
                                                                                                <div class="panel panel-info">
                                                                                                      <div class="panel-heading" style='height:75px;'>                                                            
                                                                                                            <h1 class='text-center' id='total_status_8'>0</h1>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-sm-12">
                                                                                                <p class='text-center'>Close Notaris</p>
                                                                                                <div class="panel panel-info">
                                                                                                      <div class="panel-heading" style='height:75px;'>                                                            
                                                                                                            <h1 class='text-center' id='total_status_10'>0</h1>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-sm-12">
                                                                                                <p class='text-center'>Close Cabang</p>
                                                                                                <div class="panel panel-default">
                                                                                                      <div class="panel-heading" style='height:75px;'>                                                            
                                                                                                            <h1 class='text-center' id='total_status_11'>0</h1>
                                                                                                      </div>
                                                                                                </div>
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
                                                            <h2>Jumlah Notaris Rekanan</h2>
                                                            <table  style='overflow-y: hidden !important;width:100% !important;' id="table_notaris_nasabah" class="table table-striped table-bordered">
																<thead>
																	<tr>
																		  <th rowspan='3' class="text-center">Wilayah</th>
																		  <th rowspan='3' class="text-center">Cabang</th>
																		  <th colspan='3' class="text-center">Pekerjaan Notaris</th>
																		  <th rowspan='2' colspan='2' class="text-center">Covernote</th>
																	</tr>
																	<tr>
																		  <th rowspan='2' class="text-center">Notaris</th>
																		  <th colspan='2' class="text-center">Proses</th>
																	</tr>
																	<tr>
																		  <th style='width:20%;' class="text-center">Lancar</th>
																		  <th style='width:20%;' class="text-center">Terlambat</th>
																		  <th style='width:20%;' class="text-center">Aktif</th>
																		  <th style='width:20%;' class="text-center">Expired</th>
																	</tr>
																</thead>
																<tfoot>
																	<tr>
																		<td colspan="2" class="text-center">Total</td>
																		<td id="t_notaris" class="text-center">0</td>
																		<td id="t_lancar" class="text-center">0</td>
																		<td id="t_terlambat" class="text-center">0</td>
																		<td id="t_aktif" class="text-center">0</td>
																		<td id="t_expired" class="text-center">0</td>
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
            <section id="content-body">
                  
            </section>
      </div>
      <div class="modal-body"></div>
</div> <!-- End Page Content -->

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
                  // clearTimeout(timeout);
                  // timeout = setInterval( function(){   
                        // var href = $('.type-tab-content').closest('li.active').find('a').attr('href');
                        // var list = ['#litigasi','#notaris'];
                        // var index = (list.indexOf(href)+1)%2;
                        // $('.type-tab-content[href='+list[index]+']').click();
                  // }, 300000);
            });
            // var timeout = setInterval( function(){   
                  // var href = $('.type-tab-content').closest('li.active').find('a').attr('href');
                  // var list = ['#litigasi','#notaris'];
                  // var index = (list.indexOf(href)+1)%2;
                  // $('.type-tab-content[href='+list[index]+']').click();
            // }, 300000);
            var MyVar;
            $('.type-tab-content').on('click',function(){
                  $("#table_notaris_nasabah").DataTable().destroy();
                  if($(this).attr('href')=='#litigasi'){
                  $("#pie-perkara").html('<canvas id="canvas1" style="margin: 15px 10px 10px 0;height:"></canvas>');
                  $("#pie-notaris").html('<canvas id="canvas2" style="margin: 15px 10px 10px 0;height:"></canvas><div class="row"><div class="col-sm-12"><p class="urutan_prcn_ke_1"><i class="fa fa-square"></i> Proses</p><p class="urutan_prcn_ke_2"><i class="fa fa-square"></i> Proses Terlambat</p><p class="urutan_prcn_ke_3"><i class="fa fa-square"></i> Selesai</p></div></div>');
                  $('.urutan_prcn_ke_1').children().css('color','#D9EDF7');
                  $('.urutan_prcn_ke_2').children().css('color','#49A9EA');
                  $('.urutan_prcn_ke_3').children().css('color','pink');
                  $('.urutan_prcn_ke_4').children().css('color','red');
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
                        // $("#pie-notaris").html('<canvas id="canvas2" style="margin: 15px 10px 10px 0;height:"></canvas>');
                        $.ajax({
                              url: "get_dashboard_pie",
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
                                    canvas2(msg);
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
                                          $('#total_status_'+key).html(value);
                                    });
                              }
                        });	
						var notaris =0,lancar=0,terlambat=0,aktif=0,expired=0;
                        $("#table_notaris_nasabah").DataTable({
							  dom: "Bfrtip",
							  buttons: [
								{
								  extend: 'excelHtml5',
								  title: 'Jumlah Notaris Rekanan',
								  className: "btn-sm"
								}
							  ],
                              'scrollY': "130px",
                              'scrollCollapse':true,
                              paging:false,
                              searching:false,  
                              "processing": true,
                              "serverSide": true,
                              retrieve: true,
                              "scrollX": true,
                              "ajax": {
                                    'url' : 'list_notaris',
                                    'datatype' : 'json',
                                    'type':'post',
                                    'data' : {
                                          "_token":'{{ csrf_token() }}',
                                          type:'laporan_notaris_for_dashboard',
                                          tipe:'wilayah',
                                          year:$('#year').val()
                                    }
                              },
							  'rowCallback': function(row, data, index){
								  notaris+=parseInt(data[2]);
								  lancar+=parseInt(data[3]);
								  terlambat+=parseInt(data[4]);
								  aktif+=parseInt(data[5]);
								  expired+=parseInt(data[6]);
								  console.log(notaris,lancar,terlambat,aktif,expired);
								  $('tfoot #t_notaris').html(notaris);
								  $('tfoot #t_lancar').html(lancar);
								  $('tfoot #t_terlambat').html(terlambat);
								  $('tfoot #t_aktif').html(aktif);
								  $('tfoot #t_expired').html(expired);
							  }
                        });
                        setTimeout(function(){ 
                              $('#table_notaris,#table_notaris_nasabah').DataTable().columns.adjust().responsive.recalc();
                        },500);
                  
                        // var $al = $("#table_notaris_nasabah").closest('.dataTables_scrollBody'); 
                        // var table_notaris_nasabah = 0;
                        // var myFunc = function() {
                              // var B = table_notaris_nasabah*1;
                              // $al.scrollTop(B);
                              // table_notaris_nasabah++;
                              // if (B >= $al.get(0).scrollHeight) {
                                    // table_notaris_nasabah=0;
                              // }
                        // };
                        // setTimeout(function(){
							// myVar = setInterval(myFunc, 500);
						// },1000);
                  }
                  
                  // clearTimeout(timeout);
                  // timeout = setInterval( function(){   
                        // var href = $('.type-tab-content').closest('li.active').find('a').attr('href');
                        // var list = ['#litigasi','#notaris'];
                        // var index = (list.indexOf(href)+1)%2;
                        // $('.type-tab-content[href='+list[index]+']').click();
                  // }, 300000);
            }); 
            $('.type-tab-content[href=#litigasi]').click(); 
            $("#table_agenda").DataTable({
				  dom: "Bfrtip",
				  buttons: [
					{
					  extend: 'excelHtml5',
					  title: 'Agenda Litigasi',
					  className: "btn-sm"
					}
				  ],
                  'scrollY': "175px",
                  'scrollCollapse':true,
                  "bScrollCollapse": true,
				  aaSorting: [[1, 'asc']],
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

            $('#table_agenda_wrapper').find('div.row:eq(2) div.col-sm-5').attr('class','col-sm-12');
            setTimeout(function(){ 
                  $('#table_agenda').DataTable().columns.adjust().responsive.recalc();
            },500);
            
            // var $el = $("#table_agenda").closest('.dataTables_scrollBody'); 
            // var count_agenda = 0;
            // var myFunc = function() {
                  // var A = count_agenda*1;
                  // $el.scrollTop(A);
                  // count_agenda++;
                  // if (typeof $el.get(0).scrollHeight !=='undefined' && A >= $el.get(0).scrollHeight) {
                        // count_agenda=0;
                  // }
            // };
            // setTimeout(function(){
				// myVar = setInterval(myFunc, 500);
			// },1000);
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

</script>


@endsection






