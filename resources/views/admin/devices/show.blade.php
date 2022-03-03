@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid">
        <h4>Device
            <small>List</small>
        </h4>
    </div>
    @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
    @endif
    @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <td>Id</td>
                <td>Device Name</td>
                <td>Screen</td>
                <td>Ram</td>
                <td>Battery Capacity</td>
                <td>CPU</td>
                <td>Image</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @foreach($list_device as $device)
                <tr>
                    <td style="text-align:center">{{$device->id}}</td>
                    <td>{{$device->ModelOfPhone->brand['name'].' '.$device->ModelOfPhone['name'].$device->name}}</td>  
                    <td>{{$device->screen}}</td>  
                    <td>{{$device->ram}}</td>  
                    <td>{{$device->battery_capacity}}</td>  
                    <td>{{$device->cpu}}</td>  
                    <td><img src="{{asset('admin/upload/device/'.$device->image)}}" width="100%" height="60px"></td>              
                    <td style="text-align:center"><a href="{{asset('admin/devices/edit_device/'.$device->id)}}" class="btn btn-info">Edit</a></td>
                    <td style="text-align:center"><a href="{{asset('admin/devices/delete_device/'.$device->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
