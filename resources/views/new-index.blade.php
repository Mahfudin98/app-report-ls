<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <title>Document</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link class="js-stylesheet" href="{{ asset('css/light.css') }}" rel="stylesheet"> --}}
    <link class="js-stylesheet" href="{{ asset('css/dark.css') }}" rel="stylesheet">
	<script src="{{ asset('js/settings.js') }}"></script>
	<style>
		body {
			opacity: 0;
		}
	</style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/feather-icons"></script> --}}
</head>
<body>
    <div id="app">
        <app></app>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/manifest.js')}}"></script>
    <script src="{{asset('js/vendor.js')}}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
