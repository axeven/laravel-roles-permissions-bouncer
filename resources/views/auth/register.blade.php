@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s2"></div>
    <div class="col s8">
        <form action="{{ route('register.new') }}" method="POST">
            <h4>{{ trans('global.register') }}</h4>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="row">
                <div class="input-field col s12">
                <input id="name" type="text" class="validate {{ sizeof($errors->get('name')) > 0 ? 'invalid' : '' }}" value="{{ old('name') }}" name="name" >
                    <label for="name">{{ trans('global.users.fields.name') }}</label>
                    @if(sizeof($errors->get('name')) > 0)
                        <span class="helper-text" data-error="{{ $errors->first('name') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input id="email" type="email" class="validate {{ sizeof($errors->get('email')) > 0 ? 'invalid' : '' }}" value="{{ old('email') }}" name="email" >
                    <label for="email">{{ trans('global.email') }}</label>
                    @if(sizeof($errors->get('email')) > 0)
                        <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate {{ sizeof($errors->get('password')) > 0 ? 'invalid' : '' }}" name="password">
                    <label for="password">{{ trans('global.password') }}</label>
                    @if(sizeof($errors->get('password')) > 0)
                        <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    {!! Form::password('password_confirmation', ['class' => 'validate' . (sizeof($errors->get('password_confirmation')) > 0 ? ' invalid' : ' '), 'required' => 'required','id' => 'password_confirmation']) !!}
                    {!! Form::label('password_confirmation', trans('global.password_confirmation')) !!}
                    @if(sizeof($errors->get('password_confirmation')) > 0)
                        <span class="helper-text" data-error="{{ $errors->first('password_confirmation') }}"></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    <p>
                        <label>
                            {!! Form::radio('has_company', 'true', old('has_company') ? old('has_company') == 'true': false, ['class' => 'with-gap'] ); !!}
                            <span>{{ trans('global.have_company') }}</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            {!! Form::radio('has_company', 'false', old('has_company') ? old('has_company') == 'false': false, ['class' => 'with-gap'] ); !!}
                            <span>{{ trans('global.no_company') }}</span>
                        </label>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button id="register-btn" type="submit" class="modal-action waves-effect waves-green btn">{{ trans('global.register') }}</a>
                </div>
            </div>
        </form>                
    </div>
    <div class="col s2"></div>
</div>
<div>&nbsp;</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#email').keyup(updateForm);
    $('#password').keyup(updateForm);
    $('#password_confirmation').keyup(updateForm);
    $('input[name="has_company"]').change(updateForm);
    updateForm();
});
function updateForm(){
    $('#register-btn').prop('disabled', true);
    if ($('#email').val() != "" && $('#password').val() != "" 
            && $('#password_confirmation').val() != "" 
            && $('#name').val() != "" 
            && $('input[name="has_company"]:checked').length > 0){
        $('#register-btn').attr('disabled', false);
    }
    if ($('#password').val() !=  $('#password_confirmation').val()){
        $('#password_confirmation').parent().children('span').remove();
        $('#password_confirmation').parent().append('<span class="helper-text" data-error="{{ trans('global.password_not_match') }}" ></span>');
        if(!$('#password_confirmation').hasClass('invalid')){
            $('#password_confirmation').addClass('invalid');
        }
        $('#register-btn').prop('disabled', true);
    }else{
        if($('#password_confirmation').hasClass('invalid')){
            $('#password_confirmation').removeClass('invalid');
        }
    }

}
</script>

@endsection
