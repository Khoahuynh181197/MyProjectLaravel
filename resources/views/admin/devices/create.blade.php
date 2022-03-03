@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid">
        <h4>Mobile Phone
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
    @if(session('error')&&session('error')!="")
        <div class="alert alert-success">{{session('error')}}</div>
    @endif
    @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif
    @if(isset($check))
    <form action="{{route('edit_device',['id'=>$device->id])}}" method="POST" enctype="multipart/form-data">
    @else
    <form action="{{route('add_device')}}" method="POST" enctype="multipart/form-data">
    @endif
        <div class="form-group">
            <label>Brand:</label>
            <select name="id_brand" id="select_brand" class="form-control">
                <option value="">--Choose Brand--</option>
                @if(count($brand_list)>0)
                    @foreach($brand_list as $brand)
                        @if(isset($check)&&$brand->id==$device->ModelOfPhone->id_brand)                      
                            <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                        @else
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label>Model:</label>
            <select name="id_model" id="select_model" class="form-control">
                <option value="">--Choose Model--</option>
                @if(isset($check)&&count($model_list)>0)
                    @foreach($model_list as $model)
                        @if($model->id==$device->id_model)
                            <option value="{{$model->id}}" selected>{{$model->name}}</option>
                        @else
                            <option value="{{$model->id}}">{{$model->name}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>  
        <div class="form-group">
            <label>Name of device:</label>
            <input class="form-control" autocomplete="off" name="txtDeviceName" placeholder="Please Enter Device Name" value="@if(isset($check)){{$device->name}} @endif" />
            <input type="hidden" name="id" value="@if(isset($check)){{$device->id}} @endif">
        </div>
        <div class="form-group">
            <label>Screen:</label>
            <input type="text" class="form-control" name="screen" autocomplete="off" placeholder="Please Enter Information of Screen" value="@if(isset($check)){{$device->screen}} @endif">
        </div>
        <div class="form-group">
            <label>Ram:</label>
            <input type="text" class="form-control" name="ram" autocomplete="off"  placeholder="Please Enter Information of Ram" value="@if(isset($check)){{$device->ram}} @endif">
        </div>
        <div class="form-group">
            <label>Battery Capacity:</label>
            <input type="text" class="form-control" name="battery_capacity" autocomplete="off"  placeholder="Please Enter Information of Battery Capacity" value="@if(isset($check)){{$device->battery_capacity}} @endif">
        </div>
        <div class="form-group">
            <label>CPU:</label>
            <input type="text" class="form-control" name="cpu" autocomplete="off"  placeholder="Please Enter Information of CPU" value="@if(isset($check)){{$device->cpu}} @endif">
        </div>
        <div>
            <label>Image:</label><br>
            @if(isset($check))
                <img src="{{asset('admin/upload/device/'.$device->image)}}" width="20%" height="200px">
            @endif          
            <input type="file" class="form-control" name="image_device">
        </div>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group" style="margin-top:10px;">
            <button type="submit" class="btn btn-primary">
                @if(isset($check))
                    {{"Update Device"}}
                @else
                    {{"Add Device"}}
                @endif
            </button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>   
    </form>
</div>
@endsection
