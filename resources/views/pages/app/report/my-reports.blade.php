@extends('layouts.app')


@section('title' , 'Report Saya')


@section('content')

<ul class="nav nav-tabs" id="filter-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request('status') === 'delivered' ? 'active' : '' }}"  href="{{route('myReport' , ['status'=>'delivered'])}}" role="tab" >Terkirim</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request('status') === 'in_process' ? 'active' : '' }}"  href="{{route('myReport' , ['status'=>'in_process'])}}" role="tab" >Diproses</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request('status') === 'completed' ? 'active' : '' }}"  href="{{route('myReport' , ['status'=>'completed'])}}" role="tab" >Selesai</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request('status') === 'rejected' ? 'active' : '' }}"  href="{{route('myReport' , ['status'=>'rejected'])}}" role="tab" >Ditolak</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="terkirim-tab-pane" role="tabpanel" aria-labelledby="terkirim-tab"
                tabindex="0">
                    @forelse ($reports as $report)
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
                                            <img src="{{ asset('storage/assets/images/icons/mapPin.png') }}" alt="map pin" class="icon me-2">
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
                    @empty
                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 75vh" id="no-reports">
                            <dotlottie-player
                            src="https://lottie.host/b2efa24e-9245-4253-ae7f-50b65f115c11/rGXIfMy2nP.lottie"
                            background="transparent"
                            speed="1"
                            style="width: 300px; height: 300px"
                            loop
                            autoplay
                            ></dotlottie-player>
                            <h5 class="mt-3">Belum ada laporan</h5>
                            <a href="{{route('userReport.take')}}" class="btn btn-primary py-2 px-4 mt-3">
                                Buat Laporan
                            </a>
                        </div>
                    @endforelse


            </div>
            <div class="tab-pane fade" id="diproses-tab-pane" role="tabpanel" aria-labelledby="diproses-tab"
                tabindex="0">
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
                                    <img src="{{ asset('storage/assets/images/icons/mapPin.png') }}" alt="map pin" class="icon me-2">
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
            <div class="tab-pane fade" id="selesai-tab-pane" role="tabpanel" aria-labelledby="selesai-tab" tabindex="0">
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
                                    <img src="{{ asset('storage/assets/images/icons/mapPin.png') }}" alt="map pin" class="icon me-2">
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
            <div class="tab-pane fade" id="ditolak-tab-pane" role="tabpanel" aria-labelledby="ditolak-tab" tabindex="0">
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
                                    <img src="{{ asset('storage/assets/images/icons/mapPin.png') }}" alt="map pin" class="icon me-2">
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


<script
  src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
  type="module"
></script>

@endsection



