@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    {{-- <div class="clearfix"></div> --}}
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Data Penelusuran Perkara Pending</h3>
            <div class="clearfix"></div>
            <div class="input-group pull-right">
              <a class="collapse-link pull-right pencarian-detail"><span> &nbsp&nbsp Pencarian Detail</span>
              </div><div class="clearfix"></div>
            </div></a>
            <div class="x_content" style="display: none;">
              <form class="form-horizontal form-label-left" action="{{ url('RegistrasiProposal') }}" method="GET" novalidate>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Hukum</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_jenis_hukum" name="cari_jenis_hukum" class="selectpicker form-control" data-live-search="true" style="width:100%">
                      <option value=""> --Pilih Jenis Hukum-- </option> 
                      @foreach($getJenisHukum as $getData) 
                      <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
                      @endforeach                       
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_cabang" name="cari_cabang" class="selectpicker form-control" data-live-search="true" style="width:100%">
                      <option value=""> --Pilih Cabang-- </option> 
                     {{--  @foreach($getCabang as $getData) 
                      <option value="{{ $getCabang["kode"] }}"> {{ $getCabang["nama"] }} </option>
                      @endforeach     --}}           
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_unit" name="cari_unit" class="selectpicker form-control" data-live-search="true" style="width:100%">

                    </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Perkara</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <input id="cari_perkara" name="cari_perkara" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Status Perkara
                  </label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select id="cari_statusid" name="cari_statusid" class="selectpicker form-control" data-live-search="true" style="width:100%">
                      <option></option>

                    </select>
                  </div>
                </div>
                <br>
                <div class="form-group">
                  <div class="col-md-7 col-md-offset-3">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button id="send" type="submit" class="btn btn-round btn-warning pull-right">Cari</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          @if(Session::has('messageAddedScs'))
          <div class="msg-save-success">
            <i class="fa fa-floppy-o" aria-hidden="ture" style="font-size: 17px">
              <span id="garis-tegak">|</span>
            </i>
            {{ Session::get('messageAddedScs') }}
            <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
          </div>
          @endif
          @if(Session::has('messageSubmitScs'))
          <div class="msg-save-success">
            <i class="fa fa-paper-plane-o" aria-hidden="ture" style="font-size: 17px">
              <span id="garis-tegak">|</span>
            </i>
            {{ Session::get('messageSubmitScs') }}
            <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
          </div>
          @endif
          <div class="x_panel">
            <div class="x_content">
              <table id="table_daftarpp" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Cabang</th>
                    <th>Unit</th>
                    <th>Jenis Hukum</th>
                    <th>Perkara</th>
                    <th>Pelapor</th>
                    <th>Terlapor</th>
                    <th>Status Perkara</th>
                    <th>Tanggal Status</th>
                    <th>Proses</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($getDaftarPP as $getData)
                  <tr>
                    <td>{{ $getData->cabang  }}</td>
                    <td>{{ $getData->unit  }}</td>
                    <td style="text-transform:uppercase">{{ $getData->jenis_hukum  }}</td>
                    <td style="text-transform:uppercase">{{ $getData->perkara  }}</td>
                    <td style="text-transform:uppercase">{{ $getData->pelapor  }}</td>
                    <td style="text-transform:uppercase">{{ $getData->terlapor  }}</td>
                    <td style="text-transform:uppercase">{{ $getData->status_perkara }}</td>
                    <td style="text-transform:uppercase">
                      @if($getData->tanggal_status != "")
                      {{ date('d M Y', strtotime($getData->tanggal_status)) }}
                      @else
                      @endif
                    </td>
                      <td> 
                        <div class="btn-group">
                        <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Telusur <span class="caret"></span> </a>
                        <ul class="dropdown-menu">
                          <li>
                            @if($getData->status_submit != 1)
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addstatusperkara" onclick="modal_addstatusperkara('{{ $getData->header_id }}','{{ $getData->jenis_hukum_id }}')">Tambah Kronologis</a>
                            @endif
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_tracelaporan" onclick="modal_tracelaporan('{{ $getData->header_id }}', '{{ $getData->status_submit }}', '{{ $getData->nomor_lp}}')">Catatan Perkara Berjalan</a>
                          </li>
                        </ul>
                      </td>
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

    @section('modal-content')
      @include('modals.addstatusperkara')
      @include('modals.tracelaporan')
    @endsection

    <script type="text/javascript">
      $(document).ready(function() {
        $('body').removeClass('nav-md').addClass('nav-sm');
        $('#table_daftarpp').DataTable({
          "order": [[ 0, "desc" ]]
        });
        $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });
        // Added at December 31 2016
        $('#modal_addstatusperkara').on('hidden.bs.modal', function (e) {
          $(this).find('form')[0].reset();
          $('#div-nomor-lp-pp').remove();
        })

       
        // Edn added
      });

      $(".closed").on("click", function() {
        $(".msg-save-success").remove();
      });

      function modal_addstatusperkara(header_id,jenis_hukum) {
        $('#header_id').val(header_id);
        $('#jenis_hukum').val(jenis_hukum);
        // Added at December 31 2016
        if (jenis_hukum == 2) {
          var nomor_lp = '';
              nomor_lp += '<div class="form-group margin-40" id="div-nomor-lp-pp">';
              nomor_lp += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor LP <span class="required">*</span></label>';
              nomor_lp += '<div class="col-md-9 col-sm-9 col-xs-12">';
              nomor_lp += '<input type="text" name="nomor_lp" class="form-control" style="width:100%; text-transform:uppercase"></input>';
              nomor_lp += '</div>';
              nomor_lp += '</div>';
          $('#div-id-kronologis-pp').after(nomor_lp);
        }
        // End added
        list_status_perkara();
      }

      
      function modal_tracelaporan(header_id, status_submit, nomor_lp) {
        $("#header_id_trace_laporan").val(header_id);
        // Edited at January 01 2017
        $.ajax({
          type:"get",
          url:"TraceLaporan",
          data:"header_id="+header_id,
          success: function(data){
            var html = "";
            var obj = $.parseJSON(data);
            if (nomor_lp != '') {
              $.each(obj.content, function(key, val) {
                  html += "<tr>";
                  html += "<td style='text-transform:uppercase'>"+val.status_perkara+"</td>";
                  html += "<td style='text-transform:uppercase'>"+val.nomor_lp+"</td>";
                  html += "<td style='text-transform:uppercase'>"+dateFormat(val.tanggal_status, "d mmm yyyy | HH:MM:ss")+"</td>";
                  html += "<td style='text-transform:uppercase'>"+val.kronologis+" </td>";
                  html += "<td style='text-transform:uppercase'>"+val.kendala+" </td>";
                  html += "</tr>";
              });
            } else {
              $('#th-nomor-lp').attr('hidden', 'hide');
              $.each(obj.content, function(key, val) {
                  html += "<tr>";
                  html += "<td style='text-transform:uppercase'>"+val.status_perkara+"</td>";
                  html += "<td style='text-transform:uppercase'>"+dateFormat(val.tanggal_status, "d mmm yyyy | HH:MM:ss")+"</td>";
                  html += "<td style='text-transform:uppercase'>"+val.kronologis+" </td>";
                  html += "<td style='text-transform:uppercase'>"+val.kendala+" </td>";
                  html += "</tr>";
              });
            }
            $("#tbody_trace").html(html)
            $('#modal_tracelaporan').on('hidden.bs.modal', function (e) {
              $('#th-nomor-lp').removeAttr('hidden');
            })
          }
        });
        // End Edited

        if (status_submit == 1) {
          $("#submit").attr('disabled', 'disable');
        }

      }

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

      function list_cari_status_perkara(){

        var jenis_hukum=$('#cari_jenis_hukum').val();

        $.ajax({
          url: "list_status_perkara",
          type: "GET",
          data: {jenis_hukum : jenis_hukum},
          cache: false,
          beforeSend: function() {
            $(".loading_ajax").show(); 
          },
          success: function(msg){
            $(".loading_ajax").hide();	
            var obj = $.parseJSON(msg);
            $("#cari_perkara").html(obj.content);
            $("#cari_perkara").selectpicker('refresh');
          }
        });			
      }

    </script>

    @endsection

   