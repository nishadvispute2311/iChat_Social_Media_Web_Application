<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('/css/login_and_signup.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myanchor.css')}}">

    <title>Login</title>
    <style>
        
    </style>
</head>
<body class="main">
    <div class="wrapper rounded bg-white">

        <div class="h3"><center><h3><b>Login</b></h3></center></div><br>

        <form action="{{route('validatelogin')}}" method="post">
            @csrf
            <div class="form">
                <div class=" my-md-2 my-3">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username">
                    <span class="text-danger">
                        @error('username')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class=" my-md-2 my-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" style="margin-bottom: 6px;">
                    <span class="text-danger">
                        @error('password')
                            {{$message}}
                        @enderror
                    </span>
                    <a class="direct" href="enteremail" style="float: right;"><h6>Forgot Password</h6></a><br>
                </div>
                
                <center><button class="btn btn-primary mt-3" type="submit">Submit</button></center><br>
                <a class="direct" href="register"><h6>New User! Create an account</h6></a>
            </div>
        </form>

    </div>
@if (Session::has('success'))
<script>
    toastr.success(("{!! Session::get('success') !!}"));
</script>
@endif
@if (Session::has('fail'))
<script>
    toastr.error(("{!! Session::get('fail') !!}"))
</script>
@endif
</body>
</html>