<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Add these script tags in the head section of your HTML file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style type="text/css">
    * {
    box-sizing: border-box;
    font-family: "Avenir", "Helvetica", sans-serif;
}

body {
    background-color: #f9f9f9;
    margin: 0;
}

/* Default table styles for this demo */
table {
    border-collapse: collapse;
    text-align: left;
    width: 100%;
}
table tr {
    background: white;
    border-bottom: 1px solid;
}
table th, table td {
    padding: 10px 20px;
}
table td div {
    background: #eee;
    color: dimgrey;
    display: none;
    font-size: 10px;
    font-weight: bold;
    padding: 5px;
    position: absolute;
    text-transform: uppercase;
    top: 0;
    left: 0;
}

/* Simple CSS for flexbox table on mobile */
@media(max-width: 800px) {
    table thead {
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
    table td div {
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
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse navbar" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item{{ request()->is('/') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item{{ request()->is('create') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/create') }}">Create</a>
                        </li>

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


            @yield('content')


        </main>
    </div>


    <!-- Bootstrap JavaScript and dependencies (popper.js and jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  

</body>

</html>