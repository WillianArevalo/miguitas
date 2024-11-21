<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\Settings;
use Barryvdh\DomPDF\Facade\Pdf;

class TermsAndConditionsController extends Controller
{
    public function getPolicy(string $slug)
    {
        $policy = Policy::where('slug', $slug)->first();
        return view("store.terms-and-conditions.policity", compact('policy'));
    }

    public function downloadPdf(Policy $policy)
    {
        $date = now()->timezone("America/El_Salvador")->format("Y-m-d H:i:s");
        $pdf = PDF::loadView('store.pdf.policy', [
            'policy' => $policy,
            'date' => $date,
        ])->setPaper('a4', 'portrait');
        return $pdf->download($policy->name . ".pdf");
    }
}
