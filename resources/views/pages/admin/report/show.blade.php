@extends('layouts.admin')

@section('title', 'Data Masyarakat')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
            <!-- Page Heading -->
            <a href="{{route('admin.Report.index')}}" class="btn btn-danger mb-3">Kembali</a>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Title</td>
                            <td>{{$report->title}}</td>
                        </tr>
                        <tr>
                            <td>Kode Laporan</td>
                            <td>{{$report->code}}</td>
                        </tr>
                         <tr>
                            <td>Pelapor / Penduduk</td>

                            @if($report->resident->user != NULL)
                                <td>{{$report->resident->user->name}} - {{$report->resident->user->email}}</td>
                            @endif

                            @if($report->resident->user == NULL)
                                <td class="text-danger">Data Penduduk Telah Di Hapus</td>
                            @endif

                        </tr>
                        <tr>
                            <td>Bukti Laporan</td>
                            <td>
                                <img src="{{ asset('storage/' . $report->image) }}" alt="gambar Error / tidak ditemukan" width="300" class="img-fluid mt-3">
                            </td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            @if($report->report_category != NULL)
                            <td><div>{{$report->report_category->name}}</div>
                                <img src="{{ asset('storage/' . $report->report_category->image) }}" alt="gambar Error / tidak ditemukan" width="300" class="img-fluid mt-3">
                            </td>
                            @endif

                            @if($report->report_category == NULL)
                                <td class="text-danger">Data Kategori Telah Di Hapus</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Latitude</td>
                            <td>{{$report->latitude}}</td>
                        </tr>
                        <tr>
                            <td>Longitude</td>
                            <td>{{$report->longitude}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$report->address}}</td>
                        </tr>
                        <tr>
                            <td>Map</td>
                            <td><div id="map" style="height: 300px"></div></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>{{$report->description}}</td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Status Laporan</h6>
                            <a href="{{route('admin.ReportStatus.Create', $report->id) }}" class="btn btn-primary mt-1">Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Status</th>
                                            <th>Bukti</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($report->status as $status)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($status->status == 'delivered') Telah Diserahkan @endif
                                                @if($status->status == 'in_process') Sedang Di Proses @endif
                                                @if($status->status == 'completed') Selesai @endif
                                                @if($status->status == 'rejected') DiTolak @endif
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $status->image) }}" alt="gambar Error / tidak ditemukan" width="50" height="50" class="img-fluid">
                                            </td>
                                            <td>{{ $status->description }}</td>
                                            <td>

                                                <a href="{{ route('admin.ReportStatus.edit', $status->id)}}" class="btn btn-warning">Edit</a>

                                                <form id="deleteData" action="{{route('admin.ReportStatus.destroy' , $status->id)}}" method="POST" class="d-inline">
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




  var mymap = L.map('map').setView([{{ $report->latitude }}, {{ $report->longitude }}], 13);

  var marker = L.marker([{{ $report->latitude }}, {{ $report->longitude }}]).addTo(mymap);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
  }).addTo(mymap);

  marker.bindPopup('<b>Lokasi Laporan</b><br />berada di {{ $report->address }}').openPopup();



</script>

@endsection
