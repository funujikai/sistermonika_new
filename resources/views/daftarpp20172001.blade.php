@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <h3>
        Data Penelusuran Perkara Berjalan
      </h3>
    </div>
    <div class="clearfix"></div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          @if(Session::has('messageAddedScs'))
          <div class="msg-save-success">
            <i class="fa fa-floppy-o" aria-hidden="ture" style="font-size: 17px">
              <span id="garis-tegak">|</span>
            </i>
            {{ Session::get('messageAddedScs') }}
            <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
          </div> <!-- End div msg-save-success -->
          @endif
          @if(Session::has('messageSubmitScs'))
          <div class="msg-save-success">
            <i class="fa fa-paper-plane-o" aria-hidden="ture" style="font-size: 17px">
              <span id="garis-tegak">|</span>
            </i>
            {{ Session::get('messageSubmitScs') }}
            <span class="pull-right closed"><i class="fa fa-remove" aria-hidden="true" style="color:white"></i></span>
          </div> <!-- End div msg-save-success -->
          @endif
          <div class="x_panel">
            <div class="x_content">
              <table id="table_daftarpp" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th width="7%">Cabang</th>
                    <th width="7%">Unit</th>
                    <th width="8%">Jenis Hukum</th>
                    <th width="17%">Perkara</th>
                    <th width="10%">Pelapor</th>
                    <th width="10%">Terlapor</th>
                    <th width="15%">Status Perkara</th>
                    <th width="8%">Tanggal Status</th>
                    <th width="8%">PIC</th>
                    <th width="10%">Proses</th>
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
                    <td style="text-transform:uppercase">{{ $getData->nama_pic }}</td>
                    <td class="text-center"> 
                      <div class="btn-group">
                        @if($getData->status_selesai_perkara == 0)
                        <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Telusur <span class="caret"></span> </a>
                        <ul class="dropdown-menu" style="margin: 2px -118px 0">
                          <li>
                            <!-- SETTING ROLE ADMIN DAN SUPER ADMIN -->
                            @if(Session::has('SIPP_Role') && Session::get('SIPP_Role') == 1 || Session::get('SIPP_Role') == 2)

                            @if($getData->status_submit != 1 && $getData->status_submit != 2 && $getData->status_submit != 3 && $getData->status_submit != 4)
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addstatusperkara" data-backdrop="static" onclick="modal_addstatusperkara('{{ $getData->header_id }}','{{ $getData->jenis_hukum_id }}', '{{ $getData->status_submit }}')">Tambah Kronologis</a>
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_editpp" onclick="modal_editpp('{{ $getData->header_id }}','{{ $getData->cabang }}', '{{ $getData->unit }}', '{{ $getData->jenis_hukum_id }}', '{{ $getData->perkara_perdata_id }}', '{{ $getData->pelapor }}', '{{ $getData->terlapor }}', '{{ $getData->pic }}', '{{ $getData->estimasi_kerugian }}')">Ubah Data Perkara</a>
                            @endif
                            @if($getData->status_submit == 1) {{-- show button banding --}}
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addstatusperkara" data-backdrop="static" onclick="modal_addstatusperkara('{{ $getData->header_id }}','{{ $getData->jenis_hukum_id }}', '{{ $getData->status_submit }}')">Lakukan Banding</a>
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_selesaikanperkara" data-backdrop="static" onclick="modal_selesaikanperkara('{{ $getData->header_id }}')">Penutupan Perkara</a>

                            @endif
                            @if($getData->status_submit == 2) {{-- show button kasasi --}}
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addstatusperkara" data-backdrop="static" onclick="modal_addstatusperkara('{{ $getData->header_id }}','{{ $getData->jenis_hukum_id }}', '{{ $getData->status_submit }}')" >Lakukan Kasasi</a>
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_selesaikanperkara" data-backdrop="static" onclick="modal_selesaikanperkara('{{ $getData->header_id }}')">Penutupan Perkara</a>
                            @endif
                            @if($getData->status_submit == 3) {{-- show button pk --}}
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addstatusperkara" data-backdrop="static" onclick="modal_addstatusperkara('{{ $getData->header_id }}','{{ $getData->jenis_hukum_id }}', '{{ $getData->status_submit }}')">Lakukan PK</a>
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_selesaikanperkara" data-backdrop="static" onclick="modal_selesaikanperkara('{{ $getData->header_id }}')">Penutupan Perkara</a>
                            @endif
                            @if($getData->status_submit == 4)
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_selesaikanperkara" data-backdrop="static" onclick="modal_selesaikanperkara('{{ $getData->header_id }}')">Penutupan Perkara</a>
                            @endif

                            @endif
                            <!-- END SETTING ROLE ADMIN DAN SUPER ADMIN -->

                           {{--  @if($getData->status_perkara_id == 9)
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_selesaikanperkara" data-backdrop="static" onclick="modal_selesaikanperkara('{{ $getData->header_id }}')">Penutupan Perkara</a>
                            @endif --}}
                            <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_tracelaporan" onclick="modal_tracelaporan('{{ $getData->header_id }}', '{{ $getData->status_submit }}', '{{ $getData->nomor_lp}}', '{{ $getData->status_selesai_perkara }}', '{{ $getData->jenis_hukum_id }}', '{{ $getData->status_selesai_perkara }}')" >Catatan Perkara Berjalan</a>
                          </li>
                        </ul>
                        @else
                        <a type="button" class="btn btn-default btn-default" data-toggle="modal" data-target="#modal_tracelaporan" onclick="modal_tracelaporan('{{ $getData->header_id }}', '{{ $getData->status_submit }}', '{{ $getData->nomor_lp}}', '{{ $getData->status_selesai_perkara }}', '{{ $getData->jenis_hukum_id }}', '{{ $getData->status_selesai_perkara }}')" title="Catatan Berjalan"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div> <!-- end div x_content -->
          </div> <!-- end div x_panel -->
        </div> <!-- end div col -->
      </div> <!-- end div row -->
    </div>  <!-- end modal-body -->
  </div> <!-- end div "" -->
</div> <!-- end div righ_col -->

@section('modal-content')
  @include('modals.editpp')
  @include('modals.addstatusperkara')
  @include('modals.tracelaporan')
  @include('modals.editstatusperkara')
  @include('modals.deletestatusperkara')
  @include('modals.selesaiperkara')
  @include('modals.konfirmasicabutgugatan')
@endsection

<script type="text/javascript">
  $(document).ready(function() {
    $('body').removeClass('nav-md').addClass('nav-sm');
    $(":input").inputmask(); // untuk di modal editstatusperkara
    $('.estimasi-kerugian').autoNumeric('init'); // untuk di modal editstatusperkara
    $('#table_daftarpp').DataTable({
      "order": []
    });
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
    // Function to make modal after modal works perfectly
    $(document).on('show.bs.modal', '.modal', function () {
      var zIndex = 1040 + (10 * $('.modal:visible').length);
      $(this).css('z-index', zIndex);
      setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
      }, 0);
    });
    $(document).on('hidden.bs.modal', '.modal', function () {
      $('.modal:visible').length && $(document.body).addClass('modal-open');
    });
    // End unction to make modal after modal works perfectly
    $('#modal_addstatusperkara').on('hidden.bs.modal', function (e) {
      $(this).find('form')[0].reset();
      $('#div-nomor-lp-pp').remove();
      $('.div-hasil-putusan-sp').remove();
    });
    var $SIDEBAR_MENU = $('#sidebar-menu');
    if ($SIDEBAR_MENU.find('li').hasClass('active')) {
      $SIDEBAR_MENU.find('li.active').removeClass('active-sm').removeClass('active');
    }
    $(".closed").on("click", function() {
      $(".msg-save-success").remove();
    });
    $('#modal_editpp').on('hidden.bs.modal', function (e) {
      $('#div_perkara_perdata_edit').remove();
      $('#div_perkara_pidana_edit').remove();
    });

    // $('#btn-simpan-sp').on('click', function(){
    //   $('.estimasi-kerugian').autoNumeric('init');
    // });

  });

  function modal_addstatusperkara(header_id,jenis_hukum,status_submit) {
    $('#header_id').val(header_id);
    $('#jenis_hukum').val(jenis_hukum);

    if (jenis_hukum == 2) {
      var nomor_lp = '';
      nomor_lp += '<div class="form-group margin-40" id="div-nomor-lp-pp">';
      nomor_lp += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor<span class="required">*</span></label>';
      nomor_lp += '<div class="col-md-9 col-sm-9 col-xs-12">';
      nomor_lp += '<input type="text" name="nomor_lp" class="form-control" style="width:100%; text-transform:uppercase"></input>';
      nomor_lp += '</div>';
      nomor_lp += '</div>';
      $('.div-status-perkara-sp').after(nomor_lp);
    }

    list_status_perkara();

    // Pengkondisian untuk tidak atau menampilkan kolom status dengan nilai banding, pk, kasasi 
    if (status_submit != 0) {
      var hasil_putusan = '';
          hasil_putusan += '<div class="form-group margin-40 div-hasil-putusan-sp">';
          hasil_putusan += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Hasil <span class="required">*</span></label>';
          hasil_putusan += '<div class="col-md-9 col-sm-9 col-xs-12">';
          hasil_putusan += '<select class="selectpicker form-control" id="sp_status_wol" name="sp_status_wol" data-live-search="true" style="width:100%" required>';
          hasil_putusan += '<option value=""> --Pilih Status-- </option>';
          hasil_putusan += '<option value="1"> KALAH </option>';
          hasil_putusan += '<option value="2"> MENANG </option>';
          hasil_putusan += '</select>';
          hasil_putusan += '</div>';
      if (status_submit == 1) {
        $('.div-status-perkara-sp-2').empty();
        $('#status_perkara').selectpicker('refresh');
        $('.div-status-perkara-sp-2').append('<input type="text" class="form-control" name="status_perkara_text" value="BANDING" disabled>');
        $('.div-status-perkara-sp-2').append('<input type="hidden" class="form-control" name="status_perkara_text_2" value="BANDING">');
        $('.div-status-perkara-sp').after(hasil_putusan);
        $('#sp_status_wol').selectpicker('refresh');
      }
      if (status_submit == 2) {
        $('.div-status-perkara-sp-2').empty();
        $('#status_perkara').selectpicker('refresh');
        $('.div-status-perkara-sp-2').append('<input type="text" class="form-control" name="status_perkara_text" value="KASASI" disabled>');
        $('.div-status-perkara-sp-2').append('<input type="hidden" class="form-control" name="status_perkara_text_2" value="KASASI">');
        $('.div-status-perkara-sp').after(hasil_putusan);
        $('#sp_status_wol').selectpicker('refresh');
      }
      if (status_submit == 3) {
        $('.div-status-perkara-sp-2').empty();
        $('#status_perkara').selectpicker('refresh');
        $('.div-status-perkara-sp-2').append('<input type="text" class="form-control" name="status_perkara_text" value="PK" disabled>');
        $('.div-status-perkara-sp-2').append('<input type="hidden" class="form-control" name="status_perkara_text_2" value="PK">');
        $('.div-status-perkara-sp').after(hasil_putusan);
        $('#sp_status_wol').selectpicker('refresh');
      }
    }
    // End pengkondisian untuk tidak atau menampilkan kolom status dengan nilai banding, pk, kasasi 
  };

  function modal_editpp(header_id, cabang, unit, jenis_hukum, perkara_perdata, pelapor, terlapor, pic, estimasi_kerugian) {
    change_cabang;
    $('#pp_cabang_edit').val(cabang).selectpicker('refresh');
    $.ajax({
      url: "list_unit",
      type: "GET",
      data: {cabang : cabang},
      cache: false,
      success: function(msg){
        var obj = $.parseJSON(msg);
        $("#pp_unit_edit").html(obj.content);
        $("#pp_unit_edit").selectpicker('refresh');
        $('#pp_unit_edit').val(unit).selectpicker('refresh');
      }
    });     
    $('#pp_jenis_hukum_edit').val(jenis_hukum).selectpicker('refresh');
    $('#pp_pelapor_edit').val(pelapor);
    $('#pp_terlapor_edit').val(terlapor);
    $('#pp_pic_edit').val(pic).selectpicker('refresh');
    if(estimasi_kerugian == '.0000') {
      $('#pp_estimasi_kerugian_edit').val('0,00');
    } else {
      $('#pp_estimasi_kerugian_edit').val(estimasi_kerugian.replace('.0000',',00'));
    }
    $('#pp_header_id_edit').val(header_id);

    $('#modal_editpp').ready(function() {
      var i = 1;
      var j = 1;
      var k = 1;
      var tindak_perkara_perdata = '';
          tindak_perkara_perdata += '<div class="form-group margin-40" id="div_perkara_perdata_edit">';
          tindak_perkara_perdata += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Tindak Perkara<span class="required"> *</span></label>';
          tindak_perkara_perdata += '<div class="col-md-9 col-sm-9 col-xs-12" style="padding-top: 4px; padding-left: 0px">';
          tindak_perkara_perdata += '<p>';
          tindak_perkara_perdata += '@foreach($getPerkaraPerdata as $getData)';
          tindak_perkara_perdata += '<span class="col-md-5 col-sm-5 col-xs-12" id="check-perdata-'+i++ +'"><input type="radio" class="flat" name="perkara_perdata_edit" id="perkara_perdata'+ j++ +'" value="{{ $getData->kode }}" required/> {{ $getData->nama }}</span> ';
          tindak_perkara_perdata += '@endforeach';
          tindak_perkara_perdata += '<p>';
          tindak_perkara_perdata += '</div> <!-- end col-md-9 -->';
          tindak_perkara_perdata += '</div> <!-- end form-group -->';

      var tindak_perkara_pidana = '';
          tindak_perkara_pidana += '<div class="form-group margin-40" id="div_perkara_pidana_edit">';
          tindak_perkara_pidana += '<label class="control-label col-md-3 col-sm-3 col-xs-12">Tindak Perkara<span class="required"> *</span></label>';
          tindak_perkara_pidana += '<div class="col-md-9 col-sm-9 col-xs-12" id="for-margin">';
          tindak_perkara_pidana += '@foreach($getPerkaraPidana as $getData)';
          tindak_perkara_pidana += '<div class="checkbox">';
          tindak_perkara_pidana += '<label class="padding-left-0 check-perkara-pidana-edit">';
          tindak_perkara_pidana += '<input type="checkbox" class="flat" id="perkara_pidana_'+ k++ +'" name="perkara_pidana_edit[]" value="{{ $getData->kode }}"> {{ $getData->nama }}';
          tindak_perkara_pidana += '</label>';
          tindak_perkara_pidana += '</div>';
          tindak_perkara_pidana += '@endforeach';
          tindak_perkara_pidana += '</div> <!-- end col-md-9 -->';
          tindak_perkara_pidana += '</div> <!-- end form-group -->';

      if(jenis_hukum == 1) {
        $('#div_jenis_hukum_edit').after(tindak_perkara_perdata);
        $('#div_perkara_pidana_edit').remove();
        if(perkara_perdata == 1) {
          $('#check-perdata-1').iCheck('check');
        }
        if(perkara_perdata == 2) {
          $('#check-perdata-2').iCheck('check');
        }
      };

      if(jenis_hukum == 2) {
        $('#div_perkara_perdata_edit').remove();
        $('#div_jenis_hukum_edit').after(tindak_perkara_pidana);
        
        $('.check-perkara-pidana-edit:last').on('ifUnchecked', function(e) {
          $('#txt-lainnya').remove();
        });

        $.ajax({
          type: 'GET',
          url: 'GetPerkaraPidanaId',
          data: {header_id : header_id},
          cache: false,
          success: function(data) {
            var obj = $.parseJSON(data);
            $.each(obj.content, function(key, val) {
              if(val.perkara_pidana_id == 1) {
                $('#perkara_pidana_1').iCheck('check');
              }
              if(val.perkara_pidana_id == 2) {
                $('#perkara_pidana_2').iCheck('check');
              }
              if(val.perkara_pidana_id == 3) {
                $('#perkara_pidana_3').iCheck('check');
              }
              if(val.perkara_pidana_id == 4) {
                $('#perkara_pidana_4').iCheck('check');
              }
              if(val.perkara_pidana_id == 5) {
                $('#perkara_pidana_5').iCheck('check');
              }
              if(val.perkara_pidana_id == 6) {
                $('#perkara_pidana_6').iCheck('check');
              }
              if(val.perkara_pidana_id == 7) {
                $('#perkara_pidana_7').iCheck('check');
                $('#for-margin').append('<input type="text" placeholder="Isi perkara pidana lainnya" class="form-control" id="txt-lainnya" name="perkara_pidana_lainnya_edit" value="'+val.diskripsi+'" style="text-transform:uppercase; margin-top:3px"></type>');
                $('.check-perkara-pidana-edit:last').on('ifUnchecked', function(e) {
                  $('#txt-lainnya').remove();
                });
                $('.check-perkara-pidana-edit:last').on('ifChecked', function(e) {
                  var e = $('#txt-lainnya').html();
                  if(typeof e == 'undefined') {
                    $('#for-margin').append('<input type="text" placeholder="Isi perkara pidana lainnya" class="form-control" id="txt-lainnya" name="perkara_pidana_lainnya_edit" style="text-transform:uppercase; margin-top:3px"></type>');
                  }
                });
              } else {
                $('.check-perkara-pidana-edit:last').on('ifChecked', function(e) {
                  var e = $('#txt-lainnya').html();
                  if(typeof e == 'undefined') {
                    $('#for-margin').append('<input type="text" placeholder="Isi perkara pidana lainnya" class="form-control" id="txt-lainnya" name="perkara_pidana_lainnya_edit" style="text-transform:uppercase; margin-top:3px"></type>');
                  }
                });
              }
            });
          }
        });
        $('#modal_editpp').on('hidden.bs.modal', function (e) {
          tindak_perkara_perdata = '';
          tindak_perkara_pidana = '';
        });
      };

      $('#pp_jenis_hukum_edit').on('change', function() {
        if ($('#pp_jenis_hukum_edit').val() == 1) {
          $('#div_jenis_hukum_edit').after(tindak_perkara_perdata);
          $('#div_perkara_pidana_edit').remove();
        } else if($('#pp_jenis_hukum_edit').val() == 2) {
          $('#div_perkara_perdata_edit').remove();
          $('#div_jenis_hukum_edit').after(tindak_perkara_pidana);
          $('.check-perkara-pidana-edit:last').on('ifChecked', function(e) {
            var e = $('#txt-lainnya').html();
            if(typeof e == 'undefined') {
              $('#for-margin').append('<input type="text" placeholder="Isi perkara pidana lainnya" class="form-control" id="txt-lainnya" name="perkara_pidana_lainnya_edit" style="text-transform:uppercase; margin-top:3px"></type>');
            }
          });
          $('.check-perkara-pidana-edit:last').on('ifUnchecked', function(e) {
            $('#txt-lainnya').remove();
          });
        } else {
          $('#div_perkara_pidana_edit').remove();
          $('#div_perkara_perdata_edit').remove();
        };
        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });
      });
      
      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
    });
  };

  function modal_tracelaporan(header_id, status_submit, nomor_lp, status_selesai_perkara, jenis_hukum_id, status_selesai_perkara) {
    $("#header_id_trace_laporan").val(header_id);
    $("#jenis_hukum_edit").val(jenis_hukum_id);
    $.ajax({
      type:"get",
      url:"TraceLaporan",
      data:"header_id="+header_id,
      success: function(data){
        var html = "";
        var obj = $.parseJSON(data);
        // if pidana
        if (nomor_lp != '') {
          $.each(obj.content, function(key, val) {
            html += "<tr>";
            html += "<td style='text-transform:uppercase'>"+val.kronologis+"</td>";
            html += "<td style='text-transform:uppercase'>"+val.nama_status_perkara+"</td>";
            html += "<td style='text-transform:uppercase'>"+val.nomor_lp+"</td>";
            html += "<td style='text-transform:uppercase'>"+dateFormat(val.tanggal_status, "dd mmm yyyy")+"</td>";
            html += "<td style='text-transform:uppercase'>"+val.kendala+" </td>";
            html += "<td style='text-transform:uppercase'>"+val.komentar+" </td>";
            html += "<td style='text-transform:uppercase' class='text-center td-aksi-sp col-aksi-sp'>";
            html += "<a class='btn-custom btn btn-info' id='modal_click' type='submit' data-toggle='modal' data-target='#modal_editstatusperkara' data-backdrop='static' onclick='modal_editstatusperkara("+val.laporan_detail_id+","+val.jenis_hukum_id+")' title='Ubah'><i class='i-custom fa fa-pencil-square-o' aria-hidden='true'></i></a>";
            if(val.need_result == 1 || val.need_looping == 1) {
              html += "<a class='btn-custom btn btn-danger' type='submit' data-toggle='modal' data-target='#modal_deletestatusperkara' onclick='modal_deletestatusperkara("+val.laporan_detail_id+","+val.jenis_hukum_id+")' title='Hapus' disabled><i class='i-custom fa fa-trash-o' aria-hidden='true'></i></a>";  
            } else {
              html += "<a class='btn-custom btn btn-danger' type='submit' data-toggle='modal' data-target='#modal_deletestatusperkara' onclick='modal_deletestatusperkara("+val.laporan_detail_id+","+val.jenis_hukum_id+")' title='Hapus'><i class='i-custom fa fa-trash-o' aria-hidden='true'></i></a>";
              
            }
            html += "</td>";
            html += "</tr>";
          });
        } else { // if perdata
          $('#th-nomor-lp').attr('hidden', 'hide');
          $.each(obj.content, function(key, val) {
            html += "<tr>";
            html += "<td style='text-transform:uppercase'>"+val.kronologis+" </td>";
            html += "<td style='text-transform:uppercase'>"+val.nama_status_perkara+"</td>";
            html += "<td style='text-transform:uppercase'>"+dateFormat(val.tanggal_status, "dd mmm yyyy")+"</td>";
            html += "<td style='text-transform:uppercase'>"+val.kendala+" </td>";
            html += "<td style='text-transform:uppercase'>"+val.komentar+" </td>";
            html += "<td style='text-transform:uppercase' class='text-center td-aksi-sp col-aksi-sp'>";
            html += "<a class='btn-custom btn btn-info' id='modal_click' type='submit' data-toggle='modal' data-target='#modal_editstatusperkara' data-backdrop='static' onclick='modal_editstatusperkara("+val.laporan_detail_id+","+val.jenis_hukum_id+")' title='Ubah'><i class='i-custom fa fa-pencil-square-o' aria-hidden='true'></i></a>";
            if(val.need_result == 1 || val.need_looping == 1) {
              html += "<a class='btn-custom btn btn-danger' type='submit' data-toggle='modal' data-target='#modal_deletestatusperkara' onclick='modal_deletestatusperkara("+val.laporan_detail_id+","+val.jenis_hukum_id+")' title='Hapus' disabled><i class='i-custom fa fa-trash-o' aria-hidden='true'></i></a>";  
            } else {
              html += "<a class='btn-custom btn btn-danger' type='submit' data-toggle='modal' data-target='#modal_deletestatusperkara' onclick='modal_deletestatusperkara("+val.laporan_detail_id+","+val.jenis_hukum_id+")' title='Hapus'><i class='i-custom fa fa-trash-o' aria-hidden='true'></i></a>";
              
            }
            html += "</td>";
            html += "</tr>";
          });
        }
        $("#tbody_trace").html(html);
        $('#modal_tracelaporan').on('hidden.bs.modal', function (e) {
          $('#th-nomor-lp').removeAttr('hidden');
        })
        if(status_selesai_perkara > 0) {
          $('.col-aksi-sp').css('display', 'none');
        } else {
          $('.col-aksi-sp').show();
        }
      }
    });
  }

  function modal_editstatusperkara(laporan_detail_id,jenis_hukum) {
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
        $("#status_perkara_edit").html(obj.content);
        $("#status_perkara_edit").selectpicker('refresh');
      }
    }); 


   $.ajax({
      url: "GetKronologisPerkara",
      type: "GET",
      data: {laporan_id : laporan_detail_id},
      cache: false,
      beforeSend: function() {
        $(".loading_ajax").show(); 
      },
      success: function(msg){
        $(".loading_ajax").hide();  
        var obj = $.parseJSON(msg);
        if(obj.content[0].nomor_lp != '') {
          $('#div_nomor_perkara_edit').show();
          $('#kronologis_edit').val(obj.content[0].kronologis);
          $('#status_perkara_edit').val(obj.content[0].status_perkara_id).selectpicker('refresh');
          $('#nomor_perkara_edit').val(obj.content[0].nomor_lp);
          $('#tanggal_perkara_edit').val(dateFormat(obj.content[0].tanggal_status, "yyyy-mm-dd"));
          $('#kendala_edit').val(obj.content[0].kendala);
          $('#sp_komentar_edit').val(obj.content[0].komentar);
          $('#detail_id_edit').val(obj.content[0].laporan_detail_id);
        } else {
          $('#div_nomor_perkara_edit').hide();
          $('#kronologis_edit').val(obj.content[0].kronologis);
          $('#status_perkara_edit').val(obj.content[0].status_perkara_id).selectpicker('refresh');
          $('#tanggal_perkara_edit').val(dateFormat(obj.content[0].tanggal_status, "yyyy-mm-dd"));
          $('#kendala_edit').val(obj.content[0].kendala);
          $('#sp_komentar_edit').val(obj.content[0].komentar);
          $('#detail_id_edit').val(obj.content[0].laporan_detail_id);
        }
        if(obj.content[0].status_wol != 0) {
          $('.div_status_wol_edit').show();
          $('#sp_status_wol_edit').val(obj.content[0].status_wol).selectpicker('refresh');
        } else {
          $('.div_status_wol_edit').hide();
        }
        if(obj.content[0].need_result == 1 || obj.content[0].need_looping == 1) {
          // $('#status_perkara_edit').attr('disabled', 'disabled');
          $('.div-status-perkara-sp-edit').empty();
          $('.div-status-perkara-sp-edit').prepend("<label class='control-label col-md-3 col-sm-3 col-xs-12'>Status Perkara <span class='required'>*</span></label><div class='col-md-9 col-sm-9 col-xs-12'><input id='status_perkara_edit' name='txt_status_perkara_edit' class='form-control' style='font-size: 15px;' disabled><input type='hidden' name='status_perkara_edit' value='"+obj.content[0].status_perkara_id+"'></div>");
          $('#status_perkara_edit').val(obj.content[0].nama_status_perkara);
        }  else {
          $('#status_perkara_edit').removeAttr('disabled');
          $('#txt_status_perkara_edit').val('');
        }
      }
    }); 
  }

  function modal_deletestatusperkara(laporan_detail_id,jenis_hukum) {
    $('#detail_id_delete').val(laporan_detail_id);
  }

  $('#modal_editstatusperkara').ready(function() {
    $('#status_perkara_edit').on('change', function() {
      if($('#jenis_hukum_edit').val() == 2) {
        if($('#status_perkara_edit').val() == 1) {
          $('#div_nomor_perkara_edit').hide();
        } else {
          $('#div_nomor_perkara_edit').show();
        }
      };
    });
  });

  function modal_selesaikanperkara(header_id) {
    $('#header_id_selesaiperkara').val(header_id);
  }

  function change_cabang(){

    if ($('#cari_cabang').val() != '') {
      var cabang = $('#cari_cabang').val();
    } 
    if ($('#pp_cabang_edit').val() != '') {
      var cabang = $('#pp_cabang_edit').val();
    }
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
        if ($('#cari_cabang').val() != '') {
          $("#cari_unit").html(obj.content);
          $("#cari_unit").selectpicker('refresh');
        }
        if ($('#pp_cabang_edit').val() != '') {
          $("#pp_unit_edit").html(obj.content);
          $("#pp_unit_edit").selectpicker('refresh');
        }
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

  function list_status_perkara(){

    var jenis_hukum=$('#jenis_hukum').val();

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
        $("#status_perkara").html(obj.content);
        $("#status_perkara").selectpicker('refresh');
        $("#status_perkara_edit").html(obj.content);
        $("#status_perkara_edit").selectpicker('refresh');
      }
    }); 
  }

</script>

@endsection

   