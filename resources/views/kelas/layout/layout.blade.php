<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('beranda') }}"><b style="font-family: Arial">Tugas Kelas</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <nav class="container" style="max-width: 720px;">
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        @yield('nav aktif')
                    </ul>
                </div>
            </nav>
            <a href="{{ url('logout') }}">Logout</a>
        </div>
    </nav>

    <nav class="container">
        @yield('isi')
    </nav>
</body>


</html>