@extends('layouts.app')

@section('title')
Reset Password
@endsection


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
                    <form method="POST" action="{{ route('password.email') }}">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                                <label for="email">Email</label>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light " type="submit" name="action">Send
                        <i class="material-icons right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection



