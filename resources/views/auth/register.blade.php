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

                @include('auth.layout.language')
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>{!! __('auth.Login to our site') !!}</h3>
                                <p>{!! __('auth.Enter your username and password to log on:') !!}</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                                <div class="form-group">
                                    <label class="sr-only" for="email">Email</label>
                                    <input type="email" 
                                            name="email" 
                                            placeholder="Email" 
                                            value="{{ old('email') }}" 
                                            class="form-password form-control" 
                                            id="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="password">Password</label>
                                    <input type="password" 
                                            name="password" 
                                            placeholder="Password" 
                                            class="form-password form-control" 
                                            id="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label" for="remember">
                                        <input  type="checkbox" 
                                                name="remember" 
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        {!! __('auth.Remember me') !!}
                                    </label>
                                </div>
                                <button type="submit" class="btn">
                                    {!! __('auth.Login') !!}
                                </button>
                            </form>
                            <div class="form-bottom-left"><br>
                                <p><a href="{!! route('password.request') !!}">{!! __('auth.Forgot password?') !!}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection