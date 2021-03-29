<div class="modal fade" id="modal_editstatusperkara" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Kronologis Perkara</h4>
      </div>
      <form class="form-horizontal form-label-left" action="{{ url('P_EditStatusPerkara') }}" method="POST" id="form-editstatusperkara">
        <div class="modal-body">
          <div class="form-group margin-40" id="div-id-kronologis-pp">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kronologis <span class="required">*</span></label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="kronologis_edit" id="kronologis_edit" class="form-control" style="width:100%; text-transform:uppercase" rows="4" required></textarea>
            </div>
          </div>

          <div class="form-group margin-40 div-status-perkara-sp-edit">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Perkara <span class="required">*</span></label>
            <div class="col-md-9 col-sm-9 col-xs-12 div-status-perkara-sp-2">
              <select class="selectpicker form-control" id="status_perkara_edit" name="status_perkara_edit" data-live-search="true" style="width:100%" required>

              </select>
            </div>
          </div>

          <div class="form-group margin-40 div_status_wol_edit" id="div-status-perkara-sp-edit" style="display:none">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hasil <span class="required">*</span></label>
            <div class="col-md-9 col-sm-9 col-xs-12 div-status-perkara-sp-2">
              <select class="selectpicker form-control" id="sp_status_wol_edit" name="sp_status_wol_edit" data-live-search="true" style="width:100%">
                <option value=""> --Pilih Status-- </option>
                <option value="1"> KALAH </option>
                <option value="2"> MENANG </option>
              </select>
            </div>
          </div>

          <div class="form-group margin-40" id="div_nomor_perkara_edit" style="display:none">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor <span class="required">*</span></label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input id="nomor_perkara_edit" name="nomor_perkara_edit" class="form-control" autocomplete="off">
            </div>
          </div>

          <div class="form-group margin-40">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Status <span class="required">*</span></label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input id="tanggal_perkara_edit" name="tanggal_perkara_edit" class="form-control" autocomplete="off">
            </div>
          </div>

          <div class="form-group margin-40">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kendala</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="kendala_edit" id="kendala_edit" class="form-control" maxlength="160" style="width:100%; text-transform:uppercase" rows="4"></textarea>
            </div>
          </div>

          <div class="form-group margin-40">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="sp_komentar_edit" id="sp_komentar_edit" class="form-control" maxlength="160" style="width:100%; text-transform:uppercase" rows="4"></textarea>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="detail_id_edit" name="detail_id_edit">
            <input type="hidden" id="header_id_edit" name="header_id_edit">
            <input type="hidden" id="jenis_hukum_edit" name="jenis_hukum_edit">
          </div>
        </div>
        <div class="modal-footer">
          <a type="button" data-dismiss="modal" class="btn btn-warning pull-left">Batal</a>
          <button class="btn btn-primary pull-right disabled-on-submit" id="btn-simpan-sp-edit">Ubah</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

  $('#status_perkara_edit').on('change', function() {
    var putusan = $('#status_perkara_edit').val();

    if (putusan == 11 || putusan == 21 || putusan == 31) {
      $('#div-status-perkara-sp-edit').show();
    } else {
      $('#div-status-perkara-sp-edit').hide();
    };

    // Pengkondisian jika isian kolom status = cabut gugatan
    if (putusan == 14) {
      // menambahkan attribut untuk membuka modal cabut gugatan
      $('#btn-simpan-sp-edit').attr({
        'data-toggle' : 'modal',
        'data-target' : '#modal_cabutgugatan'
      });

      $('#btn-simpan-sp-edit').click(function() {
        event.preventDefault();
        var kronologis = $('#kronologis').val();
        var tanggal_perkara = $('#tanggal_perkara').val();
        var kendala = $('#kendala').val();
        var sp_komentar = $('#sp_komentar').val();
        var header_id = $('#header_id').val();
        $('#kronologis_cabutgugatan').val(kronologis);
        $('#status_perkara_cabutgugatan').val(putusan);
        $('#tanggal_perkara_cabutgugatan').val(tanggal_perkara);
        $('#kendala_cabutgugatan').val(kendala);
        $('#sp_komentar_cabutgugatan').val(sp_komentar);
        $('#header_id_cabutgugatan').val(header_id);
      });
    } else {
      $('#btn-simpan-sp-edit').removeAttr('data-toggle data-target');
      $('#form-editstatusperkara').attr({
        'action' : '{{ url('P_EditStatusPerkara') }}',
        'method' : 'POST'
      });
    };
  });

  </script>