<style>
.image-holder{
		width : 100%
}
</style>
<div class="modal fade modal_editpn" id="modal_perpanjangan_cn" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Perpanjangan CN</h4>
			</div>
			<form class="form-horizontal form-label-left" action="{{ url('perpanjanganCN') }}" method="POST" id="form-editstatusperkara" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">No. Covernote <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input name="pn_covernote" id="pn_covernote" style="text-transform:uppercase" class="form-control" required autocomplete="off">
		                </div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Masa Berlaku <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type='text' class="datepicker form-control" id="pn_masa_berlaku" name="pn_masa_berlaku" required autocomplete="off">
		                </div>
					</div>
					<div class="form-group margin-40">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Dokumen <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input id="upload_dokumen" type="file" onchange="readURL(this);" class="form-control has-feedback-left estimasi-kerugian" required name="dokumen">						
		                </div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="header_id_cn" name="header_id_cn">
					<a type="button" data-dismiss="modal" class="btn btn-default pull-left">Batal</a>
					<button class="btn btn-primary pull-right disabled-on-submit" id="btn-simpan-sp">Ubah</button>
				</div>
				<div class="modal-footer">
				<h4 class="text-center">Preview Upload</h4>
						<div id="image-holder"></div>
						<canvas id="pdf-holder"></canvas>
				</div>
	        </form>
		</div>
	</div>
</div>
<script type="text/javascript">
var pdfjsLib = window['pdfjs-dist/build/pdf'];

pdfjsLib.GlobalWorkerOptions.workerSrc = 'js/pdfworker.js';

$("#upload_dokumen").on("change", function(e){
	var file = e.target.files[0]	
	var imgPath = $(this)[0].value;
	var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	
	if(file.type == "application/pdf"){
		$('#image-holder').hide();
		$('#pdf-holder').show();
		
		var fileReader = new FileReader();  
		fileReader.onload = function() {
			var pdfData = new Uint8Array(this.result);
			// Using DocumentInitParameters object to load binary data.
			var loadingTask = pdfjsLib.getDocument({data: pdfData});
			loadingTask.promise.then(function(pdf) {
			  console.log('PDF loaded');
			  
			  // Fetch the first page
			  var pageNumber = 1;
			  pdf.getPage(pageNumber).then(function(page) {
				console.log('Page loaded');
				
				var scale = 1.25;
				var viewport = page.getViewport({scale: scale});

				// Prepare canvas using PDF page dimensions
				var canvas = $("#pdf-holder")[0];
				var context = canvas.getContext('2d');
				canvas.height = viewport.height;
				canvas.width = viewport.width;

				// Render PDF page into canvas context
				var renderContext = {
				  canvasContext: context,
				  viewport: viewport
				};
				var renderTask = page.render(renderContext);
				renderTask.promise.then(function () {
				  console.log('Page rendered');
				});
			  });
			}, function (reason) {
			  // PDF loading error
			  console.error(reason);
			});
		};
		fileReader.readAsArrayBuffer(file);
	}else if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
		$('#pdf-holder').hide();
		$('#image-holder').show();
		
		if (typeof (FileReader) != "undefined") {

            var image_holder = $("#image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                        "class": "image-holder"
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
	}
});
</script>
