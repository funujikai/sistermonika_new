@extends('layouts.layout')
@section('main_container')
 <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h3 class="col-md-9 col-sm-9 col-xs-12">Data Proposal Selesai</h3>
                  <div class="input-group col-md-3 col-sm-3 col-xs-3  pull-right">
                  <form action="{{ url('HistoryProposal') }}" method="GET">
                    <div class="input-group col-md-12 col-sm-12 col-xs-12  pull-right">
                    <input id="carihistory_kode" name="carihistory_kode" class="form-control " placeholder="Nomor Proposal"></input>
                    <span class="input-group-btn">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-default">Find</button>
                    </span>
                  </div>
                  </form>
                  <a class="collapse-link pull-right"><span> &nbsp&nbsp Advanced Search</span>
                  </div><div class="clearfix"></div>
                </div></a>
                <div class="x_content" style="display: none;">
                  <form class="form-horizontal form-label-left" action="{{ url('HistoryProposal') }}" method="GET" novalidate>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bulan Proposal</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="carihistory_bulan" name="carihistory_bulan" class="selectpicker form-control" data-live-search="true" style="width:100%">
                            <option></option>
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
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Pembiayaan</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="carihistory_skimpembiayaan" name="carihistory_skimpembiayaan" class="selectpicker form-control" data-live-search="true" style="width:100%">
                            <option></option>
                            <option value="BARU">BARU</option>
                            <option value="TOP UP">TOP UP</option>
                            <option value="3R">3R</option>                        
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="carihistory_cabang" name="carihistory_cabang" class="selectpicker form-control" data-live-search="true" style="width:100%">
                             @foreach($getCabang as $getData) 
                              <option value="{{ $getData->cabang }}"> {{ $getData->cabang }} </option>
                            @endforeach               
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Unit</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input id="carihistory_unit" name="carihistory_unit" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Calon Debitur</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input id="carihistory_nasabah" name="carihistory_nasabah" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Status Proposal
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select id="carihistory_statusid" name="carihistory_statusid" class="selectpicker form-control" data-live-search="true" style="width:100%">
                            <option></option>
                            @foreach($getStatus as $getData) 
                              <option value="{{ $getData->status_id }}"> {{ $getData->status }} </option> 
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-md-7 col-md-offset-3">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="send" type="submit" class="btn btn-round btn-warning pull-right">Search</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <table id="table_tikethistory" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal Persetujuan</th>
                          <th>Cabang</th>
                          <th>Unit</th>
                          <th>Nama CD</th>
                          <th>Pembiayaan</th>
                          <th>Plafond Diajukan</th>
                          <th>Plafond Disetujui</th>
                          <th>Status</th>
                          <th>BWMP</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getDataHistoryTiket as $getData)
                          <tr>
                            <td>{{ $getData->kode }}</td>
                            <td>{{ date("d M Y | H:i", strtotime($getData->tanggal_proses)) }}</td>
                            <td>{{ $getData->cabang }}</td>
                            <td>{{ $getData->unit }}</td>
                            <td>{{ $getData->nasabah }}</td>
                            <td align="center">{{ $getData->produk }}</td>
                            <td align="right">{{ number_format ($getData->plafond, 2, "," , ".")  }}</td>
                            <td align="right">{{ number_format ($getData->plafond_disetujui, 2, "," , ".") }}</td>
                            <td>{{ $getData->status }}</td>
                            <td align="center">{{ $getData->inisial }}</td>
                            <td>
                              <div class="btn-group">
                                <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_traceproposal"
                                    onclick="modal_traceproposal('{{ $getData->tiket_id }}')">TRACE</a>
                                    @if ($getData->jmlbanding == 0)
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_lihatproposalselesai"
                                    onclick="modal_lihatproposalselesai('{{ $getData->cabang }}',
                                                          '{{ $getData->unit }}',
                                                          '{{ $getData->pengirim }}',
                                                          '{{ $getData->nasabah }}',
                                                          '{{ $getData->skim_pembiayaan }}',
                                                          '{{ $getData->produk }}',
                                                          '{{ $getData->program }}',
                                                          '{{ $getData->plafond }}',
                                                          '{{ $getData->plafond_disetujui }}',
                                                          '{{ $getData->suku_bunga_diajukan }}',
                                                          '{{ $getData->suku_bunga_disetujui }}',
                                                          '{{ $getData->tenor }}',
                                                          '{{ $getData->tenor_disetujui }}',
                                                          '{{ $getData->deviasi1 }}',
                                                          '{{ $getData->deviasi2 }}',
                                                          '{{ $getData->deviasi3 }}',
                                                          '{{ $getData->deviasi4 }}',
                                                          '{{ $getData->deviasi5 }}')">SEE DETAIL</a>
                                    @else
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_lihatbandingproposalselesai"
                                    onclick="modal_lihatbandingproposalselesai('{{ $getData->cabang }}',
                                                          '{{ $getData->unit }}',
                                                          '{{ $getData->pengirim_banding }}',
                                                          '{{ $getData->nasabah }}',
                                                          '{{ $getData->skim_pembiayaan }}',
                                                          '{{ $getData->produk }}',
                                                          '{{ $getData->plafond_banding }}',
                                                          '{{ $getData->suku_bunga_banding }}',
                                                          '{{ $getData->tenor_banding }}'
                                                          '{{ $getData->deviasi1 }}',
                                                          '{{ $getData->deviasi2 }}',
                                                          '{{ $getData->deviasi3 }}',
                                                          '{{ $getData->deviasi4 }}',
                                                          '{{ $getData->deviasi5 }}')">SEE DETAIL</a>
                                    @endif
                                    <a type="button" class="btn btn-default" href="{{ URL::to($getData->file_proposal) }}" target="_blank">FILE PROPOSAL</a>
                                    <!-- <a type="button" class="btn btn-default" href="{{ URL::to($getData->file_lkk) }}" target="_blank">FILE LKK</a> -->
                                    @if ( $getData->jmlbanding != 0 )
                                    <a type="button" class="btn btn-default" href="{{ URL::to($getData->file_proposal_banding) }}" target="_blank">FILE BANDING</a>
                                    @endif
                                    @if ( Session::get('Aking_Role') == 1 || Session::get('Aking_Role') == 2 || Session::get('Aking_Role') == 3)
                                    @if ($getData->status != 'CANCEL')
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_bandingproposal"
                                    onclick="modal_bandingproposal('{{ $getData->tiket_id }}',
                                                          '{{ $getData->cabang }}',
                                                          '{{ $getData->unit }}',
                                                          '{{ $getData->pengirim }}',
                                                          '{{ $getData->nasabah }}',
                                                          '{{ $getData->skim_pembiayaan }}',
                                                          '{{ $getData->produk }}',
                                                          '{{ $getData->program }}',
                                                          '{{ $getData->plafond_disetujui }}',
                                                          '{{ $getData->suku_bunga_disetujui }}',
                                                          '{{ $getData->tenor_disetujui }}')">BANDING</a>
                                    @endif
                                    @endif
                                  </li>
                                </ul>
                              </div>
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
<script type="text/javascript">
    $(document).ready(function() {
      $('body').removeClass('nav-md').addClass('nav-sm');
      $('#table_tikethistory').DataTable({
        "order": [[ 1, "desc" ]]
      });
      $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
      });
    });

    function modal_traceproposal(tiket_id) {
      $('#trace_tiketid').val(tiket_id);
      $.ajax({
          type:"get",
          url:"TraceProposal",
          data:"tiket_id="+tiket_id,
          success: function(data){
              var obj = $.parseJSON(data);
              $("#tbody_trace").html(obj.content)
          }
      });

    }

    function modal_lihatproposalselesai(cabang, unit, pengirim, nasabah, skim_pembiayaan, produk, program, plafond, plafond_disetujui, suku_bunga_diajukan, suku_bunga_disetujui, tenor, tenor_disetujui, deviasi1, deviasi2, deviasi3, deviasi4, deviasi5) {
      $('#lihat_cabang').val(cabang);
      $('#lihat_unit').val(unit);
      $('#lihat_pengirim').val(pengirim);
      $('#lihat_nasabah').val(nasabah);
      $('#lihat_skimpembiayaan').val(skim_pembiayaan);
      $('#lihat_produk').val(produk);
      $('#lihat_program').val(program);
      $('#lihat_plafond').val(plafond);
      $('#lihat_plafonddisetujui').val(plafond_disetujui);
      $('#lihat_sukubungadiajukan').val(suku_bunga_diajukan);
      $('#lihat_sukubungadisetujui').val(suku_bunga_disetujui);
      $('#lihat_tenor').val(tenor);
      $('#lihat_tenordisetujui').val(tenor_disetujui);
      $('#lihat_deviasi1').val(deviasi1);
      $('#lihat_deviasi2').val(deviasi2);
      $('#lihat_deviasi3').val(deviasi3);
      $('#lihat_deviasi4').val(deviasi4);
      $('#lihat_deviasi5').val(deviasi5);
    }

    function modal_lihatbandingproposalselesai(cabang, unit, pengirim_banding, nasabah, skim_pembiayaan, produk, program, plafond_banding, suku_bunga_diajukan_banding, tenor_banding, deviasi1, deviasi2, deviasi3, deviasi4, deviasi5, pengirim_banding, plafond_banding, suku_bunga_banding, tenor_banding) {
      $('#bandinglihat_cabang').val(cabang);
      $('#bandinglihat_unit').val(unit);
      $('#bandinglihat_pengirim').val(pengirim);
      $('#bandinglihat_nasabah').val(nasabah);
      $('#bandinglihat_skimpembiayaan').val(skim_pembiayaan);
      $('#bandinglihat_produk').val(produk);
      $('#bandinglihat_program').val(program);
      $('#bandinglihat_plafond').val(plafond);
      $('#bandinglihat_sukubungadiajukan').val(suku_bunga_diajukan);
      $('#bandinglihat_tenor').val(tenor);
      $('#bandinglihat_deviasi1').val(deviasi1);
      $('#bandinglihat_deviasi2').val(deviasi2);
      $('#bandinglihat_deviasi3').val(deviasi3);
      $('#bandinglihat_deviasi4').val(deviasi4);
      $('#bandinglihat_deviasi5').val(deviasi5);
      $('#bandinglihat_cabangbanding').val(cabang);
      $('#bandinglihat_unitbanding').val(unit);
      $('#bandinglihat_nasabahbanding').val(nasabah);
      $('#bandinglihat_skimpembiayaanbanding').val(skim_pembiayaan);
      $('#bandinglihat_produkbanding').val(produk);
      $('#bandinglihat_programbanding').val(program);
      $('#bandinglihat_pengirimbanding').val(pengirim_banding);
      $('#bandinglihat_plafondbanding').val(plafond_banding);
      $('#bandinglihat_sukubungabanding').val(suku_bunga_banding);
      $('#bandinglihat_tenorbanding').val(tenor_banding);
      $('#bandinglihat_deviasi1banding').val(deviasi1);
      $('#bandinglihat_deviasi2banding').val(deviasi2);
      $('#bandinglihat_deviasi3banding').val(deviasi3);
      $('#bandinglihat_deviasi4banding').val(deviasi4);
      $('#bandinglihat_deviasi5banding').val(deviasi5);
    }


    function modal_forwardproposal(tiket_id) {
      $('#forward_tiketid').val(tiket_id);

      $.ajax({
          type:"get",
          url:"GetUserForwardProposal",
          data:"forward_tiketid="+tiket_id,
          success: function(data){
              var obj = $.parseJSON(data);
              $("#forward_sendto").html(obj.content);
              $("#forward_sendto").selectpicker('refresh');
          }
      });
    }

    function modal_bandingproposal(tiket_id, cabang, unit, pengirim, nasabah, skim_pembiayaan, produk, program, plafond, suku_bunga_diajukan, tenor) {
      $('#approved_tiketid').val(tiket_id);
      $('#approved_cabang').val(cabang);
      $('#approved_unit').val(unit);
      $('#approved_pengirim').val(pengirim);
      $('#approved_nasabah').val(nasabah);
      $('#approved_skimpembiayaan').val(skim_pembiayaan);
      $('#approved_produk').val(produk);
      $('#approved_program').val(program);
      $('#approved_plafond').val(plafond);
      $('#approved_sukubungadiajukan').val(suku_bunga_diajukan);
      $('#approved_tenor').val(tenor);

      $('#banding_tiketid').val(tiket_id);
      $('#banding_cabang').val(cabang);
      $('#banding_unit').val(unit);
      $('#banding_pengirim').val(pengirim);
      $('#banding_nasabah').val(nasabah);
      $('#banding_skimpembiayaan').val(skim_pembiayaan);
      $('#banding_produk').val(produk);
      $('#banding_program').val(program);
    }


</script>

@endsection

@section('modal-content')
  @include('modals.lihatproposalselesai')
  @include('modals.lihatproposalbanding')
  @include('modals.traceproposal')
  @include('modals.bandingproposal')
@endsection