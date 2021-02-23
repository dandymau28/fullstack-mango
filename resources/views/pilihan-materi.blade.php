@extends('templates.app')

@section('content')
  <div class="spaces bg-pilihan">
    <div class="container">
      <h1 class="display-1 white-font">{{$judul}}</h1>
    </div>
  </div>

  <div class="container">
    <!--Pilihan Materi 2-->
    <div class="pilihan">
      <div class="row">
        @foreach($komiks as $komik)
        <div class="col-sm-2">
          <a href="/komik/{{$komik->komik_id}}">
            <div class="card">
              <img src="{{asset($komik->sampul)}}" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">{{$komik->judul}}</p>
              </div>
            </div>
          </a>
        </div>
        @endforeach

        {{-- <div class="col-sm">
          <a href="komik.html">
            <div class="card">
              <img src="asset/image/kk2_14.png" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">よく そうじを します</p>
              </div>
            </div>
          </a>
        </div> --}}

        {{-- <div class="col-sm">
          <a href="komik.html">
            <div class="card">
              <img src="asset/image/kk2_15.png" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">いまで しゅくだいを します</p>
              </div>
            </div>
          </a>
        </div> --}}

        {{-- <div class="col-sm">
          <a href="komik.html">
            <div class="card">
              <img src="asset/image/kk2_16.png" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">しろい ねこ が か いたいです</p>
              </div>
            </div>
          </a>
        </div> --}}

        {{-- <div class="col-sm">
          <a href="komik.html">
            <div class="card">
              <img src="asset/image/kk2_17.png" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">どに さん わ どこ に いますか</p>
              </div>
            </div>
          </a>
        </div> --}}
@endsection