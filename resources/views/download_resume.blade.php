@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">

<div id="resume" class="tab-pane fade in active">
  <center><h2>Resume Perkara</h2></center>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <table id="table_resume" class="table table-striped table-bordered table-responsive">
        <tr>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Tanggal Pendaftaran</td>
          <td id='tgl_pendaftaran'>{{$data->laporan_tanggal_perkara}}</td>
        </tr>
        <tr>
          <td class='no_perkara' style="color:#000" width="20%" bgcolor='#adeaea'>@if($data->m_jenis_hukum_id==2)No Laporan Polisi @else No Perkara @endif</td>
          <td id='nmr_regis'>{{$data->no_perkara}}</td>
        </tr>
        <tr>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Nama Lembaga Hukum</td>
          <td id='nm_lembaga'>{{$data->pengadilan}}</td>
        </tr>
        @if($data->m_jenis_hukum_id==2)
        <tr class='jenis_hukum_2'>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Klasifikasi Pidana</td>
          <td id='klsfks_pidana'>{{$data->nama_klasifikasi}}</td>
        </tr>
        @endif
        <tr class='jenis_hukum_2'>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Delik Pidana</td>
          <td id='dlk_pidana'>{{$data->delik_pidana}}</td>
        </tr>
        <tr>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Kedudukan Perseroan</td>
          <td id="kddkn_perseroan">{{$data->kedudukan_perseroan}}</td>
        </tr>
        <tr id='tr_plapor'>
          <td style="color:#000" width="20%" bgcolor='#adeaea' id='td_plapor'>{{$data->lbl_penggugat}}</td>
          <td id='plapor'>{{$data->laporan_header_pelapor}}</td>
        </tr>
        <tr id='tr_trlapor'>
          <td style="color:#000" width="20%" bgcolor='#adeaea' id='td_trlapor'>{{$data->lbl_tergugat}}</td>
          <td id='trlapor'>{{$data->laporan_header_terlapor}}</td>
        </tr>
        @if($data->lbl_turut_tergugat!='-')
        <tr id='tr_trt_trlapor'>
          <td style="color:#000" width="20%" bgcolor='#adeaea' id='td_trt_trlapor'>{{$data->lbl_turut_tergugat}}</td>
          <td id='trt_trlapor'>{{$data->turut_tergugat}}</td>
        </tr>
        @endif
        @if($data->m_jenis_hukum_id!=2)
        <tr class='jenis_hukum_1 jenis_hukum_4 jenis_hukum_3'>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Petitum</td>
          <td id='pttm'>{!!$data->petitum!!}</td>
        </tr>
        @endif
        <tr>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Rangkaian Proses Hukum</td>
          <td id='rdh'>{{$data->m_parameter_name}}</td>
        </tr>
        <tr>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Laporan</td>
          <td id='lprn'>{{$data->keterangan}}</td>
        </tr>
        <tr>
          <td colspan='2' style="color:#000" width="100%" bgcolor='#adeaea'>Nilai Sengketa</td>
        </tr>
        <tr>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Materil</td>
          <td id='mtrl'>{{str_replace('.0000','',$data->materil)}}</td>
        </tr>
        <tr>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Immateril</td>
          <td id='immtrl'>{{str_replace('.0000','',$data->immateril)}}</td>
        </tr>
        <tr>
          <td style="color:#000" width="20%" bgcolor='#adeaea'>Dwangsom</td>
          <td id='dwngsm'>{{str_replace('.0000','',$data->dwangsom)}}</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row" id='ptsn'>
    <div class="col-sm-12">
        @foreach($putusan as $key=>$value)
        <h2>{{$list_putusan[(($value->m_upaya_hukum_id)?$value->m_upaya_hukum_id:0)]}}</h2>
        <br>
        <table id="table_resume" class="table table-striped table-bordered table-responsive">
          <tr>
            <td style="color:#000" width="20%" bgcolor='#adeaea'>Tanggal Putusan</td>
            <td id='tgl_putusan_0'>{{$value->tanggal_pelaksanaan}}</td>
          </tr>
          <tr>
            <td style="color:#000" width="20%" bgcolor='#adeaea'>Status Putusan</td>
            <td id='sts_putusan_0'>{{strtoupper($value->nama_status_putusan)}}</td>
          </tr>
          <tr>
            <td style="color:#000" width="20%" bgcolor='#adeaea'>Nilai Ganti Kerugian</td>
            <td id='nm_lmbg_0'>{{($value->materil+$value->immateril+$value->dwangsom)}}</td>
          </tr>
          <tr>
            <td style="color:#000" width="20%" bgcolor='#adeaea'>Amar Putusan</td>
            <td id='amr_ptsn_0'>{{$value->amar_putusan}}</td>
          </tr>
        </table>
        @endforeach
      </div>
    </div>
</div> <!-- End div right col -->

<script type="text/javascript">
  $(document).ready(function() {
    $('.right_col').css('margin-left','0px');
    $('.top_nav,.left_navigasi').remove();
    setTimeout(function(){
      window.print();      
    }, 1000);
  });
</script>
@endsection
