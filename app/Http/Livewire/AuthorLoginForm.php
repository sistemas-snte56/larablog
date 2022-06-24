<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLoginForm extends Component
{
    public $email, $password;

    public function LoginHandler() {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5'
        ],[
            'email.required'=>'Ingresa tu correo electrónico',
            'email.email' => 'Dirección de correo no valido',
            'email.exists' => 'Correo electrónico no registrado.',
            'password.required' => 'La contraseña es requerida'
        ]);
        $creds = array('email'=>$this->email,'password'=>$this->password);

        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where('email', $this->email)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail','Su cuenta ha sido bloqueada.');
            } else {
                return redirect()->route('author.home');
            }
            
        } else {
            session()->flash('fail','Correo electrónico o Contraseña incorrectos');
        }
    }
    
    public function render()
    {
        return view('livewire.author-login-form');
    }
}
