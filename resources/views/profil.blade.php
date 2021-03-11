@extends('templates.app')

@push('styles')
<style>
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                        href="#list-home" role="tab" aria-controls="home">Profile</a>
                    {{-- <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                        href="#list-profile" role="tab" aria-controls="profile">Comic Language</a> --}}
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
                        <form method="post" action="/profil">
                        @csrf
                            <div class="md-form">
                                {{-- <label for="inputNama">Nama</label> --}}
                                <input type="text" class="form-control" id="inputNama" value="{{(isset($profil->nama) ? $profil->nama : '')}}" placeholder="Masukan nama kalian" name="nama">
                            </div>
                            <div class="md-form">
                                {{-- <label for="inputEmail">Email</label> --}}
                                <input type="email" class="form-control" id="inputEmail" value="{{(isset($profil->user->email) ? $profil->user->email : '')}}" placeholder="Masukan kelas kalian. Contoh: 10/11/12" name="email">
                            </div>
                            <div class="md-form">
                                <input type="text" class="form-control" id="inputNomorHP" value="{{(isset($profil->nomor_hp) ? $profil->nomor_hp : '')}}" placeholder="Masukan nomor hp kalian. Contoh: 081234567890" name="nomor_hp">
                                {{-- <label for="inputNomorHP" class="">Nomor HP</label> --}}
                            </div>
                            <button type="submit" class="btn peach-gradient btn-lg btn-block">Simpan</button>
                        </form>
                    </div>
                    {{-- <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

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
                    </div> --}}
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
                        <a href="/logout" class="btn btn-danger btn-lg btn-block">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection