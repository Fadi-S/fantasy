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
                        <div class="icon bg-green"><i class="fa fa-trophy"></i></div>
                        <div class="title"><span>Competitions</span></div>
                        <div class="number"><strong>{{ $competitionsCount }}</strong></div>
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

    <br>

    {!! Html::script("/js/admin/Chart.min.js") !!}
    {!! Html::style("/css/admin/Chart.min.css") !!}

    @foreach (auth("admin")->user()->groups as $group)
        @if($group->current_competition != null)
            <div class="container-fluid">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mx-auto">
                    <div class="card">
                        <div class="card-header"><h4>{{ $group->name }}</h4></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-header"><h4>Users Participating</h4></div>

                            <div class="card-body">
                                {!! $charts[$group->id]["users"]->container() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @if($charts[$group->id]["users"])
                {!! $charts[$group->id]["users"]->script() !!}
            @endif
        @endif
    @endforeach

@endsection

@section('title')
    <title>Thanawy | Admin</title>
@endsection