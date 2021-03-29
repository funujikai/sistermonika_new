<!DOCTYPE html>
<html style="height:100%; margin:0">
<head>
	<meta lang="eng">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="43200">
	<title>Monitor Siluman</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fonts/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/mystyle.css" rel="stylesheet" type="text/css" />
    
</head>
<body style="height:100%; margin:0">
	{{-- <nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">
					<img alt="Brand" src="#">
				</a>
			</div>
		</div>
	</nav> --}}
    <section>
        <div class="monitor_header">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <img src="images/pnm_logo.png" alt="PNM LOGO" id="pnm_logo">
                    <img src="images/antifraud.png" alt="Anti Fraud Logo" id="anti_fraud_logo">
                </div>
                 <div class="col-md-4 col-sm-4 col-xs-12">
                    <span id="title_header">MONITOR SILUMAN<span>
                </div>
                 <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="pull-right" id="div_for_time">
                        <p><span id="date_today"></span><span id="time"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	<section id="monitor_body">
		<div class="container-fluid monitor_container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 cntn_padding_tbl">
					<table id="tbl_monitor_daftarpp" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
						<thead>
                            <tr>
                                <th colspan="8">Perkara</th>
                            </tr>
							<tr>
								<th width="5%">Cabang</th>
								<th width="5%">Unit</th>
								<th width="6%">Jenis Hukum</th>
								<th width="17%">Jenis Perkara</th>
								<th width="15%">Pelapor</th>
								<th width="16%">Terlapor</th>
								<th width="10%">Status Perkara</th>
								<th width="8%">Tanggal Status</th>
								{{-- <th width="8%">PIC</th> --}}
							</tr>
						</thead>
						<tbody id="display_data_perdata">
						</tbody>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 cntn_padding_tbl">
					<table id="tbl_monitor_daftarpn" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
						<thead>
                            <tr>
                                <th colspan="7">Jaminan Notaris</th>
                            </tr>
							<tr>
								<th width="5%" class="text-center">Cabang</th>
			                    <th width="5%" class="text-center">Unit</th>
			                    <th width="15%" class="text-center">Nama Debitur</th>
			                    <th width="15%" class="text-center">Nama Notaris</th>
			                    <th width="10%" class="text-center">Jenis Pengurusan</th>
			                    <th width="10%" class="text-center">Status</th>
			                    <th width="8%" class="text-center">Tanggal Status</th>
			                    {{-- <th width="15%" class="text-center">Keterangan</th> --}}
								{{-- <th width="8%">PIC</th> --}}
							</tr>
						</thead>
						<tbody id="display_data_pidana">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<script src="js/jquery.min.js"></script>
	<script src="js/monitor.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/datatables/jquery.dataTables.min.js"></script>
    <script src="js/datatables/dataTables.bootstrap.js"></script>
    <script src="js/datatables/dataTables.buttons.min.js"></script>
    <script src="js/datatables/buttons.bootstrap.min.js"></script>
    {{-- <script src="js/datatables/jszip.min.js"></script> --}}
    <script src="js/datatables/vfs_fonts.js"></script>
    <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="js/datatables/dataTables.keyTable.min.js"></script>
    <script src="js/datatables/dataTables.responsive.min.js"></script>
    <script src="js/datatables/responsive.bootstrap.min.js"></script>
    <script src="js/datatables/dataTables.scroller.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/validator/validator.js"></script>
    <script src="js/dateformat.js"></script>
    {{-- <script src="js/main.js"></script> --}}
</body>
</html>