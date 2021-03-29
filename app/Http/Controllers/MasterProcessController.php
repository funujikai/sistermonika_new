<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use DB;
use Session;
use DateTime;

class MasterProcessController extends Controller 
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

	public function AddWilayah(Request $request){
		$wilayah = $request['wilayah'];
		$cabang = $request['cabang'];
		foreach($cabang as $key=>$value){
			DB::statement("EXEC proses_map_wilayah_cabang 'input','$wilayah','$value'");
		}
		$message = 'Data Berhasil di Mapping';
		return redirect('DaftarWilayah')->with('message', $message);
	}
	public function EditWilayah(Request $request){
		$wilayah = $request['wilayah'];
		$cabang = $request['kode_cabang'];
		$type = $request['type'];
		$id = $request['wilayah_id'];
		DB::statement("EXEC proses_map_wilayah_cabang '$type','$wilayah','$cabang','$id'");
		$message = 'Data Berhasil di Mapping';
		return redirect('DaftarWilayah')->with('message', $message);
	}
	public function AddNotaris(Request $request){
		$nama_notaris = $request['nama_notaris'];
		$no_ktp = $request['no_ktp'];
		$alamat = $request['alamat'];
		$telepon = $request['telepon'];
		$handphone = $request['handphone'];
		$nomor_inni = $request['nomor_inni'];
		$nomor_ippat = $request['nomor_ippat'];
		$wilayah_kerja = $request['wilayah_kerja'];
		$email = $request['email'];
		$user = Session::get('SIPP_Username');
		DB::statement("EXEC insert_notaris 
			'$nama_notaris'
			,'$no_ktp'
			,'$alamat'
			,'$telepon'
			,'$handphone'
			,'$nomor_inni'
			,'$nomor_ippat'
			,'$wilayah_kerja'
			,'$email'
			,'$user'
		");
		$message = 'Data Berhasil di Tambahkan';
		return redirect('DaftarNotaris')->with('message', $message);
	}
	public function EditNotaris(Request $request){
		$header_id = $request['header_id'];
		$nama_notaris = $request['nama_notaris'];
		$no_ktp = $request['no_ktp'];
		$alamat = $request['alamat'];
		$telepon = $request['telepon'];
		$handphone = $request['handphone'];
		$nomor_inni = $request['nomor_inni'];
		$nomor_ippat = $request['nomor_ippat'];
		$wilayah_kerja = $request['wilayah_kerja'];
		$email = $request['email'];
		$user = Session::get('SIPP_Username');
		DB::statement("EXEC update_notaris 
			'$header_id'
			,'$nama_notaris'
			,'$no_ktp'
			,'$alamat'
			,'$telepon'
			,'$handphone'
			,'$nomor_inni'
			,'$nomor_ippat'
			,'$wilayah_kerja'
			,'$email'
			,'$user'
		");
		$message = 'Data Berhasil di Ubah';
		return redirect('DaftarNotaris')->with('message', $message);
	}
	public function DeleteNotaris(Request $request){
		$header_id = $request['header_id'];
		$user = Session::get('SIPP_Username');
		DB::statement("EXEC delete_notaris 
			'$header_id'
			,'$user'
		");
		$message = 'Data Berhasil di Hapus';
		return redirect('DaftarNotaris')->with('message', $message);
	}
}
