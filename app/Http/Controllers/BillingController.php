<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Http\Requests\StoreBilling;
use App\Http\Requests\UpdateBilling;
use App\Imports\BillingDataImporter;
use App\Repositories\BillingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BillingController extends Controller
{

    /**
     * @var BillingDataImporter $billingDataImporter
     */
    private $billingDataImporter;

    /**
     * @var BillingRepository $billing
     */
    private $billing;

    /**
     * BillingController constructor.
     * @param BillingRepository $billing
     * @param BillingDataImporter $billingDataImporter
     */
    public function __construct(BillingRepository $billing, BillingDataImporter $billingDataImporter)
    {
        $this->billing = $billing;
        $this->billingDataImporter = $billingDataImporter;
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
     * Store a newly created billing in database.
     *
     * @param StoreBilling $request
     * @return RedirectResponse
     */
    public function store(StoreBilling $request): RedirectResponse
    {
        /** @var Billing $billing */
        $billing = auth()->user()->billings()->create($request->validated());

        try {
            $this->billingDataImporter->setBillingData($billing, $request->import_file);
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            return redirect()->route('billings.index')->with('error', __('app.import.readerError'));
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            return redirect()->route('billings.index')->with('error', __('app.import.spreadsheetError'));
        }

        $this->billing->saveBillingData($billing);

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
        $billingData = $this->billing->getBillingData($billing, 10);
        return view('billings.show', compact('billing', 'billingData'));
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
     * @param  UpdateBilling  $request
     * @param  Billing $billing
     * @return RedirectResponse
     */
    public function update(UpdateBilling $request, Billing $billing): RedirectResponse
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
