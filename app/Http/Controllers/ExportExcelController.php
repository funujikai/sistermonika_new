<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use DB;
// use App\Tiket;
// use App\Helper;
// use App\User;
// use App\Status;
// use Session;
// use DateTime;
use Maatwebsite\Excel\Facades\Excel;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;

class ExportExcelController extends Controller
{
	public function download_laporan_notaris(Request $request){
		
		set_time_limit(0);
		ini_set('memory_limit', '-1');
			
		Excel::create('Laporan Notaris', function($excel) {

			$excel->sheet('Excel sheet', function($sheet) {
				
				$getDaftarPNDetail = DB::select("EXEC get_laporan_notaris @status='1', @order='id_debitur asc', @start=0, @length=-1");
				
				
				$data= json_decode( json_encode($getDaftarPNDetail), true);
				
				
				// var_dump($data[0]);die();
				// $data=array();
				// foreach ($getDaftarPNDetail as $key=>$value){
					// $data[$key]=(array)$value;					
				// }
											
				$sheet->fromArray($data);
				$sheet->setOrientation('landscape');

			});

		})->export('xls');
				

	}
	
}
