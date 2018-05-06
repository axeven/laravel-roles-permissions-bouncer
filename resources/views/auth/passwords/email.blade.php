@extends('layouts.app')

@section('content')
{{-- <div class="card-panel green lighten-3">Pertanyaan tersimpan.</div>        
<div class="card-panel red lighten-3">Terjadi kesalahan.</div>        
<div class="card-panel blue lighten-3">Pengumuman.</div>         --}}
<div class="row">
    <div class="col s3"></div>
    <div class="col s6">
        <h4>{{ trans('global.reset_password') }}</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('password/email') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
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
                <div class="col s12">
                    <button class="btn" type="submit">{{ trans('global.app_submit') }}</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col s3"></div>
</div>
@endsection