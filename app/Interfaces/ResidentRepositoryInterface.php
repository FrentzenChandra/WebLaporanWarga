<?php
namespace App\Interfaces;

interface ResidentRepositoryInterface
{
    public function getAllResident();

    public function getAllResidentFiltered(string $filterParam = "");

    public function getResidentById(int $id);

    public function createResident(array $data);

    public function updateResident(array $data, int $id);

    public function deleteResident(int $id);
}
