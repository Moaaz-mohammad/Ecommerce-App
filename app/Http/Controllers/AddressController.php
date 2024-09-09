<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->get();
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'zip_code' => 'required',
            'title' => 'required',
        ]);

        $new_address = Address::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Address added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'address' => 'required',
            'zip_code' => 'required',
            'title' => 'required',
        ]);
        $address->update([
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Address Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->back()->with('success', 'Address deleted successfully');
    }
}
