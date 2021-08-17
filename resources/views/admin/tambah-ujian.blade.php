@extends('templates.admin.app')

@push('styles')
<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
@endpush

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Ujian</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="post" action="{{route('admin-ujian')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="komik">Komik</label>
                <select class="custom-select" name="komik">
                    <option disabled selected>Pilih komik untuk ujian ini</option>
                    @foreach($daftar_komik as $komik)
                    <option value="{{$komik->komik_id}}">{{$komik->judul}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="tanggalUjian">Waktu Ujian</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="tanggalUjian" name="tanggal_ujian">
                        {{-- <label for="jamUjian">Tanggal Ujian</label> --}}
                        <div class="input-group-append">
                            <input  type="time" class="form-control" id="jamUjian" name="jam_ujian">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label for="durasiUjian">Durasi Ujian</label>
                    <input type="text" class="form-control" id="durasiUjian" name="durasi_ujian">
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-body input-soal" id="input-soal">
            <div id="input-soal-1">
                <div class="form-group soal" id="input-soal-1">
                    <div class="d-flex justify-content-between">
                        <div>
                            <label for="soal-1">Soal 1</label>
                        </div>
                        <div style="/*padding: 50px 0px;*/">
                            <button class="btn btn-danger btn-sm" id="hapus-soal" data-id="1"
                                onclick="deletePanel(1);">Hapus Soal</button>
                        </div>
                    </div>
                    <div class="input-group">
                        <textarea class="textarea" name="pertanyaan[]" id="pertanyaan-1"></textarea>
                    </div>
                </div>
                <div class="form-row my-2">
                    <div class="col">
                        <label for="soal-1">Pilihan Jawaban 1</label>
                        <input type="text" name="jawaban_1[]" class="form-control" placeholder="Pilihan Jawaban 1">
                    </div>
                    <div class="col">
                        <label for="soal-1">Pilihan Jawaban 2</label>
                        <input type="text" name="jawaban_2[]" class="form-control" placeholder="Pilihan Jawaban 2">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="soal-1">Pilihan Jawaban 3</label>
                        <input type="text" name="jawaban_3[]" class="form-control" placeholder="Pilihan Jawaban 3">
                    </div>
                    <div class="col">
                        <label for="soal-1">Pilihan Jawaban 4</label>
                        <input type="text" name="jawaban_4[]" class="form-control" placeholder="Pilihan Jawaban 4">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="soal-1">Pilihan Jawaban 5</label>
                        <input type="text" name="jawaban_5[]" class="form-control" placeholder="Pilihan Jawaban 5">
                    </div>
                    <div class="col">
                    </div>
                </div>
                <div class="form-group mt-4">
                <label for="jawaban_benar">Jawaban Benar</label>
                @for($i = 0; $i < 5; $i++)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawaban_benar[soal_1]" id="jawabanBenar{{$i + 1}}" value="{{$i + 1}}">
                        <label class="form-check-label" for="jawabanBenar{{$i + 1}}"> Jawaban {{$i + 1}} </label>
                    </div>
                @endfor
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button class="btn btn-dark" id="tambah-soal">Tambah Soal</button>
        </div>
    </form>
</div>
<!-- /.card -->
@endsection

@push('js')

<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
        $('.textarea').summernote({
            placeholder: 'Pertanyaan',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['color', ['color']]
            ]
        });
    });

    $('#tambah-soal').on('click', function (e) {
        e.preventDefault();

        var count = $('.soal').length + 1;
        let soal = `
        <div id="input-soal-${count}">
            <div class="form-group soal">
                <div class="d-flex justify-content-between">
                    <div>
                        <label for="soal-${count}">Soal ${count}</label>
                    </div>
                    <div style="/*padding: 50px 0px;*/">
                        <button class="btn btn-danger btn-sm" id="hapus-soal" data-id="${count}"
                            onclick="deletePanel(${count});">Hapus Soal</button>
                    </div>
                </div>
                <div class="input-group">
                    <textarea class="textarea" name="pertanyaan[]" id="pertanyaan-${count}"></textarea>
                </div>
            </div>
            <div class="form-row my-2">
                <div class="col">
                    <label for="soal-${count}">Pilihan Jawaban 1</label>
                    <input type="text" name="jawaban_1[]" class="form-control" placeholder="Pilihan Jawaban 1">
                </div>
                <div class="col">
                    <label for="soal-${count}">Pilihan Jawaban 2</label>
                    <input type="text" name="jawaban_2[]" class="form-control" placeholder="Pilihan Jawaban 2">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="soal-${count}">Pilihan Jawaban 3</label>
                    <input type="text" name="jawaban_3[]" class="form-control" placeholder="Pilihan Jawaban 3">
                </div>
                <div class="col">
                    <label for="soal-${count}">Pilihan Jawaban 4</label>
                    <input type="text" name="jawaban_4[]" class="form-control" placeholder="Pilihan Jawaban 4">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                </div>
                <div class="col">
                    <label for="soal-${count}">Pilihan Jawaban 5</label>
                    <input type="text" name="jawaban_5[]" class="form-control" placeholder="Pilihan Jawaban 5">
                </div>
            </div>
            <div class="form-group mt-4">
            <label for="jawaban_benar">Jawaban Benar</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban_benar[soal_${count}]" id="jawabanBenar1" value="1">
                    <label class="form-check-label" for="jawabanBenar1"> Jawaban 1 </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban_benar[soal_${count}]" id="jawabanBenar2" value="2">
                    <label class="form-check-label" for="jawabanBenar2"> Jawaban 2 </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban_benar[soal_${count}]" id="jawabanBenar3" value="3">
                    <label class="form-check-label" for="jawabanBenar3"> Jawaban 3 </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban_benar[soal_${count}]" id="jawabanBenar4" value="4">
                    <label class="form-check-label" for="jawabanBenar4"> Jawaban 4 </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban_benar[soal_${count}]" id="jawabanBenar5" value="5">
                    <label class="form-check-label" for="jawabanBenar5"> Jawaban 5 </label>
                </div>
            </div>
        </div>
        `;

        let append = $('#input-soal').append(soal);

        bsCustomFileInput.init();
        $('.textarea').summernote({
            placeholder: 'Materi komik',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['color', ['color']]
            ]
        });
        /* var formDiv = '<div class="form-group komik">';
        var label = `<label for="panel-${count}"`;
        var img = `<img id="panel-${count}" src="#" width="100" height="100" style="object-fit: contain;" />`;
        var */
    });

    function showImage(input) {
        var target = $(input).attr("data-panel");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(`#${target}`)
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deletePanel(id) {
        $('#input-soal-' + id).remove();

        return false;
    }

</script>
@endpush
