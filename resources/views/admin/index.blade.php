@extends('admin.master')

@section('content')
        <!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Dashboard</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-users"></i></div>
                    <div class="title"><span>Users</span></div>
                    <div class="number"><strong>{{ $usersCount }}</strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="fa fa-male"></i></div>
                    <div class="title"><span>Characters</span></div>
                    <div class="number"><strong>{{ $charactersCount }}</strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="fa fa-question"></i></div>
                    <div class="title"><span>Quizzes</span></div>
                    <div class="number"><strong>{{ $quizzesCount }}</strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="fa fa-user-secret"></i></div>
                    <div class="title"><span>Admins</span></div>
                    <div class="number"><strong>{{ $adminsCount }}</strong></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('title')
    <title>Thanawy | Admin</title>
@endsection