@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s3"></div>
    <div class="col s6">
        <h4>@lang('global.change_password')</h4>
        @if(session('success'))
            <!-- If password successfully show message -->
            <div class="card-panel green lighten-3">{{ session('success') }}.</div>
        @else
            {!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
            <!-- If no success message in flash session show change password form  -->    
            <div class="row">
                <div class="col s12 input-field">
                    {!! Form::password('current_password', ['class' => 'validate' . (sizeof($errors->get('current_password')) > 0 ? ' invalid' : ' '), 'required' => 'required' ]) !!}
                    {!! Form::label('current_password', trans('global.current_password')) !!}
                    @if(sizeof($errors->get('current_password')) > 0)
                        <span class="helper-text" data-error="{{ $errors->first('current_password') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    {!! Form::password('new_password', ['class' => 'validate' . (sizeof($errors->get('new_password')) > 0 ? ' invalid' : ' '), 'required' => 'required' ]) !!}
                    {!! Form::label('new_password', trans('global.new_password')) !!}
                    @if(sizeof($errors->get('new_password')) > 0)
                        <span class="helper-text" data-error="{{ $errors->first('new_password') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    {!! Form::password('new_password_confirmation', ['class' => 'validate' . (sizeof($errors->get('new_password_confirmation')) > 0 ? ' invalid' : ' '), 'required' => 'required' ]) !!}
                    {!! Form::label('new_password_confirmation', trans('global.new_password_confirmation')) !!}
                    @if(sizeof($errors->get('new_password_confirmation')) > 0)
                        <span class="helper-text" data-error="{{ $errors->first('new_password_confirmation') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        @endif
    </div>
    <div class="col s3"></div>
</div>
@stop

