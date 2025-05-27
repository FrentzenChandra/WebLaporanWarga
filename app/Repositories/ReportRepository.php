<?php

namespace App\Repositories;

use App\Interfaces\ReportRepositoryInterface;
use App\Models\Report;
use App\Models\ReportCategory;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;

class ReportRepository implements ReportRepositoryInterface{
    public function getAllReport(){
        return Report::all();
    }
    public function getLatestReport(){
        return Report::latest()->get()->take(5);
    }

    public function getReportByCode(string $code){
        return Report::where('code' , $code)->latest()->first();
    }

    public function getReportByCategory(string $category){
        $category = ReportCategory::where('name' , $category)->first();

        return Report::where('report_category_id' , $category->id)->latest()->get();
    }


    public function getReportById(int $id){
        return Report::where('id', $id)->first();
    }

    public function getAllReportByResidentId(string $status){
        return Report::where('resident_id', Auth::user()->resident->id)
    ->whereHas('status', function (QueryBuilder $query) use ($status) {
        $query->where('status', $status)
            ->whereIn('id', function ($subQuery) {
                $subQuery->selectRaw('MAX(id)')
                    ->from('report_statuses')
                    ->groupBy('report_id');
            });
    })->get();
    }

    public function createReport(array $data){
        $report = Report::create($data);

        $report->status()->create([
            'status' => 'delivered',
            'description' => 'Laporan Berhasil Diterima'
        ]);

        return $report;
    }

    public function updateReport(array $data, int $id){
        $report = $this->getReportById($id);
        return $report->update($data);
    }

    public function deleteReport(int $id){
        $report = $this->getReportById($id);

        return $report->forceDelete();
    }
}
?>

