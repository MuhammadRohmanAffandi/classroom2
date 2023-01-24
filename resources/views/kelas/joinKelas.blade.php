<html>
    <head>
        <title>join kelas</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>
        <br>
        <div class="container">
            <div class="row">
            @if (session('statusJoin'))
                <div class="alert alert-dismissible alert-danger">
                    {{ session('statusJoin') }}
                </div>
            @endif
                <div class="card text-center">
                    <div class=c ard-body>
                        <form action="{{ url('join') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Masukan kode kelas">
                                @error('code')
                                <div id="validationServer05Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class=c ard-body>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <a href="{{ url('beranda') }}" class="btn btn-primary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>