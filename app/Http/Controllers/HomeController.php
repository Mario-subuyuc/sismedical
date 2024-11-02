<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.2fa_verify'); // Asegúrate de que la vista exista
    }


    public function verify2FA(Request $request)
{
    $user = Auth::user();  // Asegúrate de usar Auth::user()
    
    if (!$user) {
        return redirect()->route('login')->withErrors(['code' => 'Usuario no autenticado.']);
    }
    
    // Convierte two_factor_expires_at en un objeto Carbon
    $expiresAt = Carbon::parse($user->two_factor_expires_at);

    // Verificar si el código es correcto y no ha expirado
    if ($user->two_factor_code === $request->code && $expiresAt->isFuture()) {
        $user->resetTwoFactorCode();

        // Redirigir al destino final
        return redirect()->intended($this->redirectPath());
    }
    
    return redirect()->back()->withErrors(['code' => 'El código es incorrecto o ha expirado.']);
}

protected function redirectPath()
{
    return '/admin'; 
}
}
