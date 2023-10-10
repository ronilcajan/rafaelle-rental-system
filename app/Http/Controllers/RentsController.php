<?php

namespace App\Http\Controllers;

use App\Class\RentPayment;
use App\Http\Requests\RentsRequestForm;
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
        $this->authorize('viewAny_rents', Rents::class);
        
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
        $this->authorize('create_rents', Rents::class);
        
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
    public function store(RentsRequestForm $request)
    {
        
        $this->authorize('create_rents', Rents::class);

        $validate = $request->validated();

        $create = Rents::create($validate);
        
        if($create){

            $rent_payment = new RentPayment();

            $rent_payment->insert_payments($create->id, $request->terms, $request->start_date, $request->rent_type, $request->amount, $request->discount);

            return back()->with('success', 'Rents has been created successfully!');
        }

        return back()->with('error', 'Creating rent is not successful!');
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