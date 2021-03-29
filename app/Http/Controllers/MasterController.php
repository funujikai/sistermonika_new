<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use DB;
use Session;
use DateTime;
use App\Helper;

class MasterController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

/*-------------------------------------------------------------------
| Master 
|-------------------------------------------------------------------*/

	public function DaftarWilayah(Request $request) {
		$data['getWilayah'] = DB::select("EXEC dbo.get_wilayah");
		$search = '';
		if($request->cari_wilayah)
			$search="'$request->cari_wilayah'";
		$data['getCabang'] = DB::select("EXEC dbo.get_cabang $search");
		$data['accessuser'] = Helper::get_access(14)[0];
    	return view('daftarwilayah',$data);
	}
	public function DaftarNotaris(Request $request) {
		$data['getWilayah'] = DB::select("EXEC dbo.get_wilayah");
		$search = '';
		if($request->cari_wilayah)
			$search.="@wilayah='$request->cari_wilayah' ";
		if($request->cari_cabang)
			$search.=",@cabang='$request->cari_cabang' ";
		$data['getCabang'] = DB::select("EXEC dbo.get_cabang");
		$data['getNotaris'] = DB::select("EXEC dbo.get_notaris $search");
		$data['accessuser'] = Helper::get_access(15)[0];
    	return view('daftarnotaris',$data);
	}
	public function getmodulerole(Request $request){
		$data['content']=DB::select('exec get_module '.$request['header_id']);
		return $data;
	}
}
