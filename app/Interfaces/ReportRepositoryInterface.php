<?php
namespace App\Interfaces;

interface ReportRepositoryInterface
{
    public function getAllReport();

    public function getLatestReport();

    public function getReportByCode(string $code);

    public function getReportByCategory(string $category);

    public function getAllReportByResidentId(string $status);

    public function getReportById(int $id);

    public function createReport(array $data);

    public function updateReport(array $data, int $id);

    public function deleteReport(int $id);
}
