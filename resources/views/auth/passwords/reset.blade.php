@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s3"></div>
    <div class="col s6">
        <h4>{{ trans('global.reset_password') }}</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('password/reset') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="token" value="{{ $token }}" />
            <div class="row">
                <div class="col s12 input-field">
                    <input type="email" class="validate {{ sizeof($errors->get('email')) > 0 ? 'invalid' : '' }}" name="email" value="{{ old('email') }}"/>
                    <label for="email">{{ trans('global.email') }}</label>
                    @if(sizeof($errors->get('email')) > 0)
                        <span class="helper-text" data-error="{{ $errors->get('email')[0] }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate {{ sizeof($errors->get('password')) > 0 ? 'invalid' : '' }}" name="password">
                    <label for="password">{{ trans('global.password') }}</label>
                    @if(sizeof($errors->get('password')) > 0)
                        <span class="helper-text" data-error="{{ $errors->get('password')[0] }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password_confirmation" type="password" class="validate {{ sizeof($errors->get('password_confirmation')) > 0 ? 'invalid' : '' }}" name="password_confirmation">
                    <label for="password_confirmation">{{ trans('global.password_confirmation') }}</label>
                    @if(sizeof($errors->get('password_confirmation')) > 0)
                        <span class="helper-text" data-error="{{ $errors->get('password_confirmation')[0] }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button type="submit" class="btn">{{ trans('global.app_submit') }}</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col s3"></div>
</div>
@endsection
