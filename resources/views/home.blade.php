@extends('layouts.app')

@section('content')
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
@endsection
