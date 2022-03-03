@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid">
        <h4>Brand
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
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @foreach($brand_list as $brand)
                <tr>
                    <td style="text-align:center">{{$brand->id}}</td>
                    <td>{{$brand->name}}</td>                
                    <td style="text-align:center"><a href="{{asset('admin/brands/edit_brand/'.$brand->id)}}" class="btn btn-info">Edit</a></td>
                    <td style="text-align:center"><a href="{{asset('admin/brands/delete_brand/'.$brand->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
