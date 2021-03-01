<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mango</title>
    <link rel="icon" href="{{asset('image/logo.png')}}">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="{{assets('c')}}"> --}}

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/style2.css')}}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/css/mdb.min.css" rel="stylesheet" />
    <title>Manga Nihongo</title>
</head>

<body class="bg-login">
    <div class="container">
    @if(session('error'))
        @foreach(session('error')->messages() as $key => $value)
        @foreach($value as $message)
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: absolute; z-index: 1;">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
        @endforeach
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        <div class="row justify-content-md-center ma-9">
            <div class="card col-sm-6">
                <h5 class="card-header text-center">Register</h5>
                <div class="card-body">
                    <form method="post" action="/register">
                    @csrf
                        <div class="md-form">
                            <input type="text" class="form-control" id="idUser" name="nama" required>
                            <label for="idUser">Nama Lengkap</label>
                        </div>
                        <div class="md-form">
                            <input type="text" class="form-control" id="username" name="username" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="">
                            <select class="browser-default custom-select" name="kelas">
                                <option value="" disabled selected>Pilih kelasmu</option>
                                <option value="10">X</option>
                                <option value="11">XI</option>
                                <option value="12">XII</option>
                            </select>
                        </div>
                        <div class="md-form">
                            <input type="email" class="form-control" id="email" name="email" required>
                            <label for="email">Alamat Email</label>
                        </div>
                        <div class="md-form">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div>
                            <input type="hidden" class="btn btn-primary" id="register" name="role" value="siswa">
                            <input type="submit" class="btn btn-primary" id="register" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="asset/js/jquery-3.4.1.slim.min.js"></script>
    <script src="asset/js/popper.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script> -->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <!-- <script type="text/javascript" -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js">
    </script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/js/mdb.min.js">
    </script>
</body>

</html>