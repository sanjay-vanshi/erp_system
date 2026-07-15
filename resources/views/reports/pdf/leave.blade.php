<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Leave Report</title>

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
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
            padding: 7px;

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
    Leave Report
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

    <th>From Date</th>

    <th>To Date</th>

    <th>Total Days</th>

    <th>Status</th>

    <th>Approved By</th>

</tr>

</thead>



<tbody>


@forelse($leaves as $leave)


<tr>


<td class="center">

{{ $loop->iteration }}

</td>



<td>

{{ $leave->employee->employee_code ?? '' }}

</td>



<td>

{{ $leave->employee->first_name ?? '' }}

{{ $leave->employee->last_name ?? '' }}

</td>



<td>

{{ $leave->employee->department->name ?? '' }}

</td>



<td>

{{ $leave->employee->designation->title ?? '' }}

</td>



<td>

{{ \Carbon\Carbon::parse($leave->from_date)->format('d-m-Y') }}

</td>



<td>

{{ \Carbon\Carbon::parse($leave->to_date)->format('d-m-Y') }}

</td>



<td class="center">

{{ $leave->total_days }}

</td>



<td class="center">

{{ ucfirst($leave->status) }}

</td>



<td>

{{ $leave->approver->name ?? '-' }}

</td>



</tr>


@empty


<tr>

<td colspan="10" class="center">

No leave records found.

</td>

</tr>


@endforelse



</tbody>


</table>



<div class="footer">

Total Records :
{{ $leaves->count() }}

</div>



</body>

</html>