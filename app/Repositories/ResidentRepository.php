<?php

namespace App\Repositories;
use App\Interfaces\ResidentRepositoryInterface;
use App\Models\Resident;
use App\Models\User;

class ResidentRepository implements ResidentRepositoryInterface
{
    public function getAllResident()
    {
        return Resident::all();
    }

    public function getResidentById(int $id)
    {
        // Implement the logic to get a Resident by ID
        return Resident::where('id', $id)->first();
    }

    public function createResident(array $data)
    {
        // Implement the logic to create a new Resident
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user->resident()->create($data);
    }

    public function updateResident(array $data, int $id)
    {
        // Implement the logic to update a Resident
        $Resident = $this->getResidentById($id);

        $Resident->user->update([
            'name' => $data['name'],
            'password' => (isset($data['password']) ? bcrypt($data['password'])  : $Resident->user->password),
        ]);

        return $Resident->update($data);
    }

    public function deleteResident(int $id)
    {
        // Implement the logic to delete a Resident
        $resident = $this->getResidentById($id);

        $resident->user->delete();

        return $resident->delete();

    }
}
