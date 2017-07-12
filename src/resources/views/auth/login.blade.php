@extends('layouts.app')

@section('title')
Login
@endsection


@section('content')
<!-- login -->

    <h3>Login</h3>
    <div class="w3_login_module">
        <div class="form-module">
            <div class="">
            </div>
            <div class="form">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" name="email" type="text" class="validate"  required>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" name="password" class="validate" required>
                            <label for="Password">Password</label>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    
                    <button class="btn waves-effect waves-light " type="submit" name="action">Submit
                    <i class="material-icons right"></i>
                    </button>
                    
                </form>
            </div>
            <div class="cta"><a href="{{ route('password.request') }}">Forgot your password?</a></div>
        </div>
    </div>

<!-- //login -->
@endsection