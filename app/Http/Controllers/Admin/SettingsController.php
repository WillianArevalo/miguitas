<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Models\User;
use App\Utils\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $user = Auth::user();
        $addresses = Addresses::getAddresses();
        $countries = $this->getAllCountries();
        return view("admin.settings.index", [
            "user" => $user,
            "addresses" => $addresses,
            "countries" => $countries
        ]);
    }

    public function update(Request $request)
    {

        $request->validate([
            "username" => "required|string",
            "name" => "required|string",
            "last_name" => "nullable|string",
            "area_code" => "nullable|string",
            "phone" => "nullable|string",
            "birthdate" => "nullable|date",
            "gender" => "nullable|string",
            "country" => "nullable|string",
            "type" => "nullable|string",
            "state" => "nullable|string",
            "address_line_1" => "nullable|string",
            "address_line_2" => "nullable|string",
            "city" => "nullable|string",
            "zip_code" => "nullable|string",
            "city" => "nullable|string",
        ]);

        DB::beginTransaction();
        try {
            $user = User::find(auth()->user()->id);
            $user->username = $request->username;
            $user->name = $request->name;
            $user->last_name = $request->last_name;

            if ($user->customer) {
                $user->customer->area_code = $request->area_code;
                $user->customer->phone = $request->phone;
                $user->customer->birthdate = $request->birthdate;
                $user->customer->gender = $request->gender;
                $user->customer->save();
            } else {
                $user->customer()->create([
                    "area_code" => $request->area_code,
                    "phone" => $request->phone,
                    "birthdate" => $request->birthdate,
                    "user_id" => $user->id,
                ]);
            }

            if ($user->customer && $user->customer->address) {
                $user->customer->address->country = $request->country;
                $user->customer->address->type = $request->type;
                $user->customer->address->state = $request->state;
                $user->customer->address->address_line_1 = $request->address_line_1;
                $user->customer->address->address_line_2 = $request->address_line_2;
                $user->customer->address->city = $request->city;
                $user->customer->address->zip_code = $request->zip_code;
                $user->customer->address->save();
            } else {
                $user->customer->address()->create([
                    "country" => $request->country,
                    "type" => $request->type,
                    "state" => $request->state,
                    "address_line_1" => $request->address_line_1,
                    "address_line_2" => $request->address_line_2,
                    "city" => $request->city,
                    "zip_code" => $request->zip_code,
                ]);
            }

            $user->save();
            DB::commit();
            return redirect()->route("admin.settings.index")
                ->with("success", "Configuración actualizada");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("admin.settings.index")
                ->with("error", "Error al actualizar la configuración");
        }
    }

    public function changeColor(Request $request)
    {
        $auth = Auth::user();
        DB::beginTransaction();
        try {
            $user = User::find($auth->id);
            $user->color = $request->input("color");
            $user->update();
            DB::commit();
            return response()->json([
                "success" => "Tema actualizado",
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al actualizar el tema"], 500);
        }
    }


    public function getAllCountries()
    {
        $path = resource_path('data/countries.json');
        $countries = json_decode(file_get_contents($path), true);
        return $countries;
    }

    public function changeTheme(Request $request)
    {
        $auth = Auth::user();
        DB::beginTransaction();
        try {
            $user = User::find($auth->id);
            $user->theme = $request->input("theme");
            $user->update();
            DB::commit();
            return response()->json(["success" => "Tema actualizado"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al actualizar el tema"], 500);
        }
    }

    public function changeProfilePhoto(Request $request)
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
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al actualizar la foto de perfil"], 500);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            "current-password" => "required|string",
            "new-password" => "required|string",
            "confirm-password" => "required|string",
        ]);

        DB::beginTransaction();
        try {

            $user = User::find(auth()->user()->id);
            if (!Hash::check($request->input("current-password"), $user->password)) {
                return redirect()->route("admin.settings.index")
                    ->with("error", "La contraseña actual no coincide");
            }

            if ($request->input("new-password") !== $request->input("confirm-password")) {
                return redirect()->route("admin.settings.index")
                    ->with("error", "Las contraseñas no coinciden");
            }

            $user->password = Hash::make($request->input("new-password"));
            $user->last_password_change = now();
            $user->update();
            DB::commit();
            return redirect()->route("admin.settings.index")
                ->with("success", "Contraseña actualizada");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("admin.settings.index")
                ->with("error", "Error al actualizar la contraseña");
        }
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            "email" => "required|email",
        ]);
        DB::beginTransaction();
        try {
            $user = User::find(auth()->user()->id);
            $user->email = $request->email;
            $user->update();
            DB::commit();
            return redirect()->route("admin.settings.index")
                ->with("success", "Correo electrónico actualizado");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("admin.settings.index")
                ->with("error", "Error al actualizar el correo electrónico");
        }
    }
}