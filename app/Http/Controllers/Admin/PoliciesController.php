<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\PolicyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class PoliciesController extends Controller
{
    public function index()
    {
        $policies = Policy::all();
        return view('admin.policies.index', compact("policies"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file_path.*' => 'required|mimes:pdf,png,jpg,jpeg,webp|max:10240',
        ]);

        $files = $request->file('file_path');
        $filePaths = [];

        if ($files) {
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $filePath = $file->storeAs('policies', $filename, 'public');
                $filePaths[] = $filePath;
            }
        }
        DB::beginTransaction();
        try {

            $policy = Policy::create([
                'name' => $request->name,
            ]);

            foreach ($filePaths as $filePath) {
                PolicyImage::create([
                    'policy_id' => $policy->id,
                    'file_path' => $filePath,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.policies.index')->with('error', 'An error occurred while creating the policy');
        }
    }

    public function destroy(string $id)
    {
        $policy = Policy::find($id);
        if ($policy) {
            DB::beginTransaction();
            try {
                foreach ($policy->images as $image) {
                    ImageHelper::deleteImage($image->file_path);
                }
                $policy->images()->delete();
                $policy->delete();
                DB::commit();
                return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('admin.policies.index')->with('error', 'An error occurred while deleting the policy');
            }
        }
        return redirect()->route('admin.policies.index')->with('error', 'Policy not found');
    }

    public function show(Policy $policy)
    {
        $date = now()->timezone("America/El_Salvador")->format("Y-m-d H:i:s");
        $pdf = PDF::loadView('store.pdf.policy', [
            'policy' => $policy,
            'date' => $date,
        ])->setPaper('a4', 'portrait');
        return $pdf->stream($policy->name . ".pdf");
    }

    public function download(Policy $policy)
    {
        $date = now()->timezone("America/El_Salvador")->format("Y-m-d H:i:s");
        $pdf = PDF::loadView('store.pdf.policy', [
            'policy' => $policy,
            'date' => $date,
        ])->setPaper('a4', 'portrait');
        return $pdf->download($policy->name . ".pdf");
    }
}
