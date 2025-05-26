@extends('layouts.app')

@section('title' , 'Detail Report')

@section('content')

    <div class="max-w-screen-sm mx-auto bg-white min-vh-100 p-3">
        <div class="header-nav">
            <a href="{{route('home')}}">
                <img src="{{ asset('storage/assets/images/icons/left-arrow.png') }}" alt="Back?">
            </a>

            <h1>{{$report->code}}</h1>
        </div>

        <img src="{{ asset('storage/' . $report->image) }}" alt="Back?" class="report-image mt-5">

        <h1 class="report-title mt-3">{{$report->title}}</h1>

        <div class="card card-report-information mt-4">
            <div class="card-body">
                <div class="card-title mb-4 fw-bold">Detail Informasi</div>

                <div class="row mb-3">
                    <div class="col-4 text-secondary">Kode</div>
                    <div class="col-8 d-flex">
                        <span class="me-2">
                            :
                        </span>
                        <p>
                            #{{$report->code}}
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-secondary">Tanggal</div>
                    <div class="col-8 d-flex">
                        <span class="me-2">
                            :
                        </span>
                        <p>
                            {{\Carbon\Carbon::parse($report->created_at)->format('d M Y H:i')}}
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-secondary">Kategori</div>
                    <div class="col-8 d-flex">
                        <span class="me-2">
                            :
                        </span>
                        <p>
                            {{$report->report_category->name}}
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-secondary">Lokasi</div>
                    <div class="col-8 d-flex">
                        <span class="me-2">
                            :
                        </span>
                        <p>
                            {{$report->address}}
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-secondary">Status</div>
                    <div class="col-8 d-flex">
                        <span class="me-2">
                            :
                        </span>
                        @if($report->status->last()->status == 'delivered')
                        <div class="badge-pending">
                            <img src="{{ asset('storage/assets/images/icons/circle-variant.png') }}" alt="Rejected" class="icon me-2 img-fluid" >
                            <p>Sudah dikirim</p>
                        </div>
                        @endif

                        @if($report->status->last()->status == 'in_process')
                        <div class="badge-pending">
                            <img src="{{ asset('storage/assets/images/icons/circle-variant.png') }}" alt="Rejected" class="icon me-2 img-fluid" >
                            <p>Dalam Proses</p>
                        </div>
                        @endif
                        @if($report->status->last()->status == 'completed')
                        <div class="badge-success">
                            <img src="{{ asset('storage/assets/images/icons/approved.png') }}" alt="Rejected" class="icon me-2 img-fluid" >
                            <p>Selesai</p>
                        </div>
                        @endif
                        @if($report->status->last()->status == 'rejected')
                        <div class="badge-rejected">
                            <img src="{{ asset('storage/assets/images/icons/cross.png') }}" alt="Rejected" class="icon me-2 img-fluid" >

                            <p>Ditolak</p>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="card card-report-information mt-4">
            <div class="card-body">
                <div class="card-title mb-4 fw-bold">Riwayat Perkembangan</div>

                <ul class="timeline">
                    @foreach ($report->status as $status)
                    <li class="timeline-item">
                        <div class="timeline-item-content">
                            <img src="{{ asset('storage/' . $status->image) }}" alt="" class="img-fluid">
                            <span class="timeline-date">{{\Carbon\Carbon::parse($status->created_at)->format('d M Y H:i')}}</span>
                            <span class="timeline-event">{{$status->description}}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
