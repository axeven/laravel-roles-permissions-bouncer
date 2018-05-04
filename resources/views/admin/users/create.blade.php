@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('global.users.title')</h3>
{!! Form::open(['method' => 'POST', 'route' => ['admin.users.store']]) !!}
<div class="row">
    <div class="col s12 input-field">
        {!! Form::text('name', old('name'), ['class' => 'validate', 'required' => '']) !!}
        {!! Form::label('name', trans('global.users.fields.name'), []) !!}
        @if($errors->has('name'))
            <span class="help-text" data-error="{{ $errors->first('name') }}"></span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col s12 input-field">
        {!! Form::email('email', old('email'), ['class' => 'validate', 'required' => '']) !!}
        {!! Form::label('email', trans('global.users.fields.email'), []) !!}
        @if($errors->has('email'))
            <span class="help-text" data-error="{{ $errors->first('email') }}"></span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col s12 input-field">
        {!! Form::password('password', ['class' => 'validate', 'required' => '']) !!}
        {!! Form::label('password', trans('global.users.fields.password'), []) !!}
        @if($errors->has('password'))
            <span class="help-text" data-error="{{ $errors->first('password') }}"></span>  
        @endif
    </div>
</div>
<div class="row">
    <div class="col s12 input-field">
        {!! Form::select('roles[]', $roles, old('roles'), ['class' => '', 'multiple' => 'multiple', 'required' => '']) !!}
        {!! Form::label('roles', trans('global.users.fields.roles'), []) !!}
        <p class="help-block"></p>
        @if($errors->has('roles'))
            <span class="help-text" data-error="{{ $errors->first('roles') }}"></span>  
        @endif
    </div>
</div>
<div class="row">
    <div class="col s12">
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    </div>
</div>
{!! Form::close() !!}
@stop

