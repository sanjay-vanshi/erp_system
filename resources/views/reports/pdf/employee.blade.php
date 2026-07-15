<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Employee Report</title>

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
            margin-bottom: 15px;
            font-size: 11px;
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
            font-weight: bold;
            text-align: center;
            padding: 8px;
        }

        td {
            padding: 6px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
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
        Employee Report
    </div>

    <div class="date">
        Generated :
        {{ now()->format('d-m-Y h:i A') }}
    </div>

    <table>

        <thead>

            <tr>

                <th>#</th>

                <th>Code</th>

                <th>Name</th>

                <th>Department</th>

                <th>Designation</th>

                <th>Email</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @forelse($employees as $employee)

                <tr>

                    <td class="center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $employee->employee_code }}
                    </td>

                    <td>
                        {{ $employee->first_name }}
                        {{ $employee->last_name }}
                    </td>

                    <td>
                        {{ $employee->department->name }}
                    </td>

                    <td>
                        {{ $employee->designation->title }}
                    </td>

                    <td>
                        {{ $employee->email }}
                    </td>

                    <td class="center">
                        {{ ucfirst($employee->status) }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="center">
                        No records found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">
        Total Employees : {{ $employees->count() }}
    </div>

</body>

</html>