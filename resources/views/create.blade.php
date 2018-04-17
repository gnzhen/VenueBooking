<?php
 use App\Venue;
?>

@extends('layouts.app')

@section('content')
	<div class="container">
	
	<button class="btn btn-primary">
		<a href="{{ URL::route('home') }}" style="color:white;">Back
		</a>
	</button>
	
	<h2>New Booking</h2>

		<div class="panel-body">

			<!-- New Member Form -->
			{!! Form::open([
				'route' => ['request.store'],
				'class' => 'form-horizontal'
			]) !!}

			<!-- From -->
			<div class="form-group{{ $errors->has('book_from')? ' has-error' : '' }}">
                {!! Form::label('book_fromLabel', 'From', [
					'class' => 'control-label col-sm-3',
				]) !!}
                
				<div class="col-sm-6">
					<div class='input-group date' id='datetimepicker1'>
	                    <input type='text' class="form-control" name="book_from"/>
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>

                    @if ($errors->has('book_from'))
                        <span class="help-block">
                            <strong>{{ $errors->first('book_from') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- To -->
			<div class="form-group{{ $errors->has('book_to')? ' has-error' : '' }}">
                {!! Form::label('book_toLabel', 'To', [
					'class' => 'control-label col-sm-3',
				]) !!}
                
				<div class="col-sm-6">
					<div class='input-group date' id='datetimepicker2'>
	                    <input type='text' class="form-control" name="book_to"/>
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
	                
                    @if ($errors->has('book_to'))
                        <span class="help-block">
                            <strong>{{ $errors->first('book_to') }}</strong>
                        </span>
                    @endif 
                </div>
            </div>

			<!-- Venue -->
			<div class="form-group{{ $errors->has('venue_id')? ' has-error' : '' }}">
				{!! Form::label('venueLabel', 'Venue', [
					'class' => 'control-label col-sm-3',
				]) !!}

				<div class="col-sm-6">
					{!! Form::select('venue_id', Venue::pluck('name', 'id'), null, [
						'class' => 'form-control',
						'placeholder' => '- Select Venue -',
					]) !!}

					@if ($errors->has('venue_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('venue_id') }}</strong>
                        </span>
                    @endif 
				</div>
			</div>

			<!-- Reason -->
			<div class="form-group{{ $errors->has('reason')? ' has-error' : '' }}">
				{!! Form::label('reasonLabel', 'Reason', [
					'class' => 'control-label col-sm-3',
				]) !!}
				<div class="col-sm-6">
					{!! Form::textarea('reason', null, [
						'class' => 'form-control',
					]) !!}
					@if ($errors->has('reason'))
                        <span class="help-block">
                            <strong>{{ $errors->first('reason') }}</strong>
                        </span>
                    @endif 
				</div>
			</div>

			<!-- Submit Button -->
			<div class="form-group row">
				<div class="col-sm-offset-3 col-sm-6">
					{!! Form::button('Save', [
						'type' => 'submit',
						'class' => 'btn btn-success',
					]) !!}
				</div>
			</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		$(function () {
            $('#datetimepicker1').datetimepicker({
        		format: 'DD/MM/YY LT',
            });
	        $('#datetimepicker2').datetimepicker({
	        	format: 'DD/MM/YY LT',
	            useCurrent: false //Important! See issue #1075
	        });
	        $("#datetimepicker1").on("dp.change", function (e) {
	            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
	        });
	        $("#datetimepicker2").on("dp.change", function (e) {
	            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
	        });
        });
	</script>  
@endsection