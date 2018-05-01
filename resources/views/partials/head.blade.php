<meta charset="utf-8">
<title>
    {{ trans('global.global_title') }}
</title>

<meta http-equiv="X-UA-Compatible"
      content="IE=edge">
<meta content="width=device-width, initial-scale=1.0"
      name="viewport"/>
<meta http-equiv="Content-type"
      content="text/html; charset=utf-8">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link href="{{ url('materialize/css/materialize.min.css') }}" rel="stylesheet">
<link href="{{ url('materialize/css/icon.css') }}" rel="stylesheet">
<link href="{{ url('css/main.css') }}" rel="stylesheet">
<link href="{{ url('jquery-ui-1.12.1.custom/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ url('jquery-ui-1.12.1.custom/jquery-ui.structure.min.css') }}" rel="stylesheet">
<link href="{{ url('jquery-ui-1.12.1.custom/jquery-ui.theme.min.css') }}" rel="stylesheet">
<style type="text/css">
#header-image{
      background: url('{{ url('images/startup.jpg') }}') center no-repeat;
      background-size: cover;
}
@font-face {
  font-family: 'Material Icons';
  font-style: normal;
  font-weight: 400;
  src: url('{{ url('materialize/fonts/material-icons.woff2') }}') format('woff2');
}
</style>
<script type="text/javascript" src="{{ url('/js/jquery-3.3.1.min.js') }}" ></script>
<script type="text/javascript" src="{{ url('/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}" ></script>