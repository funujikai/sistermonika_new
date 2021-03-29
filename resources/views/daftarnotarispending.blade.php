@extends('layouts.layout')
@section('main_container')
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <h3>
      Daftar Jaminan Notaris Pending
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
                    <th class="text-center">Cabang</th>
                    <th class="text-center">Unit</th>
                    <th class="text-center">Nama Debitur</th>
                    <th class="text-center">Nama Notaris</th>
                    <th class="text-center">Jenis Pengurusan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Tanggal Status</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">PIC</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($getTotalListNotarisPending as $daftarPN)
                  <tr>
                    <td width="5%">{{ $daftarPN->cabang }}</td>
                    <td width="5%">{{ $daftarPN->unit }}</td>
                    <td width="15%" style="text-transform:uppercase">{{ $daftarPN->debitur }}</td>
                    <td width="15%" style="text-transform:uppercase">{{ $daftarPN->notaris }}</td>
                    <td width="10%">{{ $daftarPN->jenis_pengurusan_nama }}</td>
                    <td width="10%" style="text-transform:uppercase">{{ $daftarPN->nama_status_jaminan }}</td>
                    <td width="8%">
                      @if(isset($daftarPN->tanggal_status))
                      {{ date("d M Y", strtotime($daftarPN->tanggal_status)) }}
                      @else
                      @endif
                    </td>
                    <td width="15%" style="text-transform:uppercase">{{ $daftarPN->keterangan }}</td>
                    <td width="7%" style="text-transform:uppercase">{{ $daftarPN->nama_pic }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div> <!-- End div x_content -->
        </div> <!-- End div x_panel -->
      </div> <!-- End div modal row -->
    </div> <!-- End div modal body -->
  </div> <!-- End div class = "" -->
</div> <!-- End div right col -->

<script type="text/javascript">

  $(document).ready(function() {
    $('body').removeClass('nav-md').addClass('nav-sm');
    $('#table_daftarpp').DataTable({
      "order": []
    });
  });

</script>

@endsection
