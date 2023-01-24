<html>
    <head>
        <title>buat kelas</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>
        <br>
        <div class="container">
        <div class="row">
            <div class="card">
            <form action="{{ url('tambahKelas') }}" method="post">
                @csrf
                <fieldset>
                    <legend>Buat Kelas</legend>

                    <div class="mb-3">
                    <label for="name" class="form-label">Nama Kelas</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama kelas">
                    @error('name')
                        <div id="validationServer05Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Kelas</label>
                    <input type="text" id="deskripsi" name="deskripsi" class="form-control" placeholder="Masukan Deskripsi kelas">
                    </div>

                    <div class=c ard-body>
                        <button type="submit" class="btn btn-primary" name="submit">Buat</button>
                        <a href="{{ url('beranda') }}" class="btn btn-primary">Batal</a>
                    </div>
                    
                </fieldset>
            </form>
            </div>
        </div>
    </div>
    </body>
</html>