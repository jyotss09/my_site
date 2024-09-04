<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    // Create a new address
    public function createAddress(Request $request)
    {
        $request->validate([
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        $address = Address::create([
            'user_id' => $request->user()->id, // Assuming user is authenticated
            'street_address' => $request->input('street_address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'pincode' => $request->input('pincode'),
            'country' => $request->input('country'),
        ]);

        return response()->json(['id' => $address->id], 201);
    }
}