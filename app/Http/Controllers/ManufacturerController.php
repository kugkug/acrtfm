<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreManufacturerRequest $request)
    {
        $request->validate([
            'brand'=>'required|max:255',
            'brand_logo'=>'required|mimes:jpg,jpeg,png',
        ]);

        $brand = $request->brand;
        $brand_logo = $request->file('brand_logo');
        if ($brand_logo) {
            $logo_name = strtolower($brand).".".$brand_logo->getClientOriginalExtension();
            if ($brand_logo->move('images/brand_logos', $logo_name)) {
                Manufacturer::create([
                    'brand' => $brand,
                    'brand_logo' => $logo_name,
                ]);

                return response()->json(['message' => 'Successfully Saved']);
            }
        } else {
            return response()->json(['message' => 'Invalid Brand Logo']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        //
    }
}
