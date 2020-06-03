<?php

namespace App\Http\Controllers;

use App\Http\Requests\BatchDeleteProviderMargin;
use App\Http\Requests\EditableUpdateProviderCountry;
use App\Http\Requests\EditableUpdateProviderMargin;
use App\Http\Requests\StoreProviderMargin;
use App\ProvidersMargin;
use App\Repositories\ProviderMarginRepository;
use App\Services\ProviderMarginImportHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProviderMarginController extends Controller
{
    /** @var ProviderMarginRepository */
    private $providerMargin;

    /**
     * ProviderController constructor.
     * @param ProviderMarginRepository $providerMarginRepository
     */
    public function __construct(ProviderMarginRepository $providerMarginRepository)
    {
        $this->providerMargin = $providerMarginRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $providersMargins = $this->providerMargin->getAll();
        return view('providers.margins.index', compact('providersMargins'));
    }

    /**
     * @return View
     */
    public function import(): View
    {
        return view('providers.margins.import');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreProviderMargin $request
     * @return RedirectResponse
     */
    public function store(StoreProviderMargin $request): RedirectResponse
    {
        $importHandler = new ProviderMarginImportHandler($request->validated());
        try {
            $importHandler->importProviderMargin();
        } catch (\Exception $exception){
            return back()->with('error', __('app.import.error'));
        }
        return redirect()->route('providersMargins.index')->with('success', __('app.providers.margin.updated'));
    }

    /**
     * @param EditableUpdateProviderMargin $request
     * @param ProvidersMargin $providerMargin
     */
    public function editableUpdateMargin(EditableUpdateProviderMargin $request, ProvidersMargin $providerMargin): void
    {
        $providerMargin->margin = $request->value;
        $providerMargin->save();
    }

    /**
     * @param EditableUpdateProviderCountry $request
     * @param ProvidersMargin $providerMargin
     */
    public function editableUpdateCountry(EditableUpdateProviderCountry $request, ProvidersMargin $providerMargin):void
    {
        $providerMargin->country = $request->value;
        $providerMargin->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProvidersMargin  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProvidersMargin $provider)
    {
        //
    }

    /**
     * @param BatchDeleteProviderMargin $request
     * @return JsonResponse
     */
    public function batchDelete(BatchDeleteProviderMargin $request): JsonResponse
    {
        $this->providerMargin->destroyByIds($request->providerMarginIds);
        return response()->json([
            'status' => 'success',
            'heading' => __('app.general.success'),
            'message' => __('app.general.batch.delete')
        ]);
    }
}
