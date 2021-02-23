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
        <a href="" class="" data-toggle="modal" data-target="#exampleModalCenter">
          <img src="{{asset($alamat->alamat)}}" class="img-fluid" alt="">
        </a>
      @endforeach
      <div style="background-color: white; height: 5em; display: block; width: 43.75em;">
        <div class="container">
          <a href="latihan.html" class="btn btn-primary btn-lg btn-block">
            <h2>Yuk Latihan</h2>
          </a>
        </div>
      </div>

      <!-- materi -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Penjelasan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table">
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
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection