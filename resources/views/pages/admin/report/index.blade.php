@extends('layouts.admin')

@section('title', 'Data Masyarakat')

@section('content')
<a href="{{route('admin.Report.create')}}" class="btn btn-primary mb-3">Tambah Data</a>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Data Laporan</h6>
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

                                            <td>{{$report->code}}</td>

                                            @if($report->resident->user != NULL)
                                            <td>Nama : {{$report->resident->user->name}} | Email : {{$report->resident->user->email}}</td>
                                            @endif
                                            @if($report->resident->user == NULL)
                                            <td class="text-danger">Data Penduduk Telah Di Hapus</td>
                                            @endif


                                            @if($report->report_category  != NULL)
                                            <td>{{$report->report_category->name}}</td>
                                            @endif
                                            @if($report->report_category == NULL)
                                            <td class="text-danger">Data Kategori Telah Di Hapus</td>
                                            @endif

                                            <td>
                                                <img src="{{ asset('storage/' . $report->image) }}" alt="gambar Error / tidak ditemukan" width="50" height="50" class="img-fluid">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.Report.edit', $report->id)}}" class="btn btn-warning">Edit</a>

                                                <a href="{{route('admin.Report.show' , $report->id)}}" class="btn btn-info">Show</a>

                                            <form  id="deleteData" action="{{route('admin.Report.destroy' , $report->id)}}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button  onclick="deleteDataConfirmation()" class="btn btn-danger">Delete</button>
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
