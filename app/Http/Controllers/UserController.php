<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        $orderslist=Order::query()->where('user_id', Auth::user()->id);

        return view('user.index',[
        'orderslist' => $orderslist->paginate(10)]);
    }

    public function create()
    {
        return view('user.create');
    }

    public  function store(Request $request)
    {

        $order = Order::create(request()->all());

        if ($request->hasFile('file')) {

            $path = $request->file('file')->store('files');
            $order->file_path=$path;
            $order->save();
        }




        return redirect()->route('orders.show', $order);
    }


    public function show(Order $order)
    {
        return view('user.show', compact('order'));
    }
}
