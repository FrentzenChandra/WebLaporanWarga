<?php

namespace App\Repositories;
use App\Interfaces\ResidentRepositoryInterface;
use App\Models\Resident;

class ResidentRepository implements ResidentRepositoryInterface
{
    public function getAllResidents()
    {
        return Resident::all();
    }

    public function getResidentById(int $id)
    {
        // Implement the logic to get a resident by ID
        return Resident::where('id', $id)->first();
    }

    public function createResident(array $data)
    {
        // Implement the logic to create a new resident
        return Resident::create($data);
    }

    public function updateResident(array $data, int $id)
    {
        // Implement the logic to update a resident
        $resident = $this->getResidentById($id);
        return $resident->update($data);
    }

    public function deleteResident(int $id)
    {
        // Implement the logic to delete a resident
        $resident = $this->getResidentById($id);
        return $resident->delete();
    }
}