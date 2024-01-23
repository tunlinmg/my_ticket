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
    @include('sharedata.navigation')
    @yield('content')

    <!-- Bootstrap JavaScript and dependencies (popper.js and jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  

</body>

</html>