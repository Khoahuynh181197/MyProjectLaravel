@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid">
        <h4>User
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
    <form action="{{route('edit_user',['id'=>$user->id])}}" method="POST">
    @else
    <form action="{{route('add_user')}}" method="POST">
    @endif  
        <div class="form-group">
            <label>Username:</label>
            <input class="form-control" name="txtUsername" autocomplete="off" placeholder="Please Enter Username" value="@if(isset($check)){{$user->name}} @endif" />
            <input type="hidden" name="id" value="@if(isset($check)){{$user->id}} @endif">
        </div>
        <div class="form-group">
            <label>Birthday:</label>
            <select name="day" style="margin-left:30px">
                <option value="">--Choose Day--</option>
                @for($i=1;$i<=31;$i++)
                    @if(isset($check)&&date("d",strtotime($user->birthday))==$i)
                        <option value="{{$i}}" selected>{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif
                @endfor
            </select>
            <select name="month">
                <option value="">--Choose Month--</option>
                @for($i=1;$i<=12;$i++)
                    @if(isset($check)&&date("m",strtotime($user->birthday))==$i)
                        <option value="{{$i}}" selected>{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif
                @endfor
            </select>
            <select name="year">
                <option value="">--Choose Year--</option>
                @for($i=1980;$i<=2022;$i++)
                    @if(isset($check)&&date("Y",strtotime($user->birthday))==$i)
                        <option value="{{$i}}" selected>{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input type="text" name="txtAddress" autocomplete="off" id="" placeholder="Please Enter Address" class="form-control" value="@if(isset($check)){{$user->address}} @endif"> 
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="txtPhone" autocomplete="off" id="" placeholder="Please Enter Phone" class="form-control" value="@if(isset($check)){{$user->phone}} @endif">
        </div>
        <div class="form-group">
            <label>E-Mail:</label>
            <input type="text" name="txtEmail" id="" autocomplete="off" placeholder="Please Enter E-Mail" class="form-control" value="@if(isset($check)){{$user->email}} @endif">
        </div>
        @if(!isset($check))
        <div class="form-group">
            <label>Password:</label>
            <input type="text" name="txtPassword" id="" autocomplete="off" placeholder="Please Enter Password" class="form-control" value="@if(isset($check)){{$password}} @endif">
        </div>
        @endif
        <div class="form-group">
            <label>Level:</label>
            <label class="radio-inline" style="padding-top:2px">
                <input type="radio" name="rdoLevel"  style="margin-left:10px" value="1" @if(isset($check)&&$user->level==1) {{'checked'}} @endif> Admin
            </label>
            <label class="radio-inline">
                <input type="radio" name="rdoLevel" style="margin-left:10px" value="0" @if(isset($check)&&$user->level==0) {{'checked'}} @endif> Member
            </label>
        </div>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <button type="submit" class="btn btn-primary">
            @if(isset($check))
                {{"Update User"}}
            @else
                {{"Add User"}}
            @endif
        </button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
</div>
@endsection
