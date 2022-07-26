<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('public/assets/images/sammie_icon.ico') }}"> 
    <title>POS | Login</title>

    <!-- Theme CSS -->  
	<link id="theme-style" rel="stylesheet" href="{{ asset('public/assets/css/devresume.css') }}">
</head>
<style>
    /* @import url(https://fonts.googleapis.com/css?family=Roboto:300); */

    .login-page {
        /* width: 700px; */
        padding: 5% 0 0;
        margin: auto;
    }
    .form {
        /* position: relative;
        z-index: 1; */
        background: #FFFFFF;
        width: 35%;
        margin: 0 auto 100px;
        padding: 45px;
        /* text-align: center; */
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 10px 10px 10px 15px;
        box-sizing: border-box;
        font-size: 16px;
    }
    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }
    .form button:hover,.form button:active,.form button:focus {
        background: #43A047;
    }
    
    body {
        /* font-family: Helvetica; */
        background: #76b852; /* fallback for old browsers */
        background: rgb(141,194,111);
        background: linear-gradient(90deg, rgba(141,194,111,1) 0%, rgba(118,184,82,1) 50%);
        /* font-family: "Roboto", sans-serif; */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;      
    }

    h1 {
        margin-top: 0;
        color: #4CAF50;
    }

    strong {
        font-size: 1rem;
    }

    .form-label {
        font-weight: bold;
    }

    .alert {
        text-align: center;
    }

</style>
<body>
    <div class="login-page">        
        <div class="form">
            {{-- <h1 class="mb-4" style="text-align: center"></h1>             --}}
            @if (Session::has('success'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('auth'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('auth') }}
                </div>
            @endif
            <div class="mb-4" style="text-align: center; margin-top: -20px;">
                <img src="{{ asset('public/assets/images/sammie_icon.ico') }}" height="100px" width="100px" alt="Sammie">
            </div>
            
            <form action="login" method="POST" autocomplete="off" class="login-form">
                @csrf
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" placeholder="Username" required autofocus>
         
                <label for="password" class="form-label"> Password</label>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit"><strong>login</strong></button>
                {{-- <p class="message">Not registered? <a href="#">Create an account</a></p> --}}
            </form>
            <div class="pt-3">
                @include('layout.footer')
            </div>
            
        </div>
    </div>
</body>

<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>

<script>
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
</script>
</html>