<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Simple Laravel 10 User Roles and Permissions - AllPHPTricks.com</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Add these script and css for datatable -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- css for datatable is not need 

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
-->
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style type="text/css">
        * {
            box-sizing: border-box;
            font-family: "Avenir", "Helvetica", sans-serif;
        }

        body {
            background-color: #f9f9f9;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Default table styles for this demo */
        table {
            border-collapse: collapse;
            text-align: left;
            width: 80%;
        }
        table tr {
            background: white;
            border-bottom: 1px solid;
        }
        table th, table td {
            padding: 10px 20px;
        }
        table td span {
            background: #eee;
            color: dimgrey;
            display: none;
            font-size: 10px;
            font-weight: bold;
            padding: 5px;
            position: relative;
            text-transform: uppercase;
            top: 0;
            left: 0;
        }

/*for sidebar*/
        .sidebar {
            background-color: #333;
            color: white;
            height: 100vh;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #575757;
        }


/* Simple CSS for flexbox table on mobile */
@media(max-width: 800px) {
    table thead #hidden{
        left: -9999px;
        position: absolute;
        visibility: hidden; 
    }
    table tr {
        border-bottom: 0;
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }
    table td {
        border: none; /* Remove border */
        margin: 0 0 10px 0;
        padding: 15px;
        position: relative;
        width: 100%;
    }
    table td span {
        display: block;
        background: #eee;
        color: dimgrey;
        border-radius: .5em;
    }
    table td p {
        display: block;
        margin: 1.5em 0 0 0;
    }
    .mobile {
        display: block;
        background: #eee;
        color: dimgrey;
        border-radius: .5em;
        padding: 10px;
    }
}

    </style>



</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Home
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @canany(['create-role', 'edit-role', 'delete-role'])
                                <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Roles</a></li>
                            @endcanany
                            @canany(['create-user', 'edit-user', 'delete-user'])
                                <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                            @endcanany
                            @canany(['create-product', 'edit-product', 'delete-product'])
                                <li><a class="nav-link" href="{{ route('products.index') }}">Manage Products</a></li>
                            @endcanany
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center mt-3">
                    <div class="col-md-12">
                        
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ $message }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{ Session::get('error') }}
                        </div>
                        @endif

                        <h3 class="text-center mt-3 mb-3">Ministry of Information - <a href="{{ url('/') }}">Dashboard</a></h3>

                        <div>@yield('content')</div>

                        <div class="row justify-content-center text-center mt-3">
                            <div class="col-md-12">
                                <p>Back to Tutorial: 
                                    <a href="https://www.allphptricks.com/simple-laravel-10-user-roles-and-permissions/"><strong>Tutorial Link</strong></a>
                                </p>
                                <p>
                                    For More Information Visit: <a href="https://moi.gov.mm/"><strong>Official website</strong></a>
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>