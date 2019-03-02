@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <p>image Logo Madera</p>
                </div>
            </div>
        {{--<div class="col">--}}
            <div class="card">
                {{--<div class="card-header">{{ __('Login') }}</div>--}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login.custom') }}">
                        @csrf
                        {{--email--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--login--}}
                        <div class="form-group row">
                            <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('IDENTIFIANT') }}</label>

                            <div class="col-md-6">
                                <input id="login" type="login" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                @if ($errors->has('login'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--password--}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('MOT DE PASSE') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Mémoriser mon mot de passe') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('CONNEXION') }}
                                </button>

                                {{--@if (Route::has('password.request'))--}}
                                    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                        {{--{{ __('Forgot Your Password?') }}--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        {{--</div>--}}
    </div>
</div>
@endsection
