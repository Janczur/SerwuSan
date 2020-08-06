<?php

namespace App\Http\Controllers;

use App\Helpers\CallPriceCalculator;
use App\Http\Requests\CalculateCallPriceRequest;
use App\Http\Requests\StoreProvidersPricelist;
use App\Imports\Providers\Pricelists\ProvidersPricelistToArrayImport;
use App\Jobs\ImportProvidersPricelistData;
use App\ProvidersPricelist;
use App\Repositories\ProviderMarginRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProviderPriceListController extends Controller
{
    /** @var ProviderMarginRepository */
    private $providerMargin;

    /**
     * ProviderPriceListController constructor.
     * @param ProviderMarginRepository $providerMargin
     */
    public function __construct(ProviderMarginRepository $providerMargin)
    {
        $this->providerMargin = $providerMargin;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $providersPricelists = auth()->user()->providersPricelists()->latest()->get();
        return view('providers.priceList.index', compact('providersPricelists'));
    }

    /**
     * @return View
     */
    public function import(): View
    {
        return view('providers.priceList.import');
    }

    public function store(StoreProvidersPricelist $request)
    {
        /** @var ProvidersPricelist $providersPricelist */
        $providersPricelist = auth()->user()->providersPricelists()->create($request->validated());
        $providersPricelistSheets = Excel::toArray(new ProvidersPricelistToArrayImport(), $request->file('importFile'));
        ImportProvidersPricelistData::dispatch($providersPricelist, $providersPricelistSheets);
        return redirect()->route('providersPriceLists.index')->with('success', __('app.providers.pricelist.added'));
    }

    /**
     * @param ProvidersPricelist $providersPricelist
     * @return View
     */
    public function show(ProvidersPricelist $providersPricelist): View
    {
        return view('providers.pricelist.show', [
            'providersPricelist' => $providersPricelist
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProvidersPricelist $providersPricelist
     * @return RedirectResponse
     */
    public function destroy(ProvidersPricelist $providersPricelist): RedirectResponse
    {
        try {
            $providersPricelist->delete();
        } catch (\Exception $exception){
            return redirect()->route('providersPriceLists.index')->with('error', __('app.general.error'));
        }
        return redirect()->route('providersPriceLists.index')->with('success', __('app.providers.pricelist.deleted'));
    }

    public function calculateCallPrice(CalculateCallPriceRequest $request)
    {
        $providersMargins = $this->providerMargin->getCountryWithMargin()->toArray();
        $callPriceCalculator = new CallPriceCalculator($providersMargins);
        $callPriceCalculator->setCountryCallPrices($request->validated());
        $callPriceCalculator->calculateCallPrices();
        return response()->json([
            'status' => 'success',
            'heading' => __('app.general.success'),
            'message' => __('app.providers.pricelist.calculator.success'),
            'calculatedCallPrices' => $callPriceCalculator->getCalculatedCallPrices()
        ]);
    }
}
