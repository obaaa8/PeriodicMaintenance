<?php
namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;

class AdminReportController extends Controller {

  // technicians, rooms, buildings, devices
  public function getMaintenances()
  {
    $data = [];
    $data['buildings'] = DB::table('buildings')->select('id','number','name')->get();
    $data['rooms'] = DB::table('rooms')->select('id','number','name','buildings_id')->get();
    $data['technicians'] = DB::table('cms_users')->where('id_cms_privileges',3)->pluck('name');
    $data['devices'] = DB::table('devices')->select('id', 'brand', 'name', 'serial_number', 'ip', 'rooms_id')->get();
    $data['page_title'] = "Report :: Periodic Maintenances";
    return view('report.periodic_maintenances',$data);
  }

  //
  public function getMaintenancesGeneral(Request $rquest)
  {
    dd($rquest->type);
  }

  // type, building_name, building_type, building_form, building_to
  public function getMaintenancesBuilding(Request $rquest)
  {
    dd($rquest->type);
  }

  //
  public function getMaintenancesRoom(Request $rquest)
  {
    dd($rquest->type);
  }

  //
  public function getMaintenancesTechnician(Request $rquest)
  {
    dd($rquest->type);
  }

  // 
  public function getMaintenancesDevice(Request $rquest)
  {
    dd($rquest->type);
  }
}
