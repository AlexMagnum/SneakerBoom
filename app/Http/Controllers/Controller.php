<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function profile()
    {
        return view('auth.userprofile');
    }

    public function profileUpdate(Request $r)
    {
        $user = User::find(Auth::id());
        $user->pip = $r->profile_name;
        $user->phone = $r->profile_phone;
        $user->birthdate = $r->profile_birthdate;
        $user->save();

        Session::flash('message', 'Профіль оновлено успішно!');

        return redirect()->route('profile');
    }

    public function deliveryAddress()
    {
        return view('auth.deliveryaddress');
    }

    public function deliveryAddressUpdate(Request $r)
    {
        $user = User::find(Auth::id());

        $user->region = $r->profile_region;
        $user->city = $r->profile_city;
        $user->number_department = $r->profile_num_dep;
        $user->save();

        Session::flash('message', 'Адресу оновлено успішно!');

        return redirect()->route('deliveryaddress');
    }

    public function changePassword()
    {
        return view('auth.changepassword');
    }

    public function changePasswordUpdate(Request $r)
    {
        $user = User::find(Auth::id());

        if (Hash::check($r->updatepassword, $user->password) == false) {
            Session::flash('message', 'Невірний пароль користувача!');
            return redirect()->route('changepassword');
        } else if ($r->newpassword != $r->confirmpassword) {
            Session::flash('message', 'Паролі не співпадають!');
            return redirect()->route('changepassword');
        } else {
            $user->password = Hash::make($r->newpassword);
            $user->save();
            Session::flash('message', 'Паролі успішно змінено!');
            return redirect()->route('changepassword');
        }
    }

    public function viewOrders()
    {
        $orders = Order::select("*")->where('user_id', "=", Auth::id())->orderBy('created_at', 'DESC')->paginate(10);

        return view('auth.vieworders', [
            'orders' => $orders
        ]);
    }

    public function sendContact(Request $request)
    {
        $contact = new Contact();

        $contact->name = $request->username;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->created_at = date(now());
        $contact->updated_at = date(now());
        $contact->status = "Чекає відповіді";

        $contact->save();
        return redirect()->back()->with('alert-success', 'Ваше повідомлення успішно надіслано! Очікуйте відповіді.');
    }

    public function addNewsletter(Request $request)
    {
        $rss = new Newsletter();

        if (!Newsletter::where('email', $request->email)->first()) {
            $rss->email = $request->email;
        } else {
            return redirect()->back()->with('alert-abort', 'Даний email уже підписаний на новини!');
        }

        $rss->save();
        return redirect()->back()->with('alert-success', 'Ви успішно підписалися на останні новини!');

    }
}
