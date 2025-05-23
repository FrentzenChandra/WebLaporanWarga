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
                            <td>{{$report->resident->user->name}} - {{$report->resident->user->email}}</td>
                        </tr>
                        <tr>
                            <td>Bukti Laporan</td>
                            <td>
                                <img src="{{ asset('storage/' . $report->image) }}" alt="avatar" width="300" class="img-fluid mt-3">
                            </td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td><div>{{$report->report_category->name}}</div>
                                <img src="{{ asset('storage/' . $report->report_category->image) }}" alt="avatar" width="300" class="img-fluid mt-3">
                            </td>
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

    </div>
    <!-- End of Main Content -->
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
