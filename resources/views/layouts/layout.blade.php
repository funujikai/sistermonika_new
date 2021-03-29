<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SISTER MONIKA - DIVISI LEGAL</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href='css/fullcalendar.min.css' rel='stylesheet' />
        <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="fonts/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/select/select2.min.css" rel="stylesheet">
        <link href="css/selectbootstrap/selectbootstrap.min.css" rel="stylesheet">
        <link href="css/icheck/flat/blue.css" rel="stylesheet">
        <link rel="stylesheet" href="tagsinput/dist/bootstrap-tagsinput.css">
        <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/mystyle.css" rel="stylesheet" type="text/css" />
		<script src="js/pdfviewer.js"></script>        
		<script src="js/pdfobject.js"></script>
		<script>
			if(PDFObject.supportsPDFs){
			console.log("Yay, this browser supports inline PDFs.");
			} else {
			console.log("Boo, inline PDFs are not supported by this browser");
			}
		</script>
		<style>
			.nav.side-menu> li.current-page, .nav.side-menu> li.active{
				border-bottom: 0px solid #5bc0de !important;
			}
		</style>
        <script src="js/jquery.min.js"></script>

    </head>
    
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                @if(Session::has('SIPP_Role'))
                    @include('includes.topbar')
                    @include('includes.sidebar')
                @endif

                @yield('main_container')
                @yield('modal-content')
                {{-- <footer style="background: #fff"> --}}
                <footer class="bluesky">
                  <div class="pull-right">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 1.3 &nbsp &nbsp
                    </div>
                    <span style="margin-right:5px">Copyright &copy; 2018</span><span><a href="http://pnm.co.id">PT. Permodalan Nasional Madani</a>.</span><span style="margin-right:5px; margin-left:5px">All rights reserved.</span>
                  </div>
                  <div class="clearfix"></div>
                </footer>
            </div>
        </div>
        @include('../modals/notifnotaris')
       
        <script src='js/moment.min.js'></script>
        <script src='js/fullcalendar.min.js'></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables/dataTables.bootstrap.js"></script>
        <script src="js/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datatables/buttons.bootstrap.min.js"></script>
        <script src="js/datatables/jszip.min.js"></script>
        <script src="js/datatables/pdfmake.min.js"></script>
        <script src="js/datatables/vfs_fonts.js"></script>
        <script src="js/datatables/buttons.html5.min.js"></script>
        <script src="js/datatables/buttons.print.min.js"></script>
        <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="js/datatables/dataTables.keyTable.min.js"></script>
        <script src="js/datatables/dataTables.responsive.min.js"></script>
        <script src="js/datatables/responsive.bootstrap.min.js"></script>
        <script src="js/datatables/dataTables.scroller.min.js"></script>
        <script src="js/select/select2.full.js"></script>
        <script src="js/selectbootstrap/selectbootstrap.min.js"></script>
        <script src="js/input_mask/jquery.inputmask.js"></script>
        <script src="js/datepicker/bootstrap-datepicker.min.js"></script>
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="js/ckeditor/ckeditor.js"></script>
        <script src="js/icheck/icheck.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/validator/validator.js"></script>
        <script src="js/autoNumeric.js"></script>
        <script src="js/dateformat.js"></script>        
        <script src="tagsinput/dist/bootstrap-tagsinput.min.js"></script>       
        <script src="js/main.js"></script>
        
        <script>
            $(document).ready(function(){
				$.fn.dataTable.ext.errMode = 'none';
                @if(Session::has('SIPP_Username'))
                    $.ajax({
                        url: "notic_number",
                        type: "get",
                        cache: false,
                        beforeSend: function() {
                            $(".loading_ajax").show(); 
                        },
                        success: function(msg){
                            $(".loading_ajax").hide();  
                            $('#number_list').html(msg[0].notif_log);
                        }
                    }); 
                @endif

            });
            function list_notif(){
                $.ajax({
                    url: "get_notice",
                    type: "get",
                    cache: false,
                    beforeSend: function() {
                        $(".loading_ajax").show(); 
                    },
                    success: function(msg){
                        $(".loading_ajax").hide();  
                        $('#notif_log').html(msg.content);
                        $('#number_list').html(0);
                    }
                }); 
            }         
        </script>
    </body>
    
</html>