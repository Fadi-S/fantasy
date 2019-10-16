@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Reviews</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Reviews</li>
        </ul>
    </div>

    <div class="col-12">
        <br><br>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Reviews Table</h3>
            </div>

            <div class="card-body">

                {{ $reviews->render() }}
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Reported at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td></td>
                                <td>{{ $review->body }}</td>
                                <td>{{ ($review->rating) ?: "No rating" }}</td>
                                <td>{{ $review->created_at->format("l, j F Y h:i a") }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("title")
    <title>All Reviews | StGeorge Thanawy</title>
@endsection