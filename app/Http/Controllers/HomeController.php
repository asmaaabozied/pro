<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Tracking;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeOwners   = User::where('deleted_at', null)->where('account_type', 3)->count();
        $clients       = User::where('deleted_at', null)->where('account_type', 4)->count();
        $currentOrders = Order::limited()->where('deleted_at', null)->whereIn('status', trans('order.order_status_group.current'))->get();
        $previousOrders= Order::limited()->where('deleted_at', null)->whereIn('status', trans('order.order_status_group.previous'))->get();
        $carts         = Cart::where('deleted_at', null)->where('status', 'open')->limited()->count();
        $products      = Product::limited()->where('deleted_at', null)->where('active', true)->count();
        $orders        = Order::limited()->where('deleted_at', null)->whereDate('created_at', today())->get();
        return view('home', compact('storeOwners', 'clients', 'currentOrders', 'previousOrders', 'carts', 'products', 'orders'));
    }

    public function test(){
        Tracking::add_to_track();
    }
}
