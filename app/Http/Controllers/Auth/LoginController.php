<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    private AuthRepositoryInterface $authRepository;
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function index()
    {
        return view('pages.auth.login');
    }

    public function store(StoreLoginRequest $request){
        $credentials = $request->validated();

        if($this->authRepository->login($credentials)) {
        if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                logger('Login gagal untuk email: ' . $credentials['email']);
            }
        }

        return redirect()->route('home');
    }

    public function logout() {
        $this->authRepository->logout();

        return redirect()->route('login');
    }



}
