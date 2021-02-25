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
        <div class="container">
            <div class="row justify-content-center">
                <img src="{{asset('image/crown.png')}}" style="width: 2em; height: 2em;">
                <h3>&nbsp; Leaderboard &nbsp;</h3>
                <img src="{{asset('image/queen crown.png')}}" style="width: 2em; height: 2em;">
            </div>
            <div class="row justify-content-center">
                <h3>{{@$komik->judul}}</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>
                        <th class="col-lg" scope="col">Name</th>
                        <th scope="col">Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_nilai as $key => $value)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$value->nama}}</td>
                        <td>{{$value->nilai}}</td>
                    </tr>
                    @endforeach
                    {{-- <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>98</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>97</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection