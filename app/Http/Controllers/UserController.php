<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Requests;
use DB;
use App\Tiket;
use App\User;
use App\Status;
use App\Helper;
use Session;
use DateTime;

class UserController extends Controller 
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
| Master User Roles
|-------------------------------------------------------------------*/

	public function DaftarRoles(Request $request) {
		$data['getUserRole'] = DB::select("EXEC dbo.get_roles");
		$data['getmenus'] = DB::select("EXEC dbo.get_menus");
		$data['accessuser'] = Helper::get_access(12)[0];
		return view('role', $data);
	}

	public function PostUserRole(Request $request){
	    $role_name = $request['role_add_name'];
		$status = 1;   
		$pic = $head = 0;
		$scope = '';
		if(isset($request['PIC']))
	 		$pic = $request['PIC'];    
		if(isset($request['head']))
	 		$head = $request['head'];   
		if(isset($request['scope']))
	 		$scope = $request['scope']; 
	    $created_by_name = Session::get('SIPP_Username');
	    $created_by_id = Session::get('SIPP_IDSDM');
	    DB::statement("EXEC dbo.insert_roles @role_name='$role_name',@pic='$pic',@head='$head',@scope='$scope', @status='$status', @created_by_name='$created_by_name', @created_by_id='$created_by_id' ");

		$message = "Info: Data berhasil ditambah!";
  
    	return redirect('DaftarRoles')->with('message', $message);
	}

	public function DeleteUserRole(Request $request){
	    $role_id = $request['role_id'];

	    DB::statement("EXEC dbo.delete_roles @role_id='$role_id' ");

		$message = "Info: Data berhasil dihapus!";
  
    	return redirect('DaftarRoles')->with('message', $message);
	}

	public function ActivateUserRole(Request $request){
	    $role_id = $request['role_activate_id'];
	    $status = 1;
	    $updated_by_name = Session::get('SIPP_Username');
	    $updated_by_id = Session::get('SIPP_IDSDM');

	    DB::statement("EXEC dbo.update_status_roles @role_id='$role_id',@status='$status', @updated_by_name='$updated_by_name', @updated_by_id='$updated_by_id'");

		$message = "Info: Role berhasil diaktifkan!";
  
    	return redirect('DaftarRoles')->with('message', $message);
	}

	public function DeactivateUserRole(Request $request){
	    $role_id = $request['role_deactivate_id'];
	    $status = 0;
	    $updated_by_name = Session::get('SIPP_Username');
	    $updated_by_id = Session::get('SIPP_IDSDM');

	    DB::statement("EXEC dbo.update_status_roles @role_id='$role_id',@status='$status', @updated_by_name='$updated_by_name', @updated_by_id='$updated_by_id'");

		$message = "Info: Role berhasil dinonaktifkan!";
  
    	return redirect('DaftarRoles')->with('message', $message);
	}

	public function UpdateUserRole(Request $request){
	    $role_id = $request['role_edit_id'];
	    $role_name = $request['role_edit_name'];  
		$pic = $head = 0;
		$scope = '';
		if(isset($request['PIC']))
	 		$pic = $request['PIC'];    
		if(isset($request['head']))
	 		$head = $request['head'];   
		if(isset($request['scope']))
	 		$scope = $request['scope']; 
	    $updated_by_name = Session::get('SIPP_Username');
	    $updated_by_id = Session::get('SIPP_IDSDM');

	    DB::statement("EXEC dbo.update_roles @role_id='$role_id', @role_name='$role_name',@pic='$pic',@head='$head',@scope='$scope', @updated_by_name='$updated_by_name', @updated_by_id='$updated_by_id' ");

		$message = "Info: Data role berhasil diubah!";
  
    	return redirect('DaftarRoles')->with('message', $message);
	}
	public function updatemoduleuser(Request $request){
		$getmenus = DB::select("EXEC dbo.get_menus");
		$role_id = $request['header_id'];
	    $updated_by_name = Session::get('SIPP_Username');
		foreach($getmenus as $key=>$value){
			$read = (isset($request['read_'.$value->id]))?'1':'0';
			$insert = (isset($request['insert_'.$value->id]))?'1':'0';
			$delete = (isset($request['delete_'.$value->id]))?'1':'0';
			$update = (isset($request['update_'.$value->id]))?'1':'0';
			$detail = (isset($request['detail_'.$value->id]))?'1':'0';
			DB::statement("exec update_module '$value->id','$role_id','$read','$insert','$update','$delete','$detail','$updated_by_name'");
		}
		$message = "Info: Data Akses role berhasil diubah!";
    	return redirect('DaftarRoles')->with('message', $message);
	}


/*-------------------------------------------------------------------
| Master User
|-------------------------------------------------------------------*/

	public function DaftarUsers(Request $request) {
		$data['getUserSipp'] = DB::select("EXEC dbo.get_users_sipp");
		$data['getUsers'] = DB::select("EXEC dbo.get_users");
		$data['getRoles'] = DB::select("EXEC dbo.get_roles");
		$data['accessuser'] = Helper::get_access(13)[0];
		return view('users', $data);
	}
	
	public function PostUserData(Request $request)
	{	
	    $role = $request['sipp_role'];
	    $username = $request['sipp_user'];
	    $status = 1;
	    $created_by_name = Session::get('SIPP_Username');
	    $created_by_id = Session::get('SIPP_IDSDM');

	    $dtUser = DB::select("EXEC dbo.get_users_sipp_by_username @username='$username' ");
	    // print_r($dtUser);exit;
	    $idsdm = $dtUser[0]->ID_SDM;
	    $nip = $dtUser[0]->NIP;
	    $nama = $dtUser[0]->nama;
	    $email = $dtUser[0]->email;

	    DB::statement("EXEC dbo.insert_users @role='$role', @nip='$nip', @idsdm='$idsdm', @username='$username', @nama='$nama', @email='$email', @status='$status', @created_by_name='$created_by_name', @created_by_id='$created_by_id' ");

		$message = "Info: Data berhasil ditambah!";
  
    	return redirect('DaftarUsers')->with('message', $message);
	}

	public function ActivateUser(Request $request){
	    $user_id = $request['user_activate_id'];
	    $status = 1;
	    $updated_by_name = Session::get('SIPP_Username');
	    $updated_by_id = Session::get('SIPP_IDSDM');

	    DB::statement("EXEC dbo.update_status_user @user_id='$user_id',@status='$status', @updated_by_name='$updated_by_name', @updated_by_id='$updated_by_id'");

		$message = "Info: User berhasil diaktifkan!";
  
    	return redirect('DaftarUsers')->with('message', $message);
	}

	public function DeactivateUser(Request $request){
	    $user_id = $request['user_deactivate_id'];
	    $status = 0;
	    $updated_by_name = Session::get('SIPP_Username');
	    $updated_by_id = Session::get('SIPP_IDSDM');

	    DB::statement("EXEC dbo.update_status_user @user_id='$user_id',@status='$status', @updated_by_name='$updated_by_name', @updated_by_id='$updated_by_id'");

		$message = "Info: User berhasil dinonaktifkan!";
  
    	return redirect('DaftarUsers')->with('message', $message);
	}

	public function UpdateUserData(Request $request){
	    $user_id = $request['user_edit_id'];
	    $role_id = $request['sipp_edit_role'];
	    $updated_by_name = Session::get('SIPP_Username');
	    $updated_by_id = Session::get('SIPP_IDSDM');

	    DB::statement("EXEC dbo.update_user @user_id='$user_id',@role_id='$role_id', @updated_by_name='$updated_by_name', @updated_by_id='$updated_by_id' ");

		$message = "Info: Data user berhasil diubah!";
  
    	return redirect('DaftarUsers')->with('message', $message);
	}


}
