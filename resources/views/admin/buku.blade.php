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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Buku</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data-buku" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Judul</th>
                                    <th>Kelas</th>
                                    <th>Sampul</th>
                                    <th width="100px">Action</th>
                                    {{-- <th>Engine version</th>
                                    <th>CSS grade</th> --}}
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Judul</th>
                                    <th>Kelas</th>
                                    <th>Sampul</th>
                                    <th width="100px">Action</th>
                                    {{-- <th>Engine version</th>
                                    <th>CSS grade</th> --}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Buku</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('store-buku')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="JudulBuku">Judul Buku</label>
                                <input type="text" class="form-control" id="JudulBuku" name="judul"
                                    placeholder="Masukkan judul buku">
                            </div>
                            <div class="form-group">
                                <label for="JenjangKelas">Jenjang Kelas</label>
                                <input type="text" class="form-control" id="JenjangKelas" name="kelas"
                                    placeholder="10/11/12">
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
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    function deleteUrl(id) {
        Swal.fire({
            title: 'Yakin dihapus?',
            text: "Data yang terhapus tidak dapat dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                window.location = 'http://127.0.0.1:8000/admin-page/buku/' + id + '/delete';
            }
        })
    }

    $(document).ready(function () {
        bsCustomFileInput.init();
    });

    $(function() {
        $('#data-buku').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin-page/buku",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'judul', name: 'judul'},
                {data: 'tingkat', name: 'tingkat'},
                {data: 'gambar_sampul', name: 'sampul', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        })
    })
</script>
@endpush
