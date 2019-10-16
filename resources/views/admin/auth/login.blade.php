<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Thanawy Login</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="{{ url('css/admin/app.css') }}" rel="stylesheet"/>
</head>

<body>
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content mx-auto">
                            <div class="logo">
                                <img src="{{ url('images/logo.png') }}" height="200" width="200">
                            </div>
                            <p>Saint George Church, Sporting</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <form method="POST" action="{{ url('admin/login') }}" class="form-validate">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="login-username" class="label-material">Email</label>
                                    <input id="login-username" value="{{ old('email') }}" type="text" name="email" required data-msg="Please enter your username" class="input-material">
                                </div>
                                <div class="form-group">
                                    <label for="login-password" class="label-material">Password</label>
                                    <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                                </div>

                                    <div class="i-checks">
                                        <input id="option" class="checkbox-template" name="remember" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="option">Keep me logged in</label>
                                    </div>
                                    <br>
                                <center>
                                    <button type="submit" id="login" class="btn btn-primary">Login</button>
                                </center>

                            </form>
                            @include("errors.list")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>