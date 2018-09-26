@extends('crudbooster::admin_template')
@section('content')

  <h2>{{ trans('crudbooster.maintenances_report') }}</h2>

  <ul class="nav nav-tabs nav-justified">
      <li class="active"><a data-toggle="tab" href="#{{ trans('crudbooster.general') }}">{{ trans('crudbooster.general') }}</a></li>
      <li><a data-toggle="tab" href="#{{ trans('menu.Buildings') }}">{{ trans('menu.Buildings') }}</a></li>
      <li><a data-toggle="tab" href="#{{ trans('menu.Rooms') }}">{{ trans('menu.Rooms') }}</a></li>
      <li><a data-toggle="tab" href="#{{ trans('menu.Technician') }}">{{ trans('menu.Technician') }}</a></li>
      <li><a data-toggle="tab" href="#{{ trans('menu.Devices') }}">{{ trans('menu.Devices') }}</a></li>
    </ul>

    <div class="tab-content" style="padding:5px;">
      <div id="{{ trans('crudbooster.general') }}" class="tab-pane fade in active">
        <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('crudbooster.general') }}</h3>
    </div>
    <form action="{{ url ('admin/report/periodic_maintenances/general') }}" method="POST" enctype="multipart/form-data" >
      {!! csrf_field() !!}
      <input type="hidden" name="type" value="general">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="card" style="padding: 10px;">

            <div class="row">
              {{-- <div class="col-md-3">
                <label>{{ trans('crudbooster.general') }}</label>
                <input list="buildings" required="true" name="building_name" class="form-control" placeholder="{{ trans('crudbooster.general') }}" aria-describedby="basic-addon2">
                <datalist id="buildings">
                  @foreach ($buildings as $value)
                  <option value="{{ $value->name }}">
                  @endforeach
                </datalist>
              </div> --}}

              <div class="col-md-3">
                <div class="form-group">
                  <label>{{ trans('crudbooster.report_type') }}</label>
                  <select id="Shift_id" name="general_type" class="form-control border-input" required="true">
                    <option disabled selected value> -- {{  trans('crudbooster.datamodal_select') }} -- </option>
                    <option value="general_general">{{  trans('crudbooster.General') }}</option>
                    <option value="general_mini">{{  trans('crudbooster.mini') }}</option>
                  </select>
                </div>
              </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_from') }}</label>
                        <input type="date" required="true" name="general_form"class="form-control border-input">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_to') }}</label>
                        <input type="date" required="true" name="general_to"class="form-control border-input">
                    </div>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-success btn-float">{{  trans('crudbooster.Go') }}</button>
      </div>
    </form>
  </div>
      </div>
      <div id="{{ trans('menu.Buildings') }}" class="tab-pane fade">
        <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('menu.Buildings') }}</h3>
    </div>
    <form action="{{ url ('admin/report/periodic_maintenances/building') }}" method="POST" enctype="multipart/form-data" >
      {!! csrf_field() !!}
      <input type="hidden" name="type" value="building">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="card" style="padding: 10px;">

            <div class="row">
              <div class="col-md-3">
                <label>{{ trans('table.buildings_name') }}</label>
                <input list="buildings" required="true" name="building_name" class="form-control" placeholder="{{ trans('table.buildings_name') }}" aria-describedby="basic-addon2">
                <datalist id="buildings">
                  @foreach ($buildings as $value)
                  <option value="{{ $value->name }}">
                  @endforeach
                </datalist>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>{{ trans('crudbooster.report_type') }}</label>
                  <select id="Shift_id" name="building_type" class="form-control border-input" required="true">
                    <option disabled selected value> -- {{  trans('crudbooster.datamodal_select') }} -- </option>
                    <option value="building_general">{{  trans('crudbooster.General') }}</option>
                    <option value="building_mini">{{  trans('crudbooster.mini') }}</option>
                  </select>
                </div>
              </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_from') }}</label>
                        <input type="date" required="true" name="building_form"class="form-control border-input">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_to') }}</label>
                        <input type="date" required="true" name="building_to"class="form-control border-input">
                    </div>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-success btn-float">{{  trans('crudbooster.Go') }}</button>
      </div>
    </form>
  </div>
      </div>
      <div id="{{ trans('menu.Rooms') }}" class="tab-pane fade">
        <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('menu.Rooms') }}</h3>
    </div>
    <form action="{{ url ('admin/report/periodic_maintenances/room') }}" method="POST" enctype="multipart/form-data" >
      {!! csrf_field() !!}
      <input type="hidden" name="type" value="room">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="card" style="padding: 10px;">

            <div class="row">
              <div class="col-md-3">
                <label>{{ trans('table.rooms_number') }}</label>
                <input list="room" required="true" name="room_name" class="form-control" placeholder="{{ trans('table.rooms_number') }}" aria-describedby="basic-addon2">
                <datalist id="room">
                  @foreach ($rooms as $value)
                  <option value="{{ $value->number }}">
                  @endforeach
                </datalist>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>{{ trans('crudbooster.report_type') }}</label>
                  <select id="Shift_id" name="room_type" class="form-control border-input" required="true">
                    <option disabled selected value> -- {{  trans('crudbooster.datamodal_select') }} -- </option>
                    <option value="room_general">{{  trans('crudbooster.General') }}</option>
                    <option value="room_mini">{{  trans('crudbooster.mini') }}</option>
                  </select>
                </div>
              </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_from') }}</label>
                        <input type="date" required="true" name="room_{{  trans('crudbooster.filter_from') }}"class="form-control border-input">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_to') }}</label>
                        <input type="date" required="true" name="room_to"class="form-control border-input">
                    </div>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-success btn-float">{{  trans('crudbooster.Go') }}</button>
      </div>
    </form>
  </div>
      </div>
      <div id="{{ trans('menu.Technician') }}" class="tab-pane fade">
        <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('menu.Technician') }}</h3>
    </div>
    <form action="{{ url ('admin/report/periodic_maintenances/technician') }}" method="POST" enctype="multipart/form-data" >
      {!! csrf_field() !!}
      <input type="hidden" name="type" value="technician">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="card" style="padding: 10px;">

            <div class="row">
              <div class="col-md-3">
                <label>{{ trans('table.technicians_id') }}</label>
                <input list="technician" required="true" name="technician_name" class="form-control" placeholder="{{ trans('table.technicians_id') }}" aria-describedby="basic-addon2">
                <datalist id="technician">
                  @foreach ($technicians as $value)
                    <option value="{{ $value }}">
                  @endforeach
                </datalist>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>{{ trans('crudbooster.report_type') }}</label>
                  <select id="Shift_id" name="technician_type" class="form-control border-input" required="true">
                    <option disabled selected value> -- {{  trans('crudbooster.datamodal_select') }} -- </option>
                    <option value="technician_general">{{  trans('crudbooster.General') }}</option>
                    <option value="technician_mini">{{  trans('crudbooster.mini') }}</option>
                  </select>
                </div>
              </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_from') }}</label>
                        <input type="date" required="true" name="technician_{{  trans('crudbooster.filter_from') }}"class="form-control border-input">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_to') }}</label>
                        <input type="date" required="true" name="technician_to"class="form-control border-input">
                    </div>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-success btn-float">{{  trans('crudbooster.Go') }}</button>
      </div>
    </form>
  </div>
      </div>
      <div id="{{ trans('menu.Devices') }}" class="tab-pane fade">
        <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('menu.Devices') }}</h3>
    </div>
    <form action="{{ url ('admin/report/periodic_maintenances/device') }}" method="POST" enctype="multipart/form-data" >
      {!! csrf_field() !!}
      <input type="hidden" name="type" value="device">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="card" style="padding: 10px;">

            <div class="row">
              <div class="col-md-3">
                <label>{{ trans('table.devices_serial_number') }}</label>
                <input list="devices" required="true" name="device_name" class="form-control" placeholder="{{ trans('table.devices_serial_number') }}" aria-describedby="basic-addon2">
                <datalist id="devices">
                  @foreach ($devices as $value)
                  <option value="{{ $value->serial_number }}">
                  @endforeach
                </datalist>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>{{ trans('crudbooster.report_type') }}</label>
                  <select id="Shift_id" name="device_type" class="form-control border-input" required="true">
                    <option disabled selected value> -- {{  trans('crudbooster.datamodal_select') }} -- </option>
                    <option value="device_general">{{  trans('crudbooster.General') }}</option>
                    <option value="device_mini">{{  trans('crudbooster.mini') }}</option>
                  </select>
                </div>
              </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_from') }}</label>
                        <input type="date" required="true" name="device_form"class="form-control border-input">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{  trans('crudbooster.filter_to') }}</label>
                        <input type="date" required="true" name="device_to"class="form-control border-input">
                    </div>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-success btn-float">{{  trans('crudbooster.Go') }}</button>
      </div>
    </form>
  </div>
      </div>
    </div>
@endsection
