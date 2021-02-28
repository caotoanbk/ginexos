@extends('layouts.app')
@section('content')
<div class="card mt-3">
    <div class="card-header bg-info text-white text-center">Settings</div>
    <div class="card-body">
        <div class="row">
            @foreach($apps as $app)
            <div class="col-md-3 col-sm-6">
                <a class="btn btn-success w-100" title="{{$app->CrudappsName}}" href="{{route('crud.index', ['table' => $app->CrudappsName])}}">{{$app->CrudappsDescription}}</a>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection