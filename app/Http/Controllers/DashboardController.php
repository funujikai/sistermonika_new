<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use DB;
use Session;
use DateTime;

class DashboardController extends Controller
{
	public function Dashboard() 
    {
		
		$server_name=$_SERVER['SERVER_NAME'];
		if($server_name=='appserverapache02.pnm.co.id'){
			return redirect('http://sistermonika.pnm.co.id');
		}
        $data['getwilayah']=DB::select('exec get_wilayah');
		return view('dashboard',$data);
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
            case '0': 
                $search .= ' @order="wilayah '.$request['order'][0]['dir'].'", ';
                break;
            case '1': 
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
				$data[$key][]=$value->wilayah;
				$data[$key][]=$value->total_wilayah;
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
    public function monitoring(Request $request){
        $search=' @year="'.$request->year.'", ';
        $getlist=$data=array();
        
        switch($request['order'][0]['column']){
            case '0': 
                $search .= ' @order="wilayah '.$request['order'][0]['dir'].'", ';
                break;
            case '1': 
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
				$data[$key][]=$value->wilayah;
				$data[$key][]=$value->total_wilayah;
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
            $data['header']=array();
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
                $data['header'][$value->m_jenis_hukum_id]+=$value->total;
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
            $data['status']=array('8'=>0,'9'=>0,'10'=>0,'11'=>0);
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
}
