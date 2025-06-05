@extends('layouts.admin')

@section('title', 'Data Masyarakat')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

            <!-- Page Heading -->
            <a href="{{route('admin.resident.index')}}" class="btn btn-danger mb-3">Kembali</a>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama</td>
                            <td>{{$Resident->user->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$Resident->user->email}}</td>
                        </tr>
                         <tr>
                            <td>Avatar</td>
                            <td> <img src="{{ asset('storage/' . $Resident->avatar) }}" alt="gambar Error / tidak ditemukan" width="250" class="img-fluid"> </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

        <!-- /.container-fluid -->

    <!-- End of Main Content -->
@endsection
