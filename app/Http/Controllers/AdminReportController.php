<?php
namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use CRUDBooster;

class AdminReportController
{

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
    $general_from = Carbon::parse($rquest->general_from)->format('Y-m-d 00:00:00');
    $general_to = Carbon::parse($rquest->general_to)->format('Y-m-d 00:00:00');

    if ($rquest->general_type == 'general_general') {
      $periodic_maintenances = DB::table('periodic_maintenances')
      ->whereDate('created_at','>=',$general_from)
      ->whereDate('created_at','<=',$general_to)
      ->get();

    if ($periodic_maintenances->toArray() == null) {
      return back()->with('error', 'لا توجد بيانات!');
    }

      $result = [];
      $x=0;
      foreach ($periodic_maintenances as $key => $value) {
        $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
        $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
        $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
        $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

        $result[$x][trans('table.number')]              = $x+1;
        $result[$x][trans('table.buildings_name')]              = $building;
        $result[$x][trans('table.rooms_name')]                  = $room->name;
        $result[$x][trans('table.devices')]                = $device->name;
        $result[$x][trans('table.devices_serial_number')] = $value->devices_serial_number;
        $result[$x][trans('table.technicians_id')]            = $technician->name;
        $result[$x][trans('table.report')]                = $value->report;
        $result[$x][trans('table.created_at')]            = $value->created_at;
        $x++;
      }
      return Excel::create('Maintenance General | '.Carbon::parse($rquest->general_from)->format('Y-m-d').' - '.Carbon::parse($rquest->general_to)->format('Y-m-d'), function($excel) use ($result) {
        $excel->sheet('mySheet', function($sheet) use ($result)
          {
            // $sheet->fromArray($result);
            $sheet->fromArray($result, null, 'A1', true);
          });
      })->download('xls');

    }elseif ($rquest->general_type == 'general_mini') {
      $periodic_maintenances = DB::table('periodic_maintenances')
      ->whereDate('created_at','>=',$general_from)
      ->whereDate('created_at','<=',$general_to)
      ->get();
      $result = [];
      $x=0;
      foreach ($periodic_maintenances as $key => $value) {
        $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
        $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
        $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
        $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

        $result[$x][trans('table.number')]              = $x+1;
        $result[$x][trans('table.buildings_name')]              = $building;
        $result[$x][trans('table.rooms_name')]                  = $room->name;
        $result[$x][trans('table.devices')]                = $device->name;
        $result[$x][trans('table.technicians_id')]            = $technician->name;
        $result[$x][trans('table.created_at')]            = $value->created_at;
        $x++;
      }
      return Excel::create('Maintenance General | '.Carbon::parse($rquest->general_from)->format('Y-m-d').' - '.Carbon::parse($rquest->general_to)->format('Y-m-d'), function($excel) use ($result) {
        $excel->sheet('mySheet', function($sheet) use ($result)
          {
            // $sheet->fromArray($result);
            $sheet->fromArray($result, null, 'A1', true);
          });
      })->download('xls');

    }

  }

  // type, building_name, building_type, building_form, building_to
  public function getMaintenancesBuilding(Request $rquest)
  {

    $building_from = Carbon::parse($rquest->building_from)->format('Y-m-d 00:00:00');
    $building_to = Carbon::parse($rquest->building_to)->format('Y-m-d 00:00:00');

    $buildings_id = DB::table('buildings')->where('name',$rquest->building_name)->value('id');
    $rooms_id = DB::table('rooms')->where('buildings_id',$buildings_id)->value('id');
    $serial_numbers = DB::table('devices')->where('rooms_id',$rooms_id)->pluck('serial_number')->toArray();

    $periodic_maintenances = DB::table('periodic_maintenances')
    ->whereDate('created_at','>=',$building_from)
    ->whereDate('created_at','<=',$building_to)
    ->whereIn('devices_serial_number',$serial_numbers)
    ->get();

    if ($periodic_maintenances->toArray() == null) {
      return back()->with('error', 'لا توجد بيانات!');
    }

    if ($rquest->building_type == 'building_general') {
      $result = [];
      $x=0;
      foreach ($periodic_maintenances as $key => $value) {
        $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
        $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
        $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
        $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

        $result[$x][trans('table.number')]              = $x+1;
        $result[$x][trans('table.buildings_name')]              = $building;
        $result[$x][trans('table.rooms_name')]                  = $room->name;
        $result[$x][trans('table.devices')]                = $device->name;
        $result[$x][trans('table.devices_serial_number')] = $value->devices_serial_number;
        $result[$x][trans('table.technicians_id')]            = $technician->name;
        $result[$x][trans('table.report')]                = $value->report;
        $result[$x][trans('table.created_at')]            = $value->created_at;
        $x++;
      }
      return Excel::create('Maintenance Building | '.Carbon::parse($rquest->building_from)->format('Y-m-d').' - '.Carbon::parse($rquest->building_to)->format('Y-m-d'), function($excel) use ($result) {
        $excel->sheet('mySheet', function($sheet) use ($result)
          {
            // $sheet->fromArray($result);
            $sheet->fromArray($result, null, 'A1', true);
          });
      })->download('xls');

    }elseif ($rquest->building_type == 'building_mini') {
      $result = [];
      $x=0;
      foreach ($periodic_maintenances as $key => $value) {
        $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
        $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
        $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
        $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

        $result[$x][trans('table.number')]              = $x+1;
        $result[$x][trans('table.buildings_name')]              = $building;
        $result[$x][trans('table.rooms_name')]                  = $room->name;
        $result[$x][trans('table.devices')]                = $device->name;
        $result[$x][trans('table.technicians_id')]            = $technician->name;
        $result[$x][trans('table.created_at')]            = $value->created_at;
        $x++;
      }
      return Excel::create('Maintenance Building | '.Carbon::parse($rquest->building_from)->format('Y-m-d').' - '.Carbon::parse($rquest->building_to)->format('Y-m-d'), function($excel) use ($result) {
        $excel->sheet('mySheet', function($sheet) use ($result)
          {
            $sheet->fromArray($result, null, 'A1', true);
          });
      })->download('xls');

    }
  }

  //
  public function getMaintenancesRoom(Request $rquest)
  {
    $room_from = Carbon::parse($rquest->room_from)->format('Y-m-d 00:00:00');
    $room_to = Carbon::parse($rquest->room_to)->format('Y-m-d 00:00:00');

    // $buildings_id = DB::table('buildings')->where('name',$rquest->building_name)->value('id');
    $rooms_id = DB::table('rooms')->where('number',$rquest->rooms_number)->value('id');
    $serial_numbers = DB::table('devices')->where('rooms_id',$rooms_id)->pluck('serial_number')->toArray();

    $periodic_maintenances = DB::table('periodic_maintenances')
    ->whereDate('created_at','>=',$room_from)
    ->whereDate('created_at','<=',$room_to)
    ->whereIn('devices_serial_number',$serial_numbers)
    ->get();

    if ($periodic_maintenances->toArray() == null) {
      return back()->with('error', 'لا توجد بيانات!');
    }

    if ($rquest->room_type == 'room_general') {
      $result = [];
      $x=0;
      foreach ($periodic_maintenances as $key => $value) {
        $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
        $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
        $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
        $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

        $result[$x][trans('table.number')]              = $x+1;
        $result[$x][trans('table.buildings_name')]              = $building;
        $result[$x][trans('table.rooms_name')]                  = $room->name;
        $result[$x][trans('table.devices')]                = $device->name;
        $result[$x][trans('table.devices_serial_number')] = $value->devices_serial_number;
        $result[$x][trans('table.technicians_id')]            = $technician->name;
        $result[$x][trans('table.report')]                = $value->report;
        $result[$x][trans('table.created_at')]            = $value->created_at;
        $x++;
      }
      return Excel::create('Maintenance Room | '.Carbon::parse($rquest->room_from)->format('Y-m-d').' - '.Carbon::parse($rquest->room_to)->format('Y-m-d'), function($excel) use ($result) {
        $excel->sheet('mySheet', function($sheet) use ($result)
          {
            // $sheet->fromArray($result);
            $sheet->fromArray($result, null, 'A1', true);
          });
      })->download('xls');

    }elseif ($rquest->room_type == 'room_mini') {
      $result = [];
      $x=0;
      foreach ($periodic_maintenances as $key => $value) {
        $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
        $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
        $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
        $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

        $result[$x][trans('table.number')]              = $x+1;
        $result[$x][trans('table.buildings_name')]              = $building;
        $result[$x][trans('table.rooms_name')]                  = $room->name;
        $result[$x][trans('table.devices')]                = $device->name;
        $result[$x][trans('table.technicians_id')]            = $technician->name;
        $result[$x][trans('table.created_at')]            = $value->created_at;
        $x++;
      }
      return Excel::create('Maintenance Room | '.Carbon::parse($rquest->room_from)->format('Y-m-d').' - '.Carbon::parse($rquest->room_to)->format('Y-m-d'), function($excel) use ($result) {
        $excel->sheet('mySheet', function($sheet) use ($result)
          {
            // $sheet->fromArray($result);
            $sheet->fromArray($result, null, 'A1', true);
          });
      })->download('xls');

    }

  }

  //
  public function getMaintenancesTechnician(Request $rquest)
  {

    $technician_from = Carbon::parse($rquest->technician_from)->format('Y-m-d 00:00:00');
    $technician_to = Carbon::parse($rquest->technician_to)->format('Y-m-d 00:00:00');

    $technician_id = DB::table('cms_users')->where('name',$rquest->technician_name)->value('id');

    $periodic_maintenances = DB::table('periodic_maintenances')
    ->whereDate('created_at','>=',$technician_from)
    ->whereDate('created_at','<=',$technician_to)
    ->where('technicians_id',$technician_id)
    ->get();
    // dd($periodic_maintenances->toArray());
    if ($periodic_maintenances->toArray() == null) {
      return back()->with('error', 'لا توجد بيانات!');
    }

    if ($rquest->technician_type == 'technician_general') {
      $result = [];
      $x=0;
      foreach ($periodic_maintenances as $key => $value) {
        $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
        $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
        $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
        $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

        $result[$x][trans('table.number')]              = $x+1;
        $result[$x][trans('table.buildings_name')]              = $building;
        $result[$x][trans('table.rooms_name')]                  = $room->name;
        $result[$x][trans('table.devices')]                = $device->name;
        $result[$x][trans('table.devices_serial_number')] = $value->devices_serial_number;
        $result[$x][trans('table.technicians_id')]            = $technician->name;
        $result[$x][trans('table.report')]                = $value->report;
        $result[$x][trans('table.created_at')]            = $value->created_at;
        $x++;
      }
      return Excel::create('Technician Maintenance | '.Carbon::parse($rquest->technician_from)->format('Y-m-d').' - '.Carbon::parse($rquest->technician_to)->format('Y-m-d'), function($excel) use ($result) {
        $excel->sheet('mySheet', function($sheet) use ($result)
          {
            // $sheet->fromArray($result);
            $sheet->fromArray($result, null, 'A1', true);
          });
      })->download('xls');

    }elseif ($rquest->technician_type == 'technician_mini') {
      $result = [];
      $x=0;
      foreach ($periodic_maintenances as $key => $value) {
        $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
        $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
        $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
        $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

        $result[$x][trans('table.number')]              = $x+1;
        $result[$x][trans('table.buildings_name')]              = $building;
        $result[$x][trans('table.rooms_name')]                  = $room->name;
        $result[$x][trans('table.devices')]                = $device->name;
        $result[$x][trans('table.technicians_id')]            = $technician->name;
        $result[$x][trans('table.created_at')]            = $value->created_at;
        $x++;
      }
      return Excel::create('Technician Maintenance | '.Carbon::parse($rquest->technician_from)->format('Y-m-d').' - '.Carbon::parse($rquest->technician_to)->format('Y-m-d'), function($excel) use ($result) {
        $excel->sheet('mySheet', function($sheet) use ($result)
          {
            // $sheet->fromArray($result);
            $sheet->fromArray($result, null, 'A1', true);
          });
      })->download('xls');

    }

  }

  //
  public function getMaintenancesDevice(Request $rquest)
  {
    $device_from = Carbon::parse($rquest->device_from)->format('Y-m-d 00:00:00');
    $device_to = Carbon::parse($rquest->device_to)->format('Y-m-d 00:00:00');
    $periodic_maintenances = DB::table('periodic_maintenances')
    ->whereDate('created_at','>=',$device_from)
    ->whereDate('created_at','<=',$device_to)
    ->where('devices_serial_number',$rquest->devices_serial_number)
    ->get();
    // dd($periodic_maintenances->toArray());
    if ($periodic_maintenances->toArray() == null) {
      return back()->with('error', 'لا توجد بيانات!');
    }

    if ($rquest->device_type == 'device_general') {
          $result = [];
          $x=0;
          foreach ($periodic_maintenances as $key => $value) {
            $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
            $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
            $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
            $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

            $result[$x][trans('table.number')]              = $x+1;
            $result[$x][trans('table.buildings_name')]              = $building;
            $result[$x][trans('table.rooms_name')]                  = $room->name;
            $result[$x][trans('table.devices')]                = $device->name;
            $result[$x][trans('table.devices_serial_number')] = $value->devices_serial_number;
            $result[$x][trans('table.technicians_id')]            = $technician->name;
            $result[$x][trans('table.report')]                = $value->report;
            $result[$x][trans('table.created_at')]            = $value->created_at;
            $x++;
          }
          return Excel::create('Devices Maintenance | '.Carbon::parse($rquest->device_from)->format('Y-m-d').' - '.Carbon::parse($rquest->device_to)->format('Y-m-d'), function($excel) use ($result) {
            $excel->sheet('mySheet', function($sheet) use ($result)
              {
                // $sheet->fromArray($result);
                $sheet->fromArray($result, null, 'A1', true);
              });
          })->download('xls');

        }elseif ($rquest->device_type == 'device_mini') {
          $result = [];
          $x=0;
          foreach ($periodic_maintenances as $key => $value) {
            $device = DB::table('devices')->where('serial_number',$value->devices_serial_number)->first();
            $room = DB::table('rooms')->where('id',$device->rooms_id)->first();
            $building = DB::table('buildings')->where('id',$room->buildings_id)->value('name');
            $technician = DB::table('cms_users')->where('id',$value->technicians_id)->first();

            $result[$x][trans('table.number')]              = $x+1;
            $result[$x][trans('table.buildings_name')]              = $building;
            $result[$x][trans('table.rooms_name')]                  = $room->name;
            $result[$x][trans('table.devices')]                = $device->name;
            $result[$x][trans('table.technicians_id')]            = $technician->name;
            $result[$x][trans('table.created_at')]            = $value->created_at;
            $x++;
          }
          return Excel::create('Devices Maintenance | '.Carbon::parse($rquest->device_from)->format('Y-m-d').' - '.Carbon::parse($rquest->device_to)->format('Y-m-d'), function($excel) use ($result) {
            $excel->sheet('mySheet', function($sheet) use ($result)
              {
                $sheet->fromArray($result, null, 'A1', true);
              });
          })->download('xls');

        }

  }

}
