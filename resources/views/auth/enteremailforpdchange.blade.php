<!-- enteremailforpdchange -->
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

    <title>Forget Password</title>
    <style>
        
    </style>
</head>
<body class="main">
    <div class="wrapper rounded bg-white">

        <div class="h3"><center><h3><b>Enter Email</b></h3></center></div><br>

        <form action="validatemyemail" method="post">
            @csrf
            <div class="form">
                <div class=" my-md-2 my-3">
                    <input type="text" class="form-control" name="email">
                    <span class="text-danger">
                        @error('email')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                
                <center><button class="btn btn-primary mt-3" type="submit">Submit</button></center><br>
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