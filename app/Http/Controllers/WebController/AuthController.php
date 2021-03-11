<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\ProfilUserModel as Profil;
use Illuminate\Support\Facades\Validator;
use DB;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // dd(Auth::user()->role);
            if (Auth::user()->role === 'guru') {
                return redirect()->intended('/admin-page');
            } else if (Auth::user()->role === 'siswa') {
                return redirect()->intended('/');
            }
        }

        return redirect('login');
    }

    public function logout() {
        Auth::logout();

        return redirect('login');
    }

    public function view() {
        if (Auth::check()) {
            return redirect()->intended('/');
        } else {
            return view('login');
        }
    }

    public function register_view() {
        if (Auth::check()) {
            return redirect()->intended('/');
        } else {
            return view('register');
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'username' => 'required|max:255|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
        ], [
            'email.unique' => 'Email sudah digunakan',
            'email.required' => 'Kolom email harus diisi',
            'username.required' => 'Kolom username harus diisi',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password dibutuhkan',
            'password.min' => 'Password harus lebih dari 8 karakter'
        ]);

        if($validator->fails()) {
            return back()->with([
                'error' => $validator->errors()
            ]);
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'role' => $request->get('role')
            ]);

            $profil = Profil::create([
                'user_id' => $user->user_id,
                'nama' => $request->input('nama'),
                'kelas' => $request->input('kelas')
            ]);
        } catch(Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => $e->getMessage
            ]);
        }

        DB::commit();

        return redirect('/login');
    }
}
