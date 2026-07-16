@extends('layouts.erp')


@section('content')


<div class="container">


<div class="card">


<div class="card-header">

<h4>
Holiday Details
</h4>

</div>



<div class="card-body">


<table class="table table-bordered">


<tr>

<th>
Holiday Name
</th>


<td>
{{ $holiday->name }}
</td>

</tr>



<tr>

<th>
Holiday Date
</th>


<td>
{{ $holiday->holiday_date }}
</td>

</tr>



<tr>

<th>
Description
</th>


<td>
{{ $holiday->description }}
</td>

</tr>



<tr>

<th>
Status
</th>


<td>


@if($holiday->status)

<span class="badge bg-success">
Active
</span>


@else

<span class="badge bg-danger">
Inactive
</span>


@endif


</td>

</tr>



</table>



<a href="{{ route('holidays.index') }}"
class="btn btn-secondary">

Back

</a>


<a href="{{ route('holidays.edit',$holiday) }}"
class="btn btn-warning">

Edit

</a>



</div>


</div>


</div>



@endsection