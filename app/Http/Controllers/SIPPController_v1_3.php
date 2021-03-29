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

// -----------------------------Tambah PP--------------------------------------------------------------
    public function TambahPP2()
    {
        $getCabang = DB::select("EXEC dbo.get_cabang");
        $getJenisHukum = DB::select("EXEC dbo.get_jenis_hukum");
        $getPerkaraPerdata = DB::select("Exec dbo.get_perkara_perdata");
        $getPerkaraPidana = DB::select("Exec dbo.get_perkara_pidana");
        $getUserPIC = DB::select("Exec dbo.get_user_pic");
        $dataPP = ['getCabang' => $getCabang, 'getJenisHukum' => $getJenisHukum, 'getPerkaraPerdata' => $getPerkaraPerdata, 'getPerkaraPidana' => $getPerkaraPidana, 'getUserPIC' => $getUserPIC];

        return view('tambahpp', $dataPP);
    }
	
	
	public function ProsesTambahPP(Request $request)
    {
        $cabang = $request['pp_cabang'];
        $unit = $request['pp_unit'];
        $jenis_hukum = $request['pp_jenis_hukum'];
        $perkaraPerdata = $request['perkara_perdata']; 
        $perkaraPidana = $request['perkara_pidana']; 
        $pelapor = $request['pp_pelapor'];
        $terlapor = $request['pp_terlapor'];
        $diskripsi = $request['perkara_pidana_lainnya'];
        $userPIC = $request['pp_pic'];
        // jika kolom estimasi kerugian tidak diisi, nilai estimasi kerugian = 0.0 (float format)
        // jika diisi, ambil nilai isian
        if ($request['pp_estimasi_kerugian'] == null){
          $estimasiKerugian = 0.0;
        } else {
          // hilangkan karakter . dan , dari isian kolom estimasi kerugian
          $estimasiKerugian = str_replace(".", "", $request['pp_estimasi_kerugian']);
          $estimasiKerugian = str_replace(",", "", $estimasiKerugian);
          $estimasiKerugian = substr($estimasiKerugian, 0, -2);
        }
        $created_by = Session::get('SIPP_Username');
        $date = date('Y-m-d');

        if (isset($perkaraPerdata)) {
          // jika yang dipiliah ada perdata
          DB::statement("EXEC dbo.insert_laporan_header @pp_cabang='$cabang', @pp_unit='$unit', @pp_jenis_hukum='$jenis_hukum', @pp_perkara='$perkaraPerdata', @pp_pelapor='$pelapor',@pp_terlapor='$terlapor',@pp_pic='$userPIC',@pp_estimasi_kerugian='$estimasiKerugian', @created_by='$created_by'");
        } else {
          // jika pidana
          DB::statement("EXEC dbo.insert_laporan_header @pp_cabang='$cabang', @pp_unit='$unit', @pp_jenis_hukum='$jenis_hukum', @pp_perkara='$perkaraPerdata', @pp_pelapor='$pelapor',@pp_terlapor='$terlapor',@pp_pic='$userPIC',@pp_estimasi_kerugian='$estimasiKerugian', @created_by='$created_by'");
          foreach($perkaraPidana as $value) {
            // jika opsi yang dipilih ada lainnya (7 = m_perkara_pidana_id dengan nana Lainnya)
            if($value != 7) {
              DB::statement("EXEC dbo.insert_laporan_header_perkara_pidana @pp_perkara_pidana_id='$value', @created_by='$created_by'");
            } else {
              DB::statement("EXEC dbo.insert_laporan_header_perkara_pidana @pp_perkara_pidana_id='$value', @diskripsi='$diskripsi', @created_by='$created_by'");
            }
          }
        };
        $message = "Info: Data berhasil disimpan!";

        return redirect('TambahPP')->with('message', $message);
    }

// -----------------------------Edit PP----------------------------------------------------------------
  public function GetPerkaraPidanaId(Request $request) 
  {
    $header_id = $request['header_id'];

    $getPerkaraPidanaId = DB::select("EXEC dbo.get_perkara_pidana_id @header_id='$header_id' ");

    $data["content"] = $getPerkaraPidanaId;

    echo json_encode($data);
  }

  public function ProsesEditPP(Request $request)
    {
        $cabang = $request['pp_cabang_edit'];
        $unit = $request['pp_unit_edit'];
        $jenis_hukum = $request['pp_jenis_hukum_edit'];
        $perkaraPerdata = $request['perkara_perdata_edit']; 
        $perkaraPidana = $request['perkara_pidana_edit']; 
        $pelapor = $request['pp_pelapor_edit'];
        $terlapor = $request['pp_terlapor_edit'];
        $diskripsi = $request['perkara_pidana_lainnya_edit'];
        $userPIC = $request['pp_pic_edit'];
        $headerId = $request['pp_header_id_edit'];
        // jika kolom estimasi kerugian tidak diisi, nilai estimasi kerugian = 0.0 (float format)
        // jika diisi, ambil nilai isian
        if ($request['pp_estimasi_kerugian_edit'] == null){
          $estimasiKerugian = 0.0;
        } else {
          // hilangkan karakter . dan , dari isian kolom estimasi kerugian
          $estimasiKerugian = str_replace(".", "", $request['pp_estimasi_kerugian_edit']);
          $estimasiKerugian = str_replace(",", "", $estimasiKerugian);
          $estimasiKerugian = substr($estimasiKerugian, 0, -2);
        }
        $user = Session::get('SIPP_Username');
        $date = date('Y-m-d');

        if (isset($perkaraPerdata)) {
          // jika yang dipiliah ada perdata
          DB::statement("EXEC dbo.update_perkara @laporan_header_id='$headerId', @laporan_header_cabang='$cabang', @laporan_header_unit='$unit', @m_jenis_hukum_id='$jenis_hukum', @m_perkara_perdata_id='$perkaraPerdata', @laporan_header_pelapor='$pelapor',@laporan_header_terlapor='$terlapor',@laporan_header_pic='$userPIC',@estimasi_kerugian='$estimasiKerugian', @updated_by='$user'");

          DB::statement("EXEC dbo.update_laporan_header_perkara_pidana @laporan_header_id='$headerId' ");
        } else {
          // jika pidana
          DB::statement("EXEC dbo.update_perkara @laporan_header_id='$headerId', @laporan_header_cabang='$cabang', @laporan_header_unit='$unit', @m_jenis_hukum_id='$jenis_hukum', @m_perkara_perdata_id='$perkaraPerdata', @laporan_header_pelapor='$pelapor',@laporan_header_terlapor='$terlapor',@laporan_header_pic='$userPIC',@estimasi_kerugian='$estimasiKerugian', @updated_by='$user'");
         
          DB::statement("EXEC dbo.update_laporan_header_perkara_pidana @laporan_header_id='$headerId' ");
          foreach($perkaraPidana as $value) {
            // jika opsi yang dipilih ada lainnya (7 = m_perkara_pidana_id dengan nana Lainnya)
            if($value != 7) {
              DB::statement("EXEC dbo.insert_laporan_header_perkara_pidana @pp_perkara_pidana_id='$value', @pp_header_id='$headerId', @created_by='$user'");
            } else {
               DB::statement("EXEC dbo.insert_laporan_header_perkara_pidana @pp_perkara_pidana_id='$value', @pp_header_id='$headerId', @diskripsi='$diskripsi', @created_by='$user'");
            }
          }
        };
        $messageAddedScs = "Info: Data berhasil diubah!"; 

        return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
    }

// -----------------------------Daftar PP--------------------------------------------------------------

	public function DaftarPP()
  {
    $getCabang = DB::select("EXEC dbo.get_cabang");
    $getJenisHukum = DB::select("EXEC dbo.get_jenis_hukum");
    $getDaftarPP = DB::select("EXEC dbo.get_laporan");
    $getUserPIC = DB::select("Exec dbo.get_user_pic");
    $getPerkaraPerdata = DB::select("Exec dbo.get_perkara_perdata");
    $getPerkaraPidana = DB::select("Exec dbo.get_perkara_pidana");
    $dataPP = ['getCabang' => $getCabang, 'getDaftarPP' => $getDaftarPP, 'getJenisHukum' => $getJenisHukum, 'getUserPIC' => $getUserPIC, 'getPerkaraPerdata' => $getPerkaraPerdata, 'getPerkaraPidana' => $getPerkaraPidana];

    return view('daftarpp', $dataPP);
  }
	
	
	 public function TraceLaporan(Request $request)
    {
        $header_id = $request['header_id'];
        
        $getTrack = DB::select("EXEC dbo.get_laporan_detail_by_header @header_id=$header_id");

        $data["content"] = $getTrack;
        echo json_encode($data);
    }

// -----------------------------Daftar Perdata Pending------------------------------------------------------

  public function PerdataPending() 
  {
    $getTotalListPerdataPending = DB::select("EXEC get_list_perdata_pending");

    return view('daftarperdatapending', ['getTotalListPerdataPending' => $getTotalListPerdataPending]);
  }   

  // -----------------------------Daftar Pidana Pending------------------------------------------------------

  public function PidanaPending() 
  {
    $getTotalListPidanaPending = DB::select("EXEC get_list_pidana_pending");

    return view('daftarpidanapending', ['getTotalListPidanaPending' => $getTotalListPidanaPending]);
  }

// -----------------------------Daftar Pidana Pending------------------------------------------------------

  public function NotarisPending() 
  {
    $getTotalListNotarisPending = DB::select("EXEC get_list_notaris_pending");

    return view('daftarnotarispending', ['getTotalListNotarisPending' => $getTotalListNotarisPending]);
  }    

// -----------------------------Status Perkara--------------------------------------------------------------

	public function ProsesTambahStatusPerkara(Request $request)
    {
        $status_perkara = $request['status_perkara'];
        $tanggal_perkara = $request['tanggal_perkara'];
        $kronologis = htmlentities($request['kronologis'],ENT_QUOTES);
        $kendala = htmlentities($request['kendala'],ENT_QUOTES);
        $nomorLP = $request['nomor_lp']; 
        $status = $request['sp_status_wol'];
        $komentar = htmlentities($request['sp_komentar'],ENT_QUOTES);
        $statusPerkaraText = $request['status_perkara_text_2']; 
        $jenisHukum = $request['jenis_hukum']; 
		    $header_id = $request['header_id'];
		
        $user = Session::get('SIPP_Username');
        $date = date('Y-m-d');

        if($status != null && $statusPerkaraText == null && ($status_perkara == 21 OR $status_perkara == 11) ) {
          DB::statement("EXEC dbo.insert_laporan_detail @pp_status_perkara='$status_perkara', @pp_tanggal_perkara='$tanggal_perkara', @pp_kronologis='$kronologis', @pp_nomor_lp='$nomorLP', @pp_kendala='$kendala', @pp_status_wol='$status', @pp_komentar='$komentar', @pp_header_id='$header_id',@created_by='$user'");
          // echo "yes";
          DB::statement("EXEC dbo.update_laporan_header @header_id='$header_id', @updated_by='$user' ");
        } elseif($status != null && $statusPerkaraText == 'BANDING') {
          DB::statement("EXEC dbo.insert_laporan_detail_bkpl @pp_status_perkara_text='$statusPerkaraText', @pp_tanggal_perkara='$tanggal_perkara', @pp_kronologis='$kronologis', @pp_nomor_lp='$nomorLP', @pp_kendala='$kendala', @pp_status_wol='$status', @pp_komentar='$komentar', @pp_header_id='$header_id',@created_by='$user'"); 

          DB::statement("EXEC dbo.update_laporan_header_banding @header_id='$header_id', @updated_by='$user' ");
          // echo "$statusPerkaraText";
        } elseif($status != null && $statusPerkaraText == 'KASASI') {
          DB::statement("EXEC dbo.insert_laporan_detail_bkpl @pp_status_perkara_text='$statusPerkaraText', @pp_tanggal_perkara='$tanggal_perkara', @pp_kronologis='$kronologis', @pp_nomor_lp='$nomorLP', @pp_kendala='$kendala', @pp_status_wol='$status', @pp_komentar='$komentar', @pp_header_id='$header_id',@created_by='$user'"); 

          DB::statement("EXEC dbo.update_laporan_header_kasasi @header_id='$header_id', @updated_by='$user' ");
          // echo "$statusPerkaraText";
        } elseif($status != null && $statusPerkaraText == 'PK') {
          DB::statement("EXEC dbo.insert_laporan_detail_bkpl @pp_status_perkara_text='$statusPerkaraText', @pp_tanggal_perkara='$tanggal_perkara', @pp_kronologis='$kronologis', @pp_nomor_lp='$nomorLP', @pp_kendala='$kendala', @pp_status_wol='$status', @pp_komentar='$komentar', @pp_header_id='$header_id',@created_by='$user'"); 

          DB::statement("EXEC dbo.update_laporan_header_pk @header_id='$header_id', @updated_by='$user' ");
        } else {
          DB::statement("EXEC dbo.insert_laporan_detail @pp_status_perkara='$status_perkara', @pp_tanggal_perkara='$tanggal_perkara', @pp_kronologis='$kronologis', @pp_nomor_lp='$nomorLP', @pp_kendala='$kendala', @pp_status_wol='$status', @pp_komentar='$komentar', @pp_header_id='$header_id',@created_by='$user'");
        }

        $messageAddedScs = "Info: Data berhasil ditambah!"; 

        return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
    }

// -----------------------------Edit Status Perkara--------------------------------------------------------------

  public function ProsesEditStatusPerkara(Request $request)
  {
    $status_perkara = $request['status_perkara_edit'];
    $tanggal_perkara = $request['tanggal_perkara_edit'];
    $kronologis = htmlentities($request['kronologis_edit'],ENT_QUOTES);
    $kendala = htmlentities($request['kendala_edit'],ENT_QUOTES);
    $nomorLP = $request['nomor_perkara_edit']; 
    $status = $request['sp_status_wol_edit'];
    $komentar = htmlentities($request['sp_komentar_edit'],ENT_QUOTES);
    $jenisHukum = $request['jenis_hukum_edit']; 
    $header_id = $request['header_id_edit'];
    $detail_id = $request['detail_id_edit'];

    $user = Session::get('SIPP_Username');
    $date = date('Y-m-d');

    DB::statement("EXEC dbo.update_laporan_detail @laporan_detail_id='$detail_id', @m_parameter_id='$status_perkara', @laporan_detail_tanggal='$tanggal_perkara', @laporan_detail_kronologis='$kronologis', @laporan_nomor_lp='$nomorLP', @laporan_detail_kendala='$kendala', @m_status_akhir='$status', @komentar='$komentar',@updated_by='$user'");

    $messageAddedScs = "Info: Data berhasil diubah!"; 

    return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
  }

// -----------------------------Delete Status Perkara--------------------------------------------------------------

  public function ProsesDeleteStatusPerkara(Request $request)
  {
    $laporan_detail_id = $request['detail_id_delete'];
    $user = Session::get('SIPP_Username');

    DB::statement("EXEC dbo.delete_laporan_detail @laporan_detail_id='$laporan_detail_id',@updated_by='$user' ");

    $messageAddedScs = "Info: Data berhasil dihapus!"; 
    return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
  }

  public function GetKronologisPerkara(Request $request)
  {
    $laporan_id = $request['laporan_id'];

    $getTrack = DB::select("EXEC dbo.get_laporan_detail_by_laporan_id @laporan_id=$laporan_id");

    $data["content"] = $getTrack;
    echo json_encode($data);
  }

// -----------------------------SelesaiPP--------------------------------------------------------------

  public function SelesaiPerkara(Request $request) {
    $header_id = $request['header_id_selesaiperkara'];
    $user = Session::get('SIPP_Username');


    DB::statement("EXEC dbo.update_laporan_header_is_closed @header_id='$header_id', @updated_by='$user' ");

    $messageSubmitScs = "Info: Data berhasil disubmit!";

    return redirect('DaftarPP')->with('messageSubmitScs', $messageSubmitScs);
  }

  // -----------------------------CabutGugatanPP--------------------------------------------------------------

  public function CabutGugatanPerkara(Request $request) {
    $status_perkara = $request['status_perkara_cabutgugatan'];
    $tanggal_perkara = $request['tanggal_perkara_cabutgugatan'];
    $kronologis = $request['kronologis_cabutgugatan'];
    $kendala = $request['kendala_cabutgugatan'];
    $komentar = $request['sp_komentar_cabutgugatan'];
    $header_id = $request['header_id_cabutgugatan'];
    $user = Session::get('SIPP_Username');

    DB::statement("EXEC dbo.insert_laporan_detail @pp_status_perkara='$status_perkara', @pp_tanggal_perkara='$tanggal_perkara', @pp_kronologis='$kronologis', @pp_kendala='$kendala', @pp_komentar='$komentar', @pp_header_id='$header_id',@created_by='$user'");

    DB::statement("EXEC dbo.update_laporan_header_is_closed @header_id='$header_id', @updated_by='$user' ");

    $messageSubmitScs = "Info: Data berhasil disubmit!";

    return redirect('DaftarPP')->with('messageSubmitScs', $messageSubmitScs);
  }

	
// -----------------------------History PP--------------------------------------------------------------

  public function HistoryPP() 
  {
    $getCabang = DB::select("EXEC dbo.get_cabang");
    $getJenisHukum = DB::select("EXEC dbo.get_jenis_hukum");
    $history = DB::select("EXEC get_laporan_closed");
    $dataHistory = ['getCabang' => $getCabang, 'history' => $history,  'getJenisHukum' => $getJenisHukum];

    return view('historypp', $dataHistory);
  }

// -----------------------------Laporan PP--------------------------------------------------------------
	
  public function LaporanPP(Request $request) {
    $getCabang = DB::select("EXEC dbo.get_cabang");
    $getJenisHukum = DB::select("EXEC dbo.get_jenis_hukum");
    // $getPerkaraPerdata = DB::select("Exec dbo.get_perkara_perdata");
    // $getPerkaraPidana = DB::select("Exec dbo.get_perkara_pidana");
     // get history pn
    $search="";
    $jenisPengurusan = $request['cari_jenis_pengurusan'];
    $cabang = $request['cari_cabang'];
    if($cabang != '') {
      $search .= "@cari_cabang='$cabang',";
    }

    $unit = $request['cari_unit'];
    if($unit != '') {
      $search .= "@cari_unit='$unit',";
    }

    $jenis_hukum = $request['cari_jenis_hukum'];
    if($jenis_hukum != '') {
      $search .= "@cari_jenis_hukum='$jenis_hukum',";
    }

    $perkara = $request['cari_perkara'];
    if($perkara != '') {
      $search .= "@cari_tindak_perkara='$perkara',";
    }

    $pelapor = $request['cari_pelapor'];
    if($pelapor != '') {
      $search .= "@cari_pelapor='$pelapor',";
    }

    $terlapor = $request['cari_terlapor'];
    if($terlapor != '') {
    $search .= "@cari_terlapor='$terlapor',";
    }

    $search = substr($search, 0, -1);
    $getDaftarPP = DB::select("EXEC dbo.get_laporan_for_print $search");


    $dataLaporan = ['getCabang' => $getCabang, 'getJenisHukum' => $getJenisHukum, 'getDaftarPP' => $getDaftarPP];

    return view('laporanpp', $dataLaporan);
  }
	
	
// -----------------------------Others--------------------------------------------------------------	
	public function list_unit(Request $request)
	{	
	$cabang=$request->cabang;
	 $getUnit = DB::select("EXEC dbo.get_unit @cabang='$cabang'");
		$html ="<option value=''></option>";
		
	foreach($getUnit as $getData){

           	$html .= "
                      <option value='".$getData->kode."'>".$getData->nama." </option>
                      ";
        }
		
		
		$data_unit["content"] = $html;
		echo json_encode($data_unit);
	}
	
	
	
	public function list_status_perkara(Request $request)
	{	
	$jenis_hukum=$request->jenis_hukum;
	 $getParameter = DB::select("EXEC dbo.get_parameter @jenis_hukum='$jenis_hukum'");
		$html ="<option value=''> --Pilih Status Perkara-- </option>";
		
	foreach($getParameter as $getData){
           	$html .= "<option value='".$getData->kode."'>".$getData->nama." </option>";
        }
		
		
		$data_parameter["content"] = $html;
		echo json_encode($data_parameter);
	}


  // -----------------------------Tambah PN--------------------------------------------------------------
  public function TambahPN() {
    $getCabang = DB::select("EXEC dbo.get_cabang");
    $getJenisPengurusan = DB::select("EXEC dbo.get_jenis_pengurusan");
    $getUserPIC = DB::select("Exec dbo.get_user_pic");
    $dataPN = ['getCabang' => $getCabang, 'getJenisPengurusan' => $getJenisPengurusan, 'getUserPIC' => $getUserPIC];
    return view('tambahpn', $dataPN);
  }

  public function ProsesTambahPN(Request $request) {
    $cabang = $request['pn_cabang'];
    $unit = $request['pn_unit'];
    $namaDebitur = $request['pn_nama_debitur'];
    $namaNotaris = $request['pn_nama_notaris'];
    $userPIC = $request['pn_pic'];
    $jenisPengurusan = $request['pn_jenis_pengurusan'];
    $jenisPengurusanLainnya = $request['pn_jenis_pengurusan_lainnya'];
    $created_by = Session::get('SIPP_Username');

    DB::statement("EXEC dbo.insert_lap_notaris_header @lap_notaris_header_cabang='$cabang', @lap_notaris_header_unit='$unit', @lap_notaris_header_debitur='$namaDebitur', @lap_notaris_header_notaris='$namaNotaris', @jenis_pengurusan_lainnya='$jenisPengurusanLainnya', @lap_notaris_header_pic='$userPIC', @m_jenis_pengurusan_id='$jenisPengurusan', @created_by='$created_by' ");

    $message = "Info: Data berhasil disimpan!";

    return redirect('TambahPN')->with('message', $message);
  }

  // -----------------------------Edit PN--------------------------------------------------------------

  public function ProsesEditPN(Request $request) {
    $headerId = $request['pn_header_id_edit'];
    $cabang = $request['pn_cabang_edit'];
    $unit = $request['pn_unit_edit'];
    $namaDebitur = $request['pn_nama_debitur_edit'];
    $namaNotaris = $request['pn_nama_notaris_edit'];
    $userPIC = $request['pn_pic_edit'];
    $jenisPengurusan = $request['pn_jenis_pengurusan_edit'];
    $jenisPengurusanLainnya = $request['pn_jenis_pengurusan_lainnya_edit'];
    $user = Session::get('SIPP_Username');

    DB::statement("EXEC dbo.update_pn @lap_notaris_header_id='$headerId', @lap_notaris_header_cabang='$cabang', @lap_notaris_header_unit='$unit', @lap_notaris_header_debitur='$namaDebitur', @lap_notaris_header_notaris='$namaNotaris', @lap_notaris_header_pic='$userPIC', @m_jenis_pengurusan_id='$jenisPengurusan', @jenis_pengurusan_lainnya='$jenisPengurusanLainnya', @updated_by='$user' ");

    $message = "Info: Data berhasil diubah!";
  
    return redirect('DaftarPN')->with('message', $message);
  
  }
  // -----------------------------DaftarPN--------------------------------------------------------------

  public function DaftarPN(Request $request) {
    $getCabang = DB::select("EXEC dbo.get_cabang");
    $getJenisPengurusan = DB::select("EXEC dbo.get_jenis_pengurusan");
    $getStatusJaminan = DB::select("EXEC dbo.get_status_jaminan");
    $getKendala = DB::select("EXEC dbo.get_kendala");
    $getUserPIC = DB::select("Exec dbo.get_user_pic");

    // get daftar pn
    // $search="";
    // $jenisPengurusan = $request['cari_jenis_pengurusan'];
    // if($jenisPengurusan != '') {
    //   $search .= "@m_jenis_pengurusan_id='$jenisPengurusan',";
    // }

    // $cabang = $request['cari_cabang'];
    // if($cabang != '') {
    //   $search .= "@lap_notaris_header_cabang='$cabang',";
    // }

    // $unit = $request['cari_unit'];
    // if($unit != '') {
    //   $search .= "@lap_notaris_header_unit='@unit',";
    // }

    // $namaDebitur = $request['cari_debitur'];
    // if($namaDebitur != '') {
    //   $search .= "@lap_notaris_header_debitur='$namaDebitur',";
    // }

    // $namaNotaris = $request['cari_notaris'];
    // if($namaNotaris != '') {
    //   $search .= "@lap_notaris_header_notaris='$namaNotaris',";
    // }

    // $search = substr($search, 0, -1);

    $getDaftarPN = DB::select("EXEC dbo.get_laporan_notaris");
    $header_id = $request['header_id'];
    $getDaftarPNDetail = DB::select("EXEC dbo.get_laporan_notaris_detail_by_header @header_id='$header_id' ");
    $dataPN = ['getCabang' => $getCabang, 'getStatusJaminan' => $getStatusJaminan, 'getKendala' => $getKendala, 'getDaftarPN' => $getDaftarPN, 'getJenisPengurusan' => $getJenisPengurusan, 'getDaftarPNDetail' => $getDaftarPNDetail, 'getUserPIC' => $getUserPIC];

    return view('daftarpn', $dataPN);
  }

  public function CatatanJaminanBerjalan(Request $request) {
      $header_id = $request['header_id'];
      $getLaporanNotaris = DB::select("EXEC dbo.get_laporan_notaris_detail_by_header @header_id='$header_id'");

      $html ="";
      foreach($getLaporanNotaris as $getData) {
        $html .= "<tr class='row-trace-pn'>";
        $html .= "<td>".date("d M Y", strtotime($getData->lap_notaris_detail_tanggal))."</td>";
        $html .= "<td style='text-transform:uppercase'>".$getData->nama_status_jaminan."</td>";
        $html .= "<td style='text-transform:uppercase'>".$getData->nama_kendala."</td>";
        $html .= "<td style='text-transform:uppercase'>".$getData->keterangan."</td>";
        $html .= "<td style='text-transform:uppercase' class='text-center td-aksi-sp col_aksi_jaminanberjalan'>";
        $html .= "<a class='btn-custom btn btn-info' type='submit' data-toggle='modal' data-target='#modal_editstatusnotaris' data-backdrop='static' onclick='modal_editstatusnotaris(".$getData->lap_notaris_detail_id.")' title='Ubah'><i class='i-custom fa fa-pencil-square-o' aria-hidden='true'></i></a>";
        $html .= "<a class='btn-custom btn btn-danger' type='submit' data-toggle='modal' data-target='#modal_deletestatusnotaris' onclick='modal_deletestatusnotaris(".$getData->lap_notaris_detail_id.")' title='Hapus'><i class='i-custom fa fa-trash-o' aria-hidden='true'></i></a>";
        $html .= "</td>";
        $html .= "</tr>";
      }
      $data["content"] = $html;
      echo json_encode($data);

    }

  // -----------------------------Post Proses--------------------------------------------------------------
  public function PostProsesPN(Request $request) 
  {
    $header_id = $request['header_id'];
    $statusJaminan = $request['pn_status'];
    $tanggalStatus = $request['tanggal_status'];
    $kendala = $request['pn_kendala'];
    $keterangan = htmlentities($request['pn_keterangan'],ENT_QUOTES);
    $created_by = Session::get('SIPP_Username');

    DB::statement("EXEC dbo.insert_lap_notaris_detail @lap_notaris_header_id='$header_id', @lap_notaris_status_jaminan='$statusJaminan', @lap_notaris_detail_tanggal='$tanggalStatus', @lap_notaris_kendala='$kendala', @lap_notaris_detail_keterangan='$keterangan', @created_by='$created_by' ");

    $message = "Info: Data berhasil ditambah!";
  
    return redirect('DaftarPN')->with('message', $message);
  }

  // -----------------------------Edit Proses--------------------------------------------------------------
  public function GetDetailNotaris(Request $request)
  {
    $detail_id = $request['lap_notaris_detail_id'];
    $getLaporanNotaris = DB::select("EXEC dbo.get_laporan_notaris_detail_by_detail_id @detail_id='$detail_id'");

    $data["content"] = $getLaporanNotaris;
    echo json_encode($data);
  }

  public function EditProsesPN(Request $request)
  {
    $detail_id = $request['detail_id_edit'];
    $statusJaminan = $request['pn_status_edit'];
    $tanggalStatus = $request['tanggal_status_edit'];
    $kendala = $request['pn_kendala_edit'];
    $keterangan = htmlentities($request['pn_keterangan_edit'],ENT_QUOTES);
    $user = Session::get('SIPP_Username');

    DB::statement("EXEC dbo.update_lap_notaris_detail @lap_notaris_detail_id='$detail_id', @m_status_jaminan_id='$statusJaminan', @lap_notaris_detail_tanggal='$tanggalStatus', @m_kendala_id='$kendala', @lap_notaris_detail_keterangan='$keterangan', @updated_by='$user' ");

    $message = "Info: Data berhasil diubah!";
  
    return redirect('DaftarPN')->with('message', $message);
  }

  // -----------------------------Delete Proses--------------------------------------------------------------
  public function DeleteProsesPN(Request $request)
  {
    $detail_id = $request['detail_id_delete'];
    $user = Session::get('SIPP_Username');

    DB::statement("EXEC dbo.delete_lap_notaris_detail @lap_notaris_detail_id='$detail_id', @updated_by='$user' ");

    $message = "Info: Data berhasil dihapus!";
  
    return redirect('DaftarPN')->with('message', $message);
  }

  // -----------------------------SubmitCatatanNotaris--------------------------------------------------------------

  public function SubmitCatatanNotaris(Request $request) {
    $header_id = $request['header_id_catatan_jaminan'];
    $user = Session::get('SIPP_Username');

    DB::statement("EXEC dbo.update_lap_notaris_header @header_id='$header_id', @updated_by='$user' ");

    $messageSubmitScs = "Info: Data berhasil disubmit!";

    return redirect('DaftarPN')->with('messageSubmitScs', $messageSubmitScs);
  }

  // -----------------------------HistoryPN--------------------------------------------------------------

  public function HistoryPN(Request $request) {
    $getCabang = DB::select("EXEC dbo.get_cabang");
    $getJenisPengurusan = DB::select("EXEC dbo.get_jenis_pengurusan");
    // get history pn
    $search="";
    $jenisPengurusan = $request['cari_jenis_pengurusan'];
    if($jenisPengurusan != '') {
      $search .= "@m_jenis_pengurusan_id='$jenisPengurusan',";
    }

    $cabang = $request['cari_cabang'];
    if($cabang != '') {
      $search .= "@lap_notaris_header_cabang='$cabang',";
    }

    $unit = $request['cari_unit'];
    if($unit != '') {
      $search .= "@lap_notaris_header_unit='$unit',";
    }

    $namaDebitur = $request['cari_debitur'];
    if($namaDebitur != '') {
      $search .= "@lap_notaris_header_debitur='$namaDebitur',";
    }

    $namaNotaris = $request['cari_notaris'];
    if($namaNotaris != '') {
      $search .= "@lap_notaris_header_notaris='$namaNotaris',";
    }
    $search = substr($search, 0, -1);
    $history = DB::select("EXEC dbo.get_laporan_notaris_submited $search");
    $dataHistory = ['getCabang' => $getCabang, 'getJenisPengurusan' => $getJenisPengurusan, 'history' => $history];

    return view('historypn', $dataHistory);
  }

  // -----------------------------LaporanPN--------------------------------------------------------------

   public function LaporanPN(Request $request) {
    $getCabang = DB::select("EXEC dbo.get_cabang");
    $getStatusJaminan = DB::select("EXEC dbo.get_status_jaminan");
    $getKendala = DB::select("EXEC dbo.get_kendala");
    // $getJenisPengurusan = DB::select("EXEC dbo.get_jenis_pengurusan");
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
    $getLaporanPN = DB::select("EXEC dbo.get_laporan_notaris_for_print $search");
    $dataLaporanPN = ['getCabang' => $getCabang, 'getStatusJaminan' => $getStatusJaminan, 'getKendala' => $getKendala, 'getLaporanPN' => $getLaporanPN];

    return view('laporanpn', $dataLaporanPN);
  }

}
