@extends('admin.layouts.index')
@section('content')
<div class="content-container">
    <div class="container-fluid">
        <h4>User
            <small>List</small>
        </h4>
    </div>
    @if(isset($message))
        <div class="alert alert-success">{{$message}}</div>
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
                <td>Username</td>
                <td>Birthday</td>
                <td>Address</td>
                <td>Phone</td>
                <td>E-Mail</td>
                <td>Level</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @foreach($list_user as $user)
                <tr>
                    <td style="text-align:center">{{$user->id}}</td>
                    <td>{{$user->name}}</td>  
                    <td>{{date("d/m/Y",strtotime($user->birthday))}}</td>  
                    <td>{{$user->address}}</td>  
                    <td>{{$user->phone}}</td>  
                    <td>{{$user->email}}</td>  
                    <td style="text-align:center">
                        @if($user->level=='1')
                            {{'Admin'}}
                        @else
                            {{'User'}}
                        @endif
                    </td>              
                    <td style="text-align:center"><a href="{{asset('admin/users/edit_user/'.$user->id)}}" class="btn btn-info">Edit</a></td>
                    <td style="text-align:center"><a href="{{asset('admin/users/delete_user/'.$user->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
