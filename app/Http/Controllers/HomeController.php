<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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
        return view('home');
    }


    public function orders()
    {
        //выводим на страницу все заказы данного клиента

        $orderslist=Order::query()->where('user_id', Auth::user()->id);

        return view('user.index',[
            'orderslist' => $orderslist->paginate(10)]);
    }
}
