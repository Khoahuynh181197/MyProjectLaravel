@extends('admin.layouts.index')
@section('content')
<!-- @include('admin.layouts.menu') -->
<div class="content-container">
    <div class="container-fluid">
        <h4>Brand
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
    @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif
    @if(isset($check))
    <form action="{{route('edit_brand',['id'=>$brand->id])}}" method="POST">
    @else
    <form action="{{route('add_brand')}}" method="POST">
    @endif  
        <div class="form-group">
            <label>Brand Name</label>
            <input class="form-control" name="txtBrandName" autocomplete="off" placeholder="Please Enter Brand Name" value="@if(isset($check)){{$brand->name}} @endif" />
            <input type="hidden" name="id" value="@if(isset($check)){{$brand->id}} @endif">
        </div>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <button type="submit" class="btn btn-primary">
            @if(isset($check))
                {{"Update Brand"}}
            @else
                {{"Add Brand"}}
            @endif
        </button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
</div>
@endsection
