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
        <div class="row justify-content-md-center ma-9">
            <div class="card col-sm-6">
                <h5 class="card-header text-center">Login</h5>
                <div class="card-body">
                    <form action="/login" method="post">
                    @csrf
                        <div class="md-form">
                            <input type="text" class="form-control" id="idUser" name="username" required>
                            <label for="idUser">Username</label>
                        </div>
                        <div class="md-form">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" id="login">login</button>
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