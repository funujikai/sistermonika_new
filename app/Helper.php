<?php namespace App;

use DB;
use Session;

class Helper {
	public static function get_access($menu_id){
		$role_id=Session::get('SIPP_Role');
		return DB::select("exec get_module '$role_id','$menu_id'");
	}
}