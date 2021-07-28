@extends('templates.app')

@section('content')
  <div class="container bg-comic">
    <div class="row justify-content-md-center">
      <!-- komik -->
      {{-- <img src="asset/image/Slice 2.jpg" class="img-fluid" alt="">
      <a href="" class="" data-toggle="modal" data-target="#exampleModalCenter">
        <img src="asset/image/Slice 3.jpg" class="img-fluid" alt="">
      </a>
      <a href="" class="" data-toggle="modal" data-target="#exampleModalCenter">
        <img src="asset/image/Slice 4.jpg" class="img-fluid" alt="">
      </a>
      <a href="" class="" data-toggle="modal" data-target="#exampleModalCenter">
        <img src="asset/image/Slice 5.jpg" class="img-fluid" alt="">
      </a>
      <img src="asset/image/Slice 6.jpg" class="img-fluid" alt="">
      <a href="" class="" data-toggle="modal" data-target="#exampleModalCenter">
        <img src="asset/image/Slice 7.jpg" class="img-fluid" alt="">
      </a>
      <img src="asset/image/Slice 9.jpg" class="img-fluid" alt="">
      <a href="latihan.html" class="">
        <img src="asset/image/Slice 10.jpg" class="img-fluid" alt="">
      </a> --}}

      @foreach ($alamatKomik as $alamat)
        <a href="" class="d-flex" data-toggle="modal" data-target="#panel-{{$alamat->alamat_komik_id}}" style="min-width: 80%">
          <img src="{{asset($alamat->alamat)}}" class="img-fluid" alt="" style="margin-left: auto; margin-right: auto;">
        </a>
      @endforeach

      <!-- materi -->
      <!-- Modal -->
      @foreach ($materis as $materi)
        <div class="modal fade" id="panel-{{$materi->alamat_komik_id}}" tabindex="-1" role="dialog"
          aria-labelledby="panel-{{$materi->alamat_komik_id}}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="panel-{{$materi->alamat_komik_id}}-title">Penjelasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {!! $materi->isi !!}
                {{-- <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Bentuk</th>
                      <th scope="col">Penjelasan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">+</th>
                      <td>Subjek + は + (Nama Tempat)　に　います　</td>
                    </tr>
                    <tr>
                      <th scope="row">-</th>
                      <td>Subjek + は + (Nama Tempat)　に　いません</td>
                    </tr>
                    <tr>
                      <th scope="row">?</th>
                      <td>Subjek + は + (Nama Tempat )/どこ　に　います　か　？</td>
                    </tr>
                  </tbody>
                </table> --}}
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

  </div>
  <div style="background-color: white; height: 5em; display: block; width: 60%; padding-top: 1em; margin: 0 auto;">
    <div class="container">
      <a href="/latihan/{{$dataKomik->komik_id}}" class="btn btn-primary btn-lg btn-block">
        @if (count($alamatKomik) >= 1)
            <h2><strong>やってみましょう！</strong></h2>
        @else
            <h2><strong>テスト</strong></h2>
        @endif
        {{session('status')}}
      </a>
    </div>
  </div>

  <div class="container komentar" style="margin-top: 3em;">
    <div class="margin-komentar">
      <form method="post" action="/komentar">
      @csrf
        <div class="form-group">
          <label for="exampleFormControlTextarea1" style="font-weight: bold;">Komentar</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="komentar"></textarea>
        </div>
        <div class="form-group">
          <input type="hidden" value="{{$dataKomik->komik_id}}" name="komik_id">
          <input type="submit" class="btn btn-success" value="Kirim" style="float: right;">
        </div>
      </form>
    </div>

    <div class="komentar-section">
    @foreach($komentars as $komentar)
      <div class="single-komentar">
        <div class="row">
          <div class="col-sm-1">
              <div class="foto-komentar">
                <img src="{{asset($komentar->foto_profil)}}" class="foto-komentar" style="object-fit: contain;">
              </div>
          </div>
          <div class="col">
            <div class="isi-komentar">
              <div class="row justify-content-between">
                <div class="nama-profil-komentar">
                  <span>{{$komentar->nama}}</span>
                </div>
                <div class="">
                  </span>{{ \Carbon\Carbon::parse($komentar->created_at)->locale('id_ID')->diffForHumans() }}</span>
                </div>
              </div>
              <div class="isi-komentar">
                <span>{{$komentar->isi_komentar}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
@endsection
