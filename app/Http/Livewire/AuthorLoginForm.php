<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLoginForm extends Component
{
    public $login_id, $password;

    public function LoginHandler() {

        /***
         * Validar el ingreso si es por email o por usuario | Valida una dirección de correo electrónico.
         * La variable login_id viene de author-login-form
         */
        
        $fielType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

       

        if ($fielType == 'email') {
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'login_id' => 'required|min:5'
            ],[
                'login_id'=>'Usuario o correo requerido.',
                'login_id.email' => 'Dirección de correo no valido.',
                'login_id.exists' => 'Correo electrónico no registrado.',
                'password.required' => 'La contraseña es requerida.'
            ]);

        } else {
            $this->validate([ # Se valida si existe usuario
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5'
            ],[
                'login_id.required'=>'Usuario o correo requerido.',
                'login_id.exists' => 'Usuario no registrado.',
                'password.required' => 'La contraseña es requerida.'
            ]);

        }

        #La variable $creds es una cadena que mostratar el tipo de archivo que es 
        $creds = array( $fielType => $this->login_id, 'password' => $this->password );

        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where($fielType, $this->login_id)->first();
            if ($checkUser->blocked == 1) { #Verificamos si el usuario que intenta ingresar no se encuentra bloqueado
                Auth::guard('web')->logout();
            } else {
                return redirect()->route('author.home');
                return redirect()->route('author.login')->with('fail','Su cuenta ha sido bloqueada.');
            }
            
        } else {
            session()->flash('fail','Usuario / email o contraseña incorrectos.');
        }
        



        // $this->validate([
        //     'email' => 'required|email|exists:users,email',
        //     'password' => 'required|min:5'
        // ],[
        //     'email.required'=>'Ingresa tu correo electrónico',
        //     'email.email' => 'Dirección de correo no valido',
        //     'email.exists' => 'Correo electrónico no registrado.',
        //     'password.required' => 'La contraseña es requerida'
        // ]);
        // $creds = array('email'=>$this->email,'password'=>$this->password);

        // if (Auth::guard('web')->attempt($creds)) {
        //     $checkUser = User::where('email', $this->email)->first();
        //     if ($checkUser->blocked == 1) {
        //         Auth::guard('web')->logout();
        //         return redirect()->route('author.login')->with('fail','Su cuenta ha sido bloqueada.');
        //     } else {
        //         return redirect()->route('author.home');
        //     }
            
        // } else {
        //     session()->flash('fail','Correo electrónico o contraseña incorrectos.');
        // }
    }
    
    public function render()
    {
        return view('livewire.author-login-form');
    }
}
