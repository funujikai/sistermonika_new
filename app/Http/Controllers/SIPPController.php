<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use DB;
use App\Tiket;
use App\User;
use App\Status;
use Session;
use DateTime;
use App\Helper;

// use Elasticsearch\ClientBuilder;

class SIPPController extends Controller
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


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function TambahPP()
    {	
        $getWilayah = DB::select("EXEC dbo.get_wilayah");
        $getJenisHukum = DB::select("EXEC dbo.get_jenis_hukum");
        $getHukumBerjalan = DB::select("EXEC dbo.get_hukum_berjalan");
        $getPerkaraPidana = DB::select("Exec dbo.get_perkara_pidana");
        $getJenisPerdata = DB::select("Exec dbo.get_jenis_perdata");
        $dataPP = ['getWilayah' => $getWilayah, 'getJenisHukum' => $getJenisHukum, 'getHukumBerjalan' => $getHukumBerjalan, 'getPerkaraPidana' => $getPerkaraPidana, 'getJenisPerdata' => $getJenisPerdata];
		$dataPP['accessuser'] = Helper::get_access(6)[0];
		$dataPP['getUnitBisnis'] = DB::select("Exec dbo.get_unit_bisnis");	
		$dataPP['getklasifikasiperkara'] = DB::select("Exec dbo.get_klasifikasi_perkara");

        return view('tambahpp', $dataPP);
    }

	public function DaftarPP()
	{
		$getWilayah = DB::select("EXEC dbo.get_wilayah");
		$getJenisHukum = DB::select("EXEC dbo.get_jenis_hukum");
		$getHukumBerjalan = DB::select("EXEC dbo.get_hukum_berjalan");
		$getPerkaraPidana = DB::select("Exec dbo.get_perkara_pidana");
        $getJenisPerdata = DB::select("Exec dbo.get_jenis_perdata");
		$dataPP = ['getWilayah' => $getWilayah, 'getHukumBerjalan' => $getHukumBerjalan, 'getJenisHukum' => $getJenisHukum, 'getPerkaraPidana' => $getPerkaraPidana,'getJenisPerdata'=>$getJenisPerdata];
		$dataPP['accessuser'] = Helper::get_access(7)[0];
		$dataPP['getUnitBisnis'] = DB::select("Exec dbo.get_unit_bisnis");
		$dataPP['getklasifikasiperkara'] = DB::select("Exec dbo.get_klasifikasi_perkara");
		return view('daftarpp', $dataPP);
	}

	public function HistoryPP() 
	{
		$getCabang = DB::select("EXEC dbo.get_wilayah");
		$getJenisHukum = DB::select("EXEC dbo.get_jenis_hukum");
		$dataHistory = ['getCabang' => $getCabang, 'getJenisHukum' => $getJenisHukum];		
		$dataHistory['accessuser'] = Helper::get_access(8)[0];
		$dataHistory['getJenisPerdata'] = DB::select("Exec dbo.get_jenis_perdata");
		$dataHistory['getWilayah'] = DB::select("EXEC dbo.get_wilayah");
		$dataHistory['getUnitBisnis'] = DB::select("Exec dbo.get_unit_bisnis");
		return view('historypp', $dataHistory);
	}

	public function LaporanPP(Request $request) {
		$getCabang = DB::select("EXEC dbo.get_wilayah");
		$getJenisHukum = DB::select("EXEC dbo.get_jenis_hukum");
		$dataLaporan = ['getCabang' => $getCabang, 'getJenisHukum' => $getJenisHukum];
		$dataLaporan['accessuser'] = Helper::get_access(9)[0];
		return view('laporanpp', $dataLaporan);
	}
	public function PerdataPending() 
	{
		$getTotalListPerdataPending = DB::select("EXEC get_list_perdata_pending");

		return view('daftarperdatapending', ['getTotalListPerdataPending' => $getTotalListPerdataPending]);
	}   

	public function PidanaPending() 
	{
		$getTotalListPidanaPending = DB::select("EXEC get_list_pidana_pending");

		return view('daftarpidanapending', ['getTotalListPidanaPending' => $getTotalListPidanaPending]);
	}

	public function NotarisPending() 
	{
		$getTotalListNotarisPending = DB::select("EXEC get_list_notaris_pending");

		return view('daftarnotarispending', ['getTotalListNotarisPending' => $getTotalListNotarisPending]);
	}    


	public function TambahPN() {
		$getCabang = DB::select("EXEC dbo.get_wilayah");
		$dataPN = ['getCabang' => $getCabang];
		$dataPN['getPencairan'] = DB::select('Exec dbo.get_jenis_pengurusan 1');
		$dataPN['getAgunan'] = DB::select('Exec dbo.get_jenis_pengurusan 2');
		$dataPN['getJenisAgunan'] = DB::select('Exec dbo.get_jenis_agunan');
		// var_dump($dataPN);die;
		return view('tambahpn', $dataPN);
	}

	public function DaftarPN(Request $request) {
		$getCabang = DB::select("EXEC dbo.get_wilayah");
		$getKendala = DB::select("EXEC dbo.get_kendala");

		// $getDaftarPN = DB::select("EXEC dbo.get_laporan_notaris");
		$header_id = $request['header_id'];		
		$getDaftarPNDetail = DB::select("EXEC dbo.get_laporan_notaris_detail_by_header @header_id='$header_id' ");		
		$dataPN = ['getCabang' => $getCabang, 'getKendala' => $getKendala, 'getDaftarPNDetail' => $getDaftarPNDetail];
		$dataPN['getPencairan'] = DB::select('Exec dbo.get_jenis_pengurusan 1');		
		$dataPN['getAgunan'] = DB::select('Exec dbo.get_jenis_pengurusan 2');
		$dataPN['getJenisAgunan'] = DB::select('Exec dbo.get_jenis_agunan');
		$dataPN['getStatusRekomendasi'] = DB::select('Exec dbo.get_status_rekomendasi');		

		return view('daftarpn', $dataPN);
	}
  
	public function HistoryPN(Request $request) {
		$getCabang = DB::select("EXEC dbo.get_wilayah");
		$getJenisPengurusan = DB::select("EXEC dbo.get_jenis_pengurusan");
		$dataHistory = ['getCabang' => $getCabang, 'getJenisPengurusan' => $getJenisPengurusan];

		return view('historypn', $dataHistory);
	}
  
	public function LaporanPN(Request $request) {
		$getCabang = DB::select("EXEC dbo.get_wilayah");
		$getKendala = DB::select("EXEC dbo.get_kendala");
		$getAgunan = DB::select("EXEC dbo.get_jenis_pengurusan 2");
		// get laporan pn
		$search="";
		$cabang = $request['cari_cabang'];
		if($cabang != '') {
			$search .= "@cari_cabang='$cabang',";
		}

		$unit = $request['cari_unit'];
		if($unit != '') {
			$search .= "@cari_unit='$unit',";
		}

		$status = $request['cari_status'];
		if($status != '') {
			$search .= "@cari_status='$status',";
		}

		$kendala = $request['cari_kendala'];
		if($kendala != '') {
			$search .= "@cari_kendala='$kendala',";
		}
		$search = substr($search, 0, -1);
		// $getLaporanPN = DB::select("EXEC dbo.get_laporan_notaris_for_print $search");
		$dataLaporanPN = ['getCabang' => $getCabang, 'getKendala' => $getKendala, 'getAgunan' => $getAgunan];
		$dataLaporanPN['getStatusRekomendasi'] =DB::select('exec get_status_rekomendasi');
		return view('laporanpn', $dataLaporanPN);
	}
	public function download_resume(Request $request){
		$header_id = $request['header_id'];
		$data["data"] = DB::select("EXEC dbo.get_laporan_header_by_id @header_id=$header_id")[0];
		$data["data"]->laporan_tanggal_perkara=(($data["data"]->laporan_tanggal_perkara!='')?date('d M Y',strtotime($data["data"]->laporan_tanggal_perkara)):'');
		$data["putusan"] = DB::table('laporan_detail as a')
		->join('m_status_putusan as c','c.id','=','a.m_status_akhir')
		->join('laporan_header as d','d.laporan_header_id','=','a.laporan_header_id')
		->join('m_parameter as b','b.m_parameter_id','=','a.m_parameter_id')
		->where('a.laporan_header_id','=',$header_id)
		->where('need_result','=','1')->select('tanggal_pelaksanaan','nama_status_putusan','amar_putusan','a.m_upaya_hukum_id','materil','immateril','dwangsom')->get();
		foreach($data['putusan'] as $key=>$value){
			$data["putusan"][$key]->tanggal_pelaksanaan=(($data["putusan"][$key]->tanggal_pelaksanaan!='')?date('d M Y',strtotime($data["putusan"][$key]->tanggal_pelaksanaan)):'');
		}
		$data['list_putusan']=array('Putusan','Banding','Kasasi','PK','Keberatan');
		// var_dump($data);die;
		return view('download_resume',$data);
	}
}
