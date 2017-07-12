@extends('layouts.app')
@section('content')
<div class="container">
    <div class="w3_login">
        <h3>Reset Password</h3>
        <div class="w3_login_module">
            <div class="form-module">
                <div class="">
                </div>
                <div class="form">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="email" class="validate" value="{{ $email or old('email') }}" required>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate" required>
                                <label for="Password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="confirmPassword" type="password" class="validate" required>
                                <label for="confirmPassword">Confirm Password</label>
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
                        @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                        <button class="btn waves-effect waves-light " type="submit" name="action">Reset
                        <i class="material-icons right"></i>
                        </button>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection