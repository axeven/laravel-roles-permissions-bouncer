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
                    <li><a href="#">{{ trans('global.login') }}</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="header-image" class="center-align">
        <div class="highlight" >
            <a href="#" class="btn-large waves-effect waves-light">{{ trans('global.start_your_plan') }}</a>
        </div>
    </div>
</header>
<div class="container">
    <div class="row no-margin-bottom">
        <div class="col l12">
            <h3>{{ trans('global.events') }}</h3>
            <div class="row no-margin-bottom">
                <div class="col l6">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ url('images/startup.jpg') }}">
                            <span class="card-title black-text"></span>
                        </div>
                        <div class="card-content">
                            <p>
                                Seminar tentang bagaimana cara mengembangkan bisnis yang baik.
                            </p>
                        </div>
                        <div class="card-action">
                            <a href="#"> {{ trans('global.action.more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col l6">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ url('images/startup.jpg') }}">
                            <span class="card-title black-text"></span>
                        </div>
                        <div class="card-content">
                            <p>
                                Workshop marketing online menggunakan Facebook.
                            </p>
                        </div>
                        <div class="card-action">
                            <a href="#"> {{ trans('global.action.more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l12">
            <h3>{{ trans('global.about') }}</h3>
                <div class="card">
                    <div class="card-content">
                        <div class="row no-margin-bottom">
                            <div class="col l8">
                                <p>&nbsp;</p>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores aspernatur saepe, provident et possimus, nulla autem voluptates asperiores, nisi soluta magnam pariatur eligendi illum veniam facilis? Aliquam distinctio est voluptatum?
                                </p>
                                <p>&nbsp;</p>
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto itaque repudiandae quasi corrupti fuga nesciunt obcaecati, tempora expedita veritatis quam. Corrupti incidunt rerum minima animi temporibus dolor deleniti ullam voluptatum!
                                </p>
                            </div>
                            <div class="col l4">
                                <img class="responsive-img" src="{{ url('images/startup.jpg') }}" />
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
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
            <span class="right">&COPY; 2018 </span>
        </div>
    </div>
</footer>
<div id="login-modal" class="modal">
    
</div>
</body>
</html>