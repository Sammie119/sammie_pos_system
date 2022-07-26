<!DOCTYPE html>
<html lang="en"> 
<head>
	<title>@yield('title')</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Sammav IT Consult">  
    <meta name="csrf-token" content="{{ csrf_token() }}">  
	<link rel="shortcut icon" href="{{ asset('public/assets/images/sammie_icon.ico') }}"> 
	
	<!-- FontAwesome JS-->
	<script defer src="{{ asset('public/assets/fontawesome/js/all.min.js') }}"></script>
	
	<!-- Theme CSS -->  
	<link id="theme-style" rel="stylesheet" href="{{ asset('public/assets/css/devresume.css') }}">

</head> 

<body>
	<!-- Nav bar -->
	@switch(Auth()->user()->role)
		@case(1)
			@include('layout.navbar')
			@break

		@case(0)
			@include('layout.user_navbar')
			@break
	
		@default
			
	@endswitch
	
	<!-- //Nav bar -->

	<!--main-wrapper-->
	<div class="main-wrapper">
		@if (Session::has('success'))
			<div class="alert alert-success" role="alert">
				{{ Session::get('success') }}
			</div>
		@endif

		@if (Session::has('error'))
			<div class="alert alert-danger" role="alert">
				{{ Session::get('error') }}
			</div>
		@endif
		
        @yield('content')
				
		{{-- @include('layout.footer') --}}
		
	</div><!--//main-wrapper-->
			
	<!-- Scripts -->
	@stack('scripts')
	<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    </script>
    
</body>
</html> 

