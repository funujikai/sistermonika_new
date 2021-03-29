@extends('layouts.layout')
@section('main_container')
@if(Session::has('SIPP_Role'))
<div class="right_col" role="main">
@else
<div class="right_col" role="main" style="margin-left:0" id="monitor">
@endif
  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <h3>
        Daftar Pending Perkara Pidana
      </h3>
    </div>
    <div class="clearfix"></div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
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
                  </tr>
                </thead>
                <tbody>
                  @foreach($getTotalListPidanaPending as $getData)
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


<script type="text/javascript">

$(document).ready(function() {
  $('body').removeClass('nav-md').addClass('nav-sm');

  $('#table_daftarpp').DataTable({
    "order": []
  });

  var $SIDEBAR_MENU = $('#sidebar-menu');
  if ($SIDEBAR_MENU.find('li').hasClass('active')) {
    $SIDEBAR_MENU.find('li.active').removeClass('active-sm').removeClass('active');
  }
});

</script>

@endsection

   