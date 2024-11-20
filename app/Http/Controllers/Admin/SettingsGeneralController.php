<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsGeneralController extends Controller
{
    public function index()
    {
        $maintenance = Settings::where('key', 'site_in_maintenance')->first();
        $settings = Settings::all();
        $socialLinks = SocialLink::all();
        return view('admin.general_settings.index', compact('maintenance', 'settings', 'socialLinks'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            foreach ($request->all() as $key => $value) {
                if ($key == '_token' || $key == '_method') continue;

                if ($key == "store_logo" && $request->hasFile("store_logo")) {
                    $file = $request->file("store_logo");
                    $value = ImageHelper::saveImage($file, 'images/settings');
                }

                if ($key == "store_favicon" && $request->hasFile("store_favicon")) {
                    $file = $request->file("store_favicon");
                    $value = ImageHelper::saveImage($file, 'images/settings');
                }

                Settings::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            DB::commit();
            return redirect()->route('admin.general-settings.index')->with('success', 'Datos actualizados correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.general-settings.index')->with('error', 'Error al actualizar los datos');
        }
    }

    public function maintenanceUpdate(Request $request)
    {
        $maintenance = $request->input("site_in_maintenance");
        DB::beginTransaction();
        try {
            if (!$request->input("site_in_maintenance")) {
                $maintenance = 0;
            } else {
                $maintenance = 1;
            }
            $settings = Settings::where('key', 'site_in_maintenance')->first();
            $settings->update(['value' => $maintenance]);
            DB::commit();
            return response()->json(['success' => 'Maintenance mode updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error updating maintenance mode']);
        }
    }
}