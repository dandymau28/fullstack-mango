@extends('templates.admin.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <!-- left column -->
        {{-- <div class="col-md-6"> --}}
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Buku</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin-buku')}}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="JudulBuku">Judul Buku</label>
                        <input type="text" class="form-control" id="JudulBuku" name="judul"
                            placeholder="Masukkan judul buku">
                    </div>
                    <div class="form-group">
                        <label for="JenjangKelas">Jenjang Kelas</label>
                        <input type="text" class="form-control" id="JenjangKelas" name="kelas" placeholder="10/11/12">
                    </div>
                    <div class="form-group">
                        <label for="Sampul">Sampul Buku</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="Sampul" name="sampul">
                                <label class="custom-file-label" for="Sampul">Pilih file</label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
        {{-- </div> --}}
        {{-- </div> --}}
    </div>
</section>
@endsection

@push('js')
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });

</script>
@endpush
