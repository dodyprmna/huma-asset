<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index() {
        return view('pages.auth.login');
    }

    function auth(Request $request) {
        $request->validate([
            'nip'     => 'required',
            'password'  => 'required'
        ],
        [
            'nip.required'        => 'NIP tidak boleh kosong',
            'password.required'     => 'Password tidak boleh kosong'
        ]);

        $credentials = array(
            'nip'     => $request->nip,
            'password'  => $request->password,
        );

        if (Auth::attempt($credentials)) {
            return redirect('/bangunan');
        }else{
            echo "nip atau password salah";
        }

        // return redirect('/');
        
    }
}
