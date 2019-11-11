<?php

namespace App\Http\Controllers;

use App\Repositories\BillingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /** @var BillingRepository */
    private $billing;

    /**
     * HomeController constructor.
     * @param BillingRepository $billing
     */
    public function __construct(BillingRepository $billing)
    {
        $this->billing = $billing;
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $billingsCount = $this->billing->countAll();
        return view('home', compact('billingsCount'));
    }
}
