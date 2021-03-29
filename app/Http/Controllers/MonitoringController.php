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

class MonitoringController extends Controller
{
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

  public function MonitoringSiluman()
  {
    return view('SilumanMonitor');
  }

  public function DaftarPerkara()
  {
    $getDaftarPerkara = DB::select("EXEC dbo.get_monitor_perkara");

    $data["content"] = $getDaftarPerkara;

    echo json_encode($data);
  }

  public function DaftarNotaris()
  {
    $getDaftarNotaris = DB::select("EXEC dbo.get_monitor_notaris");

    $data["content"] = $getDaftarNotaris;

    echo json_encode($data);
  }

  // public function DaftarPerdata()
  // {
  //   $getDaftarPerdata = DB::select("EXEC dbo.get_monitor_perdata");

  //   $data["content"] = $getDaftarPerdata;

  //   echo json_encode($data);
  // }

  // public function DaftarPidana()
  // {
  //   $getDaftarPidana = DB::select("EXEC dbo.get_monitor_pidana");

  //   $data["content"] = $getDaftarPidana;

  //   echo json_encode($data);
  // }

}
