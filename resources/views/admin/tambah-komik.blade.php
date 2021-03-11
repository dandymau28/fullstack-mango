@extends('templates.admin.app')

@push('styles')
<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
@endpush

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Komik</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="post" action="{{route('admin-komik')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="judulKomik">Judul Komik</label>
                <input type="text" class="form-control" id="judulKomik" name="judul" placeholder="Masukkan judul komik">
            </div>
            <div class="form-group">
                <label for="tingkatKelas">Tingkat Kelas</label>
                <input type="text" class="form-control" id="tingkatKelas" name="tingkat" placeholder="10/11/12">
            </div>
            <div class="form-group">
                <label for="JenjangKelas">Serial Buku</label>
                <select class="custom-select" name="buku">
                    <option disabled selected>Pilih buku untuk komik ini</option>
                    @foreach($daftar_buku as $buku)
                    <option value="{{$buku->buku_id}}">{{$buku->judul}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Sampul">Sampul Komik</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Sampul" name="sampul">
                        <label class="custom-file-label" for="Sampul">Pilih file</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-body input-komik" id="input-komik">
            <div class="form-group komik" id="input-komik-1">
                <div class="d-flex justify-content-between">
                    <div>
                        <label for="panel-1">Panel Komik 1</label>
                        <img id="panel-1" src="#" width="100" height="100" style="object-fit: contain;" />
                    </div>
                    <div style="padding: 50px 0px;">
                        <button class="btn btn-danger btn-sm" id="hapus-panel" data-id="1"
                            onclick="deletePanel(1);">Hapus Panel</button>
                    </div>
                </div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="panel-1" name="komik[]" data-panel="panel-1"
                            onchange="showImage(this);">
                        <label class="custom-file-label" for="panel-1">Pilih file</label>
                    </div>
                </div>
                <div class="input-group my-3">
                    <textarea class="textarea" name="materi[]" id="materi-1" placeholder="Materi komik"></textarea>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button class="btn btn-dark" id="tambah-panel">Tambah Panel</button>
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
            placeholder: 'Materi komik',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']]
            ]
        });
    });

    $('#tambah-panel').on('click', function (e) {
        e.preventDefault();

        var count = $('.komik').length + 1;
        formGroup = document.createElement('div');
        formGroup.setAttribute("class", "form-group komik");
        formGroup.setAttribute("id", "input-komik-" + count);
        label = document.createElement('label');
        label.setAttribute("for", `panel-${count}`);
        label.textContent = `Panel Komik ${count}`;
        image = document.createElement('img');
        image.setAttribute("id", `panel-${count}`);
        image.setAttribute("width", "100");
        image.setAttribute("height", "100");
        image.setAttribute("style", "object-fit: contain;");
        inputGroup = document.createElement("div");
        inputGroup.setAttribute("class", "input-group");
        customFile = document.createElement("div");
        customFile.setAttribute("class", "custom-file");
        inputFile = document.createElement("input");
        inputFile.setAttribute("type", "file");
        inputFile.setAttribute("class", 'custom-file-input');
        inputFile.setAttribute("id", `panel-${count}`);
        inputFile.setAttribute("name", "komik[]");
        inputFile.setAttribute("data-panel", `panel-${count}`);
        inputFile.setAttribute("onchange", `showImage(this);`);
        labelCustom = document.createElement("label");
        labelCustom.setAttribute("class", "custom-file-label");
        labelCustom.setAttribute("for", `panel-${count}`);
        labelCustom.textContent = "Pilih file";
        customFile.appendChild(inputFile);
        customFile.appendChild(labelCustom);

        inputGroup.appendChild(customFile);

        emptyDiv = document.createElement("div");
        emptyDiv.appendChild(label);
        emptyDiv.appendChild(image);

        deleteButton = document.createElement("div");
        deleteButton.setAttribute("class", "btn btn-danger btn-sm");
        deleteButton.setAttribute("id", "hapus-panel");
        deleteButton.setAttribute("data-id", count);
        deleteButton.setAttribute("onclick", `deletePanel(${count});`);
        deleteButton.textContent = "Hapus Panel";

        paddedDiv = document.createElement("div");
        paddedDiv.setAttribute('style', 'padding: 50px 0px;');

        paddedDiv.appendChild(deleteButton);

        justifyDiv = document.createElement("div");
        justifyDiv.setAttribute('class', 'd-flex justify-content-between');

        justifyDiv.appendChild(emptyDiv);
        justifyDiv.appendChild(paddedDiv);

        textareaDiv = document.createElement('div');
        textareaDiv.setAttribute("class", "input-group my-3");

        textareaSummernote = document.createElement("textarea");
        textareaSummernote.setAttribute("class", "textarea");
        textareaSummernote.setAttribute("name", "materi[]");
        textareaSummernote.setAttribute("id", "materi-" + count);

        textareaDiv.appendChild(textareaSummernote);

        formGroup.appendChild(justifyDiv);
        formGroup.appendChild(inputGroup);
        formGroup.appendChild(textareaDiv);

        document.getElementById('input-komik').appendChild(formGroup);

        bsCustomFileInput.init();
        $('.textarea').summernote({
            placeholder: 'Materi komik',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']]
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
        $('#input-komik-' + id).remove();

        return false;
    }

</script>
@endpush
