<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidentRequest;
use App\Interfaces\ResidentRepositoryInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private ResidentRepositoryInterface $ResidentRepository;
    public function __construct(ResidentRepositoryInterface $ResidentRepository)
    {
        $this->ResidentRepository = $ResidentRepository;
    }

    public function create() {
        return view('pages.auth.register');
    }

    public function store(StoreResidentRequest $request) {
        $data = $request->validated();

        $data['avatar'] = $request->file('avatar')->store('assets/avatar' , 'public');

        $this->ResidentRepository->createResident($data);

        return redirect()->route('login')->with('success' , 'yay Pendaftaran Berhasil Silakan Login');
    }


}
