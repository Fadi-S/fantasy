@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">View All Admins Activity</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url("/admin") }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url("/admin/admins") }}">Admins</a></li>
            <li class="breadcrumb-item active">Activity</li>
        </ul>
    </div>

    <div class="col-12">
        <center>{{ $activities->render("pagination::bootstrap-4") }}</center>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Admins Activity</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Picture</th>
                            <th>by</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Action</th>
                            <th>Changes</th>
                            <th>Time</th>
                            <th>Restore</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td><img height="70" width="70" src="{{ $activity->creator()->picture }}"></td>
                                <td>{{ $activity->creator()["name"] }}</td>
                                <td>
                                    {{ $activity->logged()["name"] }}
                                </td>
                                <td>{{ $activity->humanReadableType() }}</td>
                                <td>{{ ucfirst($activity->action()) }}</td>
                                <td>
                                    @if($activity->action() == 'edit')
                                        <button class="btn btn-success" data-target="#changes{{ $activity->id }}"
                                                data-toggle="modal">View Changes
                                        </button>
                                    @endif
                                </td>
                                <td>{{ $activity->done_at->diffforhumans() }}</td>
                                <td>
                                    @if($activity->action() == 'delete')
                                        <a class="btn btn-danger" href="{{ url("/admin/activity/$activity->id/restore") }}">Restore</a>
                                    @endif
                                </td>
                            </tr>
                            @if($activity->action() == 'edit')
                                <div class="modal fade" id="changes{{ $activity->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <span style="font-weight: bold;">Changes</span>
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <span>Old: <pre>{{ print_r($activity->old(), true) }}</pre></span>
                                                <br>
                                                <span>New: <pre>{{ print_r($activity->new(), true) }}</pre></span>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-info" data-dismiss="modal">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <center>{{ $activities->render("pagination::bootstrap-4") }}</center>
    </div>
@endsection

@section('title')
    <title>Admin Activity Log | Admin</title>
@endsection