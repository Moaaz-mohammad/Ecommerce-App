<?php

namespace App\Http\Controllers;

use App\Models\KoponCode;
use Illuminate\Http\Request;

class KoponCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $koponCodes = KoponCode::orderBy('created_at', 'DESC')->get();
        return view('dashboard.koponCodes.index', compact('koponCodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.koponCodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'code' => 'required',
            'descount_price' => 'required'
        ]);

        $koponCode = KoponCode::create($request->all());
        return redirect()->back()->with('success', 'Kopon add successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(KoponCode $koponCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KoponCode $koponCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KoponCode $koponCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KoponCode $koponCode)
    {
        //
    }

    public function checkKopon(Request $request) {
        $codesent = $request->koponCode;
        $koponCodes = KoponCode::all();

        $price = 0;
        foreach ($koponCodes as $code) {
            if ($code->code == $codesent) {
                $price +=  $code->descount_price;
            }
        }
        
        return response()->json([
            'data' => $price,
        ]
    );
    }
}
