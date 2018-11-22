<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
       //выводим список всех заказов

        $orderslist=Order::query();

        return view('admin.index',[
            'orderslist' => $orderslist->paginate(10)]);
    }


    public function show(Order $order)
    {
        //выводим информацию конкретного заказа и чат этого заказа

        $order_id=$order->id;
        $messages=Message::where('order_id', $order_id)->orderBy('id','desc')->pluck('body');
        return view('admin.show')->with(compact('messages', $messages))->with('order', $order);
    }

    public function update(Request $request, Order $order)
    {
        //изменяем статус заказа

        $order->order_status=1;
        $order->save();

        return back();
    }

    public function message(Request $request, Order $order )
    {
        //записываем сообщения в БД

        $order_id=request()->order->id;
        if (request()->message){
            Message::create([
                'body'=>'Менеджер: '.$request->message,
                'order_id'=>$order_id,
            ]);
        }
        $messages=Message::where('order_id', $order_id)->orderBy('id','desc')->pluck('body');
        return view('admin.show')->with(compact('messages', $messages))->with('order', $order);
    }

}
