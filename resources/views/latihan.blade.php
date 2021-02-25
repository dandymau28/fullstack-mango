@extends('templates.app')

@section('content')
  <div class="container my-5">
    <div class="row">
      <div class="col">
        <form method="post" action="/latihan/{{$ujian->komik_id}}">
        @csrf
        @foreach($ujian->soal as $key => $value)
        <div class="soal" id="{{'soal_'.$key}}">
          もんだい <span>{{$key + 1}}</span>
          <p class="my-3">
            {{$value->pertanyaan}}
          </p class="mx-3">
          <div class="my-4 jawaban">
            @foreach($value->pilihan_jawaban as $jawaban)
            <input type="radio" id="{{$jawaban->jawaban}}" name="{{$value->soal_id}}" value="{{$jawaban->jawaban}}" data-id="{{$key}}">
            <label for="{{$jawaban->jawaban}}">{{$jawaban->jawaban}}</label>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>
      <div class="col">
        <div class="nomor-soal">
          <div class="container">
            <div class="row">
              @for ($i = 0; $i < $jumlah_soal; $i++)
              <button class="btn btn-light nomor text-center nomor" data-id="{{$i}}" id="{{$i}}">{{$i + 1}}</button>
              @endfor
              {{-- <button class="btn btn-activated nomor text-center nomor" data-id="2">2</button>
              <button class="btn btn-warning nomor text-center">3</button>
              <button class="btn btn-light nomor text-center">4</button>
              <button class="btn btn-light nomor text-center">5</button> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="submit" class="btn btn-danger btn-lg btn-block" value="Selesaikan Ujian!">
    </form>
  </div>
@endsection

@push('js')

<script>
  $(document).ready(function() {
    $('.soal').hide();
    $('#soal_0').show();
  })

  $("input").on('change', function() {
    var id = $(this).data("id");

    $('#' + id).addClass('btn-success').removeClass('btn-light');
  })

  $('.nomor').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data("id");

    $('.soal').hide();

    $('#soal_' + id).show();
  })
</script>

@endpush