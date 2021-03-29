<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SIPPController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardKhususController;
use App\Http\Controllers\SIPPAPIController;
use App\Http\Controllers\SIPPProcessController;
use App\Http\Controllers\MasterProcessController;
use App\Http\Controllers\ExportExcelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


#LOGINCONTROLLER
Route::get('login', [LoginController::class, 'getLogin']);
Route::get('login_sso', [LoginController::class, 'login_sso']);
Route::get('logout', [LoginController::class, 'logout']);

#DASHBOARDKHUSUSCONTROLLER
Route::get('dashboardkhusus', [DashboardKhususController::class, 'Dashboard']);
Route::get('list_agenda_dashboard', [DashboardKhususController::class, 'list_agenda_dashboard']);
Route::get('detail_data_dashboard', [DashboardKhususController::class, 'detail_data_dashboard']);
Route::get('list_rank', [DashboardKhususController::class, 'list_rank']);
Route::get('get_dashboard_pie', [DashboardKhususController::class, 'get_dashboard_pie']);
Route::get('get_notif_notaris', [DashboardKhususController::class, 'get_notif_notaris']);
Route::get('list_detail_transaction', [DashboardKhususController::class, 'list_detail_transaction']);
Route::get('get_kendala_list', [DashboardKhususController::class, 'get_kendala_list']);
Route::get('get_rekomendasi_list', [DashboardKhususController::class, 'get_rekomendasi_list']);
Route::get('list_notaris_khusus', [DashboardKhususController::class, 'list_notaris_khusus']);

#DASHBOARDCONTROLLER
Route::get('dashboard', [DashboardController::class, 'Dashboard']);            
Route::get('/', [DashboardController::class, 'Dashboard'])->name('Dashboard');

#USERCONTROLLER
Route::get('/DaftarRoles', [UserController::class, 'DaftarRoles'])->name('DaftarRoles');
Route::post('/PostUserRole', [UserController::class, 'PostUserRole'])->name('PostUserRole');
Route::post('/DeleteUserRole', [UserController::class, 'DeleteUserRole'])->name('DeleteUserRole');
Route::post('/ActivateUserRole', [UserController::class, 'ActivateUserRole'])->name('ActivateUserRole');
Route::post('/DeactivateUserRole', [UserController::class, 'DeactivateUserRole'])->name('DeactivateUserRole');
Route::post('/UpdateUserRole', [UserController::class, 'UpdateUserRole'])->name('UpdateUserRole');
Route::get('/DaftarUsers', [UserController::class, 'DaftarUsers'])->name('DaftarUsers');
Route::post('/PostUserData', [UserController::class, 'PostUserData'])->name('PostUserData');
Route::post('/ActivateUser', [UserController::class, 'ActivateUser'])->name('ActivateUser');
Route::post('/DeactivateUser', [UserController::class, 'DeactivateUser'])->name('DeactivateUser');
Route::post('/UpdateUserData', [UserController::class, 'UpdateUserData'])->name('UpdateUserData');

#SIPPCONTROLLER
//_______________________________View__________________________________//
Route::get('/TambahPP', [SIPPController::class, 'TambahPP'])->name('TambahPP');                 
Route::get('/DaftarPP', [SIPPController::class, 'DaftarPP'])->name('DaftarPP');          
Route::get('/HistoryPP', [SIPPController::class, 'HistoryPP'])->name('HistoryPP'); 
Route::get('/LaporanPP', [SIPPController::class, 'LaporanPP'])->name('LaporanPP'); 
Route::get('/TambahPN', [SIPPController::class, 'TambahPN'])->name('TambahPN'); 
Route::get('/DaftarPN', [SIPPController::class, 'DaftarPN'])->name('DaftarPN'); 
Route::get('/HistoryPN', [SIPPController::class, 'HistoryPN'])->name('HistoryPN'); 
Route::get('/LaporanPN', [SIPPController::class, 'LaporanPN'])->name('LaporanPN'); 
Route::get('/DaftarWilayah', [MasterController::class, 'DaftarWilayah'])->name('DaftarWilayah'); 
Route::get('/DaftarNotaris', [MasterController::class, 'DaftarNotaris'])->name('DaftarNotaris'); 

//___________________________________PROCESS_________________________________________//
Route::post('P_TambahPP', [SIPPProcessController::class, 'ProsesTambahPP']); 
Route::post('P_TambahStatusPerkara', [SIPPProcessController::class, 'ProsesTambahStatusPerkara']); 
Route::post('P_EditStatusPerkara', [SIPPProcessController::class, 'ProsesEditStatusPerkara']); 
Route::post('P_DeleteStatusPerkara', [SIPPProcessController::class, 'ProsesDeleteStatusPerkara']); 
Route::post('/PostSelesaiPerkara', [SIPPProcessController::class, 'SelesaiPerkara'])->name('SelesaiPerkara');
Route::post('/CabutGugatanPerkara', [SIPPProcessController::class, 'CabutGugatanPerkara'])->name('CabutGugatanPerkara');
Route::post('/deleteperkara', [SIPPProcessController::class, 'deleteperkara'])->name('deleteperkara');
Route::post('/deleteperkarahistory', [SIPPProcessController::class, 'deleteperkarahistory']);
Route::post('/PostPN', [SIPPProcessController::class, 'ProsesTambahPN'])->name('PostPN');
Route::post('/P_EditPN', [SIPPProcessController::class, 'ProsesEditPN']);
Route::post('/PostProsesPN', [SIPPProcessController::class, 'PostProsesPN'])->name('PostProsesPN');
Route::post('/EditProsesPN', [SIPPProcessController::class, 'EditProsesPN'])->name('EditProsesPN');
Route::post('/DeleteProsesPN', [SIPPProcessController::class, 'DeleteProsesPN'])->name('DeleteProsesPN');
Route::post('/SubmitCatatanNotaris', [SIPPProcessController::class, 'SubmitCatatanNotaris'])->name('SubmitCatatanNotaris');
Route::post('/unSubmitCatatanNotaris', [SIPPProcessController::class, 'unSubmitCatatanNotaris'])->name('unSubmitCatatanNotaris');
Route::post('P_EditPP', [SIPPProcessController::class, 'ProsesEditPP']);
Route::post('perpanjanganCN', [SIPPProcessController::class, 'perpanjanganCN']);
Route::post('AddWilayah', [MasterProcessController::class, 'AddWilayah'])->name('AddWilayah');
Route::post('EditWilayah', [MasterProcessController::class, 'EditWilayah'])->name('EditWilayah');
Route::post('AddNotaris', [MasterProcessController::class, 'AddNotaris'])->name('AddNotaris');
Route::post('EditNotaris', [MasterProcessController::class, 'EditNotaris'])->name('EditNotaris');
Route::post('DeleteNotaris', [MasterProcessController::class, 'DeleteNotaris'])->name('DeleteNotaris');
Route::post('UpdateModuleUser', [UserController::class, 'UpdateModuleUser'])->name('UpdateModuleUser');
Route::post('P_TambahUpayaHukum', [SIPPProcessController::class, 'ProsesTambahUpayaHukum'])->name('P_TambahUpayaHukum');
Route::post('deletedaftardebitur', [SIPPProcessController::class, 'deletedaftardebitur'])->name('deletedaftardebitur');
Route::post('deletePN', [SIPPProcessController::class, 'deletePN'])->name('deletePN');

//___________________________________AJAX_________________________________________//

Route::get('GetPerkaraPidanaId', [SIPPAPIController::class, 'GetPerkaraPidanaId']);
Route::get('TraceLaporan', [SIPPAPIController::class, 'TraceLaporan']);
Route::get('GetKronologisPerkara', [SIPPAPIController::class, 'GetKronologisPerkara']);
Route::get('list_status_perkara', [SIPPAPIController::class, 'list_status_perkara']);
Route::get('list_proses_hukum', [SIPPAPIController::class, 'list_proses_hukum']);
Route::get('list_upaya_hukum', [SIPPAPIController::class, 'list_upaya_hukum']);
Route::get('list_unit', [SIPPAPIController::class, 'list_unit']);
Route::get('list_daftar_notaris', [SIPPAPIController::class, 'list_daftar_notaris']);
Route::get('list_cabang', [SIPPAPIController::class, 'list_cabang']); 
Route::get('list_area', [SIPPAPIController::class, 'list_area']); 
Route::get('/GetNoteNotarisBerjalan', [SIPPAPIController::class, 'CatatanJaminanBerjalan']); 
Route::get('/GetDetailNotaris', [SIPPAPIController::class, 'GetDetailNotaris']); 
Route::post('/list_perkara', [SIPPAPIController::class, 'list_perkara']);   
Route::post('list_notaris', [SIPPAPIController::class, 'list_notaris']);   
Route::get('list_status_putusan', [SIPPAPIController::class, 'list_status_putusan']);             
Route::get('list_schedule_agenda', [SIPPAPIController::class, 'list_schedule_agenda']);    
Route::get('get_detail_header/{type}', [SIPPAPIController::class, 'get_detail_header']); 
Route::get('get_status_pengikatan', [SIPPAPIController::class, 'get_status_pengikatan']); 
Route::get('getModuleRole', [MasterController::class, 'getmodulerole']); 
Route::get('list_dasar_gugatan', [SIPPAPIController::class, 'listdasargugatan']); 
Route::get('mapping_jenis_agunan', [SIPPAPIController::class, 'mapping_jenis_agunan']); 
Route::get('mapping_pidana', [SIPPAPIController::class, 'mapping_pidana']); 
Route::get('get_detail_laporan_notaris', [SIPPAPIController::class, 'get_detail_laporan_notaris']); 
Route::get('list_rank', [DashboardController::class, 'list_rank']);
Route::get('/notic_number', [SIPPAPIController::class, 'notic_number']);  
Route::get('get_notice', [SIPPAPIController::class, 'get_notice']);  
Route::get('list_tracelaporan', [SIPPAPIController::class, 'list_tracelaporan']);  
Route::get('download_resume', [SIPPAPIController::class, 'download_resume']);
Route::get('get_notif_notaris', [DashboardController::class, 'get_notif_notaris']);
Route::get('search_notaris', [SIPPAPIController::class, 'search_notaris']);
Route::get('get_kendala_reason', [SIPPAPIController::class, 'get_kendala_reason']);
Route::get('download_laporan_notaris', [ExportExcelController::class, 'download_laporan_notaris']);




