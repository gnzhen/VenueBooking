<?php
use Carbon\Carbon;
?>
@extends('layouts.app')

@section('content')

 <!-- Bootstrap Boilerplate... -->

<div class="container">
	<div class="panel-body">
		<button class="btn btn-primary">
			<a href="{{ URL::route('home') }}" style="color:white;">Back
			</a>
		</button>
		<table class="table table-striped task-table">
			<thead>
				<tr>
					<th>Attribute</th>
					<th>Value</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>Booking Person</td>
					<td>{{ $request->user->user_id }}</td>
				</tr>
				<tr>
					<td>Venue</td>
					<td>{{ $request->venue->name }}</td>
				</tr>
				<tr>
					<td>Status</td>
					@if($request->status == "approved")
						<td style="color:green">
					@elseif ($request->status == "rejected") 
						<td style="color:red">
					@else
						<td>
					@endif
					{{ $request->status }}</td>
				</tr>
				<tr>
					<td>From</td>
					<td>{{ Carbon::parse($request->book_from)->format('d/m/y h:i A') }}</td>
				</tr>
				<tr>
					<td>To</td>
					<td>{{ Carbon::parse($request->book_to)->format('d/m/y h:i A') }}</td>
				</tr>
				<tr>
					<td>Reason</td>
					<td>{{ $request->reason }}</td>
				</tr>
			</tbody>
		</table>
		<div style="margin-bottom:10px;">
			{!! Form::model($request, ['route' => ['admin.update', $request->id], 'method' => 'PUT']) !!}

				<input type="hidden" name="status" value="approved">

				<button class="btn btn-success btn-lg btn-block" type="submit"> Approve Request
				</button>
			{!! Form::close() !!}
		</div>
		{!! Form::model($request, ['route' => ['admin.update', $request->id], 'method' => 'PUT']) !!}

			<input type="hidden" name="status" value="rejected">

			<button class="btn btn-danger btn-lg btn-block" type="submit"> Reject Request
			</button>
		{!! Form::close() !!}
	</div>
</div>
 @stop