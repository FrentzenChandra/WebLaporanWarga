<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use App\Interfaces\ResidentRepositoryInterface;
use App\Repositories\ResidentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class ReportController extends Controller
{

    private ReportRepositoryInterface $ReportRepository;
    private ReportCategoryRepositoryInterface $ReportCategoryRepository;
    private ResidentRepositoryInterface $ResidentRepository;

    public function __construct(
        ReportRepositoryInterface $ReportRepository,
        ResidentRepositoryInterface $ResidentRepository,
        ReportCategoryRepositoryInterface $ReportCategoryRepository)
    {
        $this->ReportRepository = $ReportRepository;
        $this->ResidentRepository = $ResidentRepository;
        $this->ReportCategoryRepository = $ReportCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = $this->ReportRepository->getAllReport();

        return view('pages.admin.report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $residents = $this->ResidentRepository->getAllResident();
        $categories = $this->ReportCategoryRepository->getAllReportCategories();

        return view('pages.admin.report.create', compact('residents', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        $data = $request->validated();
        $data['report_category_id'] = $data['category_id'];
        $data['code'] = 'LAPOR_KETAP'. mt_rand(100000, 9999999);

        $data['image'] = $request->file('image')->store('assets/report' , 'public');

        $this->ReportRepository->createReport($data);


          Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Laporan Berhasil Dibuat",
            'showConfirmButton='=> tRUE,
            'timer'=> 1000]);

        return redirect()->route('admin.Report.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = $this->ReportRepository->getReportById($id);

        return view('pages.admin.report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $residents = $this->ResidentRepository->getAllResident();
        $categories = $this->ReportCategoryRepository->getAllReportCategories();
        $report = $this->ReportRepository->getReportById($id);

        return view('pages.admin.report.edit', compact('residents' , 'categories' , 'report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, string $id)
    {
        $data = $request->validated();

        $data['report_category_id'] = $data['category_id'];

        if ($request->image) {
            $data['image'] = $request->file('image')->store('assets/report', 'public');
            Storage::disk('public')->delete($request['old-image']);
        }

        $this->ReportRepository->updateReport($data, $id);


          Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Laporan Berhasil Diubah",
            'showConfirmButton='=> tRUE,
            'timer'=> 1000]);

        return redirect()->route('admin.Report.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = $this->ReportRepository->getReportById($id);

        $this->ReportRepository->deleteReport($id);

        Storage::disk('public')->delete($report['image']);

        Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Penduduk Berhasil Dihapus",
            'showConfirmButton=' => tRUE,
            'timer'=> 1000]);

        return redirect()->route('admin.Report.index');
    }
}
