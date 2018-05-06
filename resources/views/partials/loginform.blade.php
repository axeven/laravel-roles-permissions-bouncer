<form action="{{ url('login') }}" method="POST">
    <div class="modal-content">
        <h4>{{ trans('global.login') }}</h4>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="row">
            <div class="input-field col s12">
            <input id="email" type="email" class="validate {{ sizeof($errors->get('email')) > 0 ? 'invalid' : '' }}" value="{{ old('email') }}" name="email" >
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
            <p class="col s12">
                <label>
                    <input type="checkbox"  name="remember" />
                    <span>{{ trans('global.remember_me') }}</span>
                </label>
            </p>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ route('auth.password.reset') }}" class="modal-action waves-effect waves-green btn-flat">{{ trans('global.forgot_password') }}</a>
        <button id="login-btn" type="submit" class="modal-action waves-effect waves-green btn-flat">{{ trans('global.login') }}</a>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    $('#email').keyup(canLogin);
    $('#password').keyup(canLogin);
    canLogin();
});
function canLogin(){
    if ($('#email').val() != "" && $('#password').val() != ""){
        $('#login-btn').attr('disabled', false);
    }else{
        $('#login-btn').prop('disabled', true);
    }
}
</script>