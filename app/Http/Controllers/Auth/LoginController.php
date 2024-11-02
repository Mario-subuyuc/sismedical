<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;
use Carbon\Carbon;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers; 

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function send2FACode(User $user)
    {
        $user->two_factor_code = rand(1000, 9999);  // Generar código de 4 dígitos
        $user->two_factor_expires_at = Carbon::now()->addMinutes(10);  // Expira en 10 minutos
        $user->save();

        // Verificar si el correo es enviado con éxito
        Mail::to($user->email)->send(new TwoFactorCodeMail($user));
    }

    protected function authenticated(Request $request, $user)
    {
        // Enviar el código 2FA al correo del usuario
        $this->send2FACode($user);
    
        // Verificar si este punto se ejecuta
        //   dd('Redirigiendo a verificación 2FA'); 
    
        // Redirigir a la página de verificación del código 2FA
        return redirect()->route('2fa.verify');
    }
    
    
}
