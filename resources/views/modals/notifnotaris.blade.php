<div class="modal fade" id="modal_notifnotaris" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
				<h4 class="modal-title" id="myModalLabel">Perubahan Pekerjaan Monitoring Notaris</h4>
			</div>
			<div class="modal-body">
				<br>
				<div class="row">
					<div class="col-sm-4">
						<input type="date" id='notif_date_notaris' class='form-control'>
					</div>
				</div>
				<br>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-striped table-bordered table-responsive" id='list_notif_notaris'>
							<thead>
								<tr>
									<th rowspan='2'>No</th>
									<th rowspan='2'>Wilayah</th>
									<th rowspan='2'>Cabang</th>
									<th colspan='1'>Umapped</th>
									<th colspan='5'>Mapped</th>
									<th colspan='3'>Status</th>
								</tr>
								<tr>
									<th>Hapus</th>
									<th>Tambah</th>
									<th>Perpanjangan</th>
									<th>Ubah</th>
									<th>Hapus</th>
									<th>Submit</th>
									<th>Tambah</th>
									<th>Ubah</th>
									<th>Hapus</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<td colspan='3'>Total</td>
									<td id='total_notif_0'>0</td>
									<td id='total_notif_1'>0</td>
									<td id='total_notif_2'>0</td>
									<td id='total_notif_3'>0</td>
									<td id='total_notif_4'>0</td>
									<td id='total_notif_5'>0</td>
									<td id='total_notif_6'>0</td>
									<td id='total_notif_7'>0</td>
									<td id='total_notif_8'>0</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('#notif_date_notaris').on('change',function(){
		$.ajax({
			method: "get",
			url: "get_notif_notaris",
			data: { date:$(this).val()},
			
		}).done(function( msg ) {
			var html = '';
			var total=[0,0,0,0,0,0,0,0,0];
			$.each(msg.data,function(index,value){
				html+='<tr><td>'+(index+1)+'</td><td>'+value.wilayah+'</td><td>'+value.cabang+'</td><td>'+value.um_del+'</td><td>'+value.m_in+'</td><td>'+value.m_perpanjangan+'</td><td>'+value.m_up+'</td><td>'+value.m_del+'</td><td>'+value.m_sub+'</td><td>'+value.s_in+'</td><td>'+value.s_up+'</td><td>'+value.s_del+'</td></tr>';
				total[0]+=parseInt(value.um_del);
				total[1]+=parseInt(value.m_in);
				total[2]+=parseInt(value.m_perpanjangan);
				total[3]+=parseInt(value.m_up);
				total[4]+=parseInt(value.m_del);
				total[5]+=parseInt(value.m_sub);
				total[6]+=parseInt(value.s_in);
				total[7]+=parseInt(value.s_up);
				total[8]+=parseInt(value.s_del);
			});
			$('#list_notif_notaris').find('tbody').html(html);
			for(var i=0;i<total.length;i++){
				$("#total_notif_"+i).html(total[i]);
			}
		});
	});
});
function list_notif_notaris(){
	$('#notif_date_notaris').val('{{date("Y-m-d")}}').change();
}
</script>