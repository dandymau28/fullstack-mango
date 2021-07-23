@extends('templates.app')

@section('content')
<style>
    .token-input {
        margin: 0 auto;
        margin-top: 2rem;
    }
</style>
<div class="card token-input" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Enter token to unlock</h5>
      <h6 class="card-subtitle mb-2 text-muted">Dapatkan token dari guru Anda!</h6>
      <form action="{{ route('unlock-komik') }}" method="post">
          @csrf
          <div class="form-group">
              <input type="text" class="form-control" name="token" id="token" placeholder="Jangan masukin token listrik!">
              <input type="hidden" name="komik_id" value="{{ $komik_id }}">
          </div>
          <input class="btn btn-primary" type="submit" value="Unlock!">
      </form>
    </div>
  </div>
@endsection
