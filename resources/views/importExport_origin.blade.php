<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>


<body>
<br/>
<br/>
	<div class="container">		
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title" style="padding:12px 0px;font-size:25px;"><strong>Tải lên bảng công tháng</strong></h3>
		  </div>
		  <div class="panel-body">


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


				<h3>Import File Form:</h3>
				<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label for="" class="control-label col-sm-2">Excel File:</label>
						<div class="col-sm-10">
							<input type="file" name="import_file" style="border: none; margin-top:5px;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>

						</div>
					</div>
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label col-sm-2">Công ty</label>
						<div class="col-sm-8">
					<select name="congty" id="congty" class="form-control">
						<option value="">Haesung</option>
						<option value="">LG Display</option>
					</select>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-2">Tháng:</label>
						<div class="col-sm-8">

							<input type="text" placeholder="tháng" class="form-control"/>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" class="btn btn-primary">Import CSV or Excel File</button>
							</div>	
					</div>


				</form>
				<br/>

		    	
		    	<h3>Import File From Database:</h3>
		    	<div style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;"> 		
			    	<a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success btn-lg">Download Excel xls</button></a>
					<a href="{{ url('downloadExcel/xlsx') }}"><button class="btn btn-success btn-lg">Download Excel xlsx</button></a>
					<a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-success btn-lg">Download CSV</button></a>
		    	</div>


		  </div>
		</div>
	</div>


</body>


</html>