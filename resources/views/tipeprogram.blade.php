@extends('layouts.layout')
@section('main_container')
  <div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Tipe Program</h2>
                      <a type="button" class="btn btn-round btn-success pull-right" data-toggle="modal" data-target="#modal_tambahprogram">Tambah Program</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="table_program" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th width="8%">No</th>
                          <th>Tipe Program</th>
                          <th width="12%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = "1"?>
                        @foreach($getProgram as $getData)
                          <tr>
                            <td align="center">{{ $no++ }} </td>
                            <td>{{ $getData->program }}</td>
                            <td>
                              <div class="btn-group">
                                <a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_ubahprogram"
                                    onclick="modal_ubahprogram('{{ $getData->program_id }}',
                                                          '{{ $getData->program }}')">UBAH</a>
                                  </li>
                                  <li>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_konfirmasihapusprogram"
                                    onclick="modal_konfirmasihapusprogram('{{ $getData->program_id }}',
                                                          '{{ $getData->program}}')">HAPUS</a>
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
    $('#table_program').DataTable();
  });

  function modal_ubahprogram(program_id, program) {
    $('#ubahprogramid').val(program_id);
    $('#ubahprogram').val(program);
  }

  function modal_konfirmasihapusprogram(program_id, program) {
    $('#hapusprogramid').val(program_id);
    $('#hapusprogram').html(program);
  }

</script>

@endsection

@section('modal-content')
  @include('modals.tambahprogram')
  @include('modals.ubahprogram')
  @include('modals.konfirmasihapusprogram')
@endsection