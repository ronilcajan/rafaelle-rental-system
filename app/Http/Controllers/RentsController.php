<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Property;
use App\Models\Rents;
use App\Models\Tenants;
use Illuminate\Http\Request;

class RentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rents.index', [
            'title' => 'Rents Management',
            'rents' => Rents::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rents.create', [
            'title' => 'Create Rents',
            'tenants' => Tenants::get(),
            'properties' => Property::where('status','vacant')->get(),
            'owners' => Owner::get(), 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rents $rents)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rents $rents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rents $rents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rents $rents)
    {
        //
    }
}