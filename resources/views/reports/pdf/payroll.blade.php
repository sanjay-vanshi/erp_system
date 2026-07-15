<!DOCTYPE html>
<html>
<head>

<title>Payroll Report</title>

<style>

body {
    font-family: sans-serif;
    font-size: 12px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #000;
    padding: 5px;
    text-align: center;
}

th {
    font-weight: bold;
}

h3 {
    text-align: center;
}

</style>

</head>

<body>


<h3>
    Payroll Report
</h3>


<table>

<thead>

<tr>

<th>Employee Code</th>
<th>Employee Name</th>
<th>Department</th>
<th>Designation</th>
<th>Payroll Month</th>
<th>Basic Salary</th>
<th>Allowance</th>
<th>Deduction</th>
<th>Net Salary</th>
<th>Status</th>

</tr>

</thead>


<tbody>

@foreach($payrolls as $payroll)

<tr>

<td>
{{ $payroll->employee->employee_code ?? '' }}
</td>


<td>
{{ $payroll->employee->first_name ?? '' }}
{{ $payroll->employee->last_name ?? '' }}
</td>


<td>
{{ $payroll->employee->department->name ?? '' }}
</td>


<td>
{{ $payroll->employee->designation->title ?? '' }}
</td>


<td>
{{ $payroll->payroll_month }}
</td>


<td>
{{ $payroll->basic_salary }}
</td>


<td>
{{ $payroll->allowance }}
</td>


<td>
{{ $payroll->deduction }}
</td>


<td>
{{ $payroll->net_salary }}
</td>


<td>
{{ $payroll->payment_status }}
</td>


</tr>

@endforeach


</tbody>

</table>


</body>
</html>