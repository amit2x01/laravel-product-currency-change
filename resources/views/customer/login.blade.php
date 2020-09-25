@extends('customer.layouts.page_layout')

@section('content')
	<!-- login form -->
               
                    <div class="container">
                        <div class="row py-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">


                                <h3 class="mb-3 text-center">Login to your account</h3>
                                
                                <form class="mb-3 " action="{{ url('login') }}" method="post">
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
                                <div class="text-center">
                                    
                                    <p class="mt-3">or</p>
                                    @if(isset($_GET['http_redirect']))
                                     <a href="{{ url('/signup?http_redirect=').$_GET['http_redirect'] }}" class="mb-3 btn btn-success">Create Account</a>
                                    @else
                                     <a href="{{ url('/signup') }}" class="mb-3 btn btn-success">Create Account</a>
                                    @endif
                                    {{-- <p class="small"><a href="#">Have you forgotten your account details? </a></p> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                
             <!-- !login form -->
@endsection