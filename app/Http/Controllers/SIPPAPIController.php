<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use DB;
use App\Tiket;
use App\Helper;
use App\User;
use App\Status;
use Session;
use DateTime;

class SIPPAPIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => [
            'list_daftar_notaris','mapping_pidana','mapping_jenis_agunan','list_notaris'
        ]]);
    }
	public function GetPerkaraPidanaId(Request $request) 
	{
		$header_id = $request['header_id'];
		$getPerkaraPidanaId = DB::select("EXEC dbo.get_perkara_pidana_id @header_id='$header_id' ");
		$data["content"] = $getPerkaraPidanaId;
		echo json_encode($data);
	}
	public function list_tracelaporan(Request $request){
		// var_dump($request->all());die;
		$header_id = $request['header_id'];
		$accessuser = Helper::get_access(7)[0];
		$getTrack = DB::select("EXEC dbo.get_laporan_detail_by_header @header_id=$header_id");
		$data = array();
		// return $getTrack;die;
		foreach($getTrack as $key=>$value){
			$data[$key][]=$value->no_perkara;
			$data[$key][]=(($value->tempus!='1970-01-01')?date('d M Y',strtotime($value->tempus)):'');
			$data[$key][]=$value->pelapor;
			$data[$key][]=$value->terlapor;
			$data[$key][]=$value->nama_klasifikasi;
			$data[$key][]=$value->kedudukan_perseroan;
			$data[$key][]=str_replace('.0000','',$value->outstanding); //FZL
			$data[$key][]=str_replace('.0000','',$value->materil);
			$data[$key][]=str_replace('.0000','',$value->immateril);
			$data[$key][]=str_replace('.0000','',$value->dwangsom);
			$data[$key][]=$value->status;
			$data[$key][]=(($value->tanggal_status!='')?date('d M Y',strtotime($value->tanggal_status)):'');
			$data[$key][]=$value->keterangan;
			$html ='';
			if($value->dokumen!=''&&$accessuser->detail==1)
				$html.="<a href='upload/$value->dokumen' target='blank' download><button type='button' class='btn btn-default'><i class='fa fa-download' aria-hidden='true'></i></button></a>";
			if($value->is_closed==0){
				if($accessuser->update==1)
					$html.="<button type='button' data-toggle='modal' data-target='#modal_add".(($value->need_looping==1)?'upayahukum':'statusperkara')."' onclick='modal_edit".(($value->need_looping==1)?'upayahukum':'statusperkara')."(".$value->laporan_detail_id.",".$value->jenis_hukum_id.",".$value->m_jenis_perdata_id.")' class='btn btn-warning'><i class='fa fa-edit'></i></button>";
				if($accessuser->delete==1)
					$html.="<button type='button' data-toggle='modal' data-target='#modal_deletestatusperkara' data-backdrop='static' class='btn btn-danger' onclick='modal_deletestatuspekara(".$value->laporan_detail_id.")'><i class='fa fa-trash' aria-hidden='true'></i></button>";
			}
			$data[$key][]=$html;
		}
		$total = count($getTrack);
		$response['recordsTotal'] = $total;
		$response['recordsFiltered'] = $total;
		$response['data'] = $data;
		return $response;
	}
	public function TraceLaporan(Request $request)
    {
        $header_id = $request['header_id'];
		$accessuser = Helper::get_access(7)[0];
        
		$data["data"] = DB::select("EXEC dbo.get_laporan_header_by_id @header_id=$header_id")[0];
		$data["data"]->laporan_tanggal_perkara=(($data["data"]->laporan_tanggal_perkara!='')?date('d M Y',strtotime($data["data"]->laporan_tanggal_perkara)):'');
		$data["putusan"] = DB::table('laporan_detail as a')
		->join('m_status_putusan as c','c.id','=','a.m_status_akhir')
		->join('laporan_header as d','d.laporan_header_id','=','a.laporan_header_id')
		->join('m_parameter as b','b.m_parameter_id','=','a.m_parameter_id')
		->where('a.laporan_header_id','=',$header_id)
		->where('need_result','=','1')->get();
		foreach($data['putusan'] as $key=>$value){
			$data["putusan"][$key]->tanggal_pelaksanaan=(($data["putusan"][$key]->tanggal_pelaksanaan!='')?date('d M Y',strtotime($data["putusan"][$key]->tanggal_pelaksanaan)):'');
		}
        echo json_encode($data);
    }
	
	public function GetKronologisPerkara(Request $request)
	{
		$laporan_id = $request['laporan_id'];

		$getTrack = DB::select("EXEC dbo.get_laporan_detail_by_laporan_id @laporan_id=$laporan_id");

		$data["content"] = $getTrack;
		echo json_encode($data);
	}
	public function list_status_putusan(Request $request)
	{
		$laporan_id = $request['jenis_hukum'];

		$getTrack = DB::select("EXEC dbo.get_status_putusan @jenis_hukum=$laporan_id");
		$html ="<option value=''>-- Pilih Status Putusan --</option>";
		foreach($getTrack as $value){
           	$html .= "
                <option value='".$value->kode."'>".$value->nama." </option>
            ";
        }
		$data["content"] = $html;
		echo json_encode($data);
	}
	public function list_daftar_notaris(Request $request)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header("Access-Control-Allow-Headers: X-Requested-With");
		$cabang=$request->cabang;		
		$getnotaris = DB::select("EXEC dbo.get_notaris @cabang='$cabang'");
		$data['data'] = $getnotaris;
		return $data;
	}
	public function list_cabang(Request $request)
	{	
		$wilayah=$request->wilayah;
		$unit_bisnis=$request->unit_bisnis;
		$getUnit = DB::select("EXEC dbo.get_cabang @wilayah='$wilayah', @unit_bisnis='$unit_bisnis'");
		$html ="<option value=''>-- Pilih ".(($unit_bisnis==2)?'Region':'Cabang')." --</option>";
		foreach($getUnit as $value){
           	$html .= "
                <option value='".$value->kode."'>".$value->nama." </option>
            ";
        }
		$data_unit["content"] = $html;
		echo json_encode($data_unit);
	}
	public function list_area(Request $request)
	{	
		$area=$request->area;
		$unit_bisnis=$request->unit_bisnis;
		$getUnit = DB::select("EXEC dbo.get_area @area='$area'");
		$html ="<option value=''>-- Pilih Cabang --</option>";
		foreach($getUnit as $value){
           	$html .= "
                <option value='".$value->kode."'>".$value->nama." </option>
            ";
        }
		$data_unit["content"] = $html;
		echo json_encode($data_unit);
	}
	public function list_unit(Request $request)
	{	
		$cabang=$request->cabang;
		$unit_bisnis=$request->unit_bisnis;
		$getUnit = DB::select("EXEC dbo.get_unit @cabang='$cabang',@unit_bisnis='$unit_bisnis'");
		$html ="<option value=''>-- Pilih ".(($unit_bisnis==1)?'Unit':'Area')." --</option>";
		foreach($getUnit as $value){
			$html .= "
                <option value='".$value->kode."'>".$value->nama." </option>
            ";
        }
		$data_unit["content"] = $html;	
		$getnotaris = DB::select("EXEC dbo.get_notaris @cabang='$cabang'");
		$html ="<option value=''>-- Pilih Notaris --</option>";
		
		foreach($getnotaris as $value){
			$html .= "
                <option value='".$value->kode."'>".$value->nama." </option>
            ";
		}
		$data_unit['notaris'] = $html;
		echo json_encode($data_unit);
	}
	public function listdasargugatan(Request $request)
	{	
		$jenis_hukum=$request->jenis_hukum;
		$jenis_perdata=$request->jenis_perdata;
		// return "EXEC dbo.get_perkara_perdata @jenis_hukum='$jenis_hukum',@jenis_perdata='$jenis_perdata'";
	 	$getdata = DB::select("EXEC dbo.get_perkara_perdata @jenis_hukum='$jenis_hukum',@jenis_perdata='$jenis_perdata'");
		$html ="<option value=''>-- Pilih Dasar Gugatan Hukum --</option>";
		foreach($getdata as $value){
           	$html .= "
                <option value='".$value->kode."'>".$value->nama." </option>
            ";
        }
		$data_unit["content"] = $html;
		echo json_encode($data_unit);
	}
	public function get_status_pengikatan(Request $request)
	{	
	$tipe_pengikatan=$request->tipe_pengikatan;
	 $getdata = DB::select("EXEC dbo.get_status_jaminan @tipe_pengikatan='$tipe_pengikatan'");
		$html ="<option value=''>-- Pilih Status --</option>";
		foreach($getdata as $value){
           	$html .= "
                <option value='".$value->kode."'>".$value->nama." </option>
            ";
        }
		$data_unit["content"] = $html;
		echo json_encode($data_unit);
	}
	
	
	public function list_status_perkara(Request $request)
	{	
		$jenis_hukum=$request->jenis_hukum;
		$hukum_berjalan=$request->hukum_berjalan;
		$jenis_perdata=$request->jenis_perdata;
		$proses_hukum=$request->proses_hukum;
		$upaya_hukum=$request->upaya_hukum;
		$query = '';
		$getParameter = DB::select("EXEC dbo.get_parameter @jenis_hukum='$jenis_hukum', @hukum_berjalan='$hukum_berjalan',@jenis_perdata='$jenis_perdata',@proses_hukum='$proses_hukum',@upaya_hukum='$upaya_hukum'");
		$query = "EXEC dbo.get_parameter @jenis_hukum='$jenis_hukum', @hukum_berjalan='$hukum_berjalan',@jenis_perdata='$jenis_perdata',@proses_hukum='$proses_hukum',@upaya_hukum='$upaya_hukum'";

		$html ="<option value=''> --Pilih Proses Hukum-- </option>";
		foreach($getParameter as $value){
           	$html .= "<option value='".$value->kode."' data-need_result='".$value->need_result."' data-need_looping='".$value->need_looping."' data-status_proses='".$value->status_proses."' data-not_need_result='".$value->not_need_result."' data-need_agenda='".$value->need_agenda."'>".$value->nama." </option>";
        }
		$data_parameter["content"] = $html;
		// $data_parameter["query"] = $query;
		echo json_encode($data_parameter);
	}
	public function list_proses_hukum(Request $request)
	{	
		$hukum_berjalan=$request->hukum_berjalan;
		$query = '';
		$getParameter = DB::select("EXEC dbo.get_proses_hukum @hukum_berjalan='$hukum_berjalan'");
		$query = "EXEC dbo.get_proses_hukum @hukum_berjalan='$hukum_berjalan'";
		$html ="<option value='0'> --Pilih Proses Hukum-- </option>";
		foreach($getParameter as $value){
           	$html .= "<option value='".$value->kode."'>".$value->nama." </option>";
        }
		$data_parameter["content"] = $html;
		// $data_parameter["query"] = $query;
		echo json_encode($data_parameter);
	}
	public function list_upaya_hukum(Request $request)
	{	
		$jenis_hukum=$request->jenis_hukum;
		$jenis_perdata=$request->jenis_perdata;
		$type=$request->type;
		$query = "EXEC dbo.get_upaya_hukum @jenis_hukum='$jenis_hukum',@jenis_perdata='$jenis_perdata',@type=$type";
		$getParameter = DB::select($query);
		$html ="<option value='0'> --Pilih Upaya Hukum-- </option>";
		foreach($getParameter as $value){
           	$html .= "<option value='".$value->kode."' data-need_agenda='".$value->need_agenda."' data-penggugat='".$value->penggugat."' data-tergugat='".$value->tergugat."' data-turut_tergugat='".$value->turut_tergugat."'>".$value->nama." </option>";
        }
		$data_parameter["content"] = $html;
		// $data_parameter["query"] = $query;
		echo json_encode($data_parameter);
	}
		
	public function CatatanJaminanBerjalan(Request $request) {
		$header_id = $request['header_id'];
		$getLaporanNotaris = DB::select("EXEC dbo.get_laporan_notaris_detail_by_header @header_id='$header_id'");
		$accessuser = Helper::get_access(10)[0];
		$html =array(1=>'',2=>'');
		foreach($getLaporanNotaris as $value) {
			$html[$value->tipe_pengikatan] .= "<tr class='row-trace-pn'>";
			$html[$value->tipe_pengikatan] .= "<td>".date("d M Y", strtotime($value->lap_notaris_detail_tanggal))."</td>";
			$html[$value->tipe_pengikatan] .= "<td style='text-transform:uppercase'>".$value->nama_status_jaminan."</td>";
			$html[$value->tipe_pengikatan] .= "<td style='text-transform:uppercase'>".$value->nama_kendala."</td>";
			$html[$value->tipe_pengikatan] .= "<td style='text-transform:uppercase'>".$value->keterangan."</td>";
			$html[$value->tipe_pengikatan] .= "<td style='text-transform:uppercase' class='text-center td-aksi-sp col_aksi_jaminanberjalan'>";
			if($accessuser->update==1)
				$html[$value->tipe_pengikatan] .= "<a class='btn-custom btn btn-info' type='submit' data-toggle='modal' data-target='#modal_editstatusnotaris' data-backdrop='static' onclick='modal_editstatusnotaris(".$value->lap_notaris_detail_id.",".$value->tipe_pengikatan.")' title='Ubah'><i class='i-custom fa fa-pencil-square-o' aria-hidden='true'></i></a>";
			if($accessuser->delete==1)
				$html[$value->tipe_pengikatan] .= "<a class='btn-custom btn btn-danger' type='submit' data-toggle='modal' data-target='#modal_deletestatusnotaris' onclick='modal_deletestatusnotaris(".$value->lap_notaris_detail_id.")' title='Hapus'><i class='i-custom fa fa-trash-o' aria-hidden='true'></i></a>";
			$html[$value->tipe_pengikatan] .= "</td>";
			$html[$value->tipe_pengikatan] .= "</tr>";
		}
		$data["content"] = $html;
		echo json_encode($data);
	}

	public function list_schedule_agenda(Request $request)
	{
		$header_id = $request['header_id'];
        $getTrack = DB::select("EXEC dbo.get_laporan_detail_by_header @header_id=$header_id");
		$data = array();
		$starttanggal=$endtanggal=$status=$upaya_hukum='';

		foreach($getTrack as $key=>$value){
			$starttanggal = $value->tanggal_status;
			$data[]=array(
				'title'=>$value->status,
				'start'=>$starttanggal,
				'color'=>'#5BC0DE'
			);
			$endtanggal=$value->tanggal_agenda;
			$status = $value->nama_agenda;
			$upaya_hukum = $value->m_upaya_hukum_selanjutnya;
		}
		if($endtanggal!= '1970-01-01'){
			$data[]=array(
				'title'=>$status
			);
			if($upaya_hukum>0){
				$data[count($data)-1]['start']=$starttanggal;
				$data[count($data)-1]['end']=date('Y-m-d',strtotime($endtanggal.' +1 day'));
				$data[count($data)-1]['color']='#ffff00';
			}else{
				$data[count($data)-1]['start']=$endtanggal;
				$data[count($data)-1]['color']='#ccffcc';
			}
			$data[count($data)-1]['textColor']='#000000';
		}
		$data["content"] = $data;
		return ($data);
	}
	public function GetDetailNotaris(Request $request)
	{
		$detail_id = $request['lap_notaris_detail_id'];
		$getLaporanNotaris = DB::select("EXEC dbo.get_laporan_notaris_detail_by_detail_id @detail_id='$detail_id'");

		$data["content"] = $getLaporanNotaris;
		$tipe_pengikatan=$request->tipe_pengikatan;
		$getdata = DB::select("EXEC dbo.get_status_jaminan @tipe_pengikatan='$tipe_pengikatan'");
		$html ="<option value=''>-- Pilih Status --</option>";
		foreach($getdata as $value){
           	$html .= "
                <option value='".$value->kode."'>".$value->nama." </option>
            ";
        }
		$data['status'] =$html;
		echo json_encode($data);
	}
	public function get_detail_header($type,Request $request){
		$getlist = DB::table($type);
		if($request->has('join')){
			foreach($request['join'] as $key=>$value){
				$getlist->join($value['table'],$value['table_a_compare'],$value['operator'],$value['table_b_compare']);
			}
		}
		foreach($request['where'] as $key=>$value){
			if($value['header_id']!='')
				$getlist->where($value['type'],'=',$value['header_id']);
			else
				$getlist->whereRaw($value['type']);
		}
		return $getlist->get();
	}
	public function list_notaris(Request $request){
		$type = $request['type'];
		$data = array();
		$type_laporan=$search = '';
		$search='';
		if(Session::has('SIPP_Role'))
			$accessuser = Helper::get_access(($type=='laporan_notaris_for_print')?11:10)[0];
		if(strtolower($type)=='laporan_notaris'){
			$getPencairan = DB::select('Exec dbo.get_jenis_pengurusan 1');
			$search.= ' @status="'.$request['status'].'", ';
		}else
			$getKendala = DB::select("EXEC dbo.get_kendala");

		$getAgunan = DB::select('Exec dbo.get_jenis_pengurusan 2');
		
		// if(isset($request['tipe'])&&$request['tipe']!=''){
			// $search .= ' @type="'.$request['tipe'].'", ';
			// $search .= ' @order="'.$request['tipe'].' '.$request['order'][0]['dir'].'", ';
			// if($request['tipe']=='notaris')
				// $getStatusRekomendasi = DB::select('Exec dbo.get_status_rekomendasi');
		// }else{		
			if($type=='laporan_notaris'){
				switch($request['order'][0]['column']){
					case '0': 
						$search .= ' @order="id_debitur '.$request['order'][0]['dir'].'", ';
						break;
					case '1': 
						$search .= ' @order="no_rekening '.$request['order'][0]['dir'].'", ';
						break;
					case '2': 
						$search .= ' @order="cabang '.$request['order'][0]['dir'].'", ';
						break;
					case '3': 
						$search .= ' @order="unit '.$request['order'][0]['dir'].'", ';
						break;
					case '4': 
						$search .= ' @order="debitur '.$request['order'][0]['dir'].'", ';
						break;
					case '5': 
						$search .= ' @order="jenis_agunan '.$request['order'][0]['dir'].'", ';
						break;
					case '6': 
						$search .= ' @order="notaris '.$request['order'][0]['dir'].'", ';
						break;
					case '7': 
						$search .= ' @order="no_covernote '.$request['order'][0]['dir'].'", ';
						break;
					case '8': 
						$search .= ' @order="[to] '.$request['order'][0]['dir'].'", ';
						break;
					case '9': 
						$search .= ' @order="masa_berlaku '.$request['order'][0]['dir'].'", ';
						break;
					case '10': 
						$search .= ' @order="pencairan '.$request['order'][0]['dir'].'", ';
						break;
					case '11': 
						$search .= ' @order="tanggal_pencairan '.$request['order'][0]['dir'].'", ';
						break;
					case '12': 
						$search .= ' @order="tgl_penyelesaian_pencairan '.$request['order'][0]['dir'].'", ';
						break;
					case '13': 
						$search .= ' @order="status_pencairan '.$request['order'][0]['dir'].'", ';
						break;
					case '14': 
						$search .= ' @order="agunan '.$request['order'][0]['dir'].'", ';
						break;
					case '15': 
						$search .= ' @order="tanggal_agunan '.$request['order'][0]['dir'].'", ';
						break;
					case '16': 
						$search .= ' @order="tgl_penyelesaian_agunan '.$request['order'][0]['dir'].'", ';
						break;
					case '17': 
						$search .= ' @order="status_agunan '.$request['order'][0]['dir'].'", ';
						break;
					case '19': 
						$search .= ' @order="kendala '.$request['order'][0]['dir'].'", ';
						break;
					case '20': 
						$search .= ' @order="rekomendasi '.$request['order'][0]['dir'].'", ';
						break;
					default:
						$search .= ' @order="header_id '.$request['order'][0]['dir'].'", ';
						break;
				}
			}elseif($type=='unmapped_debitur'){
				switch($request['order'][0]['column']){
					case '0': 
						$search .= ' @order="nasabah_id '.$request['order'][0]['dir'].'", ';
						break;
					case '1': 
						$search .= ' @order="no_rekening '.$request['order'][0]['dir'].'", ';
						break;
					case '2': 
						$search .= ' @order="nama_nasabah '.$request['order'][0]['dir'].'", ';
						break;
					case '3': 
						$search .= ' @order="plafond '.$request['order'][0]['dir'].'", ';
						break;
					case '4': 
						$search .= ' @order="wilayah '.$request['order'][0]['dir'].'", ';
						break;
					case '5': 
						$search .= ' @order="nama_cabang '.$request['order'][0]['dir'].'", ';
						break;
					case '6': 
						$search .= ' @order="nama_unit '.$request['order'][0]['dir'].'", ';
						break;
					default:
						$search .= ' @order="a.created_date '.$request['order'][0]['dir'].'", ';
						break;
				}
			}elseif($type=='laporan_notaris_for_print'){
				$search .= ' @type="'.$request['tipe'].'", ';
				if($request['tipe']=='wilayah'){
					$search .= ' @order="wilayah '.$request['order'][0]['dir'].'", ';
				}else{
					$search .= ' @order="debitur desc", ';	
					$getStatusRekomendasi = DB::select('Exec dbo.get_status_rekomendasi');
				}
			}else{
				switch($request['order'][0]['column']){
					case '0': 
						$search .= ' @order="wilayah '.$request['order'][0]['dir'].'", ';
						break;
					case '1': 
						$search .= ' @order="cabang '.$request['order'][0]['dir'].'", ';
						break;
					case '2': 
						$search .= ' @order="notaris '.$request['order'][0]['dir'].'", ';
						break;
					case '3': 
						$search .= ' @order="proses_agunan '.$request['order'][0]['dir'].'", ';
						break;
					case '4': 
						$search .= ' @order="proses_terlambat_agunan '.$request['order'][0]['dir'].'", ';
						break;
					case '5': 
						$search .= ' @order="cn_active '.$request['order'][0]['dir'].'", ';
						break;
					case '6': 
						$search .= ' @order="cn_habis '.$request['order'][0]['dir'].'", ';
						break;
					default:
						$search .= ' @order="kode_wilayah '.$request['order'][0]['dir'].'", ';
						break;
				}
			}
		// }
		if($request['search']['value']!='')
			$search .= ' @search=\''.$request['search']['value'].'\', ';
		
		if($request['wilayah']!=''||(Session::has('SIPP_kode_wilayah')))
			$search .= ' @lap_notaris_header_wilayah=\''.(($request['wilayah']!='')?$request['wilayah']:Session::get('SIPP_kode_wilayah')).'\', ';
		
		if($request['cabang']!=''||(Session::has('SIPP_kode_cabang')))
			$search .= ' @lap_notaris_header_cabang=\''.(($request['cabang']!='')?$request['cabang']:Session::get('SIPP_kode_cabang')).'\', ';
		
		if($request['unit']!=''||(Session::has('SIPP_kode_unit')))
			$search .= ' @lap_notaris_header_unit=\''.(($request['unit']!='')?$request['unit']:Session::get('SIPP_kode_unit')).'\', ';
		
		if($request['mulai']!='')
			$search .= ' @to_mulai=\''.$request['mulai'].'\', ';
		
		if($request['selesai']!='')
			$search .= ' @to_selesai=\''.$request['selesai'].'\', ';
		
		if($request['year']!='')
			$search .= ' @year=\''.$request['year'].'\', ';
		
		// return json_encode($request['status_perkara']);die;
		
		// return "query : exec get_".$type." ".$search." @start=".$request['start'].", @length=".$request['length'];die;

		
		try{
			$GetKaryawan = DB::Select("exec get_".$type." ".$search." @start=".$request['start'].", @length=".$request['length']);
		}catch(\Illuminate\Database\QueryException $ex){
			$response['catch'] =$ex->getMessage();
		}	
		
		// var_dump($search);die();
		$total = 0;
		// if(strtolower($type)=='laporan_notaris'){
			// $gettotal = DB::Select("exec get_".$type."_count ".$search." @start=".$request['start'].", @length=".$request['length']);
		// }
	if (isset($GetKaryawan)){
		foreach($GetKaryawan as $key=>$value){
			if(strtolower($type)=='laporan_notaris'){
				$data[$key][]=$value->id_debitur;
				$data[$key][]=$value->no_rekening;
				$data[$key][]=$value->cabang;
				$data[$key][]=$value->unit;
				$data[$key][]=$value->debitur;
				$data[$key][]=$value->jenis_agunan;
				$data[$key][]=$value->notaris;
				$data[$key][]=$value->no_covernote;
				$data[$key][]=date('d M Y',strtotime($value->to));
				$data[$key][]=date('d M Y',strtotime($value->masa_berlaku));
				$data[$key][]=$value->pencairan;
				$data[$key][]=date('d M Y',strtotime($value->tanggal_pencairan));
				$data[$key][]=date('d M Y',strtotime($value->tgl_penyelesaian_pencairan));
				$data[$key][]=$value->status_pencairan;
				$data[$key][]=$value->agunan;
				$data[$key][]=date('d M Y',strtotime($value->tanggal_agunan));
				$data[$key][]=date('d M Y',strtotime($value->tgl_penyelesaian_agunan));
				$data[$key][]=$value->status_agunan;
				$diff =date_diff(date_create($value->to),date_create(date('Y-m-d')));
				$data[$key][]=(strtolower($value->status_agunan)=='proses notaris')?$diff->format('%R%a'):'-';
				$data[$key][]=$value->ket_pencairan;
				$data[$key][]=$value->ket_agunan;
				$data[$key][]=$value->kendala;
				$data[$key][]=$value->rekomendasi;
				$data[$key][]=$value->total_perpanjangan;
				$data[$key][]=$value->status_update;				
				$html = '<div class="btn-group">';
				$html .='<a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span></a>
						<ul class="dropdown-menu proses-notaris" style="margin-left: -240px">
							<li>
								<!-- SETTING ROLE ADMIN DAN SUPER ADMIN -->';
							if($value->status_submit == 0){
								if($accessuser->update==1){
									$html .='
									<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_editpn" onclick="modal_editpn(
										\'mapped\'
										,\''.$value->header_id.'\'
										,\''.$value->to.'\'
										,\''.strtoupper($value->wilayah).'\'
										,\''.$value->cabang.'\'
										,\''.$value->unit.'\'
										,\''.$value->id_debitur.'\'
										,\''.$value->no_rekening.'\'
										,\''.str_replace("'"," ",$value->debitur).'\'
										,\''.number_format((Int)$value->plafond,2,",",".").'\'
										,\''.$value->lap_notaris_header_notaris.'\'
										,\''.$value->notaris.'\'
										,\''.trim(preg_replace('/\s+/', ' ', $value->id_agunan)).'\'
										,\''.$value->m_jenis_agunan_id.'\'
										,\''.trim(preg_replace('/\s+/', ' ', $value->no_covernote)).'\'
										,\''.$value->masa_berlaku.'\'
										,\''.$value->pencairan.'\'
										,\''.$value->tanggal_pencairan.'\'
										,\''.$value->agunan.'\'
										,\''.$value->tanggal_agunan.'\'
										,\''.$value->pengikatan_lainnya.'\'
									)">Ubah Data Jaminan Notaris</a>';
								}
								if($accessuser->insert==1){
									$html .='
										<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addprosespn" data-backdrop="static" onclick="modal_addprosespn(\''.$value->header_id.'\',1)">Proses Status Pengikatan Pembiayaan</a>
										<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addprosespn" data-backdrop="static" onclick="modal_addprosespn(\''.$value->header_id.'\',2)">Proses Status Pengikatan Agunan</a>
										<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_perpanjangan_cn" data-backdrop="static" onclick="modal_perpanjangan_cn(\''.$value->header_id.'\')">Perpanjangan CN</a>
									';
									// if($value->need_closed==1){
									if($value->status_agunan=='CLOSE CABANG'){									
										$html .='
											<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_konfirmasi_simpan" data-backdrop="static" onclick="submit_order(\''.$value->header_id.'\')">Submit</a>
										';
									}
								}
								// if($accessuser->delete==1){
									// $html .='
										// <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_deletepn" data-backdrop="static" onclick="modal_deletepn(\''.$value->header_id.'\')">Hapus Dari Daftar</a>
									// ';
								// }
							}else{
								if($accessuser->update==1){
									$html .='
										<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_konfirmasi_unsimpan" data-backdrop="static" onclick="unsubmit_order(\''.$value->header_id.'\')">Unsubmit</a>
									';
								}
							}
							if($accessuser->detail==1&&$value->document!=''){
								// $html .='<a type="button" class="btn btn-default" href="upload/'.$value->document.'" download>Dokumen</a>';
								$html .='<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_dokumencn" data-backdrop="static" onclick="dokumencn(\'upload/'.$value->document.'\')">Dokumen</a>';
							}
							$html .='<!-- END SETTING ROLE ADMIN DAN SUPER ADMIN -->
						
							<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_notejaminanberjalan" onclick="modal_notejaminanberjalan(\''.$value->header_id.'\', \''.$value->status_submit.'\')">History status & kendala</a>
							</li>
						</ul>';
				$html.='</div>';
				$data[$key][]=$html;
				$data[$key][]=$value->tipe_kredit;
			}elseif(strtolower($type)=='laporan_notaris_for_print'){
				$datas=(array)$value;
				if(!isset($request['for'])){
					$detailid='';
					if($request['tipe']=='wilayah'){
						$data[$key][]=$datas['wilayah'];
						$data[$key][]=$datas['cabang'];
						$data[$key][]=$datas['notaris'];
						$data[$key][]=$datas['debitur'];
						$detailid=$datas['cabang'];
					}else{
						$data[$key][]=$datas['notaris'];
						$data[$key][]=$datas['debitur'];
						$detailid=$datas['notaris_id'];
					}
					$data[$key][]=$datas['selesai_tepat_pencairan'];
					$data[$key][]=$datas['selesai_terlambat_pencairan'];
					$data[$key][]=$datas['proses_pencairan'];
					$data[$key][]=$datas['proses_terlambat_pencairan'];
					$data[$key][]=$datas['selesai_tepat_agunan'];
					$data[$key][]=$datas['selesai_terlambat_agunan'];
					$data[$key][]=$datas['proses_agunan'];
					$data[$key][]=$datas['proses_terlambat_agunan'];
					$data[$key][]="<button data-toggle=\"modal\" data-target=\"#modal_detailcn\" onclick=\"modal_getdetail('".$request['tipe']."','".$detailid."','habis')\">".$datas['cn_habis']."</button>";
					$data[$key][]="<button data-toggle=\"modal\" data-target=\"#modal_detailcn\" onclick=\"modal_getdetail('".$request['tipe']."','".$detailid."','aktif')\">".$datas['cn_active']."</button>";
					foreach($getAgunan as $values){
						$data[$key][]=$datas['jaminan'.$values->kode];
					}
					foreach($getKendala as $values){
						$data[$key][]=$datas['kendala'.$values->kode];
					}
					if($request['tipe']=='notaris'){
						foreach($getStatusRekomendasi as $values){
							$data[$key][]=$datas['rekomendasi'.$values->kode];
						}
					}
				}
			}elseif(strtolower($type)=='laporan_notaris_for_dashboard'){
				$datas=(array)$value;
				$data[$key][]=$datas['wilayah'];
				$data[$key][]=$datas['cabang'];
				$data[$key][]=$datas['notaris'];
				$data[$key][]=$datas['proses_agunan'];
				$data[$key][]=$datas['proses_terlambat_agunan'];
				$data[$key][]=$datas['cn_habis'];
				$data[$key][]=$datas['cn_active'];
			}else{
				$data[$key][]=$value->NASABAH_ID;
				$data[$key][]=$value->no_rekening;
				$data[$key][]=$value->NAMA_NASABAH;
				$data[$key][]=number_format($value->Plafond,2,",",".");
				$data[$key][]=$value->wilayah;
				$data[$key][]=$value->nama_cabang;
				$data[$key][]=$value->nama_unit;
				$html='';
					$html = '<div class="btn-group">';
						$html .='<a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span></a>
								<ul class="dropdown-menu" style="margin-left: -240px">
									<li>
										<!-- SETTING ROLE ADMIN DAN SUPER ADMIN -->';
									if($accessuser->insert==1){
										$html .='
											<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_editpn" onclick="modal_editpn(
												\'unmapped\'
												,\'\'
												,\''.$value->tgl_pencairan.'\'
												,\''.$value->wilayah.'\'
												,\''.$value->KODE_CABANG.'\'
												,\''.$value->KODE_UNIT.'\'
												,\''.$value->NASABAH_ID.'\'
												,\''.$value->no_rekening.'\'
												,\''.str_replace("'"," ",$value->NAMA_NASABAH).'\'
												,\''.number_format((Int)$value->Plafond,2,",",".").'\'
												,\'\'
												,\'\'
												,\'\'
												,\'\'
												,\'\'
												,\'\'
												,\'\'
												,\''.date('Y-m-d',strtotime($value->tgl_pencairan.' +18 day')).'\'
												,\'\'
												,\''.date('Y-m-d',strtotime($value->tgl_pencairan.' +8 month')).'\'
												,\'\'
											)">Tambah Jaminan Notaris</a>';
									}
									if($accessuser->update==1){
									// if($accessuser->delete==1){
										$html .='
											<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_konfirmasidebitur" onclick="modal_deletedebitur(
												\''.$value->NASABAH_ID.'\'
												,\''.$value->no_rekening.'\'
												,\''.$value->NAMA_NASABAH.'\'
											)">Hilangkan Dari Daftar</a>';
									}

									$html.='<!-- END SETTING ROLE ADMIN DAN SUPER ADMIN -->
								</li>
							</ul>
						</div>';
				$data[$key][]=$html;
			}
			if($total==0){
				// if(strtolower($type)=='laporan_notaris'){
					// $total = $gettotal[0]->total;
				// }else{
					$total = $value->total;
				// }
			}
		}
	}

		$response['recordsTotal'] = $total;
		$response['recordsFiltered'] = $total;
		$response['data'] = $data;
		$response['query'] = "query : exec get_".$type." ".$search." @start=".$request['start'].", @length=".$request['length'];
		return $response;
	}
	
	public function list_perkara(Request $request){
		$type = $request['type'];
		$idperkara = $request['idperkara'];
		$data = array();
		$search = '';
		$accessuser=array();
		if($type == 'laporan')
			$accessuser = Helper::get_access(7)[0];
		else
			$accessuser = Helper::get_access(8)[0];
		switch($request['order'][0]['column']){
			case '0': 
				$search .= ' @order="unit_bisnis '.$request['order'][0]['dir'].'", ';
				break;
			case '1': 
				$search .= ' @order="wilayah '.$request['order'][0]['dir'].'", ';
				break;
			case '2': 
				$search .= ' @order="cabang '.$request['order'][0]['dir'].'", ';
				break;
			case '3': 
				$search .= ' @order="unit '.$request['order'][0]['dir'].'", ';
				break;
			case '4': 
				$search .= ' @order="nama_pic '.$request['order'][0]['dir'].'", ';
				break;
			case '5': 
				$search .= ' @order="no_perkara '.$request['order'][0]['dir'].'", ';
				break;
			case '6': 
				$search .= ' @order="laporan_tanggal_perkara '.$request['order'][0]['dir'].'", ';
				break;
			case '7': 
				$search .= ' @order="pelapor '.$request['order'][0]['dir'].'", ';
				break;
			case '8': 
				$search .= ' @order="terlapor '.$request['order'][0]['dir'].'", ';
				break;
			case '9': 
				if(in_array($idperkara,array(1,3,4))){
					$search .= ' @order="turut_tergugat '.$request['order'][0]['dir'].'", ';
				}else{
					$search .= ' @order="nama_klasifikasi '.$request['order'][0]['dir'].'", ';
				}
				break;
			case '10': 
				$search .= ' @order="kedudukan_perseroan '.$request['order'][0]['dir'].'", ';
				break;
			case '11': 
				$search .= ' @order="materil '.$request['order'][0]['dir'].'", ';
				break;
			case '12': 
				$search .= ' @order="immateril '.$request['order'][0]['dir'].'", ';
				break;
			case '13': 
				$search .= ' @order="dwangsom '.$request['order'][0]['dir'].'", ';
				break;
			case '14': 
				if($type=='laporan_closed'){
					$search .= ' @order="tanggal_pelaksanaan '.$request['order'][0]['dir'].'", ';
				}else{
					$search .= ' @order="unit_bisnis '.$request['order'][0]['dir'].'", ';
				}
				break;
			case '14': 
				$search .= ' @order="m_parameter_name '.$request['order'][0]['dir'].'", ';
				break;
			case '15': 
				$search .= ' @order="case when bulan<>0 then bulan when minggu<>0 then minggu when hari<>0 then hari end '.$request['order'][0]['dir'].'", ';
				break;
		}
		if($request['search']['value']!='')
			$search .= ' @search=\''.$request['search']['value'].'\', ';
		
		if($request['unit_bisnis']!='')
			$search .= ' @unit_bisnis=\''.$request['unit_bisnis'].'\', ';
			
		if($request['wilayah']!='')
			$search .= ' @wilayah=\''.$request['wilayah'].'\', ';
		
		if($request['cabang']!='')
			$search .= ' @cabang=\''.$request['cabang'].'\', ';
		
		if($request['area']!='')
			$search .= ' @area=\''.$request['area'].'\', ';
		
		if($request['unit']!='')
			$search .= ' @unit=\''.$request['unit'].'\', ';

		if($request['jenis_perkara']!='')
			$search .= ' @jenis_perkara=\''.$request['jenis_perkara'].'\', ';

		if($request['dasar_perkara']!='')
			$search .= ' @dasar_perkara=\''.$request['dasar_perkara'].'\', ';
		
		if($request['mulai']!='')
			$search .= ' @to_mulai=\''.$request['mulai'].'\', ';
		
		if($request['selesai']!='')
			$search .= ' @to_selesai=\''.$request['selesai'].'\', ';
		
		// return json_encode($request['status_perkara']);die;
		
		// return "query : exec get_".$type." ".$search." @idperkara=".$idperkara.", @start=".$request['start'].", @length=".$request['length'];die;
		try{
			$GetKaryawan = DB::Select("exec get_".$type." ".$search." @idperkara=".$idperkara.", @start=".$request['start'].", @length=".$request['length']);
		}catch(\Illuminate\Database\QueryException $ex){
			$response['catch'] =$ex->getMessage();
		}	
		$total = 0;
		// echo json_encode($GetKaryawan);die;

		if (isset($GetKaryawan)){
			foreach($GetKaryawan as $key=>$value){
				$data[$key][]=$value->unit_bisnis;
				$data[$key][]=$value->wilayah;
				$data[$key][]=($value->unit_bisnis=='ULaMM')?$value->cabang:$value->cabang_mekaar;
				$data[$key][]=($value->unit_bisnis=='ULaMM')?$value->unit:'-';
				$data[$key][]=$value->nama_pic;
				$data[$key][]=$value->no_perkara;
				$data[$key][]=(($value->laporan_tanggal_perkara!='')?date('d M Y',strtotime($value->laporan_tanggal_perkara)):'');
				$data[$key][]=$value->pelapor;
				$data[$key][]=$value->terlapor;
				if(in_array($idperkara,array(1,3,4))){
					$data[$key][]=$value->turut_tergugat;
				}else{
					$data[$key][]=$value->nama_klasifikasi;
				}
				$data[$key][]=$value->kedudukan_perseroan;
				if (isset($value->m_upaya_hukum_selanjutnya)){
					if ($value->m_upaya_hukum_selanjutnya==1){
						$data[$key][]='Tingkat Banding';
					}else if ($value->m_upaya_hukum_selanjutnya==2){
						$data[$key][]='Tingkat Kasasi';
					}else if ($value->m_upaya_hukum_selanjutnya==3){
						$data[$key][]='Tingkat PK';
					}else if ($value->m_upaya_hukum_selanjutnya==4){
						$data[$key][]='Pengadilan Tinggi';			
					}else if ($value->m_upaya_hukum_selanjutnya==5){
						$data[$key][]='Selesai';
					}else if ($value->m_upaya_hukum_selanjutnya==0){
						$data[$key][]='Tingkat Pengadilan Negri';				
					}else{
						$data[$key][]='Tingkat Pengadilan Negri';				
					}
				}else{
					$data[$key][]='Tingkat Pengadilan Negri';				
				}
				
				$data[$key][]=number_format(($value->outstanding=='')?0:$value->outstanding); //FZL
				
				$data[$key][]=number_format(($value->materil=='')?0:$value->materil);
				$data[$key][]=number_format(($value->immateril=='')?0:$value->immateril);
				$data[$key][]=number_format(($value->dwangsom=='')?0:$value->dwangsom);
				if($type=='laporan_closed'){
					$data[$key][]=(($value->tanggal_pelaksanaan!='')?date('d M Y',strtotime($value->tanggal_pelaksanaan)):'');
					$data[$key][]=$value->m_parameter_name;
					$arraytanggal = array();
					if( $value->bulan != 0 ) 
						$arraytanggal[]= $value->bulan.' bulan';
					if( $value->minggu != 0 ) 
						$arraytanggal[]= $value->minggu.' minggu';
					if( $value->hari != 0 ) 
						$arraytanggal[]= $value->hari.' hari';
					$data[$key][]=implode(',',$arraytanggal);
				}
				$html = '<div class="btn-group">';
				$html .='<a data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Proses <span class="caret"></span> </a>
						<ul class="dropdown-menu" style="margin: 2px -118px 0">
							<li>
							<!-- SETTING ROLE ADMIN DAN SUPER ADMIN -->';	
								if($value->status_selesai_perkara == 0){
									if($accessuser->update==1){
										if($value->status_submit == 0){
											$html .='<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_editpp" onclick="modal_editpp(\''.trim($value->header_id,' ').'\')">Ubah Data Perkara</a>';
										}
									}
									if($accessuser->insert==1){
										if($value->status_submit == 0){
											$html .='	
												<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addstatusperkara" data-backdrop="static" onclick="modal_addstatusperkara(\''.trim($value->header_id,' ').'\',\''.$idperkara.'\', \''.$value->jenis_perdata_id.'\')">Tambah Kronologis</a>
											';
										}elseif($value->status_submit != 0&&$value->upaya_hukum==1){
											$html .='	
												<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_addupayahukum" data-backdrop="static" onclick="modal_addupayahukum(\''.trim($value->header_id,' ').'\',\''.$idperkara.'\', \''.$value->jenis_perdata_id.'\')">Tambah Upaya Hukum</a>
											';
										}
										$html .='
											<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_selesaikanperkara" data-backdrop="static" onclick="modal_selesaikanperkara(\''.trim($value->header_id,' ').'\')">Penutupan Perkara</a>
										';
									}								
									if($accessuser->delete==1){
										$html .='
											<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_hapusperkara" onclick="modal_hapusperkara(\''. trim($value->header_id,' ') .'\', \''. $value->no_perkara .'\')" >Hapus Perkara</a>
										';
									}
								}
								if($accessuser->detail==1){
									if($value->dokumen!=''){
										$html .='
											<a type="button" class="btn btn-default" href="upload/'.$value->dokumen.'" download>Dokumen</a>
										';
									}
									$html .='<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_tracelaporan" onclick="modal_tracelaporan(\''. trim($value->header_id,' ') .'\', \''. $value->status_submit .'\', \''. $value->status_selesai_perkara .'\')" >Detail Perkara</a>
										<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_scheduleagenda" onclick="modal_scheduleagenda(\''. trim($value->header_id,' ') .'\')" >View Agenda</a>
										<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_hapusperkara" onclick="modal_hapusperkara(\''. trim($value->header_id,' ') .'\', \''. $value->no_perkara .'\')" >Hapus Perkara</a>';
								}
						$html.='</li>
							</ul>';
				$html.='</div>';
				$data[$key][]=$html;
				if($total==0){
					$total = $value->total;
				}
			}
		}
		$response['recordsTotal'] = $total;
		$response['recordsFiltered'] = $total;
		$response['data'] = $data;
		$response['query'] = "exec get_".$type." ".$search." @idperkara=".$idperkara.", @start=".$request['start'].", @length=".$request['length'];
		return $response;
	}
	public function get_detail_laporan_notaris(Request $request){
		$column = 'a.lap_notaris_header_notaris';
		if($request['type']=='wilayah'){
			$column = 'a.lap_notaris_header_cabang';
		}
		$id =$request['detail'];
		$operator = '<';
		if($request['search']=='aktif'){
			$operator = '>=';
		}
		$query = 'exec get_detail_laporan_notaris @column="'.$column.'", @id="'.$id.'",@operator="'.$operator.'",@to_mulai="'.$request['to_mulai'].'",@to_selesai="'.$request['to_selesai'].'"';
		$list = DB::select($query);
		$html='';
		foreach($list as $key=>$value){
			$html.='<tr>';
			$html.='<td>'.($key+1).'</td>';
			$html.='<td>'.$value->id_debitur.'</td>';
			$html.='<td>'.$value->nama_debitur.'</td>';
			$html.='</tr>';
		}
		$data['content']=$html;
		$data['query']=$query;
		return $data;
	}
	public function notic_number(Request $reqeust){
		return DB::table('m_users')->where('username','=',Session::get('SIPP_Username'))->where('status_user','=','1')->get();
	}
	public function get_notice(Request $reqeust){
		$gettotal = DB::table('m_users')->where('username','=',Session::get('SIPP_Username'))->where('status_user','=','1')->get()[0];
		$getlog =DB::table('log_perkara')->orderBy('created_date', 'desc')->get();
		$html = '';
		$color=array('INSERT'=>'#007bff','UPDATE'=>'#ffc107','DELETE'=>'#dc3545');
		foreach($getlog as $key=>$value){
			$html.='
			<li style="padding:15px 15px;border-bottom:grey 2px solid;border-left:5px solid '.$color[$value->log_status].';">
				<div>
					<strong>'.(($key<$gettotal->notif_log)?'<span class="label label-danger">New</span>':'').' '.$value->username.'</strong>
					<span class="pull-right text-muted">
						<em>'.date('d-m-Y H:i',strtotime($value->created_date)).'</em>
					</span>
				</div>
				<div>'.$value->description.'</div>
			</li>';
		}
		$data['content']=$html;
		DB::table('m_users')
            ->where('username', Session::get('SIPP_Username'))
            ->update(['notif_log' => 0]);
		return $data;
	}
	public function mapping_jenis_agunan(){
		$list = DB::table('lap_notaris_header')->whereNotNull('m_pengurusan_agunan_id')->limit(1000)->get();
		foreach($list as $key=>$value){
			$m_pengurusan_agunan_id=explode(',',$value->m_pengurusan_agunan_id);
			foreach($m_pengurusan_agunan_id as $keys=>$values){
				if($values!='')
				DB::statement("EXEC dbo.insert_lap_notaris_jenis_agunan @jenis_agunan='$values',@header_id='$value->lap_notaris_header_id', @created_by='sys'");
			}
			DB::table('lap_notaris_header')
			->where('lap_notaris_header_id', $value->lap_notaris_header_id)
			->update(['m_pengurusan_agunan_id' => NULL]);
		}
		return ['message'=>'success'];
	}
	public function mapping_pidana(){
		$list = DB::table('laporan_header')->whereNotNull('temp_dasar_pidanan')->limit(1000)->get();
		foreach($list as $key=>$value){
			$temp_dasar_pidanan=explode(',',$value->temp_dasar_pidanan);
			foreach($temp_dasar_pidanan as $keys=>$values){
				if($values!='')
				DB::statement("EXEC dbo.insert_laporan_header_perkara_pidana @pp_perkara_pidana_id='".$values."', @pp_header_id='".$value->laporan_header_id."', @created_by='sys'");
			}
			DB::table('laporan_header')
			->where('laporan_header_id', $value->laporan_header_id)
			->update(['temp_dasar_pidanan' => NULL]);
		}
		return ['message'=>'success'];
	}
	public function search_notaris(Request $request){
		$q = $request['term']['term'];
		// var_dump('exec get_notaris @search="'.$q.'"');
		$data = DB::select('exec get_notaris @search="'.$q.'"');
		return $data;
		
	}

	public function get_kendala_reason(Request $request)
	{
		$kendala_id = $request['kendala_id'];

		$getTrack = DB::select("EXEC dbo.get_kendala_reason @kendala_id=$kendala_id");
		$html ="<option value=''>-- Pilih Alasan Kendala --</option>";
		foreach($getTrack as $value){
           	$html .= "
                <option value='".$value->m_kendala_reason_id."'>".$value->m_kendala_reason_name." </option>
            ";
        }
		$data["content"] = $html;
		echo json_encode($data);
	}
}
