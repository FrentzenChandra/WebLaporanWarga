<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidentRequest;
use App\Interfaces\ResidentRepositoryInterface;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

}
