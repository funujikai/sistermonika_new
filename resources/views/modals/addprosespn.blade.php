<div class="modal fade" id="modal_addprosespn" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Proses Baru Pengikatan <label class='title-form'></label></h4>
			</div>
			<form class="form-horizontal form-label-left" action="{{ route('PostProsesPN') }}" method="POST">
				<div class="modal-body">
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	<select class="selectpicker form-control" id="pn_status" name="pn_status" data-live-search="true" style="width:100%" required>
		                          <option value=""> --Pilih Status-- </option> 
		                    </select>
                        </div>
                    </div>
					
					<div class="form-group margin-40">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Status <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          	 <input id="tanggal_status" name="tanggal_status" class="datepicker form-control" required autocomplete="off">
                        </div>
                    </div>
					
					<div class="form-group margin-40 kendala">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Kendala <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" id="pn_kendala" name="pn_kendala" data-live-search="true" style="width:100%" required>
		                          <option value=""> --Pilih Status-- </option> 
		                          @foreach($getKendala as $getData)
		                          <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
		                          @endforeach
		                    </select>
						</div>
					</div>
					
					<div class="form-group margin-40 alasan_kendala">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Alasan Kendala <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" id="pn_alasan_kendala" name="pn_alasan_kendala" data-live-search="true" style="width:100%" required>
		                          <option value=""> --Pilih Alasan Kendala-- </option> 
		                    </select>
						</div>
					</div>					

					<div class="form-group margin-40 keterangan_kendala">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea id="pn_keterangan" name="pn_keterangan" class="form-control" maxlength="160" style="width:100%; text-transform:uppercase" rows="4"></textarea>
						</div>
					</div>
					
					<div class="form-group margin-40 rekomendasi">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Rekomendasi <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="selectpicker form-control" id="pn_rekomendasi" name="pn_rekomendasi" data-live-search="true" style="width:100%" required>
		                          <option value=""> --Pilih Rekomendasi-- </option> 
		                          @foreach($getStatusRekomendasi as $getData)
		                          <option value="{{ $getData->kode }}"> {{ $getData->nama }} </option> 
		                          @endforeach
		                    </select>
						</div>
					</div>

				</div>
				<div class="modal-footer">
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="header_id" name="header_id">
					<input type="hidden" id="tipe_pengikatan" name="tipe_pengikatan">
                    <a type="button" data-dismiss="modal" class="btn btn-warning pull-left">Batal</a>
            		<button class="btn btn-primary pull-right" data-target="modal_konfirmasi_simpan" data-toggle="modal">Simpan</button>
				</div>
		    </form>
		</div>
	</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(":input").inputmask();
	
	 $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
      });
	  
	 $(".keterangan_kendala").hide();
  });
  
  $('#pn_kendala').on('change',function(){  
	if ($(this).val()==7){  
		$(".alasan_kendala").hide();
		$('#pn_alasan_kendala').prop('required',false);		
		$(".keterangan_kendala").show();
		$('#pn_keterangan').prop('required',true);		
		console.log('masuk sini');		
	}
	else if ($(this).val()==6)
	{
		$(".alasan_kendala").hide();
		$('#pn_alasan_kendala').prop('required',false);			
	}
	else
	{
	  $(".alasan_kendala").show();
	  $('#pn_alasan_kendala').prop('required',true);
	  $.ajax({
        url: "get_kendala_reason",
        type: "GET",
        data: {
          kendala_id : $(this).val()
        },
        cache: false,
        beforeSend: function() {
          $(".loading_ajax").show(); 
        },
        success: function(msg){
          $(".loading_ajax").hide();	
          var obj = $.parseJSON(msg);
          $("[id*=pn_alasan_kendala]").html(obj.content).selectpicker('refresh');
        }
      });
	}		
  });
  
  $('#pn_alasan_kendala').on('change',function(){	
	  // console.log('ok',alasan_kendalanya);
	  if ($( "#pn_alasan_kendala option:selected" ).text().trim()=='Lainnya'){
		  console.log('iya');
		  $(".keterangan_kendala").show();
	  }else{
		  console.log('tidak');
		  $(".keterangan_kendala").hide();
	  }
		  
  });
  
 //  function list_status_perkara(){
		
	// 	var jenis_hukum=$('#jenis_hukum').val();
		
	// 	$.ajax({
	// 		url: "list_status_perkara",
	// 		type: "GET",
	// 		data: {jenis_hukum : jenis_hukum},
	// 		cache: false,
	// 		 beforeSend: function() {
 //             $(".loading_ajax").show(); 
 //           },
	// 		success: function(msg){
	// 		$(".loading_ajax").hide();	
	// 		 var obj = $.parseJSON(msg);
 //               $("#status_perkara").html(obj.content);
	// 		   $("#status_perkara").selectpicker('refresh');
	// 		}
	// 	});			
	// }
	
	</script>