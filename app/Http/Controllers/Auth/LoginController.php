<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:customer,merchant',
        ]);

        // Cek kredensial dan role
        $user = User::where('email', $credentials['email'])
                    ->where('role', $credentials['role'])
                    ->first();

        if (!$user || !Auth::attempt(['email' => $credentials['email'], 'password' => $request->password])) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }

        // Login user
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role === 'merchant') {
            return redirect()->route('merchant.dashboard'); // Ganti dengan rute dashboard merchant Anda
        } else {
            return redirect()->route('customer.dashboard'); // Ganti dengan rute dashboard customer Anda
        }
    }
}
