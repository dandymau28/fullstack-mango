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
                        {{-- <div class="d-flex justify-content-between">
                            <h3 class="card-title">Daftar Ujian</h3>
                            <a href="{{route('tambah-ujian')}}" class="btn btn-primary btn-md">Tambah Ujian</a>
                        </div> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data-nilai" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    {{-- <th width="10px">No</th> --}}
                                    <th>Nama Siswa</th>
                                    <th>Judul Komik</th>
                                    <th>Nilai</th>
                                    {{-- <th width="100px">Action</th> --}}
                                    {{-- <th>Engine version</th>
                                    <th>CSS grade</th> --}}
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    {{-- <th width="10px">No</th> --}}
                                    <th>Nama Siswa</th>
                                    <th>Judul Komik</th>
                                    <th>Nilai</th>
                                    {{-- <th width="100px">Action</th> --}}
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
    /*function deleteUrl(id) {
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
                window.location = 'ujian/' + id + '/delete';
            }
        })
    }*/

    $(function() {
        $('#data-nilai').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin-page/nilai",
            columns: [
                //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'profil_user.nama'},
                {data: 'judul', name: 'komik.judul'},
                {data: 'nilai_angka', name: 'nilai.nilai_angka'}
            ]
        })
    });
</script>
@endpush