@php
dd($result);
@endphp
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Building</th>
        <th>Room</th>
        <th>Device</th>
        <th>serial number</th>
        <th>Technician</th>
        <th>Report</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($result as $key => $value)
        {{-- <tr>
          <td>{{ $value[$key]['building'] }}</td>
          <td>{{ $value[$key]['room'] }}</td>
          <td>{{ $value[$key]['device'] }}</td>
          <td>{{ $value[$key]['devices_serial_number'] }}</td>
          <td>{{ $value[$key]['technician'] }}</td>
          <td>{{ $value[$key]['report'] }}</td>
          <td>{{ $value[$key]['created_at'] }}</td>
        </tr> --}}
      @endforeach
    {{--  --}}
    </tbody>
  </table>
