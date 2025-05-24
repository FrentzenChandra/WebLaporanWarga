@extends('layouts.admin')

@section('title' , "Tambah Data Masyarakat")

@section('content')

        <div class="container-fluid">

            <!-- Page Heading -->


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Status Laporan - {{$report->code}}</h6>
                </div>
                <div class="card-body">

                    <form action="{{route('admin.ReportStatus.store')}}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <input type="text" name="report_id" value="{{old('report_id', $report->id)}}" hidden>
                        <div class="form-group">
                            <div id="tes" for="status" class="block">Pilih Kategori Laporan</div>
                            <select class="custom-select @error('status') is-invalid @enderror" name="status" id="status" >
                                    <option value="" >--Pilih Kategori--</option>
                                    <option value="delivered">Sudah Dikirim</option>
                                    <option value='in_process'>Dalam Proses</option>
                                    <option value='completed'>Sudah Selesai</option>
                                    <option value="rejected">Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" value="{{old('image')}}" name="image" >
                            @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi Status</label>
                            <textarea style="resize:none" class="form-control @error('description') is-invalid @enderror" id="description" cols="100" rows="10"  name="description" >{{old('description')}}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

@endsection
