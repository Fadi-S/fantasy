<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('title')

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="{{ url('css/admin/app.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <script src="{{ url('js/jquery.js') }}"></script>

</head>
<body>
<div class="page">
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header">
                        <a href="{{ url('/admin') }}" class="navbar-brand d-none d-sm-inline-block">
                            <div class="brand-text d-none d-lg-inline-block"><span>ST </span> <strong>George</strong></div>
                            <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>StG</strong></div></a>
                        <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <li class="nav-item">
                            <a href="{{ url("/admin/change-password") }}" class="nav-link btn btn-primary"> <span class="d-none d-sm-inline">Change Password</span> <i class="fa fa-edit"></i></a>
                        </li>
                        &nbsp;
                        <li class="nav-item">
                            <form method="POST" action="{{ url('admin/logout') }}">
                                {{ csrf_field() }}
                                <button class="nav-link logout btn btn-danger"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
        <nav class="side-navbar">
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="{{ auth()->guard('admin')->user()->picture }}" alt="{{ auth()->guard('admin')->user()->name }}'s profile" class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h4">{{ auth()->guard('admin')->user()->name }}</h1>
                </div>
            </div>
            <span class="heading">Main</span>
            <ul class="list-unstyled">
                <li><a class="sidebar-link" href="{{ url('/admin') }}"> <i class="fa fa-home"></i>Home </a></li>

                <li><a href="#quizzes" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-pencil"></i>Quizzes </a>
                    <ul id="quizzes" class="collapse list-unstyled ">
                        <li><a class="sidebar-link" href="{{ url('admin/quizzes/create') }}">Create Quiz</a></li>
                        <li><a class="sidebar-link" href="{{ url('admin/quizzes') }}">All Quizzes</a></li>

                        <li><a class="sidebar-link" href="{{ url('admin/texts/create') }}">Add Shahed</a></li>

                    </ul>
                </li>

                <li><a href="#questions" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-question"></i>Questions </a>
                    <ul id="questions" class="collapse list-unstyled ">
                        <li><a class="sidebar-link" href="{{ url('admin/questions/create') }}">Add Question</a></li>
                        <li><a class="sidebar-link" href="{{ url('admin/questions') }}">All Questions</a></li>

                    </ul>
                </li>
                
                <li><a href="#users" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-users"></i>Users </a>
                    <ul id="users" class="collapse list-unstyled ">

                        <li><a class="sidebar-link" href="{{ url('admin/users/create') }}">Create User</a></li>

                        <li><a class="sidebar-link" href="{{ url('admin/users') }}">All Users</a></li>

                    </ul>
                </li>

                <li><a href="#admins" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-user-secret"></i>Admins </a>
                    <ul id="admins" class="collapse list-unstyled ">
                        <li><a class="sidebar-link" href="{{ url('admin/admins/create') }}">Create Admin</a></li>
                        <li><a class="sidebar-link" href="{{ url('admin/admins') }}">All Admins</a></li>

                    </ul>
                </li>

                <li><a href="#characters" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-male"></i>Characters </a>
                    <ul id="characters" class="collapse list-unstyled ">
                        <li><a class="sidebar-link" href="{{ url('admin/characters/create') }}">Create Character</a></li>
                        <li><a class="sidebar-link" href="{{ url('admin/characters') }}">All Characters</a></li>

                    </ul>
                </li>

                <li><a href="#competitions" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-trophy"></i>Competitions </a>
                    <ul id="competitions" class="collapse list-unstyled ">
                        <li><a class="sidebar-link" href="{{ url('admin/competitions/create') }}">Create Competition</a></li>
                        <li><a class="sidebar-link" href="{{ url('admin/competitions') }}">All Competitions</a></li>

                    </ul>
                </li>

                <li><a href="#groups" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-user-times"></i>Groups </a>
                    <ul id="groups" class="collapse list-unstyled ">
                        <li><a class="sidebar-link" href="{{ url('admin/groups/create') }}">Create Group</a></li>
                        <li><a class="sidebar-link" href="{{ url('admin/groups') }}">All Groups</a></li>

                    </ul>
                </li>

                <li><a class="sidebar-link" href="{{ url('/admin/activity') }}"> <i class="fa fa-history"></i>Activity Log </a></li>

                <li><a class="sidebar-link" href="{{ url('/admin/reviews') }}"> <i class="fa fa-info-circle"></i>Users Reviews </a></li>

            </ul>
        </nav>
        <div class="content-inner">
            @yield("content")
            @include("admin.flash")
        </div>
    </div>
</div>
    <script src="{{ url('js/admin/app.js') }}"></script>
</body>
</html>