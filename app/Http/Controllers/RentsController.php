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
            'rents' => Rents::with(['property','tenant'])->latest()->paginate(10)
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

            Property::find($request->property_id)->update(['status'=>'rented']); 

            $rent_payment = new RentPayment();

            $rent_payment->insert_payments($create->id, $request->terms, $request->start_date, $request->rent_type, $request->amount, $request->discount); //insert rent payment

            return back()->with('success', 'Rents has been created successfully!');
        }

        return back()->with('error', 'Creating rent is not successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rents $rent)
    {
        $this->authorize('view_rents', Rents::class);

        return view('rents.view', [
            'title' => 'View Rent',
            'tenants' => Tenants::get(),
            'properties' => Property::whereIn('id', [$rent->property_id])->get(),
            'owners' => Owner::get(), 
            'rent' => $rent, 
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rents $rent)
    {
        $this->authorize('update_rents', Rents::class);

        return view('rents.edit', [
            'title' => 'Edit Rent',
            'tenants' => Tenants::get(),
            'properties' => Property::whereIn('id', [$rent->property_id])->get(),
            'owners' => Owner::get(), 
            'rent' => $rent, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RentsRequestForm $request, Rents $rent)
    {
        $this->authorize('update_rents', Rents::class);

        $validate = $request->validated();

        $update = $rent->update($validate);
        
        if($update){

            Property::find($request->property_id)->update(['status'=>'rented']); 

            $rent_payment = new RentPayment();

            $rent_payment->update_payments($rent->id, $request->terms, $request->start_date, $request->rent_type, $request->amount, $request->discount); //update rent payment

            return back()->with('success', 'Rents has been created successfully!');
        }

        return back()->with('error', 'Creating rent is not successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rents $rent)
    {
        $this->authorize('delete_rents', Rents::class);

        $rent->delete();

        return back()->with('success', 'Rent details has been deleted successfully!');
    }
}