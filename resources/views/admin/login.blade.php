<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Demo | The Company</title>

	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/fontawesome.all.min.css') }}">

	<link rel="stylesheet" href="{{ asset('css/jquery-customselect.css') }}">


	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

	<script src="{{ asset('js/jquery.min.js') }}" ></script>
	<script src="{{ asset('js/sweetalert.min.js') }}"></script>
</head>
<body>
    <!-- login form -->

    <div class="container">
                        <div class="row py-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">


                                <h3 class="mb-3 text-center">Login to Admin Panel</h3>
                                
                                <form class="mb-3 " action="{{ url('/admin/login') }}" method="post">
                                   @csrf
                                   @if(Session::has('log_err'))
									<div class="alert alert-danger mb-3">
										{{ Session::get('log_err') }}
									</div>
                                   @endif
                                    <div class="form-group">
                                    	<input type="hidden" name="_redirect_url" value="{{ (isset($_GET['http_redirect']))?$_GET['http_redirect']: "" }}">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" value="{{ old('email') }}" placeholder="example@gmail.com" name="email" id="email" required>
                                        @if($errors->has('email'))
											<span class="text-danger text-16 bold">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" value="" id="password" class="form-control" required>
                                        @if($errors->has('password'))
											<span class="text-danger text-16 bold">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    
                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>
                
             <!-- !login form -->


             <script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery-customselect.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	
	<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
