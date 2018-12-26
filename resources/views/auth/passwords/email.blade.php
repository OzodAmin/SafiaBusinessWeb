<?php ?>
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
                                <h3>{!! __('auth.Email verification') !!}</h3>
                                <p>{!! __('auth.Enter your email address:') !!}</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form role="form" method="POST" action="{{ route('password.email') }}" class="login-form">
                            @csrf
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

                                <button type="submit" class="btn">
                                    {!! __('auth.Send Password Reset Link') !!}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>           
@endsection