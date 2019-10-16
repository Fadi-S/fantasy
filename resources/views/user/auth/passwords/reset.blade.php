@extends('user.master')

@section('content')
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center">
        <div class="card sign-card">
            <h1 class="card-title">Reset Password</h1>
            <div class="card-body">
                <form action="{{ url('/password/reset') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="email" value="{{ request()->get("email") }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group center-left">
                        <label class="text-normal text-dark">Password</label>
                        <input type="password" required name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group center-left">
                        <label class="text-normal text-dark">Confirm Password</label>
                        <input type="password" required name="password_confirmation" class="form-control" placeholder="Confirm Password">
                    </div>
                    <button class="btn btn-primary" type="submit">Reset Password</button>
                </form>
                @if($errors->count())
                    <br>
                    @include("errors.list")
                @endif
            </div>

        </div>
    </div>
@endsection

@section('title')
    <title>Reset Password | StGeorge Service</title>
@endsection