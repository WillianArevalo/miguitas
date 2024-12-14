<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Utils\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $customer =  Customer::where("user_id", $user->id)->first();
        $addresses = $customer ? Address::where("customer_id", $customer->id)->get() : [];
        return view("store.account.address.index", [
            "customer" => $customer,
            "addresses" => $addresses,
            "user" => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $addresses = Addresses::getAddresses();
        $countries = $this->getAllCountries();

        $data = resource_path("data/elsalvador.json");
        $data = json_decode(file_get_contents($data), true);
        $departamentos = array_reduce($data, function ($carry, $item) {
            $carry[$item["departamento"]] = $item["departamento"];
            return $carry;
        }, []);

        return view("store.account.address.new", [
            "addresses" => $addresses,
            "countries" => $countries,
            "departamentos" => $departamentos
        ]);
    }

    public function getAllCountries()
    {
        $path = resource_path('data/countries.json');
        $countries = json_decode(file_get_contents($path), true);
        return $countries;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        $validated = $request->validated();
        $user =  auth()->user();
        $customer = Customer::where("user_id", $user->id)->first();

        if (!$customer) {
            $customer = new Customer();
            $customer->user_id = $user->id;
            $customer->save();
        }

        $existingAddress = Address::where("customer_id", $customer->id)
            ->where("type", $validated["type"])
            ->first();

        if ($existingAddress) {
            return redirect()->route("account.index")->with("error", "Ya existe una dirección con el mismo tipo");
        }

        DB::beginTransaction();
        try {
            $address = new Address();
            $address->fill($validated);
            $address->customer_id = $customer->id;
            $address->save();
            DB::commit();
            return redirect()->route("account.index")->with("success", "Dirección guardada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("account.index")->with("error", "Error al guardar la dirección. Error: " . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $address = Address::where("slug", $slug)->first();
        if (!$address) return redirect()->route("account.index")->with("error", "Dirección no encontrada");
        $addresses = Addresses::getAddresses();
        return view("store.account.address.edit", ["address" => $address, "addresses" => $addresses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, string $id)
    {
        $validated = $request->validated();
        $address = Address::find($id);

        if (!$address) return redirect()->route("account.index")->with("error", "Dirección no encontrada");

        $existingAddress = Address::where("customer_id", $address->customer_id)
            ->where("type", $validated["type"])
            ->where("id", "!=", $address->id)
            ->first();

        if ($existingAddress) {
            return redirect()->route("account.index")->with("error", "Ya existe una dirección con el mismo tipo");
        }

        DB::beginTransaction();
        try {
            $address->fill($validated);
            $address->save();
            DB::commit();
            return redirect()->route("account.index")->with("success", "Dirección actualizada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("account.index")->with("error", "Error al actualizar la dirección. Error: " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::find($id);
        if (!$address) return redirect()->route("account.index")->with("error", "Dirección no encontrada");
        DB::beginTransaction();
        try {
            $address->delete();
            DB::commit();
            return redirect()->route("account.index")->with("success", "Dirección eliminada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("account.index")->with("error", "Error al eliminar la dirección. Error: " . $e->getMessage());
        }
    }

    public function getDepartamento(string $name)
    {
        $path = resource_path('data/elsalvador.json');
        $departamentos = json_decode(file_get_contents($path), true);
        $departamento = collect($departamentos)->firstWhere('departamento', $name);
        if (!$departamento) {
            return response()->json(['error' => 'Departamento no encontrado'], 404);
        }
        return $departamento;
    }

    public function getMunicipios(Request $request)
    {
        $departamento = $this->getDepartamento($request->state);
        $names = array_column($departamento['municipios'], "nombre");
        $municipios = array_combine($names, $names);

        return response()->json([
            "status" => "success",
            "names" => $names,
            "html" => view("layouts.__partials.ajax.store.select", [
                "options" => $municipios,
                "type" => "Municipio"
            ])->render()
        ]);
    }

    public function getDistritos(Request $request)
    {
        $departamento = $this->getDepartamento($request->state);
        $municipio = collect($departamento['municipios'])->firstWhere('nombre', $request->city);
        if (!$municipio) {
            return response()->json(['error' => 'Municipio no encontrado'], 404);
        }

        $distritos = array_combine($municipio['distritos'], $municipio['distritos']);

        return response()->json([
            "status" => "success",
            "names" => $municipio['distritos'],
            "html" => view("layouts.__partials.ajax.store.select", [
                "options" => $distritos,
                "type" => "Distrito"
            ])->render()
        ]);
    }
}