<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Message;



class AdminController extends Controller
{
    /**
     * show list of all orders
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orderslist=Order::orderBy('order_status', 'asc')->latest();
        $orderscount=Order::where('order_status', 0)->count();

        return view('admin.index',[
            'orderslist' => $orderslist->paginate(10),
            'orderscount'=>$orderscount,
            ]);
    }

    /**
     * show list client orders
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userorders($user_id)
    {
        $orderslist=Order::where('user_id', $user_id)
            ->orderBy('order_status', 'asc')->latest();


        return view('admin.user',[
            'orderslist' => $orderslist->paginate(10)]);
    }


    /**
     * show order and chat
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        $messages=Message::where('order_id', $order->id)->orderBy('id','desc')->pluck('body');
        return view('admin.show')->with(compact('messages', $messages))->with('order', $order);
    }



    /**
     * store messages of chat in database and show all messages of this order in chatwindow
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function message(Request $request, Order $order )
    {
        if ($request->message){
            Message::create([
                'body'=>'Менеджер: '.$request->message,
                'order_id'=>$request->order->id,
            ]);
        }
        $messages=Message::where('order_id', $request->order->id)->orderBy('id','desc')->pluck('body');
        return view('admin.show')->with(compact('messages', $messages))->with('order', $order);
    }



}
