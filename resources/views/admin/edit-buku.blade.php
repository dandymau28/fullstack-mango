@extends('templates.admin.app')

@push('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Buku</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="/admin-page/buku/{{$buku->buku_id}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="JudulBuku">Judul Buku</label>
                                <input type="text" class="form-control" id="JudulBuku" name="judul"
                                    placeholder="Masukkan judul buku" value="{{$buku->judul}}">
                            </div>
                            <div class="form-group">
                                <label for="JenjangKelas">Jenjang Kelas</label>
                                <input type="text" class="form-control" id="JenjangKelas" name="kelas"
                                    placeholder="10/11/12" value="{{$buku->tingkat}}">
                            </div>
                            <div class="form-group">
                                <label for="Sampul">Sampul Buku</label><br>
                                <img id="sampul" src="{{asset($buku->sampul)}}" width="100" height="100" style="object-fit: contain;"/>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="Sampul" name="sampul" onchange="showImage(this);">
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
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });

    function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sampul')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush