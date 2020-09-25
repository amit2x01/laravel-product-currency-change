<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Indian largest Spare Parts Market">

	<title>Bupro | Indian largest Spare Parts Market</title>

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


	<!-- site header -->

		<header id="site-header" class="mb-3">
			<div class="primary-bg text-white top-header align-items-center d-flex justify-content-between py-2 px-3 flex-direction-column-sm">
				<div class="d-flex justify-content-between text-12 my-1">
					<p class="border-right px-2"><i class="fa fa-envelope">&nbsp&nbsp</i>amitkumarbiswas@gmail.com</p>
					<p class="px-2"><i class="fa fa-phone-alt">&nbsp&nbsp</i>(+91) 905******321</p>
				</div>
				<div class="d-flex justify-content-between text-14 my-1">
					@if(!Session::has('cust_logged_id'))
						<a href="{{ url('login') }}" class="text-light no-underline border-right px-2">Login</a>
						<a href="{{ url('signup') }}" class="text-light no-underline px-2">Signup</a>
					@endif

					<form action="{{ url('/change/curr') }}" id="changeCurrForm">
						
								 <select name="currency" onchange="changeCurr()" class="form-control form-control-sm " style="background-color:#000024!important;color:white!important;appearance: auto;">
									 <option value="{{$_COOKIE['curr'] ?? "INR"}}" hidden>{{$_COOKIE['curr'] ?? "INR"}}</option>
									 <option value="INR">INR</option>
									 <option value="USD">USD</option>
								 </select>
								 @if($errors->has('currency'))
									 <span class="text-danger bold">{{ $errors->first('currency') }}</span>
								 @endif
							
						</div>
					 </form>

				</div>
			</div>

			<div class="middle-header  px-5 my-3">
				<div class="row align-items-center">
					<div class="col-md-3">
						<div class="logo text-center">
							<img src="{{asset('img/logo.png')}}" class="img-fluid" style="width: 210px;" alt="">
						</div>
					</div>
					<div class="col-md-7">
						<form class="header-search-form" action="{{ url('/products/search') }}" method="get" autocomplete="off">
							<input type="text" name="search_cri" placeholder="Search here ......... ">
							<button>Search</button>
						</form>
					</div>
					<div class="col-md-2 text-center text-md-right">

						<a href="{{ url('/cart') }}" class="px-3 text-dark"><i class="fas fa-shopping-cart text-22"></i><span class="bold text-danger badge position-absolute">{{ (Session::has('shopping_cart'))?count(Session::get('shopping_cart')):0 }}</span></a>
					</div>
				</div>
			</div>

			<nav class="navbar navbar-expand-lg primary-bg navbar-dark">
			  <a class="navbar-brand" href="#"></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
			  <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link text-center nav-hover-lime bold" href="{{ url('/') }}">Home</a>
                        </li>
                        {{-- <li class="nav-item active">
                            <a class="nav-link text-center  nav-hover-lime bold" href="About us.html">About</a>
                        </li> --}}
                        <li class="nav-item active">
                            <a class="nav-link text-center  nav-hover-lime bold" href="{{ url('/products') }}">Products</a>
                        </li>
                        {{-- <li class="nav-item active">
                            <a class="nav-link text-center  nav-hover-lime bold" href="About us.html">Contact</a>
                        </li> --}}
					    @if(Session::has('cust_logged_id'))
						<li class="nav-item active dropdown text-center nav-hover-lime bold">
					        <a class="nav-link dropdown-toggle nav-hover-lime bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					         	My Account
					        </a>
					        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
					          <a class="dropdown-item" href="{{ url('account') }}">Account</a>
					          <a class="dropdown-item" href="{{ url('account/address') }}">Address</a>
					          <a class="dropdown-item" href="{{ url('/orders') }}">Orders</a>
					          <div class="dropdown-divider"></div>
					          <a class="dropdown-item" href="{{ url('/account/modify/password') }}">Change Password</a>
					          <a class="dropdown-item" href="{{ url('account/logout') }}">Logout</a>
					        </div>
					    </li>
					    @endif

                </div>
                    </ul>
                </div>
			</nav>
		</header>

	<!-- !site header -->

	<!-- site main section -->

		<main>
			@yield('content')
		</main>

	<!-- !site main section -->


	<!-- site footer -->
		<footer class="bg-dark text-light">
			<div class="container">
				<div class="row p-3">
					<div class="col-md-6">
                        &copy; Copyright <?php

                            $curr_year = date('Y');
                            $dlp_year = "2020";

                            if($curr_year == $dlp_year){
                                echo $dlp_year;
                            }else{
                                echo $dlp_year." - ".$curr_year;
                            }

                        ?> | Bupro | All rights reserved.</span>
                        <p class="text-warning bold">Indian largest Spare Parts Market </p>
					</div>
					<div class="col-md-6">
						<div class="d-flex justify-content-end">
							<a href="#" class="fab fa-facebook-f btn btn-primary mx-2 no-border-radius"></a>
							<a href="#" class="fab fa-instagram btn btn-primary mx-2 no-border-radius"></a>
							<a href="#" class="fab fa-twitter btn btn-primary mx-2 no-border-radius"></a>
							<a href="#" class="fab fa-youtube btn btn-primary mx-2 no-border-radius"></a>
						</div>
					</div>
				</div>
			</div>
		</footer>
	<!-- !site footer -->

	<!-- site goto top -->
		<div class="goto-top">
			<a href="#site-header" class="btn btn-danger no-border-radius">
				<span class="fa fa-arrow-up"></span>
			</a>
		</div>
	<!-- !site goto top -->


	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery-customselect.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

	<script src="{{ asset('js/custom.js') }}"></script>

	<script>
        const changeCurr = () => {
            document.getElementById('changeCurrForm').submit();
        }
    </script>
</body>
</html>
