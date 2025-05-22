<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Interfaces\ResidentRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class ResidentController extends Controller
{
    // ini berguna untuk membuat sebuah variabel ResidentRepository yang dimana
    // Resident Repository berisi function function model yang digunakan untuk memangil database
    private ResidentRepositoryInterface $ResidentRepository;
    public function __construct(ResidentRepositoryInterface $ResidentRepository)
    {
        $this->ResidentRepository = $ResidentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Residents = $this->ResidentRepository->getAllResident();
        return view('pages.admin.Resident.index', compact('Residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.Resident.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResidentRequest $request)
    {
        $data = $request->validated();

        $data['avatar'] = $request->file('avatar')->store('assets/avatar' , 'public');

        $this->ResidentRepository->createResident($data);

        Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Penduduk Baru Berhasil Dibuat",
            'showConfirmButton='=> TRUE,
            'timer'=> 1000]);
        return redirect()->route('admin.Resident.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $Resident = $this->ResidentRepository->getResidentById($id);

       return view('pages.admin.Resident.show', compact('Resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Resident = $this->ResidentRepository->getResidentById($id);
        return view('pages.admin.Resident.edit', compact('Resident'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResidentRequest $request, string $id)
    {
        $data = $request->validated();


        if ($request->avatar) {
            $data['avatar'] = $request->file('avatar')->store('assets/avatar', 'public');
            Storage::disk('public')->delete( $request['old-avatar']);
        }else {
            $data['avatar'] = $request['old-avatar'];
        }


        $this->ResidentRepository->updateResident($data, $id);


          Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Penduduk Berhasil Diubah",
            'showConfirmButton='=> tRUE,
            'timer'=> 1000]);

        return redirect()->route('admin.Resident.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resident = $this->ResidentRepository->getResidentById($id);

        Storage::disk('public')->delete($resident['avatar']);


        $this->ResidentRepository->deleteResident($id);

        Swal::fire([
            'position' => "top-end",
            'icon'=> "success",
            'title'=> "Data Penduduk Berhasil DiHapus",
            'showConfirmButton=' => tRUE,
            'timer'=> 1000]);

        return redirect()->route('admin.Resident.index');
    }
}
