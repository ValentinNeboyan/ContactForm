<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Http\Controllers\MailController;

use Illuminate\Support\Carbon;
class OrderController extends Controller
{

    public function create()
    {
        return view('user.create');
    }

    public  function store(Request $request)
    {

        //Перед созданием заказа проверяем прошло ли 5 минут

        
        $lastOrder=Order::where('user_id', Auth::user()->id )->latest()->first();

        if ($lastOrder){
            $timelastorder=$lastOrder->created_at->secondsSinceMidnight();
            $currenttime=Carbon::now()->secondsSinceMidnight();

            if(($currenttime-$timelastorder)<300){
                return back()->withInput();
            }
        }




        //Создаем заказ;
        // если есть файл-записываем;
        // записываем текст заказа как первое сообщение для чата;
        // отправляем письмо менеджеру

        $order = Order::create(request()->all());
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('public/files');
            $order->file_path=$path;
            $order->save();
        }
        $order_id=$order->id;
        $name=Auth::user()->name;
        Message::create([
            'body'=>$name.': '.$order->body,
            'order_id'=>$order_id,
        ]);

        MailController::send();

        return redirect()->route('orders.show',$order);
    }


    public function show(Order $order)
    {
        //выводим инфо заказа и сообщения в чате
        $order_id=$order->id;
        $messages=Message::where('order_id', $order_id)->orderBy('id','desc')->pluck('body');
        return view('user.show')->with('messages', $messages)->with('order', $order);
    }

    public function message(Request $request, Order $order )
    {
        //записываем сообщения в БД

        $order_id=request()->order->id;
        $name=Auth::user()->name;
        Message::create([
            'body'=>$name.': '.$request->message,
            'order_id'=>$order_id,
        ]);
        $messages=Message::where('order_id', $order_id)->orderBy('id','desc')->pluck('body');
        return view('user.show')->with('messages', $messages)->with('order', $order);
    }
}
