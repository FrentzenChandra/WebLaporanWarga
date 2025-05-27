<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use Illuminate\Http\Request;

class UserReportController extends Controller
{
    private ReportRepositoryInterface $reportRepository;
    private ReportCategoryRepositoryInterface $reportCategoryRepository;


    public function __construct( ReportRepositoryInterface $reportRepository, ReportCategoryRepositoryInterface $reportCategoryRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->reportCategoryRepository = $reportCategoryRepository;
    }



    public function index(Request $request) {


        if ($request->category) {
            $reports = $this->reportRepository->getReportByCategory($request->category);
        }else {
            $reports = $this->reportRepository->getAllReport();
        }



        return view('pages.app.report.index' , compact('reports'));
    }

    public function show($code) {

        $report = $this->reportRepository->getReportByCode($code);

        return view('pages.app.report.show' , compact('report'));
    }

    public function create(){
        $categories = $this->reportCategoryRepository->getAllReportCategories();

        return view('pages.app.report.create', compact('categories'));
    }

    public function store(StoreReportRequest $request) {
        $data = $request->validated();
        $data['report_category_id'] = $data['category_id'];
        $data['code'] = 'LAPOR_KETAP'. mt_rand(100000, 9999999);

        $data['image'] = $request->file('image')->store('assets/report' , 'public');

        $this->reportRepository->createReport($data);

        return redirect()->route('userReport.success');
    }


    public function take() {
        return view('pages.app.report.take');
    }


    public function success() {
        return view('pages.app.report.success');
    }


    public function preview(){

        return view('pages.app.report.preview');
    }

    public function myReport(Request $request){
        $reports = $this->reportRepository->getAllReportByResidentId($request->status);


        return view('pages.app.report.my-reports', compact('reports'));
    }


}
