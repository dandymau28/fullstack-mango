@extends('templates.app')

@section('content')
  <div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <!-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('image/carousel_3.png')}}" class="d-block w-100" alt="..." style="height: 20em;" />
        </div>
        <div class="carousel-item">
          <img src="{{asset('image/carousel_4.png')}}" class="d-block w-100" alt="..." style="height: 20em;" />
        </div>
        <!-- <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
          </div> -->
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <div class="under-crs spaces">
    <div class="container">
      <div class="row">

        @foreach($bukus as $buku)
        <div class="col-sm-3">
          <div class="card">
            <a href="/buku/{{$buku->buku_id}}">
              <img src="{{asset($buku->sampul)}}" class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-text">
                  {{$buku->judul}}
                </p>
              </div>
            </a>
          </div>
        </div>
        @endforeach

        {{-- <div class="col-sm">
          <div class="card">
            <a href="pilihan-materi.html">
              <img src="{{asset('image/Kira-kira2.png')}}" class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-text">
                  NIHONGO KIRA-KIRA 2
                </p>
              </div>
            </a>
          </div>
        </div> --}}

        {{-- <div class="col-sm">
          <div class="card">
            <a href="pilihan-materi.html">
              <img src="{{asset('image/Kira-kira3.png')}}" class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-text">
                  NIHONGO KIRA-KIRA 3
                </p>
              </div>
            </a>
          </div>
        </div> --}}
      </div>
    </div>
  </div>

  <div class="container">
    <!--Pilihan Materi-->

    @foreach($komiks as $komik)
    @if($komik->isEmpty()) 
      @continue
    @endif
    <div class="pilihan">
      <div class="row justify-content-between judul-pilihan">
        <div class="col-4">
          <h3 class="">{{$komik[0]->buku->judul}}</h3>
        </div>
        @if(count($komik) >= 6)
        <div class="col-lg-2">
          <div class="align-bottom">
            <a href="/buku/{{$komik[0]->buku_id}}" class="btn btn-primary align-bottom">See More ></a>
          </div>
        </div>
        @endif
      </div>
      <div class="row">

      @foreach($komik as $materi)
        <div class="col-sm-2">
          <div class="card">
          <a href="/komik/{{$materi->komik_id}}">
            <img src="{{asset($materi->sampul)}}" class="card-img-top thumbnail-materi" style="object-fit: contain;" alt="..." />
            <div class="card-body">
              <p class="card-text">{{$materi->judul}}</p>
            </div>
          </a>
          </div>
        </div>
      @endforeach

        {{-- <div class="col-sm-3">
          <div class="card">
            <img src="{{asset('image/kk1_2.png')}}" class="card-img-top thumbnail-materi" alt="..." />
            <div class="card-body">
              <p class="card-text">Perkenalan dengan bahasa Jerman</p>
            </div>
          </div>
        </div> --}}

        {{-- <div class="col-sm-3">
          <div class="card">
            <img src="{{asset('image/kk1_3.png')}}" class="card-img-top thumbnail-materi" alt="..." />
            <div class="card-body">
              <p class="card-text">Perkenalan dengan bahasa Poland</p>
            </div>
          </div>
        </div> --}}

        {{-- <div class="col-sm-3">
          <div class="card">
            <img src="{{asset('image/kk1_4.png')}}" class="card-img-top thumbnail-materi" alt="..." />
            <div class="card-body">
              <p class="card-text">Perkenalan dengan bahasa Indonesia</p>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
    @endforeach

    <!--Materi ke-2-->
    <!--<div class="pilihan">
      <div class="row justify-content-between judul-pilihan">
        <div class="col-4">
          <h3 class="">Pilihan Materi Kira-kira 2</h3>
        </div>
        <div class="col-lg-2">
          <div class="align-bottom">
            <a href="pilihan-materi.html" class="btn btn-primary align-bottom">See More ></a>
          </div>
        </div>
      </div>
      <div class="row">
        @for($i = 0; $i < 6; $i++)
        <div class="col-md-2">
          <a href="komik.html">
            <div class="card">
              <img src="{{asset('image/kk2_13.png')}}" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">パダンに すんでいます</p>
              </div>
            </div>
          </a>
        </div>
        @endfor

        {{-- <div class="col-sm">
          <a href="komik.html">
            <div class="card">
              <img src="{{asset('image/kk2_14.png')}}" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">よく そうじを します</p>
              </div>
            </div>
          </a>
        </div> --}}

        {{-- <div class="col-sm">
          <a href="komik.html">
            <div class="card">
              <img src="{{asset('image/kk2_15.png')}}" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">いまで しゅくだいを します</p>
              </div>
            </div>
          </a>
        </div> --}}

        {{-- <div class="col-sm">
          <a href="komik.html">
            <div class="card">
              <img src="{{asset('image/kk2_16.png')}}" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">しろい ねこ が か いたいです</p>
              </div>
            </div>
          </a>
        </div> --}}

        {{-- <div class="col-sm">
          <a href="komik.html">
            <div class="card">
              <img src="{{asset('image/kk2_17.png')}}" class="card-img-top thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">どに さん わ どこ に いますか</p>
              </div>
            </div>
          </a>
        </div> --}}
      </div>
    </div>-->

    <!--Materi ke-3-->
    <!--<div class="pilihan">
      <div class="row justify-content-between judul-pilihan">
        <div class="col-4">
          <h3 class="">Pilihan Materi Kira-kira 3</h3>
        </div>
        <div class="col-lg-2">
          <div class="align-bottom">
            <a href="pilihan-materi.html" class="btn btn-primary align-bottom">See More ></a>
          </div>
        </div>
        </div>
        <div class="row">
        @for($i = 0; $i < 4; $i++)
          <div class="col-sm-2">
            <div class="card">
              <img src="{{asset('image/kk3_25.png')}}" class="card-img-top image-sesuai thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">Perkenalan dengan bahasa Jepang</p>
              </div>
            </div>
          </div>
        @endfor
          {{-- <div class="col-sm">
            <div class="card">
              <img src="{{asset('image/kk3_26.png')}}" class="card-img-top image-sesuai thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">Perkenalan dengan bahasa Jerman</p>
              </div>
            </div>
          </div> --}}

          {{-- <div class="col-sm">
            <div class="card">
              <img src="{{asset('image/kk3_27.png')}}" class="card-img-top image-sesuai thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">Perkenalan dengan bahasa Poland</p>
              </div>
            </div>
          </div> --}}

          {{-- <div class="col-sm">
            <div class="card">
              <img src="{{asset('image/kk3_28.png')}}" class="card-img-top image-sesuai thumbnail-materi" alt="..." />
              <div class="card-body">
                <p class="card-text">Perkenalan dengan bahasa Indonesia</p>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>-->
@endsection