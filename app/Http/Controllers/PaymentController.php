<?php

namespace App\Http\Controllers;

use App\Models\RentPayments;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view_property', Property::class);
    

        $payments = RentPayments::orderBy('status','asc')->filter(request(['search','from_date','to_date']))->paginate(10);

        return view('payments.index', [
            'title' => 'Payments Management',
            'payments' => $payments,
        ]);
    }

    public function find_payment(RentPayments $payment){
        $payment['tenant_name'] = $payment->rent->tenant->name;
        return response()->json($payment);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}