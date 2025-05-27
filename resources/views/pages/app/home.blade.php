@extends('layouts.app')

@section('title' , 'home')

@section('content')

    <div class="max-w-screen-sm mx-auto bg-white min-vh-100 p-3">
        <h6 class="greeting">Hi, {{Auth::user()->name}}</h6>
        <h4 class="home-headline">Laporkan masalahmu dan kami segera atasi itu</h4>

        <div class="d-flex align-items-center  gap-4 py-3 overflow-auto" id="category"
            style="white-space: nowrap;">
            @foreach ($categories as $category)
            <a href="{{route('userReport' , ['category' => $category->name])}}" class="category d-inline-block">
                <div class="icon">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{$category->name}}">
                </div>
                <p>{{$category->name}}</p>
            </a>
            @endforeach

        </div>

        <div class="py-3" id="reports">
            <div class="d-flex justify-content-between align-items-center">
                <h6>Pengaduan terbaru</h6>
                <a href="{{route('userReport')}}" class="text-primary text-decoration-none show-more">
                    Lihat semua
                </a>
            </div>
            @foreach ($reports as $report)
            <div class="d-flex flex-column gap-3 mt-3">
                <div class="card card-report border-0 shadow-none">
                    <a href="{{route('userReport.show' , $report->code)}}" class="text-decoration-none text-dark">
                        <div class="card-body p-0">
                            <div class="card-report-image position-relative mb-2">
                                <h1 class="card-title">
                                    {{$report->title}}
                                </h1>
                                <img src="{{ asset('storage/' . $report->image) }}" alt="{{$report->title}}">
                            @if($report->status->last())
                                @if( ($report->status->last()->status == 'in_process') || ($report->status->last()->status == 'completed') || ($report->status->last()->status == 'rejected') )

                                <div class="badge-status
                                            @if($report->status->last()->status == 'in_process') on-process  @endif
                                            @if($report->status->last()->status == 'completed') done @endif
                                            @if($report->status->last()->status == 'rejected') rejected @endif
                                            ">
                                    @if($report->status->last()->status == 'in_process') Sedang Di Proses @endif
                                    @if($report->status->last()->status == 'completed') Selesai @endif
                                    @if($report->status->last()->status == 'rejected') Gagal @endif
                                </div>

                                @endif

                            @else

                            </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-end mb-2">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/assets/images/icons/map-pin.png') }}" alt="map pin" class="icon me-2 img-fluid" >
                                <p class="text-primary city">
                                    {{$report->address}}
                                </p>
                            </div>

                            <p class="text-secondary date">
                                {{\Carbon\Carbon::parse($report->created_at)->format('d M Y H:i')}}
                            </p>
                        </div>


                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection
