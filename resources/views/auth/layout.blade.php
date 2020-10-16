<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/main.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/authentication/form-2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.min.css')}}">
    <style>
        .form-form .form-form-wrap form .field-wrapper svg.feather-eye {
            top: 46px;
        }
    </style>
</head>
<body>

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container  mt-0">
                    <div class="form-content">
                        @if (session('status'))
                            <div class="alert alert-info">
                                {{ session('status') }}
                            </div>
                        @endif

                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/authentication/form-2.min.js')}}"></script>
</body>
</html>
{{-- @endsection --}}
