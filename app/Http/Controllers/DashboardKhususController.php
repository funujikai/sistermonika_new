<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use DB;
use Session;
use DateTime;

class DashboardKhususController extends Controller
{
	public function Dashboard() 
    {
		Session::flush();
		$server_name=$_SERVER['SERVER_NAME'];
		if($server_name=='appserverapache02.pnm.co.id'){
			return redirect('http://sistermonika.pnm.co.id');
		}
        $data['getwilayah']=DB::select('exec get_wilayah');        
		return view('dashboardkhusus',$data);
    }
    public function list_agenda_dashboard(Request $request){
        $search='';
        $getlist=$data=array();
        if($request['wilayah']!=''||(Session::has('SIPP_kode_wilayah')))
			$search .= ' @wilayah=\''.(($request['wilayah']!='')?$request['wilayah']:Session::get('SIPP_kode_wilayah')).'\', ';
		
		if($request['cabang']!=''||(Session::has('SIPP_kode_cabang')))
			$search .= ' @cabang=\''.(($request['cabang']!='')?$request['cabang']:Session::get('SIPP_kode_cabang')).'\', ';
		
		if($request['unit']!=''||(Session::has('SIPP_kode_unit')))
			$search .= ' @unit=\''.(($request['unit']!='')?$request['unit']:Session::get('SIPP_kode_unit')).'\', ';
		
        switch($request['order'][0]['column']){
            case '0': 
                $search .= ' @order="cabang '.$request['order'][0]['dir'].'", ';
                break;
            case '1': 
                $search .= ' @order="tanggal_agenda '.$request['order'][0]['dir'].'", ';
                break;
            case '2': 
                $search .= ' @order="no_perkara '.$request['order'][0]['dir'].'", ';
                break;
            case '3': 
                $search .= ' @order="tempat '.$request['order'][0]['dir'].'", ';
                break;
            case '4': 
                $search .= ' @order="m_parameter_name '.$request['order'][0]['dir'].'", ';
                break;
        }
        $query = "exec get_list_agenda ".$search." @start=".$request['start'].", @length=".$request['length'];
        // echo $query;die;
        try{
            $getlist= DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            $response['catch'] =$ex->getMessage();
        }	
        
		$total = 0;
		foreach($getlist as $key=>$value){
                $data[$key][]=$value->cabang;
				$data[$key][]=date('d M Y',strtotime($value->tanggal_agenda));
				$data[$key][]=$value->no_perkara;
                $data[$key][]=$value->tempat;
				$data[$key][]=$value->m_parameter_name;
			if($total==0){
				$total = $value->total;
			}
		}
		$response['recordsTotal'] = $total;
		$response['recordsFiltered'] = $total;
		$response['data'] = $data;
		// $response['query'] = "query : exec get_".$type." ".$search." @start=".$request['start'].", @length=".$request['length'];
		return $response;
    }
    public function list_rank(Request $request){
        $search=' @year="'.$request->year.'", ';
        $getlist=$data=array();
        
        switch($request['order'][0]['column']){
            case '1': 
                $search .= ' @order="cast(replace(replace(wilayah,left(Wilayah,charindex(\' \',wilayah)),\'\'),right(wilayah,charindex(\'-\',REVERSE(wilayah))),\'\') as int) '.$request['order'][0]['dir'].'", ';
                break;
            case '2': 
                $search .= ' @order="total_wilayah '.$request['order'][0]['dir'].'", ';
                break;
        }
        $query = "exec get_list_rank_wilayah @tab='".$request->tab."',@unit_bisnis='".$request->unit_bisnis."', ".$search." @start=".$request['start'].", @length=".$request['length'];
        // echo $query;die;
        try{
            $getlist= DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            $response['catch'] =$ex->getMessage();
        }	
        
		$total = 0;
		foreach($getlist as $key=>$value){
			$data[$key][]=$key+1;
			$data[$key][]=$value->wilayah;
			$data[$key][]='<button class="btn btn-primary" onclick="detail(\''.$request->tab.'\',\''.$value->kode_unit.'\')">'.$value->total_wilayah.'</button>';
			if($total==0){
				$total = $value->total;
			}
		}
		$response['recordsTotal'] = $total;
		$response['recordsFiltered'] = $total;
		$response['data'] = $data;
		$response['query'] = $query;
		return $response;
    }
    public function list_detail_transaction(Request $request){
        $search=' @year="'.$request->year.'", ';
        $getlist=$data=array();
        switch($request['order'][0]['column']){
            case '0': 
                $search .= ' @order="col1 '.$request['order'][0]['dir'].'", ';
                break;
        }
        $search.=" @type='".$request->type."',";
        
        if(isset($request->jenis_hukum)){
            $search.=" @jenis_hukum='".$request->jenis_hukum."',";
        }
        if(isset($request->unit)){
            $search.=" @unit='".$request->unit."',";
        }
        if(isset($request->status)){
            $search.=" @status='".$request->status."',";
        }
        if(isset($request->submit)){
            $search.=" @submit='".$request->submit."',";
        }
        if(isset($request->category)){
            $search.=" @category='".$request->category."',";
        }
        if(isset($request->proses)){
            $search.=" @proses='".$request->proses."',";
        }
        $query = "exec get_list_detail_transaction ".$search." @start=0";
        // echo $query;die;
        try{
            $getlist= DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            $response['catch'] =$ex->getMessage();
        }	
        
		$total = 0;
		foreach($getlist as $key=>$value){
            $count=1;
            $obj ='col'.$count;
            do{
                $data[$key][]=$value->$obj;
                $count++;
                $obj='col'.$count;
            }while(isset($value->$obj));
		}
		$response['data'] = $data;
		$response['query'] = $query;
		return $response;
    }
    public function detail_data_dashboard(Request $request){
        $data = array();
        $wilayah = Session::get('SIPP_kode_wilayah');
        $cabang = Session::get('SIPP_kode_cabang');
        $unit = Session::get('SIPP_kode_unit');
        $year = $request->year;
        if($request->type=='litigasi'){
            $query = "exec get_dashboard_perkara @year='$year', @cabang='$cabang',@wilayah='$wilayah',@unit='$unit'";
            $getdata=DB::select($query);
            $data['total']=0;
            $data['header']=array(0,0,0,0,0,0,0,0);
            $getjenishukum = DB::table('m_jenis_hukum')->get();
            $getupayahukum = DB::table('m_upaya_hukum')->get();
            foreach($getjenishukum as $key=>$value){
                $data['header'][$value->m_jenis_hukum_id]=0;
                $data['detail'][$value->m_jenis_hukum_id]=array();
                foreach($getupayahukum as $keys=>$values){
                    if(!isset($data['detail'][$value->m_jenis_hukum_id][0])){
                        $data['detail'][$value->m_jenis_hukum_id][0]=array(0=>0,1=>0);
                    }
                    $data['detail'][$value->m_jenis_hukum_id][$values->id]=array(0=>0,1=>0);    
                }
            }			
            foreach($getdata as $key=>$value){
				if ($value->is_closed==0){
					$data['header'][$value->m_jenis_hukum_id+4]+=$value->total;
				}else{
					$data['header'][$value->m_jenis_hukum_id]+=$value->total;
				}			
                $data['detail'][$value->m_jenis_hukum_id][$value->m_upaya_hukum_id][$value->is_closed]+=$value->total;
                $data['total']+=$value->total;
           }
        }else{            
            $data['detail']=array();
            $data['header']=array(0=>0,1=>0,'all_0'=>0);
            $data['total']=0;
            $getdata=DB::select("exec get_dashboard_notaris @year='$year', @cabang='$cabang',@wilayah='$wilayah',@unit='$unit'");
            $status = DB::select("exec get_status_bpn_notaris @year='$year', @cabang='$cabang',@wilayah='$wilayah',@unit='$unit'");
            $data['total_debitur']=0;
            foreach($getdata as $key=>$value){
                $data['total_debitur']+=$value->total_debitur;
                $data['header'][$value->need_closed]+=$value->total;
                if($data['header']['all_0']==0){
                    $data['header']['all_0']+=$value->all_0;
                }
                $data['total']+=$value->total;
            }
			$data['q']="exec get_status_bpn_notaris @year='$year', @cabang='$cabang',@wilayah='$wilayah',@unit='$unit'";
            $data['status']=array('8'=>0,'9'=>0);
			foreach($status as $key=>$value){
				$data['status'][$value->m_status_jaminan_id]=$value->total;
			}
		}
       return $data;
    }
    public function get_dashboard_pie(Request $request){
        $year = $request->year;
        $type = $request->type;
        $wilayah = Session::get('SIPP_kode_wilayah');
        $cabang = Session::get('SIPP_kode_cabang');
        $unit = Session::get('SIPP_kode_unit');
        $pie=DB::select("exec get_pie_chart @type='$type', @year='$year', @cabang='$cabang',@wilayah='$wilayah',@unit='$unit'");
        $data=array();
        if($request->type=='notaris')
            $data['pie']=$pie[0];
        else{
            $data['pie']=array('perdata'=>0,'pidana'=>0,'phi'=>0,'tun'=>0);
            foreach($pie as $Key=>$value){
                $data['pie'][$value->m_jenis_hukum_name]=round($value->percentage,2);
            }
        }
        return $data;
    }
    public function get_notif_notaris(Request $request){
        $data['query']="exec get_notif_notaris @date='".$request['date']."'";
        $data['data']=DB::select("exec get_notif_notaris @date='".$request['date']."'");
        return $data;
    }	
    public function get_kendala_list(Request $request){
        $search=' @year="'.$request->year.'", ';
		$list = DB::select('exec [get_kendala]');
		$lists = array();
		$lists[0]['name']='PROSES VERIFIKASI';
		$lists[0]['total']=0;
		foreach($list as $key=>$value){
			$lists[$value->kode]['name']=$value->nama;
			$lists[$value->kode]['total']=0;
		}
        $getlist=$data=array();
        switch($request['order'][0]['column']){
            case '0': 
                $search .= ' @order="m_kendala_name '.$request['order'][0]['dir'].'", ';
                break;
        }        
        $query = "exec get_kendala_list_dashboard ".$search." @start=0";
        // echo $query;die;
        try{
            $getlist= DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            $response['catch'] =$ex->getMessage();
        }	
		$total = 0;
		foreach($getlist as $key=>$value){
			$lists[$value->m_kendala_id]['total']=$value->total_kendala;
			if($total==0){
				$total=$value->total;
			}
		}
        $i =0;
        
		foreach($lists as $key=>$value){
			// if(($request['hidden_button']=='true' && $key>0 && $key!=(count($lists)-1))||$request['hidden_button']=='false'){
            if(($request['hidden_button']=='true' && $key>0 )||$request['hidden_button']=='false'){
				$data[$i][]=$value['name'];
				$data[$i][]='<button class="btn btn-primary" onclick="detail(\'kendala\',\''.(($key==0)?'null':$key).'\',\'\',\'\')">'.$value['total'].'</button>';
				$i++;
			}
        }
        
		$response['recordsTotal'] = $i;
		$response['recordsFiltered'] = $i;
		$response['data'] = $data;
		$response['query'] = $query;
		return $response;
    }
    public function get_rekomendasi_list(Request $request){
        $search=' @year="'.$request->year.'", ';
		$list = DB::select('exec [Get_Status_rekomendasi]');
		$lists = array();
		$lists[0]['name']='PROSES VERIFIKASI';
		$lists[0]['total']=0;
		foreach($list as $key=>$value){
			$lists[$value->kode]['name']=$value->nama;
			$lists[$value->kode]['total']=0;
		}
        $getlist=$data=array();
        switch($request['order'][0]['column']){
            case '0': 
                $search .= ' @order="status_name '.$request['order'][0]['dir'].'", ';
                break;
        }        
        $query = "exec get_rekomendasi_list_dashboard ".$search." @start=0";
        // echo $query;die;
        try{
            $getlist= DB::select($query);
        }catch(\Illuminate\Database\QueryException $ex){
            $response['catch'] =$ex->getMessage();
        }	
		$total = 0;
		foreach($getlist as $key=>$value){
			$lists[$value->status_id]['total']=$value->total_rekomendasi;
			if($total==0){
				$total=$value->total;
			}
		}
		$i =0;
		foreach($lists as $key=>$value){
			if(($request['hidden_button']=='true'&&$key>0)||$request['hidden_button']=='false'){
				$data[$i][]=$value['name'];
				$data[$i][]='<button class="btn btn-primary" onclick="detail(\'rekomendasi\',\''.(($key==0)?'null':$key).'\',\'\',\'\')">'.$value['total'].'</button>';
				$i++;
			}
		}
		$response['recordsTotal'] = $i;
		$response['recordsFiltered'] = $i;
		$response['data'] = $data;
		$response['query'] = $query;
		return $response;
    }








/* SISAPICONTROLLER */
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
		// var_dump($getTrack);die;
		foreach($getTrack as $key=>$value){
			$data[$key][]=$value->no_perkara;
			$data[$key][]=(($value->tempus!='1970-01-01')?date('d M Y',strtotime($value->tempus)):'');
			$data[$key][]=$value->pelapor;
			$data[$key][]=$value->terlapor;
			$data[$key][]=$value->nama_klasifikasi;
			$data[$key][]=$value->kedudukan_perseroan;
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
           	$html .= "<option value='".$value->kode."' data-need_result='".$value->need_result."' data-need_looping='".$value->need_looping."' data-status_proses='".$value->status_proses."'>".$value->nama." </option>";
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
	public function list_notaris_khusus(Request $request){
		$type = $request['type'];
		$data = array();
		$type_laporan=$search = '';
		$search='';
		$getKendala = DB::select("EXEC dbo.get_kendala");

		$getAgunan = DB::select('Exec dbo.get_jenis_pengurusan 2');
	
        switch($request['order'][0]['column']){
            case '0': 
                $search .= ' @order="kode_wilayah '.$request['order'][0]['dir'].'", ';
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
		
	    // return "query : exec get_".$type." ".$search." @start=".$request['start'].", @length=".$request['length'];die;
		try{
			$GetKaryawan = DB::Select("exec get_".$type." ".$search." @start=".$request['start'].", @length=".$request['length']);
		}catch(\Illuminate\Database\QueryException $ex){
			$response['catch'] =$ex->getMessage();
		}	
        $total = 0;
        
    	foreach($GetKaryawan as $key=>$value){
            if(strtolower($type)=='laporan_notaris_for_dashboard'){
				$datas=(array)$value;
				$data[$key][]=$datas['wilayah'];
				$data[$key][]=$datas['cabang'];
				$data[$key][]=$datas['notaris'];
				$data[$key][]='<button class="btn btn-primary" onclick="detail(\'notaris\',\''.$datas['cabang'].'\',\'proses\',\'habis\')">'.$datas['proses_agunan'].'</button>';
				$data[$key][]='<button class="btn btn-primary" onclick="detail(\'notaris\',\''.$datas['cabang'].'\',\'proses\',\'active\')">'.$datas['proses_terlambat_agunan'].'</button>';
				$data[$key][]='<button class="btn btn-primary" onclick="detail(\'notaris\',\''.$datas['cabang'].'\',\'cn\',\'habis\')">'.$datas['cn_habis'].'</button>';
				$data[$key][]='<button class="btn btn-primary" onclick="detail(\'notaris\',\''.$datas['cabang'].'\',\'cn\',\'active\')">'.$datas['cn_active'].'</button>';
            }
			if($total==0){			
					$total = $value->total;
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
									<a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_scheduleagenda" onclick="modal_scheduleagenda(\''. trim($value->header_id,' ') .'\')" >View Agenda</a>';
							}
					$html.='</li>
						</ul>';
			$html.='</div>';
			$data[$key][]=$html;
			if($total==0){
				$total = $value->total;
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

}
