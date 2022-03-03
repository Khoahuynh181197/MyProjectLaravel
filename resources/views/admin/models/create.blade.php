@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid">
        <h4>Model of Phone
            <small>
                @if(isset($check))
                    {{"Edit"}}
                @else
                    {{"Add"}}
                @endif
            </small>
        </h4>
    </div>
    @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif
    @if(isset($check))
    <form action="{{route('edit_model',['id'=>$model->id])}}" method="POST">
    @else
    <form action="{{route('add_model')}}" method="POST">
    @endif
        <div class="form-group">
            <label>Brand:</label>
            <select name="id_brand" class="form-control">
                <option value="">--Choose Brand--</option>
                @if(count($brand_list)>0&&isset($brand_list))
                    @foreach($brand_list as $brand)
                        @if(isset($model)&&($brand->id==$model->id_brand))
                        <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                        @else
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>  
        <div class="form-group">
            <label>Name of Model:</label>
            <input class="form-control" autocomplete="off" name="txtModelName" placeholder="Please Enter Model Name" value="@if(isset($check)){{$model->name}} @endif" />
            <input type="hidden" name="id" value="@if(isset($check)){{$model->id}} @endif">
        </div>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <button type="submit" class="btn btn-primary">
            @if(isset($check))
                {{"Update Model"}}
            @else
                {{"Add Model"}}
            @endif
        </button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
</div>
@endsection
