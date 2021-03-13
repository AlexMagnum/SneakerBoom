<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Product;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;
use Symfony\Component\Console\Input\Input;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add_with_count($product, $product->id, $request->product_count[0], $request->product_size[0]);

        $request->session()->put('cart', $cart);
        return redirect()->route('shoppingcart');
    }

    public function increseItems(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        //Session::flash('message', 'This is a message!');
        $request->session()->put('cart', $cart);
        return redirect()->route('shoppingcart');
    }

    public function Cart()
    {
        if (!Session::has('cart'))
            return view('Front.checkout', ['products' => null]);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('Front.checkout', [
            'priceWithoutDiscount' => $cart->priceWithoutDiscount,
            'discount' => $cart->discount,
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice]);
    }

    public function GetCheckout()
    {
        if (Session::has('cart')) {
            return view('Front.checkout');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('Front.order', ['total' => $total]);
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0)
            Session::put('cart', $cart);
        else
            Session::forget('cart');

        return redirect()->route('shoppingcart');
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0)
            Session::put('cart', $cart);
        else
            Session::forget('cart');

        return redirect()->route('shoppingcart');
    }

    public function cleatCart()
    {
        if (Session::has('cart')) {
            Session::forget('cart');
        }

        return redirect()->route('shoppingcart');

    }

    public function order(){
        if(Session::has('cart'))
            return view('Front.order');
        else
            return redirect()->route('shoppingcart');
    }

    public function sucseccOrder(Request $r){
        $payment = $r->input('payment')[0];
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $order = new Order();

        if(Auth::user())
            $order->user_id = Auth::id();
        $order->destination_address = $r->post_obl . " -> " . $r->post_city. " -> ". $r->post_num;
        $order->total_cost = $cart->totalPrice;
        $order->status = "Нове замовлення";
        if(isset($r->order_note))
            $order->note = $r->order_note;
        $order->name = $r->order_name;
        $order->email = $r->order_email;
        $order->phone = $r->order_phone;
        $order->paymentsystem = $payment;

        if($payment == "Оплата готівкою при отриманні" && Session::has('cart'))
        {
            $order->save();
            $last_order_id = $order->id;
            Mail::to($r->order_email)->send(new \App\Mail\Order($order, $cart, $last_order_id));

            foreach ($cart->items as $item){
                $orderItems = new Order_Product();
                $product = Product::find($item['item']['id']);
                $product->sale_count += $item['qty'];
                $product->count  -=  $item['qty'];
                $product->save();
                $orderItems->order_id = $last_order_id;
                $orderItems->product_id = $item['item']['id'];
                $orderItems->quantity = $item['qty'];
                $orderItems->size = $item['size'];
                $orderItems->save();
            }
            Session::forget('cart');
            return view('Front.sucseccorder');
        }
        else if($payment == "Оплата за реквізитами" && Session::has('cart')){
            $order->save();
            $last_order_id = $order->id;
            Mail::to($r->order_email)->send(new \App\Mail\Order($order, $cart, $last_order_id));
            Mail::to($r->order_email)->send(new \App\Mail\Invoice($order, $last_order_id));

            foreach ($cart->items as $item){
                $orderItems = new Order_Product();
                $product = Product::find($item['item']['id']);
                $product->sale_count += $item['qty'];
                $product->count  -=  $item['qty'];
                $product->save();
                $orderItems->order_id = $last_order_id;
                $orderItems->product_id = $item['item']['id'];
                $orderItems->quantity = $item['qty'];
                $orderItems->size = $item['size'];
                $orderItems->save();
            }
            Session::forget('cart');
            return view('Front.sucseccorderpay');
        }
        else
            abort('404');

    }
}
