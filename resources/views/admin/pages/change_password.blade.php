@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid">
        <h3>Change Password Form</h3>      
        <form action="{{route('method_change_password')}}" method="POST">
            <div class="form-group">
                <label>Your current password:</label>
                <input type="password" name="current_password" class="form-control" placeholder="Please enter your current password">
            </div>
            <div class="form-group">
                <label>Your new password:</label>
                <input type="password" name="new_password" class="form-control" placeholder="Please enter your new password">
            </div>
            <div class="form-group">
                <label>Confirm your new password:</label>
                <input type="password" name="renew_password" class="form-control" placeholder="Please confirm your new password">
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
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <button type="submit" class="btn btn-primary">Change Password</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </form>
    </div>
</div>
@endsection