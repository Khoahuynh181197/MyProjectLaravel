<div class="nav navbar-header">
    <a class="navbar-brand" href="{{route('home')}}">Admin Form - Khoa Huynh</a>
</div>
<ul class="nav justify-content-end">
    @if(Auth::check()&&Auth::user()->level=='1')
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="name_user">
                <i class="fa-solid fa-user"></i>
            
                    {{Auth::user()->name}}
                
            </a>
            <ul class="dropdown-menu dropdown-user" id="information_user">
                <li><a href="{{route('user_profile')}}"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                <li class="divider"></li>
                <li><a href="{{route('change_password')}}"><i class="fa-solid fa-gear"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="{{route('logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
            </ul>
        </li>
    @endif
</ul>