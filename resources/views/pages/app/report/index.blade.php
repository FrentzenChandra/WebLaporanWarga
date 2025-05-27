@extends('layouts.app')

@section('title' , 'List Report')

@section('content')

    <div class="max-w-screen-sm mx-auto bg-white min-vh-100 p-3">
        <div class="py-3" id="reports">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted">{{count($reports)}} List Pengaduan {{request()->category}}</p>



            </div>

            <div class="d-flex flex-column gap-3 mt-3">
                @foreach ($reports as $report)
                <div class="card card-report border-0 shadow-none">
                    <a href="{{route('userReport.show' , $report->code)}}" class="text-decoration-none text-dark">
                        <div class="card-body p-0">
                            <div class="card-report-image position-relative mb-2">
                                <img src="{{ asset('storage/' . $report->image) }}" alt="">

                                 @if($report->status->last())
                                @if( ($report->status->last()->status == 'in_process') || ($report->status->last()->status == 'completed') || ($report->status->last()->status == 'rejected') )


                                    @if($report->status->last()->status == 'in_process')
                                    <div class="badge-status on-process">
                                        Sedang Di Proses
                                    </div>
                                    @endif
                                    @if($report->status->last()->status == 'completed')
                                    <div class="badge-status done">
                                        Selesai
                                    </div>
                                     @endif
                                    @if($report->status->last()->status == 'rejected')
                                    <div class="badge-status rejected">
                                        Sedang Di Proses
                                    </div>
                                    @endif


                                @endif

                            @else

                            </div>
                            @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-end mb-2">
                                <div class="d-flex align-items-center ">
                                    <img src="{{ asset('storage/assets/images/icons/map-pin.png') }}" alt="map pin" class="icon me-2">
                                    <p class="text-primary city">
                                        {{ \Str::substr($report->address, 0, 15) }}...
                                    </p>
                                </div>

                                <p class="text-secondary date">
                                    {{\Carbon\Carbon::parse($report->created_at)->format('d M Y H:i')}}
                                </p>
                            </div>

                            <h1 class="card-title">
                                {{$report->title}}
                            </h1>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
