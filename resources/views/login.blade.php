<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="text-danger text-center">
                <h4> {{ $error ?? '' }} </h4>
            </div>
            <div class="text-success text-center">
                <h4> {{ $success ?? '' }} </h4>
            </div>
            <div class="forms">
                <div class="form login">
                    <span class="title"> {{ Request::url() == url('admin') ? 'Admin Login' : 'Login' }}</span>

                    <form action=" {{ route('login') }} " method="POST">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="email" placeholder="Enter your email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" class="password" placeholder="Enter your password"
                                required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>

                        <div class="checkbox-text">
                            <div class="checkbox-content">
                            </div>

                            <a href=" {{ route('user.forgot') }} " class="text">Forgot password?</a>
                        </div>

                        <div class="input-field button">
                            <input type="submit" name="login" value="Login Now">
                        </div>
                    </form>


                    <div class="login-signup">
                        <span class="text">Not a member?
                            <a href="#" class="text signup-link">Signup now</a>
                        </span>
                    </div>
                </div>



                <!-- Registration Form -->
                <div class="form signup">
                    <span class="title">Registration</span>

                    <form action="{{ route('sinup') }}" method="POST">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="fname" placeholder="Enter your first name" required>
                            <i class="uil uil-user"></i>
                            <span class="text-danger">
                                @error('fname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="input-field">
                            <input type="text" name="phone_number" placeholder="Enter your phone number" required>
                            <i class="uil uil-envelope icon"></i>
                            <span class="text-danger">
                                @error('phone_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="input-field">
                            <input type="text" name="email" placeholder="Enter your email" required>
                            <i class="uil uil-user icon"></i>
                        </div>

                        <div class="input-field">
                            <input type="text" name="age" placeholder="Enter your Age" required>
                            <i class="uil uil-user icon"></i>
                        </div>

                        <div class="input-field">
                            <input type="password" name="password" class="password"
                                placeholder="Create a password"required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>

                        <div class="input-field">
                            <input type="password" name="password_confirmation" class="password"
                                placeholder="Confirm a password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>

                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                {{-- <input type="checkbox" id="sigCheck"> --}}
                                {{-- <label for="sigCheck" class="text">Remember me</label> --}}
                            </div>
                        </div>

                        <div class="input-field button">
                            <input type="submit" name="regitration" value="Register Now">
                        </div>
                    </form>

                    <div class="login-signup">
                        <span class="text">Not a member?
                            <a href="#" class="text login-link">Signup now</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Form End-->
        <script src="{{ asset('js/login.js') }}"></script>
    </div>
</body>

</html>
