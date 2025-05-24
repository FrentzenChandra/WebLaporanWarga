<?php

namespace App\Repositories;

use App\Interfaces\ReportStatusRepositoryInterface;
use App\Models\ReportStatus;

class ReportStatusRepository implements ReportStatusRepositoryInterface{
    public function getAllReportStatus(){
        return ReportStatus::all();
    }

    public function getReportStatusById(int $id){
        return ReportStatus::where('id', $id)->first();
    }

    public function createReportStatus(array $data){
        return ReportStatus::create($data);
    }

    public function updateReportStatus(array $data, int $id){
        $ReportStatus = $this->getReportStatusById($id);
        return $ReportStatus->update($data);
    }

    public function deleteReportStatus(int $id){
        $ReportStatus = $this->getReportStatusById($id);

        return $ReportStatus->forceDelete();
    }
}
?>

