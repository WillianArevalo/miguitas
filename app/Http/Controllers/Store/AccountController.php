<?php

namespace App\Http\Controllers\Store;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateRequest;
use App\Mail\VerifyEmail;
use App\Models\Address;
use App\Models\Customer;
use App\Models\User;
use App\Utils\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $customer =  Customer::where("user_id", $user->id)->first();

        $addressesCustomer = $customer
            ? Address::where("customer_id", $customer->id)->get()
            : [];


        $orders =
            $customer
            ? $customer->orders()->with("items")->get()
            : collect();

        $addresses = Addresses::getAddresses();

        if (!$user->email_verified_at && !$user->google_id) {
            session()->flash('warning', 'Verifica tu correo electrónico para mantener tus datos seguros.');
        }

        return view("store.account.index", [
            "user" => $user,
            "customer" => $customer,
            "addresses" => $addresses,
            "addressesCustomer" => $addressesCustomer,
            "orders" => $orders
        ]);
    }

    public function settings()
    {
        $auth = auth()->user();
        $user = User::with("customer")->find($auth->id);
        return view("account.index", ["user" => $user]);
    }

    public function settingsEdit()
    {
        $auth = auth()->user();
        $user = User::with("customer")->find($auth->id);
        return view("store.account.settings.settings-edit", ["user" => $user]);
    }

    public function settingsUpdate(AccountUpdateRequest $request)
    {
        $validated = $request->validated();
        $auth = auth()->user();
        $user = User::find($auth->id);
        if (!$user) return redirect()->route("account.index")->with("error", "Usuario no encontrado");
        DB::beginTransaction();
        try {
            $user->update($validated);
            if ($user->customer) {
                $user->customer->update($validated);
            } else {
                $user->customer()->create($validated);
            }
            DB::commit();
            return redirect()->route("account.index")->with("success", "Datos actualizados correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("account.index")->with("error", "Error al actualizar los datos. Error: " . $e->getMessage());
        }
    }

    public function changePassword()
    {
        $user = auth()->user();
        if (!$user->email_verified_at && !$user->google_id) {
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->email_token_expires_at = now()->addMinutes(10);
            $user->save();

            Mail::to($user->email)->send(new VerifyEmail(
                $user->name,
                route("verification.verify", ["token" => $token]),
                $token
            ));

            return redirect()->route("verification.notice");
        }

        return view("store.account.change-password");
    }

    public function editPassword(Request $request)
    {
        $rules = [
            "password" => "required|string",
            "new-password" => "required|string",
            "confirm-password" => "required|string"
        ];

        $validated = $request->validate($rules);
        $auth = auth()->user();
        $user = User::find($auth->id);

        if (!$user) return response()->json([
            "error" => "Usuario no encontrado"
        ], 404);

        if (password_verify($validated["password"], $user->password)) {
            if ($validated["new-password"] === $validated["confirm-password"]) {
                DB::beginTransaction();
                try {
                    $user->password = Hash::make($validated["new-password"]);
                    $user->save();
                    DB::commit();
                    return response()->json([
                        "success" => "Contraseña actualizada correctamente"
                    ], 200);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        "error" => "Error al actualizar la contraseña"
                    ], 500);
                }
            } else {
                return response()->json([
                    "error" => "Las contraseñas no coinciden"
                ], 400);
            }
        } else {
            return response()->json([
                "error" => "La contraseña actual es incorrecta"
            ], 400);
        }
    }

    public function changeProfile(Request $request)
    {
        $auth = Auth::user();
        DB::beginTransaction();
        try {
            $user = User::find($auth->id);
            $img = $user->profile;
            if ($request->hasFile("profile")) {
                if ($user->profile !== "images/default-profile.png") {
                    ImageHelper::deleteImage($user->profile);
                    $img = ImageHelper::saveImage($request->file("profile"), "images/profile-photos");
                } else {
                    $img = ImageHelper::saveImage($request->file("profile"), "images/profile-photos");
                }
            }
            $user->profile = $img;
            $user->update();
            DB::commit();
            return response()->json([
                "success" => "Foto de perfil actualizada",
                "html" => view("layouts.__partials.ajax.admin.settings.profile-photo", compact("user"))->render()
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al actualizar la foto de perfil"], 500);
        }
    }
}