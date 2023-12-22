<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('/css/login_and_signup.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myanchor.css')}}">
    <title>Registration</title>
</head>
<body class="main">
    <div class="wrapper rounded bg-white">

        <div class="h3"><center><h3><b>Registration Form</b></h3></center></div><br>

        <form action="{{route('datainsert')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form">
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        <span class="text-danger">
                            @error('name')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{old('email')}}">
                        <span class="text-danger">
                            @error('email')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Birthday</label>
                        <input type="date" class="form-control" name="birthdate" value="{{old('birthdate')}}">
                        <span class="text-danger">
                            @error('birthdate')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" value="{{old('country')}}">
                        <span class="text-danger">
                            @error('country')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Number</label>
                        <input type="text" class="form-control" name="number" value="{{old('number')}}">
                        <span class="text-danger">
                            @error('number')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Gender</label>
                        <input type="text" class="form-control" name="gender" value="{{old('gender')}}">
                        <span class="text-danger">
                            @error('gender')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Occupation</label>
                        <input type="text" class="form-control" name="occupation" value="{{old('occupation')}}">
                        <span class="text-danger">
                            @error('occupation')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Hobby</label>
                        <input type="text" class="form-control" name="hobby" value="{{old('hobby')}}">
                        <span class="text-danger">
                            @error('hobby')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                        <span class="text-danger">
                            @error('password')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <div class=" my-md-2 my-3">
                    <label>Profile Photo</label>
                    <input type="file" class="form-control" name="primage">
                </div>
                <center><button class="btn btn-primary mt-3" type="submit">Submit</button></center>
                <a class="direct" href="login"><h6>Existing User! Sign In</h6></a>
            </div>
        </form>

    </div>
</body>
</html>
