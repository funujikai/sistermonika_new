@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3 class="col-md-9 col-sm-9 col-xs-12">Laporan Notaris</h3>
            <div class="clearfix"></div>
            <div class="input-group col-md-3 col-sm-3 col-xs-3 pull-right">
              <a class="collapse-link pull-right pencarian-detail"><span> &nbsp&nbsp Pencarian Detail</span>
                  </div><div class="clearfix"></div>
                </div></a>
                <div class="x_content"">
                  <form class="form-horizontal form-label-left" action="#" method="GET" novalidate>
                    <div class="row form-gorup">
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Cabang</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="" class="form-control">
                          </div>
                        </div>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Unit</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                             <select id="cari_unit" name="cari_unit" class="selectpicker form-control" data-live-search="true" style="width:100%">
                            <option value=""> --Pilih Unit-- </option> 
                          </select>
                          </div>
                        </div>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Status</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="selectpicker form-control" id="cari_status" name="cari_status" data-live-search="true" style="width:100%" required>
                              <option value=""> --Pilih Status-- </option> 
                              @foreach($getStatusJaminan as $getData)
                              <option value="{{ $getData->nama }}"> {{ $getData->nama }} </option> 
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Kendala</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="selectpicker form-control" id="cari_kendala" name="cari_kendala" data-live-search="true" style="width:100%" required>
                                <option value=""> --Pilih Status-- </option> 
                                @foreach($getKendala as $getData)
                                <option value="{{ $getData->nama }}"> {{ $getData->nama }} </option> 
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="cari_cabang" name="cari_cabang" class="selectpicker form-control" data-live-search="true" onChange="change_cari_cabang()" style="width:100%">
                              <option value=""> --Pilih Cabang-- </option> 
                              @foreach($getCabang as $getData) 
                              <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option>
                              @endforeach               
                          </select>
                        </div>
                    </div>
          
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="cari_unit" name="cari_unit" class="selectpicker form-control" data-live-search="true" style="width:100%">
                            <option value=""> --Pilih Unit-- </option> 
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="selectpicker form-control" id="cari_status" name="cari_status" data-live-search="true" style="width:100%" required>
                            <option value=""> --Pilih Status-- </option> 
                            @foreach($getStatusJaminan as $getData)
                            <option value="{{ $getData->nama }}"> {{ $getData->nama }} </option> 
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kendala</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="selectpicker form-control" id="cari_kendala" name="cari_kendala" data-live-search="true" style="width:100%" required>
                            <option value=""> --Pilih Status-- </option> 
                            @foreach($getKendala as $getData)
                            <option value="{{ $getData->nama }}"> {{ $getData->nama }} </option> 
                            @endforeach
                        </select>
                        </div>
                    </div> --}}
                    <br>
                    <div class="form-group">
                      <div class="col-md-7 col-md-offset-3">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="send" type="submit" class="btn btn-dark pull-right">Cari</button>
                      </div>
                    </div>
                  </form>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <table id="table_daftarpn" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="5%" class="text-center">Cabang</th>
                    <th width="5%" class="text-center">Unit</th>
                    <th width="15%" class="text-center">Nama Debitur</th>
                    <th width="15%" class="text-center">Nama Notaris</th>
                    <th width="15%" class="text-center">Status</th>
                    <th width="15%" class="text-center">Kendala</th>
                    <th width="15%" class="text-center">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  @foreach($getLaporanPN as $data)
                  <tr>
                    <td width="5%">{{ $i++ }}</td>
                    <td>{{ $data->cabang }}</td>
                    <td width="5%">{{ $data->unit }}</td>
                    <td style="text-transform:uppercase">{{ $data->debitur }}</td>
                    <td style="text-transform:uppercase">{{ $data->notaris }}</td>
                    <td style="text-transform:uppercase">{{ $data->nama_status_jaminan }}</td>
                    <td style="text-transform:uppercase">{{ $data->kendala }}</td>
                    <td style="text-transform:uppercase">{{ $data->keterangan }}</td>
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
    <script type="text/javascript">
      $(document).ready(function() {
        $('body').removeClass('nav-md').addClass('nav-sm');
        $('#table_daftarpp').DataTable({
          "order": []
        });
        var handleDataTableButtons = function() {
          if ($("#table_daftarpn").length) {
            $("#table_daftarpn").DataTable({
              dom: "Bfrtip",
              lengthMenu: [
                  [ 10, 25, 50, -1 ],
                  [ '10 rows', '25 rows', '50 rows', 'Show all' ]
              ],
              buttons: [
                {
                  extend: "pageLength",
                  className: "btn-sm"
                },
                // {
                //   extend: "excel",
                //   className: "btn-sm"
                // },
                {
                  extend: "pdfHtml5",
                   // file name untuk menentukan nama file
                  filename: 'Laporan_Penyelesaian_Notaris', 
                  // download untuk membuka pdf ke window baru
                  download: 'open',
                  // title untuk menentukan nama di judul
                  title: 'Monitoring Penyelesaian Jaminan Di Notaris',
                  customize: function(doc) {
                    doc.defaultStyle.fontSize = 9; //<-- set fontsize to 9 instead of 10 
                  },
                  className: "btn-sm"
                },
                // {
                //   extend: "print",
                //   className: "btn-sm"
                // },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        TableManageButtons.init();

        $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });
      });

      function change_cari_cabang(){
        var cabang=$('#cari_cabang').val();
        
        $.ajax({
          url: "list_unit",
          type: "GET",
          data: {cabang : cabang},
          cache: false,
           beforeSend: function() {
                 $(".loading_ajax").show(); 
               },
          success: function(msg){
          $(".loading_ajax").hide();  
           var obj = $.parseJSON(msg);
                   $("#cari_unit").html(obj.content);
             $("#cari_unit").selectpicker('refresh');
          }
        });     
      }
    </script>

    @endsection

