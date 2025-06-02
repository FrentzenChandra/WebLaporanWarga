<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportStatusRequest;
use App\Http\Requests\UpdateReportStatusRequest;
use App\Interfaces\ReportRepositoryInterface;
use App\Interfaces\ReportStatusRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class ReportStatusController extends Controller
{

    private ReportRepositoryInterface $ReportRepository;
    private ReportStatusRepositoryInterface $ReportStatusRepository;

    public function __construct(
        ReportRepositoryInterface $ReportRepository,
        ReportStatusRepositoryInterface $ReportStatusRepository)
    {
        $this->ReportRepository = $ReportRepository;
        $this->ReportStatusRepository = $ReportStatusRepository;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($ReportId)
    {
        $report = $this->ReportRepository->getReportById($ReportId);

        return view('pages.admin.reportStatus.create' , compact('report'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportStatusRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->file('image')->store('assets/reportStatus' , 'public');

        $this->ReportStatusRepository->createReportStatus($data);

         Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Status Berhasil Dibuat",
            'showConfirmButton='=> tRUE,
            'timer'=> 1000]);

        return redirect()->route('admin.Report.show' , $data['report_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = $this->ReportStatusRepository->getReportStatusById($id);
        $report = $this->ReportRepository->getReportById($status['report_id']);

        return view('pages.admin.reportStatus.edit' , compact('status' , 'report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportStatusRequest $request, string $id)
    {
        $data = $request->validated();

        $status = $this->ReportStatusRepository->getReportStatusById($id);

        if ($request->image) {
            $data['image'] = $request->file('image')->store('assets/reportStatus', 'public');
            Storage::disk('public')->delete($request['old-image']);
        }


        $this->ReportStatusRepository->updateReportStatus($data, $id);

              Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Status Berhasil Diubah",
            'showConfirmButton='=> tRUE,
            'timer'=> 1000]);

        return redirect()->route('admin.Report.show' , $status->report->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $reportStatus = $this->ReportStatusRepository->getReportStatusById($id);


        $this->ReportStatusRepository->deleteReportStatus($id);

        Storage::disk('public')->delete($reportStatus['image']);

               Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Status Berhasil Dihapus",
            'showConfirmButton='=> tRUE,
            'timer'=> 1000]);

        return redirect()->route('admin.Report.show' , $reportStatus->report->id);
    }
}
