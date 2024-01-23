<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">WebSiteName</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item{{ request()->is('/') ? ' active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item{{ request()->is('create') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ url('/create') }}">Create</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Page 1 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Page 1-1</a></li>
                        <li><a class="dropdown-item" href="#">Page 1-2</a></li>
                        <li><a class="dropdown-item" href="#">Page 1-3</a></li>
                    </ul>
                </li>
               
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>