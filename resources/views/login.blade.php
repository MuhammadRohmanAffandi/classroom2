<!DOCTYPE html>
<html>

<head>
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>



<div class="container">
    <br>
    <h1>Login</h1>
    @if (session('message'))
        <div class="alert alert-dismissible alert-danger">
            {{ session('message')}}
        </div>
    @endif
    @if (session('statusDaftar'))
        <div class="alert alert-success col-md-4 col-md-offset-4">
            {{ session('statusDaftar') }}
        </div>
    @endif
    <div class="row">
        <div class="card">
            <form action="{{ url('/') }}" method="post">
                @csrf
                <div class="form-group">
                    <br>
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control" id="username" type="text" name="username" placeholder="Masukan username">

                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Masukan password">
                    <br>
                    <div class=c ard-body>
                        <button type="submit" class="btn btn-primary" name="submit">Masuk</button>
                        <a href="{{ url('buatAkun') }}" class="btn btn-primary">Daftar</a>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>
</div>
        
</body>


</html>