<?php

namespace App\Http\Controllers;
use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function cuenta()
    {
        $po = new PurchaseOrderController();
        $orders = $po->getPurchaseOrders();
        return view('cuenta', ['orders'=>$orders]);
    }

}
