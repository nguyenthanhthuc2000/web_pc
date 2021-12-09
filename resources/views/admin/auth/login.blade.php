
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Hotel Dashboard Template</title>
    <link rel="shortcut icon" type="image/x-icon" href="/_admin/img/favicon.png">
    <link rel="stylesheet" href="/_admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/_admin/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="/_admin/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/_admin/css/feathericon.min.css">
    <link rel="stylesheet" href="/_admin/plugins/morris/morris.css">
    <link rel="stylesheet" href="/_admin/css/style.css"> </head>
    <link rel="stylesheet" href="/vendor/sweetalert2.min.css"> </head>

<body>
<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left"> <img class="img-fluid" src="/_admin/img/logo.png" alt="Logo"> </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Login</h1>
                        <p class="account-subtitle">Đăng nhập</p>
                        <form action="{{ route('admin.post.login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Email" name="email">
                                @error('email')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                                @error('password')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Đăng nhập</button>
                            </div>
                        </form>
                        @include('notification')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/_admin/js/jquery-3.5.1.min.js"></script>
<script src="/_admin/js/popper.min.js"></script>
<script src="/_admin/js/bootstrap.min.js"></script>
<script src="/_admin/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/_admin/js/script.js"></script>
</body>

</html>
