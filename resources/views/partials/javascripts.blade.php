<script type="text/javascript" src="{{ url('/js/jquery-3.3.1.min.js') }}" ></script>
<script type="text/javascript" src="{{ url('/materialize/js/materialize.min.js') }}" ></script>
<script type="text/javascript" src="{{ url('/js/main.js') }}" ></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>



@yield('javascript')