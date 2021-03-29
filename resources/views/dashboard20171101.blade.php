@extends('layouts.layout')
@section('main_container')

<!-- Page Content -->
<div class="right_col" role="main">

      <div class="" style="min-height:570px">
            <div class="clearfix"></div>
            <div class="col-sm-12 col-xs-12">
                  <h3>
                        Dashboard
                  </h3>
                  <hr>  
            </div>
            <div class="clearfix"></div>

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
                                                <div class="x_content">
                                                      <?php $i=1 ?>
                                                      @foreach($getTopThreeCabangPerkara as $data)
                                                      <div class="widget_summary">
                                                            <div class="w_left w_25">
                                                                  <span>{{ $data->cabang }}</span>
                                                            </div>
                                                            <div class="w_center w_55">
                                                                  <div class="progress">
                                                                        <div class="progress-bar bg-green" role="progressbar" id="bar-top-3-cabang-{{ $i++ }}" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" >
                                                                              <span class="sr-only">60% Complete</span>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                            <div class="w_right w_20">
                                                                  <span>{{ $data->total_perkara }}</span>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                      </div>
                                                      @endforeach
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
                                                <div class="x_content">
                                                      <?php $j=1 ?>
                                                      @foreach ($getTopThreeCabangNotaris as $data)
                                                      <div class="widget_summary">
                                                            <div class="w_left w_25">
                                                                  <span>{{ $data->cabang }}</span>
                                                            </div>
                                                            <div class="w_center w_55">
                                                                  <div class="progress">
                                                                        <div class="progress-bar bg-green" id="bar-top-3-cabang-{{ $j++ }}" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                                              <span class="sr-only">60% Complete</span>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                            <div class="w_right w_20">
                                                                  <span>{{ $data->total_notaris }}</span>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                      </div>
                                                      @endforeach
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </section> <!-- End Section Content Body -->
            <section id="content-footer">
                  <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="x_panel">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Presentase Perkara</br>dan Notaris (Weekly)</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="x_panel">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Presentase Kerugian</br>    Perkara (Weekly)</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="x_panel">
                                    <div class="x_title">
                                          <h2 class="dashboard-sub-title">Total Kasus (Day)</h2>
                                          <ul class="nav navbar-right panel_toolbox" style="padding-left: 25px;">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                          
                                    </div>
                              </div>
                        </div>
                  </div>
            </section> <!-- End Section Content Footer -->
      </div>

      <div class="modal-body"></div>
</div> <!-- End Page Content -->

@endsection