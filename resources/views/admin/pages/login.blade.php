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
                <div class="panel-heading">Login Admin Form</div>
                <div class="panel-body">
                    <form action="{{route('method_login')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <div>
                            <label>Email:</label>
                            <input type="text"  autocomplete="off" class="form-control" placeholder="Please enter email" name="email" 
                            >
                        </div>
                        <br>	
                        <div>
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Please enter password">
                        </div>
                        <br>
                        @if(session('message'))
                            <div class="alert alert-danger">
                                {{session('message')}}
                            </div>
                        @endif
                        @if(isset($message))
                            <div class="alert alert-danger">{{$message}}</div>
                        @endif
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Login
                        </button>
                        <button type="reset" class="btn btn-danger">Reset
                        </button>
                        <a href="{{route('register_form')}}" class="btn btn-link" style="position:absolute;right:10px;bottom:15px">Register</a>
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