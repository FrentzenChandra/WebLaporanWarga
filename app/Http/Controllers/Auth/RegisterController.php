<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Interfaces\ResidentRepositoryInterface;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

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

        $user = $this->ResidentRepository->createResident($data);

        event(new Registered($user));

        return redirect()->route('login');
    }

    public function verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/');
    }

    public function sendEmail () {
        return view('pages.auth.verify-email');
    }

    public function resendEmailNotif(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function editUser(string $id)
    {

        if (Auth::user()->resident->id == $id) {
            $Resident = $this->ResidentRepository->getResidentById($id);
            return view('pages.app.editProfile', compact('Resident'));
        }

        return redirect()->route('profile')->with('message', 'Kamu Tidak Diperbolehkan Untuk Melakukan Edit Pada Akun Itu!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(UpdateResidentRequest $request, string $id)
    {
        if (Auth::user()->resident->id == $id) {
            $data = $request->validated();


            if ($request->avatar) {
                $data['avatar'] = $request->file('avatar')->store('assets/avatar', 'public');
                Storage::disk('public')->delete( $request['old-avatar']);
            }

            $this->ResidentRepository->updateResident($data, $id);


            Swal::fire([
                'position' => "top-end",
                'icon'=> "success",
                'title'=> "Data Penduduk Berhasil Diubah",
                'showConfirmButton='=> tRUE,
                'timer'=> 1000]);

            return redirect()->route('profile');
        }
    }

}
