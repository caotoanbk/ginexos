@extends('layouts.app')

@section('content')
<h4 class="mt-1">Add New {{ ucfirst($table) }}</h4>
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-1">
      <a class="btn btn-warning btn-sm" href="/crud/{{$table}}">&larr;&nbsp;Back</a>
    </div>
    <div class="card-body">
      <form action="/crud/{{$table}}/store" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
          <?php
          $loop = 0;
          ?>
            @foreach($columnInfos as $key => $value)
                @if(strpos($key, '_id') !== false)
                    <?php
                    $loop = 1;
                    $modelName = ucfirst(substr($key, 0, -3));
                    $nameField = ucfirst(substr($key, 0, -3)).'Name';
                    $string = '\\App\\'.ucfirst(substr($key, 0, -3)).'::orderBy(ucfirst(substr($key, 0, -3))."Name", "asc")->pluck(ucfirst(substr($key, 0, -3))."Name", "id")';
                    ${'items'.$loop} = eval("return $string;");
                    ?>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <strong>{{convertColumnNameToString($key)}} <sup class="text-danger">*</sup></strong>
                            {!! Form::select($key, ${'items'.$loop}, null,['class' => 'form-control', 'placeholder' => 'select..', 'data-live-search' => 'true'] ) !!}
                        </div>
                    </div>
                @elseif($key=='ApprovalusersId')
                    <?php
                        $items = \App\User::pluck('name','id');
                    ?>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <strong>{{convertColumnNameToString($key)}} <sup class="text-danger">*</sup></strong>
                            {!! Form::select($key, $items, null,['class' => 'form-control', 'placeholder' => 'select..', 'data-live-search' => 'true'] ) !!}
                        </div>
                    </div>
                @elseif($key=='WusersId')
                    <?php
                        $item1s = \App\User::pluck('name','id');
                    ?>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <strong>{{convertColumnNameToString($key)}} <sup class="text-danger">*</sup></strong>
                            {!! Form::select($key, $item1s, null,['class' => 'form-control', 'placeholder' => 'select..', 'data-live-search' => 'true'] ) !!}
                        </div>
                    </div>
                @elseif($key=='WclientsLink')
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <strong>{{convertColumnNameToString($key)}}(<a href="https://script.google.com/macros/s/AKfycbxbjWPOnhNIAaMmw0Wp7Vyy9-jEnSTCb4B8PdBOa6STlWMw_G8/exec" target="_blank">Link to upload</a>)</strong>
                            <input type="text" name="{{$key}}" class="form-control" placeholder="">
                        </div>
                    </div>
                @else
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <strong>{{convertColumnNameToString($key)}} @if(strpos($key, 'Name') !== false) <sup class="text-danger">*</sup> @endif</strong>
                        <input @if(strpos($key, 'Password') !== false) type="password" @else type="text" @endif name="{{$key}}" class="form-control" placeholder="">
                    </div>
                </div>
    
                @endif
                <?php
                $loop++;
                ?>
            @endforeach

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
  </div>
</div>
@endsection


