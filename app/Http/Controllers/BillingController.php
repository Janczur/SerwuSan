<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Http\Requests\StoreBilling;
use App\Imports\BillingDataImport;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BillingController extends Controller
{

    /**
     * @var BillingDataImport $billingDataImport
     */
    private $billingDataImport;

    /**
     * BillingController constructor.
     * @param BillingDataImport $billingDataImport
     */
    public function __construct(BillingDataImport $billingDataImport)
    {
        $this->billingDataImport = $billingDataImport;
        $this->authorizeResource(Billing::class, 'billing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $billings = auth()->user()->billings()->get();
        return view('billings.index', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('billings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBilling  $request
     * @return RedirectResponse
     */
    public function store(StoreBilling $request): RedirectResponse
    {
        $billing = auth()->user()->billings()->create($request->validated());

        $billingDataToImport = $this->billingDataImport->getBillingDataToImport($billing->id, $request->import_file);

        $billing->billingData()->insert($billingDataToImport);
        return redirect()->route('billings.index')->with('success', __('app.billings.added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Billing $billing
     * @return View
     */
    public function show(Billing $billing): View
    {
        return view('billings.show', compact('billing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Billing $billing
     * @return View
     */
    public function edit(Billing $billing): View
    {
        return view('billings.edit', compact('billing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreBilling  $request
     * @param  Billing $billing
     * @return RedirectResponse
     */
    public function update(StoreBilling $request, Billing $billing): RedirectResponse
    {
        $validatedData = $request->validated();
        if ($billing->update($validatedData)){
            return redirect()->route('billings.index')->with('success', __('app.billings.edited'));
        }
        return redirect()->route('billings.index')->with('error', __('app.general.error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Billing $billing
     * @return RedirectResponse
     */
    public function destroy(Billing $billing): RedirectResponse
    {
        if ($billing->delete()){
            return redirect()->route('billings.index')->with('success', __('app.billings.deleted'));
        }
        return redirect()->route('billings.index')->with('error', __('app.general.error'));
    }
}
