<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Models\Rate;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function index()
    {
        $rates = Rate::paginate(15);
        $data = resource_path("data/elsalvador.json");
        $data = json_decode(file_get_contents($data), true);
        $departamentos = array_reduce($data, function ($carry, $item) {
            $carry[$item["departamento"]] = $item["departamento"];
            return $carry;
        }, []);
        return view("admin.sales_strategies.rates.index", [
            "rates" => $rates,
            "departamentos" => $departamentos
        ]);
    }

    public function store(RateRequest $request)
    {
        try {
            DB::beginTransaction();
            Rate::create($request->all());
            DB::commit();
            return back()->with("success", "Tarifa de envío guardada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al guardar la tarifa de envío");
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            Rate::destroy($id);
            DB::commit();
            return back()->with("success", "Tarifa de envío eliminada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al eliminar la tarifa de envío");
        }
    }

    public function edit(string $id)
    {
        $rate = Rate::find($id);
        if ($rate) {
            return response()->json(["rate" => $rate]);
        }
    }

    public function update(string $id, Request $request)
    {
        try {
            DB::beginTransaction();
            $rate = Rate::find($id);
            $rate->update($request->all());
            DB::commit();
            return back()->with("success", "Tarifa de envío actualizada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al actualizar la tarifa de envío");
        }
    }
}