<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
<header>
    <nav>
        <div class="nav-wrapper">
            <div class="container">
                <a href="#" class="brand-logo">{{ trans('global.sitename') }}</a>
                <ul id="nav-mobile" class="right">
                    <li><a href="#">{{ trans('global.about') }}</a></li>
                    <li><a href="#">{{ trans('global.company_list') }}</a></li>
                    <li><a href="#">{{ trans('global.events') }}</a></li>
                    <li><a href="#">{{ trans('global.mentors') }}</a></li>
                    @can('questions_manage')
                        <li><a href="{{ route('admin.questions.index') }}">{{ trans('global.questions_manage.title') }}</a></li>
                    @endcan
                    @if(Auth::guest())
                        <li><a id="login" href="#">{{ trans('global.login') }}</a></li>
                    @else
                        <li><a href="#logout" onclick="$('#logout').submit()" >{{ trans('global.app_logout') }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @if( !empty( $show_banner ) )
        <div id="header-image" class="center-align">
            <div class="banner-btn" >
                <a href="#" class="btn-large waves-effect waves-light">{{ trans('global.start_your_plan') }}</a>
            </div>
        </div>
    @endif
</header>
<div class="container">
    @yield('content')
</div>
<footer class="page-footer">
    <div class="container">
        <div class="row">
        <div class="col l6 s12">
            <h5 class="white-text">{{ trans('global.sitename') }}</h5>
            <p class="grey-text text-lighten-4">Address</p>
        </div>
        <div class="col l4 offset-l2 s12">
            <h5 class="white-text">{{ trans('global.contact_us') }}</h5>
            <ul>
            <li><a class="grey-text text-lighten-3" href="#!">Email</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">LinkedIn</a></li>
            </ul>
        </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <span class="">&COPY; 2018 </span>
        </div>
    </div>
</footer>
@if(Auth::guest())
    <div id="login-modal" class="modal" style="max-width:600px">
        @include('partials.loginform')
    </div>
@endif
@include('partials.javascripts') 
@if(!Auth::guest())
    {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
    <button type="submit">@lang('global.logout')</button>
    {!! Form::close() !!}
@endif
</body>
</html>