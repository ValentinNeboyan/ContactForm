<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Http\Controllers\MailController;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{

    /**
     * show form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * create new order
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public  function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        //check if 5 minutes has passed after last order of user

        $lastOrder=Order::where('user_id', Auth::user()->id )->latest()->first();

        if ($lastOrder){
            $lastordertime=$lastOrder->created_at->secondsSinceMidnight();
            $currenttime=Carbon::now()->secondsSinceMidnight();

            if(($currenttime-$lastordertime)<300){
                return back()->withInput();
            }
        }

        //create order
        // store file
        // store the order text as the first message for the chat;
        //send mail to manager

        $order = Order::create(request()->all());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $order->file_path='/storage/'.$path;
            $order->save();
        }

        Message::create([
            'body'=>Auth::user()->name.': '.$order->body,
            'order_id'=>$order->id,
        ]);

      MailController::send();

        return redirect()->route('orders.show',$order);
    }


    /**
     * show orders info and chat
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {

        $messages=Message::where('order_id', $order->id)->orderBy('id','desc')->pluck('body');
        return view('user.show')->with('messages', $messages)->with('order', $order);
    }

    /**
     * store messages of chat in database and show all messages of this order in chatwindow
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function message(Request $request, Order $order )
    {
        Message::create([
            'body'=>Auth::user()->name.': '.$request->message,
            'order_id'=>$request->order->id,
        ]);
        $messages=Message::where('order_id', $request->order->id)->orderBy('id','desc')->pluck('body');
        return view('user.show')->with('messages', $messages)->with('order', $order);
    }

    /**
     * delete order and all messages and image of order
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        if ($order->file_path){
            File::delete(public_path($order->file_path));
        }

        Message::where('order_id', $order->id)->delete();
        $order->delete();

        return redirect(route('admin.index'));

    }

    /**
     * change status of order
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Order $order)
    {
        $order->order_status=1;
        $order->save();
        return back();
    }

}
