@extends('layouts.app')
@section('content')
	<div class="container">		
		<div class="mt-5 mx-auto" style="max-width: 600px;">
			<h5 class="text-center">TRA CỨU NGÀY CÔNG</h5>
			<form action="/ket-qua-tra-cuu" method="GET">
				<div class="form-group">
				  <label for="formGroupExampleInput">Công ty</label>
				{!! Form::select('congty', $clients , null, ['placeholder' => 'Select..', 'class' => 'form-control', 'required']) !!}	
				</div>
				<div class="form-group">
					<label>Tháng</label>
					<input name="thang" type="text" required="required" class="form-control datepickr"/>
				</div>
				<div class="form-group">
					<label for="formGroupExampleInput">CMND</label>
					<input name="cmt" type="text" class="form-control" placeholder="" required>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="submit" />
				</div>
			</form>
		</div>
	</div>

@endsection

@section('javascript')
	<script>
	flatpickr('.datepickr',{enableTime: false, dateFormat: "Y-m", allowInput: true});
	</script>
@endsection