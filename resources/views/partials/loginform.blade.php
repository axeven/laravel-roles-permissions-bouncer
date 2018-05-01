<form action="{{ url('login') }}" method="POST">
    <div class="modal-content">
        <h4>{{ trans('global.login') }}</h4>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="row">
            <div class="input-field col s12">
                <input id="email" type="email" class="validate" value="{{ old('email') }}" name="email" >
                <label for="email">{{ trans('global.email') }}</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="password" type="password" class="validate" name="password">
                <label for="password">{{ trans('global.password') }}</label>
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
        <button type="submit" class="modal-action waves-effect waves-green btn-flat">{{ trans('global.login') }}</a>
    </div>
</form>