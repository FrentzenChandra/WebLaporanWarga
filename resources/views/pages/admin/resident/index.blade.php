@extends('layouts.admin')

@section('title', 'Data Masyarakat')

@section('content')
<a href="{{route('admin.resident.create')}}" class="btn btn-primary mb-3">Tambah Data</a>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Data Masyarakat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>Avatar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Residents as $Resident)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Resident->user->email}}</td>
                                            <td>{{ $Resident->user->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $Resident->avatar) }}" alt="gambar Error / tidak ditemukan" width="50" height="50" class="img-fluid">
                                            <td >
                                                <a href="{{ route('admin.resident.edit', $Resident->id)}}" class="btn btn-warning">Edit</a>

                                                <a href="{{route('admin.resident.show' , $Resident->id)}}" class="btn btn-info">Show</a>

                                                <form id="deleteData" action="{{route('admin.resident.destroy' , $Resident->id)}}" method="POST" class="d-inline ml-4">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete</button>

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

