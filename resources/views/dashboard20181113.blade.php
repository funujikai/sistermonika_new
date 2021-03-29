@extends('layouts.layout')
@section('main_container')

<!-- Page Content -->
@if(Session::has('SIPP_Role'))
<div class="right_col" role="main">
@else
<div class="right_col" role="main" style="margin-left:0">
@endif
      <div class="" style="min-height:570px">
            <div class="clearfix"></div>
            <div class="col-sm-12 col-xs-12">
                  @if(Session::has('SIPP_Role'))
                  <h3>Dashboard</h3>
                  @else
                  <h3 class="text-center">Dashboard SILUMAN</h3>
                  @endif
                  <hr style="margin-bottom: 0px;">  
            </div>
            <div class="clearfix"></div>

            <!-- top tiles -->
            <div class="row tile_count">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                              <span class="count_top fz_14"><i class="fa fa-book"></i> Total Perkara</span>
                              <div class="count font_primary">{{ $getTotalPerkara[0]->data }}</div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                              <span class="count_top fz_14"><i class="fa fa-book"></i> Total Notaris</span>
                              <div class="count font_primary">{{ $getTotalNotaris[0]->data }}</div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                              <span class="count_top fz_14"><i class="fa fa-hourglass-half"></i> Perdata Pending</span>
                              <div class="count font_danger"><a href="{{ route('PerdataPending') }}">{{ $getTotalPerdataPending[0]->total_pending }}</a></div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                              <span class="count_top fz_14"><i class="fa fa-hourglass-half"></i> Pidana Pending</span>
                              <div class="count font_danger"><a href="{{ route('PidanaPending') }}">{{ $getTotalPidanaPending[0]->total_pending }}</a></div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                              <span class="count_top fz_14"><i class="fa fa-hourglass-half"></i> Notaris Pending</span>
                              <div class="count font_danger"><a href="{{ route('NotarisPending') }}">{{ $getTotalNotarisPending[0]->total_pending }}</a></div>
                        </div>
                  </div>
            </div>
            <!-- /top tiles -->

            <section id="content-header">
                  <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="x_panel">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">IN/OUT (Monthly)</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content"> 
                                          <div class="row"> 
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                      <div class="report-in">
                                                            <p class="report-status-header">IN</p>
                                                            <p class="tot-data">{{ $getAmountPerdataOpenInAMonth[0]->total_amount }}</p>
                                                      </div>
                                                      <div class="report-out">
                                                            <p class="report-status-header">OUT</p>
                                                            <p class="tot-data">{{ $getAmountPerdataCloseInAMonth[0]->total_amount }}</p>
                                                      </div>
                                                      <div class="deskripsi">Perdata</div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                      <div class="report-in">
                                                            <p class="report-status-header">IN</p>
                                                            <p class="tot-data">{{ $getAmountPidanaOpenInAMonth[0]->total_amount }}</p>
                                                      </div>
                                                      <div class="report-out">
                                                            <p class="report-status-header">OUT</p>
                                                            <p class="tot-data">{{ $getAmountPidanaCloseInAMonth[0]->total_amount }}</p>
                                                      </div>
                                                      <div class="deskripsi">Pidana</div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                      <div class="report-in">
                                                            <p class="report-status-header">IN</p>
                                                            <p class="tot-data">{{ $getAmountNotarisOpenInAMonth[0]->total_amount }}</p>
                                                      </div>
                                                      <div class="report-out">
                                                            <p class="report-status-header">OUT</p>
                                                            <p class="tot-data">{{ $getAmountNotarisCloseInAMonth[0]->total_amount }}</p>
                                                      </div>
                                                      <div class="deskripsi">Jaminan Notaris</div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </section> <!-- End Section Content Header -->

            <section id="content-body">
                  <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="x_panel h_305">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Top 5 Cabang Perdata</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          <?php $i=1 ?>
                                          @foreach($getTopFiveCabangPerdata as $data)
                                          <div class="widget_summary">
                                                <div class="col-md-6 col-sm-6 col-xs-6 fz_16">
                                                      <span class="top_8">{{ $data->cabang }}</span>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 fz_16">
                                                      <span class="pull-right c_green"><span class="position_num">{{ $data->total_perdata }}</span></span>
                                                </div>
                                                <div class="clearfix"></div>
                                          </div>
                                          @endforeach
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="x_panel h_305">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Top 5 Cabang Pidana</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          <?php $i=1 ?>
                                          @foreach($getTopFiveCabangPidana as $data)
                                         <div class="widget_summary">
                                                <div class="col-md-6 col-sm-6 col-xs-6 fz_16">
                                                      <span class="top_8">{{ $data->cabang }}</span>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 fz_16">
                                                      <span class="pull-right c_green"><span class="position_num">{{ $data->total_pidana }}</span></span>
                                                </div>
                                                <div class="clearfix"></div>
                                          </div>
                                          @endforeach
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="x_panel h_305">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Top 5 Cabang Notaris</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          <?php $i=1 ?>
                                          @foreach($getTopFiveCabangNotaris as $data)
                                          <div class="widget_summary">
                                                <div class="col-md-6 col-sm-6 col-xs-6 fz_16">
                                                      <span class="top_8">{{ $data->cabang }}</span>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 fz_16">
                                                      <span class="pull-right c_green"><span class="position_num">{{ $data->total_notaris }}</span></span>
                                                </div>
                                                <div class="clearfix"></div>
                                          </div>
                                          @endforeach
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="x_panel h_335">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Presentase Perkara dan Notaris (Weekly)</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                     <div class="x_content">
                                          <table class="" style="width:100%">
                                                <tr>
                                                      <th style="width:37%;">
                                                            <p class="fz_17">Grafik</p>
                                                      </th>
                                                      <th>
                                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                                  <p class="fz_17">Kasus</p>
                                                            </div>
                                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                                  <p class="fz_17">Presentase</p>
                                                            </div>
                                                      </th>
                                                </tr>
                                                <tr>
                                                      <td class="text-center">
                                                            <canvas id="canvas1" height="150" width="150" style="margin: 15px 10px 10px 0"></canvas>
                                                      </td>
                                                      <td>
                                                            <table class="tile_info" style="width:100%">
                                                                  <?php $i=1; $j=1;?>
                                                                  @foreach($percentageWeekly as $val => $key)
                                                                  <tr>
                                                                        <td style="width:70%;padding-left: 20px; font-size:17px">
                                                                              <p id="urutan_prcn_ke_{{$i++}}"><i class="fa fa-square"></i>
                                                                              @if( $val == "Jaminan Notaris")
                                                                              Penjaminan Notaris
                                                                              @else
                                                                              {{ $val }}
                                                                              @endif
                                                                              </p>
                                                                        </td>
                                                                        <td style="width:30%;padding-left: 20px; font-size:17px"><span id="jmlh_prcn_ke_{{$j++}}">{{ $key }}</span>%</td>
                                                                  </tr>
                                                                  @endforeach
                                                            </table>
                                                      </td>
                                                </tr>
                                          </table>
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="x_panel h_335">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Top 5 Jenis Perkara</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          <?php $i=1 ?>
                                          @foreach($getTotalJenisPerkara as $data)
                                          <div class="widget_summary">
                                                <div class="col-md-8 col-sm-8 col-xs-8 fz_14">
                                                      <span class="top_8">{{ $data->jenis_perkara }}</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4 fz_14">
                                                      <span class="pull-right c_green"><span class="position_num">{{ $data->total }}</span></span>
                                                </div>
                                                <div class="clearfix"></div>
                                          </div>
                                          @endforeach
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="x_panel h_335">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Top 5 Jenis Pengurusan</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          <?php $i=1 ?>
                                          @foreach($getTopFiveJenisPengurusan as $data)
                                          <div class="widget_summary">
                                                <div class="col-md-8 col-sm-8 col-xs-8 fz_14">
                                                      <span class="top_8">{{ $data->jenis_pengurusan }}</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4 fz_14">
                                                      <span class="pull-right c_green"><span class="position_num">{{ $data->total }}</span></span>
                                                </div>
                                                <div class="clearfix"></div>
                                          </div>
                                          @endforeach
                                    </div>
                              </div>
                        </div>
                  </div>
                  <!-- <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                              <div class="x_panel">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Status Perkara dan Notaris (Month)</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          <div id="echart_line" style="height:350px;"></div>
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                          <div class="x_panel">
                                                <div class="x_title">
                                                      <h2 class="dashboard-sub-title">Top 3 Cabang Perkara</h2>
                                                      <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                            </li>
                                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                            </li>
                                                      </ul>
                                                      <div class="clearfix"></div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                          <div class="x_panel">
                                                <div class="x_title">
                                                      <h2 class="dashboard-sub-title">Top 3 Cabang Notaris</h2>
                                                      <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                            </li>
                                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                            </li>
                                                      </ul>
                                                      <div class="clearfix"></div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div> -->
            </section> <!-- End Section Content Body -->
      </div>

      <div class="modal-body"></div>
</div> <!-- End Page Content -->

<script src="js/moment/moment.min.js"></script>
<script src="js/chartjs/chart.min.js"></script>
<script src="js/echart/echarts-all.js"></script>
<script src="js/echart/green.js"></script>
<script>
      $(document).ready(function(){
          $('#urutan_prcn_ke_1').children().addClass('blue');
          $('#urutan_prcn_ke_2').children().addClass('green');
          $('#urutan_prcn_ke_3').children().addClass('red');
      });
      var options = {
            legend: false,
            responsive: false
      };

      var perdataWeekly = $('#jmlh_prcn_ke_1').text();
      var pidanaWeekly = $('#jmlh_prcn_ke_2').text();
      var notarisWeekly = $('#jmlh_prcn_ke_3').text();

      new Chart(document.getElementById("canvas1"), {
            type: 'pie',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
                  labels: [
                  "Perdata",
                  "Pidana",
                  "Notaris"
                  ],
                  datasets: [{
                        data: [perdataWeekly, pidanaWeekly, notarisWeekly],
                        backgroundColor: [
                        "#3498DB",
                        "#26B99A",
                        "#E74C3C"
                        ],
                        hoverBackgroundColor: [
                        "#49A9EA",
                        "#36CAAB",
                        "#E95E4F"
                        ]
                  }]
            },
            options: options
      });

      // var ctx = document.getElementById("pieChart");
      //       var data = {
      //           datasets: [{
      //               data: [120, 50, 140, 180, 100],
      //               backgroundColor: [
      //               "#455C73",
      //               "#9B59B6",
      //               "#BDC3C7",
      //               "#26B99A",
      //               "#3498DB"
      //               ],
      //           label: 'My dataset' // for legend
      //               }],
      //               labels: [
      //               "Dark Gray",
      //               "Purple",
      //               "Gray",
      //               "Green",
      //               "Blue"
      //               ]
      //           };

      //       var pieChart = new Chart(ctx, {
      //           data: data,
      //           type: 'pie',
      //           otpions: {
      //               legend: false
      //           }
      //       });

      // var echartLine = echarts.init(document.getElementById('echart_line'), theme);

      // echartLine.setOption({
      //   title: {
      //     text: 'Line Graph',
      //     subtext: 'Subtitle'
      //   },
      //   tooltip: {
      //     trigger: 'axis'
      //   },
      //   legend: {
      //     x: 220,
      //     y: 40,
      //     data: ['Intent', 'Pre-order', 'Deal']
      //   },
      //   toolbox: {
      //     show: true,
      //     feature: {
      //       magicType: {
      //         show: true,
      //         title: {
      //           line: 'Line',
      //           bar: 'Bar',
      //           stack: 'Stack',
      //           tiled: 'Tiled'
      //         },
      //         type: ['line', 'bar', 'stack', 'tiled']
      //       },
      //       restore: {
      //         show: true,
      //         title: "Restore"
      //       },
      //       saveAsImage: {
      //         show: true,
      //         title: "Save Image"
      //       }
      //     }
      //   },
      //   calculable: true,
      //   xAxis: [{
      //     type: 'category',
      //     boundaryGap: false,
      //     data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
      //   }],
      //   yAxis: [{
      //     type: 'value'
      //   }],
      //   series: [{
      //     name: 'Jaminan Notaris',
      //     type: 'line',
      //     smooth: true,
      //     itemStyle: {
      //       normal: {
      //         areaStyle: {
      //           type: 'default'
      //         }
      //       }
      //     },
      //     data: [10, 12, 21, 54, 260, 830, 710]
      //   }, {
      //     name: 'Pidana',
      //     type: 'line',
      //     smooth: true,
      //     itemStyle: {
      //       normal: {
      //         areaStyle: {
      //           type: 'default'
      //         }
      //       }
      //     },
      //     data: [30, 182, 434, 791, 390, 30, 10]
      //   }, {
      //     name: 'Perdata',
      //     type: 'line',
      //     smooth: true,
      //     itemStyle: {
      //       normal: {
      //         areaStyle: {
      //           type: 'default'
      //         }
      //       }
      //     },
      //     data: [1320, 1132, 601, 234, 120, 90, 20]
      //   }]
      // });

</script>


@endsection






