@extends('layouts.app')
@section('content')
	<div class="container">		
		<div class="mt-3">
		  <div>
		  		@if ($message = Session::get('success'))
					<div class="alert alert-success" role="alert">
						{{ Session::get('success') }}
					</div>
				@endif


				@if ($message = Session::get('error'))
					<div class="alert alert-danger" role="alert">
						{{ Session::get('error') }}
					</div>
				@endif


				<h3 class="text-center mt-4">Upload bảng công</h3>
				<form class="mx-auto border border-secondary rounded" style=";margin-top: 15px;padding: 20px; max-width: 500px;" action="{{ URL::to('importExcel') }}" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="" class="control-label col-sm-12">Excel File <a href="/uploads/BANG_CONG_UPLOAD_MAU.xlsx">&lt;Tải file mẫu&gt;</a></label>
						<div class="col-sm-12">
							<input required type="file" name="import_file" style="border: none; margin-top:5px;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>

						</div>
					</div>
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label col-sm-4">Công ty</label>
						<div class="col-sm-12">
						{!! Form::select('congty', $clients , null, ['placeholder' => 'Select..', 'class' => 'form-control', 'required']) !!}
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-4">Ngày</label>
						<div class="col-sm-12">

							<input name="ngaylam" type="text" required="required" class="form-control datepickr"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Loại ngày</label>
						<div class="col-sm-12">
						{!! Form::select('day_type', ['0' => 'Ngày thường', '1' => 'Ngày nghỉ', '2' => 'Ngày lễ'] , null, ['placeholder' => 'Select..', 'class' => 'form-control', 'required']) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" class="btn btn-primary">Upload</button>
							</div>	
					</div>


				</form>


		  </div>
		</div>
	</div>

@endsection

@section('javascript')
	<script>
	flatpickr('.datepickr',{enableTime: false, dateFormat: "Y-m-d", allowInput: true});
	</script>
@endsection