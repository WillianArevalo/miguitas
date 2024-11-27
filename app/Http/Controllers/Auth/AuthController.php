<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view("login");
    }

    public function showRegisterForm()
    {
        return view("register");
    }

    public function validate(Request $request)
    {
        $rules = [
            "email" => "required|email",
            "password" => "required"
        ];

        $request->validate($rules);
        $credentials = $request->only("email", "password");
        $user = User::where("email", $credentials["email"])->first();

        if (Auth::attempt($credentials, $request->filled("remember"))) {
            $user->update(["last_login" => now()]);
            $user->update(["last_ip_address" => $request->ip()]);
            if ($user->role != "admin") {
                return redirect()->route("home");
            } else {
                return redirect()->route("admin.index");
            }
        }

        if (!$user) {
            return redirect()->back()->with("error", "Usuario no encontrado")->withInput(request()->only("email"));
        }

        if (!Hash::check($credentials["password"], $user->password)) {
            return redirect()->back()->with("error", "Contraseña incorrecta")->withInput(request()->only("email"));
        }

        Auth::login($user);
        if ($user->role != "admin") {
            return redirect()->route("home");
        } else {
            return redirect()->route("admin.index");
        }
    }

    public function validateAdmin(LoginAdminRequest $request)
    {
        $credentials = $request->only("email", "password");
        $user = User::where("email", $credentials["email"])->first();
        if (!$user) {
            return redirect()->back()->with("error", "Usuario no encontrado")->withInput(request()->only("email"));
        }
        if (!Hash::check($credentials["password"], $user->password)) {
            return redirect()->back()->with("error", "Contraseña incorrecta")->withInput(request()->only("email"));
        }
        Auth::login($user);
        $user->update(["last_login" => now()]);
        $user->update(["last_ip_address" => $request->ip()]);
        return redirect()->route("admin.index");
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->back();
    }

    public function register(Request $request)
    {
        $rules = [
            "name" => "required",
            "last_name" => "required",
            "email" => "required|email",
            "password" => "required"
        ];
        DB::beginTransaction();
        try {
            $request->validate($rules);
            $validated = $request->all();
            $validated["password"] = Hash::make($validated["password"]);
            $validated["username"] = $validated["name"] . $validated["last_name"];
            $user = User::create($validated);
            Auth::login($user);
            DB::commit();
            return redirect()->route("home");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", "Error al registrar el usuario.");
        }
    }

    public function showVerifyEmail()
    {
        $user = auth()->user();
        if (!$user->email_verified_at) {
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->email_token_expires_at = now()->addMinutes(10);
            $user->save();

            Mail::to($user->email)->send(new VerifyEmail(
                $user->name,
                route("verification.verify", ["token" => $token]),
                $token
            ));
        }
        return view("store.email.email-verified");
    }

    function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        $user = auth()->user();
        if (
            $user->remember_token === $token &&
            $user->email_token_expires_at &&
            Carbon::now()->lessThanOrEqualTo($user->email_token_expires_at)
        ) {
            $user->email_verified_at = now();
            $user->save();
            return redirect()->route("account.index")->with("success", "Correo electrónico verificado correctamente.");
        }

        // Token inválido o expirado
        return redirect()->route('account.index')->with(
            'error',
            'El enlace de verificación ha expirado o es inválido.'
        );
    }
}