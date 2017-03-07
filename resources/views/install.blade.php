<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>安装 - Notadd</title>
    <link href="{{ asset('assets/install/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app"></div>
<script>
    window.api = "{{ url('api') }}";
    window.url = "{{ url('') }}";
</script>
<script type="text/javascript" src="{{ asset('assets/install/js/manifest.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/install/js/vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/install/js/app.js') }}"></script>
</body>
</html>