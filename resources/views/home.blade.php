<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EduHub</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">

    <link href="/bootstrap/bootstrap.css" rel="stylesheet" />
    <script src="/jquery/jquery-3.7.1.min.js"></script>
    <script src="/socket/socket.io.js"></script>
    <script src="/bootstrap/masonry.pkgd.min.js"></script>
    <script src="/bootstrap/bootstrap.bundle.js"></script>
    <link href="/css/app.css" rel="stylesheet" />
    <script src="/js/app.js"></script>
</head>

<body class="">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/images/logo-transparent-white.png" alt="" width="120" height="30">
            </a>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container mt-2">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Web Programming</h5>
                        <p class="card-text"><small class="text-muted">CSC 1106</small></p>
                        <p class="card-text">3 deadlines this week</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Operating Systems</h5>
                        <p class="card-text"><small class="text-muted">CSC 1107</small></p>
                        <p class="card-text">2 deadlines this week</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
