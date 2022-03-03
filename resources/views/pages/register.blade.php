<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/my.css')}}">
    <link rel="stylesheet" href="{{asset('css/sb-admin-2.css')}}"> 
</head>
<body>
<div class="row carousel-holder">
	<div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Register Form</div>
                <div class="panel-body">
                    <form action="{{route('method_register')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text"  autocomplete="off" class="form-control" placeholder="Please Enter Username" name="txtName" 
                            >
                        </div>
                        <div class="form-group">
                            <label>Birthday:</label>
                            <br>
                            <select name="day" style="width:32%">
                                <option value="">--Choose Day--</option>
                                @for($i=1;$i<=31;$i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <select name="month" style="width:33%">
                                <option value="">--Choose Month--</option>
                                @for($i=1;$i<=12;$i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <select name="year" style="width:33%">
                                <option value="">--Choose Year--</option>
                                @for($i=1980;$i<=2022;$i++)
                                    <option value="{{$i}}">{{$i}}</option>
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
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" name="txtPassword" placeholder="Please Enter Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password:</label>
                            <input type="password" class="form-control" name="txtRepassword"  placeholder="Please Enter Confirm Password">
                        </div>
                        @if(session('message'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                        @endif
                        <br>
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
                        <button type="submit" class="btn btn-primary">Register
                        </button>
                        <button type="reset" class="btn btn-danger">Reset
                        </button>
                        <a href="{{route('login_form')}}" class="btn btn-link" style="position:absolute;right:10px;bottom:15px">Back to Login Form</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/my.js')}}"></script>
</body>
</html>