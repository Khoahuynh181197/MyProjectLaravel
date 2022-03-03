@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid">
        <h4>Model
            <small>List</small>
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
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <td>Id</td>
                <td>Brand Name</td>
                <td>Model Name</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @foreach($list_model as $model)
                <tr>
                    <td style="text-align:center">{{$model->id}}</td>
                    <td>{{$model->brand['name']}}</td>   
                    <td>{{$model->name}}</td>                              
                    <td style="text-align:center"><a href="{{asset('admin/models/edit_model/'.$model->id)}}" class="btn btn-info">Edit</a></td>
                    <td style="text-align:center"><a href="{{asset('admin/models/delete_model/'.$model->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
