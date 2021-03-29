<?php namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use App\Role;
use App\Http\Controllers\Controller;
use RedirectResponse;
use Validator;
use Redirect;
use Session;
use DB;

use Illuminate\Http\Request;

class LoginController extends Controller {

	public function loginredirect(){
		return view('auth.pilihlogin');
	}

	public function getLogin()
	{

		if(Session::has('SIPP_Username')) {
	 		return redirect('/');
	 	}
	 	else
	 	{
			return redirect('/login_sso');
	 	}
	}
	
	public function login_sso(Request $request)
	{
		date_default_timezone_set("Asia/Jakarta");
		$now =date("Y-m-d H:i:s");
		$server_name=$_SERVER['SERVER_NAME'];
		if($server_name=='appserverapache02.pnm.co.id'){
			return redirect('http://sistermonika.pnm.co.id');
		}
		if($server_name=="sistermonika.pnm.co.id"){
			$server_sso="http://ssowebservice.pnm.co.id";
			$redirect_url='http://ssowebservice.pnm.co.id/login.php?source=http://sistermonika.pnm.co.id/login_sso&app_code=SILUMAN';
		}else if($server_name=="10.61.3.247"){
			$server_sso="http://ssowebservice.pnm.co.id";
			$redirect_url='http://192.168.10.188/SSO_WebService/login.php?source=http://10.61.3.247/siluman_new/public/login_sso&app_code=SILUMAN';
		}else if($server_name=="27.50.31.76"){
			$server_sso="http://ssowebservice.pnm.co.id";
			$redirect_url='http://182.23.52.249/SSO_WebService/login.php?source=http://27.50.31.76:9495/siluman/public/login_sso&app_code=SILUMAN';
		}else{
			$server_sso="http://ssowebservice.pnm.co.id";
			$redirect_url='http://ssowebservice.pnm.co.id/login.php?source=http://'.$_SERVER['HTTP_HOST'].'/login_sso&app_code=SILUMAN';	 
		}
		// return redirect('/logout');
		if($request->has('UserName')&&$request->has('IDSDM')){
			$secret_code=strtoupper("$3cretc0d3".$request['UserName'].",SSO,".$request['IDSDM']);
			$json = file_get_contents($server_sso."/crosscheck.php?secret=".$secret_code."&app_code=SSO&username=".$request['UserName']);
			$obj = json_decode($json,true);
			if($obj['login'][0]['response']=='FALSE'){
				return redirect($redirect_url);
			}else{
				$data=$obj['login'][0]['data'][0];								
				Session::put('SIPP_Username', $data['username']);
				Session::put('SIPP_Name', $data['nama']);
				Session::put('SIPP_IDSDM', $data['idsdm']);
				Session::put('SIPP_Foto', $data['foto']);
				$dtUser = DB::SELECT('EXEC dbo.get_users_by_username @username="'.$data['username'].'"');
				
				// var_dump($dtUser);die();
				
				Session::put('SIPP_Role',$dtUser[0]->role_id);
				$arr_err=['Unit','Cabang','Wilayah'];
				$status=0;
				$err = -1;
				if(strtolower($dtUser[0]->scope)=='unit'){
					if($data['kode_unit']!=''){
						Session::put('SIPP_kode_unit', $data['kode_unit']);
						Session::put('SIPP_unit', $data['unit']);
					}else{
						$err=0;
					}
					if($data['kode_cabang']!=''){
						Session::put('SIPP_kode_cabang', $data['kode_cabang']);
						Session::put('SIPP_cabang', $data['cabang']);
					}else{
						$err=1;
					}
					$getdata = DB::select("exec get_wilayah '','".$dtUser[0]->kode_cabang."'");
					Session::put('SIPP_kode_wilayah', trim($getdata[0]->nama));
					if($err<0){
						$status=1;
					}
				}
				if(strtolower($dtUser[0]->scope)=='cabang'){
					if($data['kode_cabang']!=''){
						if($data['kode_cabang']=='SUB'){
							$data['kode_cabang']='SBG';
						}
						Session::put('SIPP_kode_cabang', $data['kode_cabang']);
						Session::put('SIPP_cabang', $data['cabang']);
					}else{
						$err=1;
					}
					$getdata = DB::select("exec get_wilayah '','".$data['kode_cabang']."'");
					Session::put('SIPP_kode_wilayah', trim($getdata[0]->nama));
					if($err<0){
						$status=1;
					}
				}
				if(strtolower($dtUser[0]->scope)=='wilayah'){
					if(strpos(strtoupper($data['posisi_nama']), 'LEGAL WILAYAH')!==FALSE){
						$exposisi = explode('LEGAL',strtoupper($data['posisi_nama']));
						$exposisi1 = explode('-',strtoupper($exposisi[1]));
						$getdata = DB::select("exec get_wilayah '".trim($exposisi1[0])."'");
						Session::put('SIPP_kode_wilayah', trim($getdata[0]->nama));
						$status=1;
					}else{
						$err=2;
					}
				}
				if($dtUser[0]->scope==''){
					$status=1;
				}
				
				$dtMenu = DB::SELECT('EXEC dbo.get_menus "'.$dtUser[0]->role_id.'"');
				$menu = array();
				$url = '';
				foreach($dtMenu as $key=>$value){
					$menu[$value->order]['menu']=$value->nama_menu;
					$menu[$value->order]['icon']=$value->icon;
					$menu[$value->order]['link']=$value->link;
					if($url==''&&$value->link!='#'){
						$url = $value->link;
					}
					if($value->child_order != null){
						$menu[$value->order]['child'][$value->child_order]['menu']=$value->child_nama_menu;
						$menu[$value->order]['child'][$value->child_order]['icon']=$value->child_icon;
						$menu[$value->order]['child'][$value->child_order]['link']=$value->child_link;
						if($url==''&&$value->child_link!='#')
							$url = $value->child_link;
					}
				}
				Session::put('menus',$menu);
				if($status==1){
					return redirect($url);
				}else{
					return view('logerr')->with('status','User Tidak Memiliki '.$arr_err[$err].' yang Sesuai');
				}
			}
		}
		return redirect($redirect_url);
	}
	public function logout()
	{
		Session::flush();
		return redirect('/');
	}
}
