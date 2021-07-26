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
    <form role="form" method="post" action="{{route('edit-ujian', ['id' => $ujian->ujian_id])}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="komik">Komik</label>
                <select class="custom-select" name="komik">
                    @foreach($daftar_komik as $komik)
                        @if ($komik->komik_id === $ujian->komik_id)
                        <option value="{{$komik->komik_id}}" selected>{{$komik->judul}}</option>
                        @else
                        <option value="{{$komik->komik_id}}">{{$komik->judul}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="tanggalUjian">Waktu Ujian</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="tanggalUjian" name="tanggal_ujian" value="{{ date('Y-m-d', $unixTime) }}">
                        {{-- <label for="jamUjian">Tanggal Ujian</label> --}}
                        <div class="input-group-append">
                            <input  type="time" class="form-control" id="jamUjian" name="jam_ujian" value="{{ date('H:i', $unixTime)}}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label for="durasiUjian">Durasi Ujian</label>
                    <input type="text" class="form-control" id="durasiUjian" name="durasi_ujian" value="{{$ujian->durasi_ujian}}">
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        @for ($i = 0; $i < $count; $i++)
            <input type="hidden" name="soal_id[]" value="{{ $soal[$i]->soal_id }}">
            <div class="card-body input-soal" id="input-soal">
                <div id="input-soal-{{($i + 1)}}">
                    <div class="form-group soal">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="soal-{{($i + 1)}}">Soal {{($i + 1)}}</label>
                            </div>
                            <div style="/*padding: 50px 0px;*/">
                                <button class="btn btn-danger btn-sm" id="hapus-soal" data-id="{{($i+1)}}"
                                    onclick="deletePanel({{($i + 1)}});">Hapus Soal</button>
                            </div>
                        </div>
                        <div class="input-group">
                            <textarea class="textarea" name="pertanyaan[]" id="pertanyaan-{{($i+1)}}">{{$soal[$i]->pertanyaan}}</textarea>
                        </div>
                    </div>
                    <div class="form-row my-2">
                        <div class="col">
                            <label for="soal-1">Pilihan Jawaban 1</label>
                            <input type="hidden" name="jawaban_1_id[]" value="{{ $pilihan_jawaban[($soal[$i]->soal_id)][0]->pilihan_jawaban_id }}">
                            <input type="text" name="jawaban_1[]" class="form-control" placeholder="Pilihan Jawaban 1" value={{ $pilihan_jawaban[($soal[$i]->soal_id)][0]->jawaban }}>
                        </div>
                        <div class="col">
                            <label for="soal-1">Pilihan Jawaban 2</label>
                            <input type="hidden" name="jawaban_2_id[]" value="{{ $pilihan_jawaban[($soal[$i]->soal_id)][1]->pilihan_jawaban_id }}">
                            <input type="text" name="jawaban_2[]" class="form-control" placeholder="Pilihan Jawaban 2" value={{ $pilihan_jawaban[$soal[$i]->soal_id][1]->jawaban }}>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="soal-1">Pilihan Jawaban 3</label>
                            <input type="hidden" name="jawaban_3_id[]" value="{{ $pilihan_jawaban[($soal[$i]->soal_id)][2]->pilihan_jawaban_id }}">
                            <input type="text" name="jawaban_3[]" class="form-control" placeholder="Pilihan Jawaban 3" value={{ $pilihan_jawaban[$soal[$i]->soal_id][2]->jawaban }}>
                        </div>
                        <div class="col">
                            <label for="soal-1">Pilihan Jawaban 4</label>
                            <input type="hidden" name="jawaban_4_id[]" value="{{ $pilihan_jawaban[($soal[$i]->soal_id)][3]->pilihan_jawaban_id }}">
                            <input type="text" name="jawaban_4[]" class="form-control" placeholder="Pilihan Jawaban 4" value={{ $pilihan_jawaban[$soal[$i]->soal_id][3]->jawaban }}>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                    <label for="jawaban_benar">Jawaban Benar</label>
                    @for($j = 0; $j < 4; $j++)
                        <div class="form-check">
                            @if ($soal[$i]->jawaban_benar === $pilihan_jawaban[$soal[$i]->soal_id][$j]->jawaban)
                            <input class="form-check-input" type="radio" name="jawaban_benar[soal_{{($i + 1)}}]" id="jawabanBenar{{$j + 1}}" value="{{$j + 1}}" checked>
                            @else
                            <input class="form-check-input" type="radio" name="jawaban_benar[soal_{{ ($i + 1) }}]" id="jawabanBenar{{$j + 1}}" value="{{$j + 1}}" >
                            @endif
                            <label class="form-check-label" for="jawabanBenar{{$j + 1}}"> Jawaban {{$j + 1}} </label>
                        </div>
                    @endfor
                    </div>
                </div>
            </div>
        @endfor

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
                ['table', ['table']]
            ]
        });

        for (i = 1; i < $('.textarea').length; i++) {
            if ($('#pertanyaan-' + i).val() !== "") {
                $('#pertanyaan-' + i).summernote('editor.pasteHTML', $(this).val());
            }
        }
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
                ['table', ['table']]
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
