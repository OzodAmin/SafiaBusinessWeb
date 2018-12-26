@extends('auth.layout.app')

@section('content')
<body>
    <div class="top-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Safia</strong> | Business</h1>
                    <div class="description">
                        <p>
                            This is a free responsive login form made with Bootstrap. 
                            Download it on <a href="http://www.safiabakery.uz/"><strong>SAFIA</strong></a>, customize and use it as you like!
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>{!! __('auth.Create new password') !!}</h3>
                            <p>{!! __('auth.Enter your email and new password:') !!}</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-puzzle-piece"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('password.update') }}" class="login-form">
                        @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label class="sr-only" for="email">Email</label>
                                <input type="email" 
                                        name="email" 
                                        placeholder="Email" 
                                        value="{{ old('email') }}" 
                                        class="form-password form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        id="email" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password" class="sr-only">{{ __('Password') }}</label>
                                <input id="password" 
                                        type="password" 
                                        placeholder="Password"  
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" 
                                        required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" 
                                        type="password" 
                                        class="form-control" 
                                        placeholder="Confirm Password"  
                                        name="password_confirmation" 
                                        required>
                            </div>

                            <button type="submit" class="btn">
                                {!! __('auth.Reset Password') !!}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>      
@endsection
