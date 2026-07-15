<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Attendance Report</title>

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }


        .title {

            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;

        }


        .date {

            text-align: right;
            font-size: 11px;
            margin-bottom: 15px;

        }


        table {

            width: 100%;
            border-collapse: collapse;

        }


        table,
        th,
        td {

            border: 1px solid #000;

        }


        th {

            background: #eeeeee;
            text-align: center;
            padding: 8px;

        }


        td {

            padding: 6px;

        }


        .center {

            text-align: center;

        }


        .footer {

            margin-top: 20px;
            text-align: right;
            font-size: 10px;

        }


    </style>

</head>


<body>


<div class="title">
    Attendance Report
</div>


<div class="date">

Generated :
{{ now()->format('d-m-Y h:i A') }}

</div>



<table>


<thead>

<tr>

    <th>#</th>

    <th>Employee Code</th>

    <th>Employee Name</th>

    <th>Department</th>

    <th>Designation</th>

    <th>Date</th>

    <th>Status</th>


</tr>

</thead>



<tbody>


@forelse($attendances as $attendance)


<tr>


<td class="center">

{{ $loop->iteration }}

</td>



<td>

{{ $attendance->employee->employee_code ?? '' }}

</td>



<td>

{{ $attendance->employee->first_name ?? '' }}

{{ $attendance->employee->last_name ?? '' }}

</td>



<td>

{{ $attendance->employee->department->name ?? '' }}

</td>



<td>

{{ $attendance->employee->designation->title ?? '' }}

</td>



<td>

{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d-m-Y') }}

</td>



<td class="center">

{{ ucfirst($attendance->status) }}

</td>



</tr>



@empty


<tr>

<td colspan="7" class="center">

No attendance records found.

</td>

</tr>


@endforelse



</tbody>


</table>



<div class="footer">

Total Records :
{{ $attendances->count() }}

</div>



</body>

</html>