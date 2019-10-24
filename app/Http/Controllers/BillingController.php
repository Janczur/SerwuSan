<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Http\Requests\StoreBilling;
use Illuminate\Http\Request;

class BillingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Billing::class, 'billing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = auth()->user()->billings()->get();
        return view('billings.index', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('billings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBilling  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBilling $request)
    {
        auth()->user()->billings()->create($request->validated());
        return redirect()->route('billings.index')->with('success', __('app.billings.added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        return view('billings.show', compact('billing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        if ($billing->delete()){
            return redirect()->route('billings.index')->with('success', __('app.billings.deleted'));
        }
        return redirect()->route('billings.index')->with('success', __('app.general.error'));
    }
}
