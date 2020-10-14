<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\User;
use DB;

class AuthController extends Controller
{
    public function register(Request $request) {
        try {
            DB::beginTransaction();
            $user = new User;
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            
            SendEmail::dispatch($request->input('email'));
        } catch(\Exception $e) {
            DB::rollback();

            return response()->json([
                'code' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
        DB::commit();

        return response()->json([
            'code' => 200,
            'message' => "Berhasil registrasi"
        ], 200);
    }

    public function verification($code) {
        $code = base64_decode($code);
        $email = explode('|', $code);
        try {
            DB::beginTransaction();

            User::where('email', $email[1])
                ->update([
                    'email_verified_at' => date('Y-m-d H:i:s')
                ]);
        } catch(\Exception $e) {
            DB::rollback();

            return response()->json([
                'code' => 400,
                'message' => $e->getMessage()
            ], 400);
        }

        DB::commit();

        return response()->json([
            'code' => 200,
            'message' => 'Berhasil verifikasi'
        ], 200);
    }
}
