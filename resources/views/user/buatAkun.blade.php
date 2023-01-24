<!DOCTYPE html>
<html>

<head>
    <title>Buat akun</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>



<div class="container">
    <br>
    <h1>Buat akun</h1>
    <div class="row">
        <div class="card">
            <form action="{{ url('tambahAkun') }}" method="post">
                @csrf
                <div class="form-group">
                    <br>
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control @error('username') is-invalid @enderror" id="username" type="text" name="username" placeholder="Masukan username">
                    @error('username')
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    <label class="form-label" for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" placeholder="Masukan email">
                    @error('email')
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    <label class="form-label" for="password">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Masukan password">
                    @error('password')
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <br>
                    <div class=c ard-body>
                        <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
                        <a href="{{ url('/') }}" class="btn btn-primary">Batal</a>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>
</div>
        
</body>


</html>