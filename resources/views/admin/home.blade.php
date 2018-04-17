<?php
use Carbon\Carbon;
?>

@extends('layouts.app')

@section('content')
<div class="container">
	<h2>Requests</h2>
    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">

		@if (count($requests) > 0)
			<table class="table table-striped task-table">
				<!-- Table Headings -->
				<thead>
					<tr>
						<th>Venue</th>
						<th>From</th>
						<th>To</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>

				<!-- Table Body -->
				<tbody>
					@foreach ($requests as $request)
						<tr>
							<td><div>{{ $request->venue->name }}</div></td>
							<td><div>{{ Carbon::parse($request->book_from)->format('d/m/y h:i A') }}</div></td>
							<td><div>{{ Carbon::parse($request->book_to)->format('d/m/y h:i A') }}</div></td>
							<td>
								@if($request->status == "approved")
									<div style="color:green">
								@elseif ($request->status == "rejected") 
									<div style="color:red">
								@else
									<div>
								@endif
								{{ $request->status }}</div></td>
								<td>
									<button class="btn btn-success btn-sm">
										<a href="{{ URL::route('admin.show', ['id' => $request->id]) }}" style="color:white;">View
										</a>
									</button>
								</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div style="float:right;">{{ $requests->links() }}</div>
		@else
			<div>
				No records found
			</div>
		@endif
    </div>
</div>
@endsection
