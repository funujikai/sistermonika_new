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

class SIPPProcessController extends Controller
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
	
	
	public function ProsesTambahPP(Request $request)
    {
        // var_dump($request->all());die;
        $unit_bisnis = $request['pp_unit_bisnis'];
        $tanggal_perkara = date('Y-m-d',strtotime($request['pp_tanggal_perkara']));
        $wilayah = (Session::has('SIPP_kode_wilayah'))?Session::get('SIPP_kode_wilayah'):$request['pp_wilayah'];
        $cabang = $request['pp_cabang'];
        $area = $request['pp_area'];
        $unit = $request['pp_unit'];
        $jenis_hukum = $request['pp_jenis_hukum'];
        $pengadilan = $request['pp_pengadilan'];
        $nomor_perkara = $request['pp_nomor_perkara'];
        $jenis_perdata = $request['pp_jenis_perdata'];
        $dasar_perdata = $request['pp_dasar_perdata'];
        $klasifikasi_perkara = $request['pp_klasifikasi_perkara']; 
        $delik_pidana = $request['pp_delik_pidana']; 
        $pidana_lainnya = $request['pp_pidana_lainnya'];
        $petitum = $request['pp_petitum'];
        $kedudukan_perseroan = $request['pp_kedudukan_perseroan']; 
        $pelapor = $request['pp_pelapor'];
        $terlapor = $request['pp_terlapor'];
        $turut_terlapor = '';
        if(isset($request['pp_turut_tergugat']))$turut_terlapor=$request['pp_turut_tergugat'];
        $tempus = date('Y-m-d',strtotime($request['pp_tempus']));
        $pic = $request['pp_pic'];
        $outstanding=$materil=$immateril=$dwangsom=0.0; //penambahan $outstanding FZL
		if($request['pp_outstanding']!=''){ //penambahan $outstanding FZL
          $outstanding = str_replace(".", "", str_replace(',00','',$request['pp_outstanding']));
        }
        if($request['pp_materil']!=''){
          $materil = str_replace(".", "", str_replace(',00','',$request['pp_materil']));
        }
        if($request['pp_immateril']!=''){
          $immateril = str_replace(".", "", str_replace(',00','',$request['pp_immateril']));
        }
        if($request['pp_dwangsom']!=''){
          $dwangsom = str_replace(".", "", str_replace(',00','',$request['pp_dwangsom']));
        }
        $document = '';
		$nama_file = base64_encode(date('Ymd').'-'.date('His'));
        if($request->hasFile('pp_dokumen')) {

					$file_p = $request->file('pp_dokumen');
					$destination_p = 'upload/';
					$extension = $file_p->getClientOriginalExtension();
					$file_name_p =  $nama_file.'_'.str_replace('/','-',$nomor_perkara) . '.' . $extension;
					$file_p->move($destination_p, $file_name_p );
					$document = $file_name_p;
				}
        $created_by = Session::get('SIPP_Username');
        $header_id = DB::select("EXEC 
          dbo.insert_laporan_header 
            @unit_bisnis='$unit_bisnis'
            , @tanggal_perkara='$tanggal_perkara'
            , @wilayah='$wilayah'
            , @cabang='$cabang'
            , @area='$area'
            , @unit='$unit'
            , @jenis_hukum='$jenis_hukum'
            , @pengadilan='$pengadilan'
            , @nomor_pengadilan='$nomor_perkara'
            , @jenis_perdata='$jenis_perdata'
            , @dasar_perdata='$dasar_perdata'
            , @klasifikasi_perkara='$klasifikasi_perkara'
            , @pidana_lainnya='$pidana_lainnya'
            , @petitum='$petitum'
            , @kedudukan_perseroan='$kedudukan_perseroan'
            , @pelapor='$pelapor'
            , @terlapor='".$terlapor."'
            , @turut_terlapor='".$turut_terlapor."'
            , @tempus='".$tempus."'
            , @pic='$pic'
			, @outstanding='$outstanding'
            , @materil='$materil'
            , @immateril='$immateril'
            , @dwangsom='$dwangsom'
            , @document='$document'
            , @created_by='$created_by'");
        if($delik_pidana!=NULL){
          foreach($delik_pidana as $value) {
            DB::statement("EXEC dbo.insert_laporan_header_perkara_pidana @pp_perkara_pidana_id='".$value."', @pp_header_id='".$header_id[0]->header_id."', @created_by='".$created_by."'");
          }
        }
        $message = "Info: Data berhasil disimpan!";

        return redirect('TambahPP')->with('message', $message);
    }
	
  public function ProsesEditPP(Request $request)
    {
      // var_dump($request->all());die;
      $header_id = $request['pp_header_id'];
      $unit_bisnis = $request['pp_unit_bisnis'];
      $tanggal_perkara = date('Y-m-d',strtotime($request['pp_tanggal_perkara']));
      $wilayah = $request['pp_wilayah'];
      $cabang = $request['pp_cabang'];
      $area = $request['pp_area'];
      $unit = $request['pp_unit'];
      $jenis_hukum = $request['pp_jenis_hukum'];
      $pengadilan = $request['pp_pengadilan'];
      $nomor_perkara = $request['pp_nomor_perkara'];
      $jenis_perdata = $request['pp_jenis_perdata'];
      $dasar_perdata = $request['pp_dasar_perdata'];
      $klasifikasi_perkara = $request['pp_klasifikasi_perkara']; 
      $delik_pidana = $request['pp_delik_pidana']; 
      $pidana_lainnya = $request['pp_pidana_lainnya'];
      $petitum = $request['pp_petitum'];
      $kedudukan_perseroan = $request['pp_kedudukan_perseroan']; 
      $pelapor = implode(',',$request['pp_pelapor']);
      $terlapor = $request['pp_terlapor'];
      $turut_terlapor = '';
      if(isset($request['pp_turut_tergugat']))$turut_terlapor=$request['pp_turut_tergugat'];
      $tempus = date('Y-m-d',strtotime($request['pp_tempus']));
      $pic = $request['pp_pic'];
      $materil=$immateril=$dwangsom=0.0;
      if($request['pp_materil']!=''){
        $materil = str_replace(".", "", str_replace(',00','',$request['pp_materil']));
      }
      if($request['pp_immateril']!=''){
        $immateril = str_replace(".", "", str_replace(',00','',$request['pp_immateril']));
      }
      if($request['pp_dwangsom']!=''){
        $dwangsom = str_replace(".", "", str_replace(',00','',$request['pp_dwangsom']));
      }
      $document = '';
      if($request->hasFile('pp_dokumen')) {
        $file_p = $request->file('pp_dokumen');
        $destination_p = 'upload/';
        $extension = $file_p->getClientOriginalExtension();
        $file_name_p =  $tanggal_perkara.'_'.str_replace('/','-',$nomor_perkara) . '.' . $extension;
        $file_p->move($destination_p, $file_name_p );
        $document = $file_name_p;
      }else{
        $getdata = DB::table('laporan_header')->where('laporan_header_id','=',$header_id)->get()[0];
        $document=$getdata->dokumen;
      }
      $created_by = Session::get('SIPP_Username');
      DB::statement("EXEC 
        dbo.update_perkara
          @header_id = '$header_id'  
          ,@unit_bisnis='$unit_bisnis'
          , @tanggal_perkara='$tanggal_perkara'
          , @wilayah='$wilayah'
          , @cabang='$cabang'
          , @area='$area'
          , @unit='$unit'
          , @jenis_hukum='$jenis_hukum'
          , @pengadilan='$pengadilan'
          , @nomor_pengadilan='$nomor_perkara'
          , @jenis_perdata='$jenis_perdata'
          , @dasar_perdata='$dasar_perdata'
          , @klasifikasi_perkara='$klasifikasi_perkara'
          , @pidana_lainnya='$pidana_lainnya'
          , @petitum='$petitum'
          , @kedudukan_perseroan='$kedudukan_perseroan'
          , @pelapor='$pelapor'
          , @terlapor='".$terlapor."'
          , @turut_terlapor='".$turut_terlapor."'
          , @tempus='".$tempus."'
          , @pic='$pic'
          , @materil='$materil'
          , @immateril='$immateril'
          , @dwangsom='$dwangsom'
          , @document='$document'
          , @created_by='$created_by'");
      if($delik_pidana!=NULL){
        foreach($delik_pidana as $value) {
          DB::statement("EXEC dbo.insert_laporan_header_perkara_pidana @pp_perkara_pidana_id='$value', @pp_header_id='".$header_id."', @created_by='$created_by'");
        }
      }
      $messageAddedScs = "Info: Data berhasil diubah!"; 
      return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
    }

	public function ProsesTambahStatusPerkara(Request $request)
    {
        // var_dump($request->all());die;
        $tanggal_pelaksanaan = date('Y-m-d H:i:s',strtotime($request['tanggal_pelaksanaan']));
		$nama_file = base64_encode(date('Ymd').'-'.date('His'));
		
		// var_dump($nama_file);die();
		

        $keterangan = $request['keterangan'];
        $instansi = $request['instansi'];
        $lembaga_hukum = $request['lembaga_hukum'];
        $proses_hukum = $request['proses_hukum']; 
        $rangkaian_proses = $request['rangkaian_proses'];
        $keterangan_proses = $request['keterangan_proses'];
        $status_putusan = $request['status_putusan'];
        $amar_putusan = $request['amar_putusan']; 
        $upaya_hukum_selanjutnya = $request['upaya_hukum_selanjutnya']; 
        $instansi_selanjutnya = $request['instansi_selanjutnya']; 
        $proses_hukum_selanjutnya = $request['proses_hukum_selanjutnya']; 
        $rangkaian_proses_selanjutnya = $request['rangkaian_proses_selanjutnya']; 
        $tanggal_pelaksanaan_selanjutnya = date('Y-m-d',strtotime($request['tanggal_pelaksanaan_selanjutnya']));
		    $header_id = $request['header_id'];
        $type_input = $request['type_input'];
        $detail_id = $request['detail_id'];

        $document = '';
        if($request->hasFile('dokumen')) {
          $proses = DB::table('m_parameter')->where('m_parameter_id',$rangkaian_proses)->get()[0];
					$file_p = $request->file('dokumen');
          $destination_p = 'upload/';
					$extension = $file_p->getClientOriginalExtension();
					$file_name_p =  $nama_file.'_'. $proses->m_parameter_name . '.' . $extension;
					$file_p->move($destination_p, $file_name_p );
					$document = $file_name_p;
				}elseif($detail_id!=''){
          $getdata = DB::table('laporan_detail')->where('laporan_header_id','=',$header_id)->get();
          if(count($getdata)>0){
            $document=$getdata[0]->dokumen;  
          }
        }
        $user = Session::get('SIPP_Username');
        DB::statement("EXEC dbo.".$type_input."_laporan_detail 
          @detail_id = '$detail_id',
          @tanggal_pelaksanaan='$tanggal_pelaksanaan', 
          @keterangan='$keterangan', 
          @instansi='$instansi', 
          @lembaga_hukum='$lembaga_hukum', 
          @proses_hukum='$proses_hukum', 
          @rangkaian_proses=$rangkaian_proses, 
          @keterangan_proses='$keterangan_proses', 
          @status_putusan='$status_putusan',
          @amar_putusan='$amar_putusan',
          @instansi_selanjutnya='$instansi_selanjutnya',
          @upaya_hukum_selanjutnya='$upaya_hukum_selanjutnya',
          @proses_hukum_selanjutnya='$proses_hukum_selanjutnya',
          @rangkaian_proses_selanjutnya='$rangkaian_proses_selanjutnya',
          @tanggal_pelaksanaan_selanjutnya='$tanggal_pelaksanaan_selanjutnya',
          @dokumen='$document',
          @header_id='$header_id',
          @created_by='$user'"
        );
        $messageAddedScs = "Info: Data berhasil ditambah!"; 

        return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
    }

	public function ProsesTambahUpayaHukum(Request $request)
  {
      unset($request['_token']);
      $type_input = $request['type_input'];
      $rangkaian_proses = $request['rangkaian_proses_upayahukum'];
      $user = Session::get('SIPP_Username');
      $query = "EXEC dbo.".$type_input."_laporan_detail_bkpl ";
      $tanggal_pelaksanaan = date('Y-m-d',strtotime($request['tanggal_pelaksanaan']));
      $document = '';
      if($request->hasFile('dokumen')) {
        $proses = DB::table('m_parameter')->where('m_parameter_id',$rangkaian_proses)->get()[0];
        $file_p = $request->file('dokumen');
        $destination_p = 'upload/';
        $extension = $file_p->getClientOriginalExtension();
        $file_name_p =  $tanggal_pelaksanaan.'_'. $proses->m_parameter_name . '.' . $extension;
        $file_p->move($destination_p, $file_name_p );
        $document = $file_name_p;
      }
      foreach($request->all() as $key=>$value){
        if(strpos($key, 'tanggal') !== false)$value=date('Y-m-d',strtotime($value));
        if($key=='dokumen')$value=$document;
        $query.=" @$key='$value',";
      }
      $query .= " @created_by='$user'";
      DB::statement($query);
      $messageAddedScs = "Info: Data berhasil ditambah!"; 

      return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
  }

	public function ProsesEditStatusPerkara(Request $request)
	{
		$status_perkara = $request['status_perkara_edit'];
		$tanggal_perkara = date('Y-m-d H:i:00',strtotime($request['tanggal_perkara_edit']));
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

    // var_dump($request->all());die;
		DB::statement("EXEC dbo.update_laporan_detail @laporan_detail_id='$detail_id', @m_parameter_id='$status_perkara', @laporan_detail_tanggal='$tanggal_perkara', @laporan_detail_kronologis='$kronologis', @laporan_nomor_lp='$nomorLP', @laporan_detail_kendala='$kendala', @m_status_akhir='$status', @komentar='$komentar',@updated_by='$user'");

		$messageAddedScs = "Info: Data berhasil diubah!"; 

		return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
	}
	  
	public function ProsesDeleteStatusPerkara(Request $request)
	{
		$laporan_detail_id = $request['detail_id_delete'];
		$user = Session::get('SIPP_Username');

		DB::statement("EXEC dbo.delete_laporan_detail @laporan_detail_id='$laporan_detail_id',@updated_by='$user' ");

		$messageAddedScs = "Info: Data berhasil dihapus!"; 
		return redirect('DaftarPP')->with('messageAddedScs', $messageAddedScs);
    }
	
	public function SelesaiPerkara(Request $request) {
		$header_id = $request['header_id_selesaiperkara'];
		$user = Session::get('SIPP_Username');


		DB::statement("EXEC dbo.update_laporan_header_is_closed @header_id='$header_id', @updated_by='$user' ");

		$messageSubmitScs = "Info: Data berhasil disubmit!";

		return redirect('DaftarPP')->with('messageSubmitScs', $messageSubmitScs);
	}
	
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
  
  public function deleteperkara(Request $request){
    $header_id = $request['header_id'];
    $user=Session::get('SIPP_Username');
		DB::statement("EXEC dbo.delete_laporan_header @header_id='$header_id', @updated_by='$user' ");
		$messageSubmitScs = "Info: Data berhasil dihapus!";
    return redirect('DaftarPP')->with('messageSubmitScs', $messageSubmitScs);  
  }
  
  public function deleteperkarahistory(Request $request){
    $header_id = $request['header_id'];
    $user=Session::get('SIPP_Username');
		DB::statement("EXEC dbo.delete_laporan_header @header_id='$header_id', @updated_by='$user' ");
		$messageSubmitScs = "Info: Data berhasil dihapus!";
    return redirect('HistoryPP')->with('messageSubmitScs', $messageSubmitScs);  
  }  
  # ========================================== NOTARIS =========================================== #
	public function ProsesTambahPN(Request $request) {
    $tanggal_order = $request['pn_tanggal_order'];
    $wilayah = (Session::has('SIPP_kode_wilayah'))?Session::get('SIPP_kode_wilayah'):$request['pn_wilayah'];
    $cabang = (Session::has('SIPP_kode_cabang'))?Session::get('SIPP_kode_cabang'):$request['pn_cabang'];
    $unit = (Session::has('SIPP_kode_unit'))?Session::get('SIPP_kode_unit'):$request['pn_unit'];
		$namaDebitur = $request['pn_nama_debitur'];
		$namaNotaris = $request['pn_nama_notaris'];
		$plafond = str_replace(',00','',str_replace('.','',$request['pn_plafond']));
		$no_agunan = $request['pn_no_agunan'];
		$covernote = $request['pn_covernote'];
		$masa_berlaku = $request['pn_masa_berlaku'];
		$legal_wilayah = $request['pn_legal_wilayah'];
		$pencairan = $request['pn_pencairan'];
    $tanggal_pencairan = $request['pn_tanggal_pencairan'];
		$agunan = $request['pn_agunan'];
		$jenis_agunan = $request['pn_jenis_agunan'];
		$tanggal_agunan = $request['pn_tanggal_agunan'];
		$pengikatan_lainnya = (isset($request['pengikatan_lainnya']))?$request['pengikatan_lainnya']:'0';
    $created_by = Session::get('SIPP_Username');
    $header_id = DB::select("
      EXEC 
        dbo.insert_lap_notaris_header 
          @lap_tanggal_order='$tanggal_order',
          @lap_notaris_header_wilayah='$wilayah',
          @lap_notaris_header_cabang='$cabang', 
          @lap_notaris_header_unit='$unit', 
          @lap_notaris_header_debitur='$namaDebitur', 
          @lap_notaris_header_notaris='$namaNotaris', 
          @plafond='$plafond', 
          @jenis_agunan='$jenis_agunan',   
          @covernote='$covernote', 
          @masa_berlaku='$masa_berlaku', 
          @legal_wilayah='$legal_wilayah', 
          @pencairan='$pencairan', 
          @tanggal_pencairan='$tanggal_pencairan', 
          @agunan='$agunan', 
          @tanggal_agunan='$tanggal_agunan', 
          @pengikatan_lainnya='$pengikatan_lainnya',
          @created_by='$created_by' 
    ");
    if(count($agunan)>0){
      foreach($agunan as $value) {
          DB::statement("EXEC dbo.insert_lap_notaris_jenis_agunan @jenis_agunan='$value',@header_id='".$header_id[0]->header_id."', @created_by='$created_by'");
      }
    }
		$message = "Info: Data berhasil disimpan!";

		return redirect('TambahPN')->with('message', $message);
  }
  public function deletePN(Request $request){
    $header_id = $request->header_id;
    DB::statement("exec deletePN '$header_id'");
		$message = "Info: Data berhasil dihapus!";

		return redirect('DaftarPN')->with('message', $message);
  }
	public function ProsesEditPN(Request $request) {
		$headerId = $request['pn_header_id_edit'];
		$tanggal_order = $request['pn_tanggal_order'];
		$wilayah = (Session::has('SIPP_kode_wilayah'))?Session::get('SIPP_kode_wilayah'):$request['pn_wilayah_edit'];
        $cabang = (Session::has('SIPP_kode_cabang'))?Session::get('SIPP_kode_cabang'):$request['pn_cabang_edit'];
        $unit = (Session::has('SIPP_kode_unit'))?Session::get('SIPP_kode_unit'):$request['pn_unit_edit'];
		$iddebitur = $request['pn_id_debitur_edit'];
		$namaDebitur = $request['pn_nama_debitur_edit'];
    $namaNotaris = $request['pn_nama_notaris_edit'];
		$plafond = str_replace(',00','',str_replace('.','',$request['pn_plafond']));
		$no_rekening = $request['pn_no_rekening_edit'];
		$no_agunan = $request['pn_no_agunan'];
		$covernote = $request['pn_covernote'];
		$masa_berlaku = $request['pn_masa_berlaku'];
		$pencairan = $request['pn_pencairan'];
    $tanggal_pencairan = $request['pn_tanggal_pencairan'];
		$agunan = $request['pn_agunan'];
		$jenis_agunan = $request['pn_jenis_agunan'];
		$tanggal_agunan = $request['pn_tanggal_agunan'];
		$pengikatan_lainnya = (isset($request['pengikatan_lainnya']))?$request['pengikatan_lainnya']:'0';
		$jenisPengurusan = $request['pn_jenis_pengurusan_edit'];
		$jenisPengurusanLainnya = $request['pn_jenis_pengurusan_lainnya_edit'];
		$user = Session::get('SIPP_Username');
    if($headerId==''){
      $header_id = DB::select("
        EXEC 
          dbo.insert_lap_notaris_header 
            @lap_tanggal_order='$tanggal_order',
            @lap_notaris_header_wilayah='$wilayah',
            @lap_notaris_header_cabang='$cabang', 
            @lap_notaris_header_unit='$unit', 
            @id_debitur='$iddebitur', 
            @lap_notaris_header_debitur='$namaDebitur', 
            @lap_notaris_header_notaris='$namaNotaris', 
            @plafond='$plafond', 
            @no_agunan='$no_agunan',
            @no_rekening='$no_rekening',
            @jenis_agunan='$jenis_agunan',   
            @covernote='$covernote', 
            @masa_berlaku='$masa_berlaku', 
            @pencairan='$pencairan', 
            @tanggal_pencairan='$tanggal_pencairan', 
            @tanggal_agunan='$tanggal_agunan', 
            @pengikatan_lainnya='$pengikatan_lainnya',
            @created_by='$user' 
      ");
      $headerId = $header_id[0]->header_id;
      DB::statement("
        exec
          dbo.insert_lap_notaris_detail
          @lap_notaris_header_id = $headerId
          ,@tipe_pengikatan=1
          ,@lap_notaris_status_jaminan='5'
          ,@lap_notaris_detail_tanggal='".$tanggal_order."'
          ,@lap_notaris_kendala=''
          ,@lap_notaris_detail_keterangan=''
          ,@rekomendasi=''
          ,@created_by='$user'
      ");
      DB::statement("
        exec
          dbo.insert_lap_notaris_detail
          @lap_notaris_header_id = $headerId
          ,@tipe_pengikatan=2
          ,@lap_notaris_status_jaminan='8'
          ,@lap_notaris_detail_tanggal='".$tanggal_order."'
          ,@lap_notaris_kendala=''
          ,@lap_notaris_detail_keterangan=''
          ,@rekomendasi=''
          ,@created_by='$user'
      ");
    }else{
      DB::statement("EXEC dbo.update_pn 
        @lap_notaris_header_id='$headerId', 
        @lap_tanggal_order='$tanggal_order',
        @lap_notaris_header_wilayah='$wilayah',
        @lap_notaris_header_cabang='$cabang', 
        @lap_notaris_header_unit='$unit', 
        @id_debitur='$iddebitur', 
        @lap_notaris_header_debitur='$namaDebitur', 
        @lap_notaris_header_notaris='$namaNotaris', 
        @plafond='$plafond', 
        @no_agunan='$no_agunan',
        @no_rekening='$no_rekening',
        @jenis_agunan='$jenis_agunan',   
        @covernote='$covernote', 
        @masa_berlaku='$masa_berlaku', 
        @pencairan='$pencairan', 
        @tanggal_pencairan='$tanggal_pencairan', 
        @tanggal_agunan='$tanggal_agunan', 
        @pengikatan_lainnya='$pengikatan_lainnya',
        @updated_by='$user' 
      ");
    }

    if (!empty($agunan)){
    // if(count($agunan)>0){
      foreach($agunan as $value) {
          DB::statement("EXEC dbo.insert_lap_notaris_jenis_agunan @jenis_agunan='$value',@header_id='$headerId', @created_by='$user'");
      }
    }    
		$message = "Info: Data berhasil diubah!";

		return redirect('DaftarPN')->with('message', $message);
	}
	public function PostProsesPN(Request $request) 
	{
		$header_id = $request['header_id'];
		$tipe_pengikatan = $request['tipe_pengikatan'];
		$statusJaminan = $request['pn_status'];
		$tanggalStatus = $request['tanggal_status'];
		$kendala = $request['pn_kendala'];
		$alasan_kendala = $request['pn_alasan_kendala'];
		$rekomendasi = $request['pn_rekomendasi'];
		$keterangan = htmlentities($request['pn_keterangan'],ENT_QUOTES);
		$created_by = Session::get('SIPP_Username');
		
		DB::statement("EXEC dbo.insert_lap_notaris_detail @lap_notaris_header_id='$header_id', @tipe_pengikatan='$tipe_pengikatan', @lap_notaris_status_jaminan='$statusJaminan', @lap_notaris_detail_tanggal='$tanggalStatus', @lap_notaris_kendala='$kendala', @lap_notaris_alasan_kendala='$alasan_kendala' ,@rekomendasi='$rekomendasi', @lap_notaris_detail_keterangan='$keterangan', @created_by='$created_by' ");
		
		$message = "Info: Data berhasil ditambah!";
		 
		return redirect('DaftarPN')->with('message', $message);
	}
	public function EditProsesPN(Request $request)
	{
		$detail_id = $request['detail_id_edit'];
		$statusJaminan = $request['pn_status_edit'];
		$tanggalStatus = $request['tanggal_status_edit'];
		$kendala = $request['pn_kendala_edit'];
		$rekomendasi = $request['pn_rekomendasi'];
		$keterangan = htmlentities($request['pn_keterangan_edit'],ENT_QUOTES);
		$user = Session::get('SIPP_Username');

		DB::statement("EXEC dbo.update_lap_notaris_detail @lap_notaris_detail_id='$detail_id' , @m_status_jaminan_id='$statusJaminan', @lap_notaris_detail_tanggal='$tanggalStatus', @m_kendala_id='$kendala', @rekomendasi='$rekomendasi', @lap_notaris_detail_keterangan='$keterangan', @updated_by='$user' ");

		$message = "Info: Data berhasil diubah!";

		return redirect('DaftarPN')->with('message', $message);
	}
	public function DeleteProsesPN(Request $request)
	{
		$detail_id = $request['detail_id_delete'];
		$user = Session::get('SIPP_Username');

		DB::statement("EXEC dbo.delete_lap_notaris_detail @lap_notaris_detail_id='$detail_id', @updated_by='$user' ");

		$message = "Info: Data berhasil dihapus!";

		return redirect('DaftarPN')->with('message', $message);
	}
	public function SubmitCatatanNotaris(Request $request) {
		$header_id = $request['header_id_catatan_jaminan'];
		$user = Session::get('SIPP_Username');
		DB::statement("EXEC dbo.update_lap_notaris_header @header_id='$header_id',@status='1', @updated_by='$user' ");

		$messageSubmitScs = "Info: Data berhasil disubmit!";

		return redirect('DaftarPN')->with('messageSubmitScs', $messageSubmitScs);
	}
	public function unSubmitCatatanNotaris(Request $request) {
		$header_id = $request['header_id_catatan_jaminan'];
		$user = Session::get('SIPP_Username');

		DB::statement("EXEC dbo.update_lap_notaris_header @header_id='$header_id',@status='0', @updated_by='$user' ");

		$messageSubmitScs = "Info: Data berhasil disubmit!";

		return redirect('DaftarPN')->with('messageSubmitScs', $messageSubmitScs);
	}
  public function perpanjanganCN(Request $request){
		$header_id = $request['header_id_cn'];
		$covernote = $request['pn_covernote'];
    $masa_berlaku = $request['pn_masa_berlaku'];
    $document = '';
    if($request->hasFile('dokumen')) {
      $file_p = $request->file('dokumen');
      $destination_p = 'upload/';
      $extension = $file_p->getClientOriginalExtension();
      $file_name_p =  $masa_berlaku.'_'. str_replace('/','-',$covernote) . '.' . $extension;
      $file_p->move($destination_p, $file_name_p );
      $document = $file_name_p;
    }
    $user = Session::get('SIPP_Username');
    // echo "EXEC dbo.PerpanjanganCN @header_id='$header_id', @covernote='$covernote', @masa_berlaku='$masa_berlaku', @created_by='$user'";die;
    DB::statement("EXEC dbo.PerpanjanganCN @header_id='$header_id', @covernote='$covernote', @masa_berlaku='$masa_berlaku', @document='$document', @created_by='$user'");
		$messageSubmitScs = "Info: Data perpanjangan CN berhasil!";
		return redirect('DaftarPN')->with('messageSubmitScs', $messageSubmitScs);
  }
	public function deletedaftardebitur(Request $request){
		$nasabahid = $request['nasabahid'];
		$namanasabah = $request['nm_nasabah'];
		$no_rekening = $request['nomor_rekening'];
		$alasan = $request['alasan'];
		$user = Session::get('SIPP_Username');
		DB::statement("EXEC dbo.deletelistdebitur @nasabah_id='$nasabahid', @no_rekening='$no_rekening', @namanasabah='$namanasabah', @alasan='$alasan', @created_by='$user'");
		$messageSubmitScs = "Info: Debitur $namanasabah Berhasil Dihilangkan!";
		return redirect('DaftarPN')->with('messageSubmitScs', $messageSubmitScs);

	}
}
