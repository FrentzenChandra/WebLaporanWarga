<?php

namespace App\Repositories;
use App\Interfaces\ResidentRepositoryInterface;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

class ResidentRepository implements ResidentRepositoryInterface
{
    public function getAllResident()
    {
        return Resident::all();
    }
    public function getAllResidentFiltered(string $filterParam = "")
    {
        return DB::table('residents')
        ->join('users' , 'users.id' ,'=', 'residents.user_id')
        ->select('residents.id as id_resident',
                'residents.user_id',
                'residents.avatar',
                'users.name' ,
                'users.email')
        ->where('residents.deleted_at', NULL)
        ->whereAny(['name' , 'email'], 'like' , '%'.$filterParam.'%')
        ->get();
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

        $user->assignRole('resident');

        $user->resident()->create($data);
        return $user;
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

        $resident->user->forceDelete();

        return $resident->forceDelete();

    }
}
