@extends('layouts.app')
  
@section('content')
    <h1 class="h2 mb-2 text-gray-800">Show {{ ucfirst($table) }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a class="btn btn-warning btn-sm" href="/crud/{{$table}}">&larr;&nbsp;Back</a>
        </div>
        <div class="card-body">
          <div class="container">
              <div class="row">
                  @foreach($columnInfos as $key => $value)
                    @if(strpos($key, '_id') !== false)

                    <?php
                        $modelName = ucfirst(substr($key, 0, -3));
                        $nameField = ucfirst(substr($key, 0, -3)).'Name';
                        $string = '\\App\\'.ucfirst(substr($key, 0, -3)).'::find('.$model->{$key}.')->'.ucfirst(substr($key, 0, -3)).'Name';
                        $value = eval("return $string;");
                    ?>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{convertColumnNameToString($key)}}:</strong>
                            <span>{{ $value }}</span>
                        </div>
                    </div>

                    @elseif(strpos($key, 'Image') !== false)
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{convertColumnNameToString($key)}}:</strong>
                            <?php
                                $imageName = $model->{$key};
                            ?>
                            <span><img src='{{ asset("/images/employees/$imageName") }}' class="img-thumbnail" style="max-height: 100px;" /></span>
                        </div>
                    </div>
                    @else

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{convertColumnNameToString($key)}}:</strong>
                            <span>{{ $model->{$key} }}</span>
                        </div>
                    </div>

                    @endif
                @endforeach
              </div>  
          </div>
        </div>
      </div>
@endsection