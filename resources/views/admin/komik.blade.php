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
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Daftar Komik</h3>
                        <a href="{{route('tambah-komik')}}" class="btn btn-primary btn-md">Tambah Komik</a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data-komik" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Judul</th>
                                    <th>Buku</th>
                                    <th>Sampul</th>
                                    <th width="100px">Status Terbit</th>
                                    <th width="100px">Action</th>
                                    {{-- <th>Engine version</th>
                                    <th>CSS grade</th> --}}
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Judul</th>
                                    <th>Buku</th>
                                    <th>Sampul</th>
                                    <th width="100px">Status Terbit</th>
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
                window.location = 'komik/' + id + '/delete';
            }
        })
    }

    $(document).ready(function () {
        bsCustomFileInput.init();
    });

    $(function() {
        $('#data-komik').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin-page/komik",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'judul', name: 'judul'},
                {data: 'judul_buku', name: 'judul_buku'},
                {data: 'gambar_sampul', name: 'sampul', orderable: false, searchable: false},
                {data: 'status', name: 'status', searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        })
    })
</script>
@endpush
