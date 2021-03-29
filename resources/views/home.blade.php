@extends('layouts.layout')
@section('main_container')
	<div class="right_col" role="main">

        <div class="">
          <div class="clearfix"></div>
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_content">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab1" class="nav nav-tabs bar_tabs left" role="tablist">
                      <li id="depan" role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Summary</a>
                      </li>
                      <li id="tengah" role="presentation" class=""><a href="#tab_content12" id="homeprofile-tabb" role="tab" data-toggle="tab" aria-controls="homeprofile" aria-expanded="false">Current Month</a>
                      </li>
                      <li id="belakang" role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Detail</a>
                      </li>
                    </ul>
                    <div id="myTabContent2" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">

                <!-- top tiles -->
                <div class="x_panel">
                  <div class="row tile_count">
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div  align="center">
                      <div class="count" align="center"> {{$diterimasum}} </div>
                      <span class="count_top"><i class="fa fa-envelope"></i> Proposal Diterima</span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div  align="center">
                      <div class="count purple" align="center">{{$onprogresssum[0]->onproses}}</div>
                      <span class="count_top purple"><i class="fa fa-clock-o"></i> Proposal On Progress</span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div align="center">
                      <div class="count green" align="center">{{$disetujuisum[0]->jmlsetuju}}</div>
                      <span class="count_top green"><i class="fa fa-check"></i> Proposal Disetujui</span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div align="center">
                      <div class="count red">{{$ditolaksum[0]->jmltolak}}</div>
                      <span class="count_top red" align="center"><i class="fa fa-times"></i> Proposal Ditolak</span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right blue" align="center">
                      <div class="count blue">{{$pendingsum[0]->jmlpending}}</div>
                      <span class="count_top blue" align="center"><i class="fa fa-ban"></i> Proposal Pending</span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right" align="center">
                      <div class="count aero" align="center">{{$cancelsum}}</div>
                      <span class="count_top aero"><i class="fa fa-clock-o"></i> Proposal Cancel</span>
                    </div>
                  </div>
                </div>
              </div>

                <div class="clearfix"></div>
                <div class="x_panel">
                <div class="row tile_count">
                  <div class="animated flipInY col-md-6 col-sm-6 col-xs-6 tile_stats_count">
                    <div class="left" align="center"></div>
                    <div class="right" align="center">
                      <div class="count" align="center">Rp. {{ number_format ($osdiajukansum[0]->plafond, 2, "," , ".") }}</div>
                      <span class="count_top green"><i class="fa fa-user"></i> OS Diajukan</span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-6 col-sm-6 col-xs-6 tile_stats_count">
                    <div class="left" align="center"></div>
                    <div class="right" align="center">
                      <div class="count" align="center">Rp. {{ number_format ($osdisetujuisum[0]->plafond_disetujui, 2, "," , ".") }}</div>
                      <span class="count_top green"><i class="fa fa-user"></i> OS Disetujui</span>
                    </div>
                  </div>
                </div>
              </div>
              </div>

                <!-- /top tiles -->

                <div role="tabpanel" class="tab-pane fade" id="tab_content12" aria-labelledby="homeprofile-tab">

                <!-- top tiles -->
                <div class="x_panel">
                <div class="row tile_count">
                  <!-- <div class="x_title">
                    <h5 align="left"><b>PROPOSAL BULAN BERJALAN</b></h5>
                    <div class="clearfix"></div>
                  </div> -->
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right" align="center">
                      <span class="count_top"><i class="fa fa-envelope"></i> Proposal Diterima</span>
                      <div class="count" align="center"> {{$diterima}} </div>
                      <span class="count_bottom">Diterima Bulan Lalu: <i>{{$selisihditerima}} </i></span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right" align="center">
                      <span class="count_top purple"><i class="fa fa-clock-o"></i> Proposal On Progress</span>
                      <div class="count purple">{{$onprogress[0]->onproses}}</div>
                      <span class="count_bottom purple">On Progress Bulan Lalu: <i class="purple">{{$selisihonprogress[0]->onproses}} </i></span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right" align="center">
                      <span class="count_top green"><i class="fa fa-check"></i> Proposal Disetujui</span>
                      <div class="count green">{{$disetujui[0]->jmlsetuju}}</div>
                      <span class="count_bottom green">Disetujui Bulan Lalu: <i class="green">{{$selisihdisetujui[0]->jmlsetuju}} </i></span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right" align="center">
                      <span class="count_top red"><i class="fa fa-times"></i> Proposal Ditolak</span>
                      <div class="count red">{{$ditolak[0]->jmltolak}}</div>
                      <span class="count_bottom red">Ditolak Bulan Lalu: <i class="red">{{$selisihditolak[0]->jmltolak}} </i></span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right blue" align="center">
                      <span class="count_top blue"><i class="fa fa-ban"></i> Proposal Pending</span>
                      <div class="count blue">{{$pending[0]->jmlpending}}</div>
                      <span class="count_bottom">Pending Bulan Lalu: <i class="blue">{{$selisihpending[0]->jmlpending}} </i></span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right" align="center">
                      <span class="count_top aero"><i class="fa fa-clock-o"></i> Proposal Cancel</span>
                      <div class="count aero">{{$cancel}}</div>
                      <span class="count_bottom aero">Cancel Bulan Lalu: <i class="aero">{{$selisihcancel}} </i></span>
                    </div>
                  </div>
                </div>
              </div>

                <div class="clearfix"></div>
                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h5 align="left"><b>OS BULAN BERJALAN</b></h5>
                    <div class="clearfix"></div>
                  </div> -->
                <div class="row tile_count">
                  <div class="animated flipInY col-md-6 col-sm-6 col-xs-6 tile_stats_count">
                    <div class="left"></div>
                    <div class="right" align="center">
                      <span class="count_top green"><i class="fa fa-user"></i> OS Diajukan</span>
                      <div class="count">Rp. {{ number_format ($osdiajukan[0]->plafond, 2, "," , ".") }}</div>
                      <span class="count_bottom green">OS Diajukan Bulan Lalu: <i class="green">Rp. {{ number_format ($selisihosdiajukan[0]->plafond, 2, "," , ".") }}</i></span>
                    </div>
                  </div>
                  <div class="animated flipInY col-md-6 col-sm-6 col-xs-6 tile_stats_count">
                    <div class="left"></div>
                    <div class="right" align="center">
                      <span class="count_top green"><i class="fa fa-user"></i> OS Disetujui</span>
                      <div class="count">Rp. {{ number_format ($osdisetujui[0]->plafond_disetujui, 2, "," , ".") }}</div>
                      <span class="count_bottom green">OS Disetujui Bulan Lalu: <i class="green">Rp. {{ number_format ($selisihosdisetujui[0]->plafond_disetujui, 2, "," , ".") }}</i></span>
                    </div>
                  </div>
                </div>
              </div>
              </div>




            

          <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
            <div class="x_panel">
          <div class="row tile_count">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <button id="cari" type="submit" class="btn btn-default pull-right">Cari</button>
                        <div class="col-md-2 col-sm-2 col-xs-12 pull-right">
                          <select id="cari_tahun" name="cari_tahun" class="selectpicker form-control" data-live-search="true" style="width:100%">
                            <option value="" title="Tahun"></option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                          </select>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 pull-right">
                          <select id="cari_bulan" name="cari_bulan" class="selectpicker form-control" data-live-search="true" style="width:100%">
                            <option value="" title="Bulan"></option>
                            <option value="1">JANUARI</option>
                            <option value="2">FEBRUARI</option>
                            <option value="3">MARET</option>
                            <option value="4">APRIL</option>
                            <option value="5">MEI</option>
                            <option value="6">JUNI</option>
                            <option value="7">JULI</option>
                            <option value="8">AGUSTUS</option>
                            <option value="9">SEPTEMBER</option>
                            <option value="10">OKTOBER</option>
                            <option value="11">NOVEMBER</option>
                            <option value="12">DESEMBER</option>
                          </select>
                        </div>
                      </div>
                      
                    </form>
                  </div>
                </div>
              </div>

              <div class="x_content">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h4>Proposal Diproses</h4>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table id="table_jenisusaha" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>NOA</th>
                            <th>OS</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($getdashboardproses as $getData)
                          <tr>
                            <td>{{ date('d F Y', strtotime(str_replace('-','/', $getData->tanggal))) }}</td>
                            <td align="middle">{{ $getData->noa }}</td>
                            <td align="right">{{ number_format ($getData->os, 2, "," , ".") }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h4>Proposal Dikirim</h4>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table id="table_jenisusaha" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>NOA</th>
                            <th>OS</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($getdashboardkirim as $getData)
                          <tr>
                            <td>{{ date('d F Y', strtotime(str_replace('-','/', $getData->tanggal))) }}</td>
                            <td align="middle">{{ $getData->noa }}</td>
                            <td align="right">{{ number_format ($getData->os, 2, "," , ".") }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Summary Proposal Diproses per Cabang</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table id="table_jenisusaha" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Cabang</th>
                            <th>NOA</th>
                            <th>On Prosess</th>
                            <th>Disetujui</th>
                            <th>Tidak Disetujui</th>
                            <th>Pending</th>
                            <th>Banding</th>
                            <th>OS Pengajuan</th>
                            <th>OS Disetujui</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> -->

              <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Summary Jumlah Proposal per Bulan yang Diterima</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table id="table_bulan" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Bulan</th>
                            <th>NOA</th>
                            <th>OS Pengajuan</th>
                            <th>OS Disetujui</th>
                            <th>NOA Banding</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($getdashboardbulan as $getData)
                          <tr>
                            <td>{{ $getData->bulan }}</td>
                            <td align="middle">{{ $getData->noa }}</td>
                            <td align="right">{{ number_format ($getData->ospengajuan, 2, "," , ".") }}</td>
                            <td align="right">{{ number_format ($getData->osdisetujui, 2, "," , ".") }}</td>
                            <td align="middle">{{ $getData->noabanding }}</td>
                          </tr>
                          @endforeach
                        </tbody>
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

                </div>
              </div>
            </div>
            <div class="clearfix"></div>


        </div>
      </div>

<script>
$(document).ready(function(){
  $("button").click(function() {
    $('#depan').removeClass('active');
    $('#belakang').addClass('active');
  });
}); 


          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#table_bulan").length && $("#table_bulan").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
</script>
@endsection