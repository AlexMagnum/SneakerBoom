<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Order_Product;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(Request $request)
    {
       if ($request->ajax()) {
            $orders = Order::select('*');
            return Datatables::of($orders)
                ->addColumn('action', function ($orders) {
                    $button = '
                        <a href="' . route('orders.show', $orders->id) . '" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="' . route('orders.edit', $orders->id) . '" class="btn btn-info"><i class="fas fa-edit"></i></a>
             ';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Back.Orders.ordersshow');
    }

    public function show($id)
    {
        $order = Order::find($id);

        $user = null;
        if(isset($order->user_id))
            $user = User::find($order->user_id);

        $items = Order_Product::select('*')->get();
        $products = Product::select('*')->get();

        return view('Back.Orders.ordersview', [
            "order" => $order,
            'user' => $user,
            'items' => $items,
            'products' => $products
        ]);
    }

    public function edit($id)
    {
        $order = Order::find($id);

        return view('Back.Orders.ordersedit', [
            "order" => $order
        ]);
    }


    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if($request->order_status == "Нове замовлення")
            $order->status = "Нове замовлення";
        else if($request->order_status == "Очікує оплати")
            $order->status = "Очікує оплати";
        else if($request->order_status == "Відправлене")
            $order->status = "Відправлене";
        else if($request->order_status == "Відмінене")
            $order->status = "Відмінене";
        else if($request->order_status == "Завершене")
            $order->status = "Завершене";

        if(isset($request->TTN))
            $order->TTN = $request->TTN;

        $order->updated_at = date(now());
        $order->save();

        return redirect()->route('orders.show', $id)->with('alert-success', 'Статус замовлення успішно оновлено!');
    }

    public function sendInvoice($id){
        $order = Order::find($id);
        if($order->status == "Відправлене" && isset($order->TTN))
        {
            Mail::to($order->email)->send(new \App\Mail\OrderTTN($order));
            return redirect()->route('orders.view')->with('alert-success', 'Повідомлення з номером накладної уcпішно надіслано клієнту!');
        }
        else{
            return redirect()->back()->with('alert-abort', 'Невірний статус замовлення або відсутній ТТН!');
        }
    }

}
