@extends('layouts.admin')

@section('title', 'Data Masyarakat')

@section('content')
<a href="{{route('admin.Category.create')}}" class="btn btn-primary mb-3">Tambah Data</a>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Data Kategori</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $category->image) }}" alt="avatar" width="50" height="50" class="img-fluid">
                                            <td>
                                                <a href="{{ route('admin.Category.edit', $category->id)}}" class="btn btn-warning">Edit</a>

                                                <a href="{{route('admin.Category.show' , $category->id)}}" class="btn btn-info">Show</a>

                                                <form id="deleteData" action="{{route('admin.Category.destroy' , $category->id)}}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="deleteDataConfirmation()" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection


@section('scripts')


<script>
    document.getElementById("deleteData").addEventListener("submit", function(event){
        event.preventDefault()
    });

    function deleteDataConfirmation(){
        Swal.fire({
            title: "Kamu Yakin Mau Menghapus Data ini?",
            text: "Data yang dihapus Tidak Bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                    document.getElementById("deleteData").submit();
            }
        });
    }

</script>

@endsection
