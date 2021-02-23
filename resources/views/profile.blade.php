<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="asset/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="asset/css/bootstrap-grid.css"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/css/style.css" />


    <!--Font Awesome-->
    <!-- <script src="https://kit.fontawesome.com/6b2ac3863a.js" crossorigin="anonymous"></script> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/css/mdb.min.css" rel="stylesheet">
    <title>Manga Nihongo</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">MangaNihongo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="leaderboard.html">Leaderboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="profile.html">Profil</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                        href="#list-home" role="tab" aria-controls="home">Profile</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                        href="#list-profile" role="tab" aria-controls="profile">Comic Language</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                        href="#list-messages" role="tab" aria-controls="messages">Change Password</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                        href="#list-settings" role="tab" aria-controls="settings">Logout</a>
                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                        aria-labelledby="list-home-list">
                        <form>
                            <div class="md-form">
                                <label for="inputNama">Nama</label>
                                <input type="text" class="form-control" id="inputNama">
                            </div>
                            <div class="md-form">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail">
                            </div>
                            <div class="md-form">
                                <input type="text" class="form-control" id="inputNomorHP">
                                <label for="inputNomorHP" class="">Nomor HP</label>
                            </div>
                            <button type="submit" class="btn peach-gradient btn-lg btn-block">Simpan</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary form-check-label active">
                                <input class="form-check-input" type="radio" name="options" id="option2"
                                    autocomplete="off"> <img src="asset/image/indonesia-flag.jpg"
                                    style="width: 1.5em; height: 1em;">&nbsp;Bahasa
                            </label>
                            <label class="btn btn-primary form-check-label">
                                <input class="form-check-input" type="radio" name="options" id="option3"
                                    autocomplete="off"> <img src="asset/image/1280px-Flag_of_Japan.png"
                                    style="width: 1.5em; height: 1em;">&nbsp;Nihongo
                            </label>
                        </div>

                        <div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        <form action="">
                            <div class="md-form">
                                <label for="oldPassword">Password Lama</label>
                                <input type="password" class="form-control" id="oldPassword">
                            </div>
                            <div class="md-form">
                                <label for="newPassword">Password Baru</label>
                                <input type="password" class="form-control" id="newPassword">
                            </div>
                            <div class="md-form">
                                <label for="confPassword">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confPassword">
                            </div>
                            <button type="submit" class="btn peach-gradient btn-lg btn-block">Ganti Password</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        <button type="button" class="btn btn-danger btn-lg btn-block">Logout</button>
                    </div>
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