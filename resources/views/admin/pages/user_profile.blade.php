@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid"> 
        <h3>User Profile</h3> 
        <form action="{{route('method_change_profile_user')}}" method="post">
            <div class="form-group">
                <a id="label_name" href="#" style="color:black">Name: {{Auth::user()->name}}</a>
                <input type="text" name="txtName" class="form-control" id="input_txtName" autocomplete="off" placeholder="Please Enter Name you need to change">
            </div>
            <div class="form-group">
                <a id="label_birthday" href="#" style="color:black">Birthday:  {{date('d/m/Y',strtotime(Auth::user()->birthday))}}</a>
                <select name="day" style="margin-left:30px" class="select_birthday">
                    <option value="">--Choose Day--</option>
                    @for($i=1;$i<=31;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <select name="month" class="select_birthday">
                    <option value="">--Choose Month--</option>
                    @for($i=1;$i<=12;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <select name="year" class="select_birthday">
                    <option value="">--Choose Year--</option>
                    @for($i=1980;$i<=2022;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <a id="label_address" href="#" style="color:black">Address:  {{Auth::user()->address}}</a>
                <input type="text" name="txtAddress" class="form-control" id="input_txtAddress"  autocomplete="off"  placeholder="Please Enter Address you need to change">
            </div>
            <div class="form-group">
                <a id="label_phone" href="#" style="color:black">Phone:  {{Auth::user()->phone}}</a>
                <input type="text" name="txtPhone" class="form-control" id="input_txtPhone"  autocomplete="off"  placeholder="Please enter phone you need to change">
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            @if(session('message'))
                <div class="alert alert-danger">{{session('message')}}</div>
            @endif
            @if(session('message_success'))
                <div class="alert alert-success">{{session('message_success')}}</div>
            @endif
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
    </div>
</div>
@endsection