@extends('layouts.admin')

@section('title', 'Data Masyarakat')

@section('content')
<a href="{{route('admin.Report.create')}}" class="btn btn-primary mb-3">Tambah Data</a>


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
                                            <th>Kode Laporan</th>
                                            <th>Pelapor</th>
                                            <th>Kategori Laporan</th>
                                            <th>Bukti Laporan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <th>{{$report->code}}</th>
                                            <th>Nama : {{$report->resident->user->name}} | Email : {{$report->resident->user->email}}</th>
                                            <th>{{$report->report_category->name}}</th>
                                            <td>
                                                <img src="{{ asset('storage/' . $report->image) }}" alt="avatar" width="50" height="50" class="img-fluid">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.Report.edit', $report->id)}}" class="btn btn-warning">Edit</a>

                                                <a href="{{route('admin.Report.show' , $report->id)}}" class="btn btn-info">Show</a>

                                                <form action="{{route('admin.Report.destroy' , $report->id)}}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
