<?php

namespace App\Http\Controllers;

use App\Mail\Order;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Product;
use App\Models\Ui;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function Dashboard()
    {
        $goods = Product::get();
        $latestGoods = Product::orderBy('id', 'desc')->limit(4)->get();
        $latestOrders = \App\Models\Order::orderBy('created_at', 'desc')->limit(7)->get();
        $orders = \App\Models\Order::get();
        $users = User::get();
        $contacts = Contact::get();

        return view('Back.dashboard', [
            'products' => $goods,
            'orders' => $orders,
            'users' => $users,
            'contacts' => $contacts,
            'latestGoods' => $latestGoods,
            'latestOrders' => $latestOrders
        ]);
    }

    public function UI()
    {
        $ui = Ui::first();

        $poster1 = null;
        if (isset($ui->cta1_image)) {
            if (File::exists('images/Uploads/CTA1/'))
                $poster1 = File::files('images/Uploads/CTA1/');
            else
                $poster1 = null;
        }

        $poster2 = null;
        if (isset($ui->cta2_image)) {
            if (File::exists('images/Uploads/CTA2/'))
                $poster2 = File::files('images/Uploads/CTA2/');
            else
                $poster2 = null;
        }

        return view('Back.UI.uishow', [
            'ui' => $ui,
            'poster1' => $poster1,
            'poster2' => $poster2,
        ]);
    }

    public function UIUpdate(Request $request)
    {
        $ui = Ui::first();

        $ui->social1 = $request->facebook;
        $ui->social2 = $request->twitter;
        $ui->social3 = $request->youtube;
        $ui->social4 = $request->instagram;

        $ui->cta1_header = $request->cta1_header;
        $ui->cta1_desc = $request->cta1_desc;
        $ui->cta1_url = $request->cta1_url;

        if (isset($request->cta1_image)) {
            $name = $request->cta1_image->getClientOriginalName();
            if (file_exists('images/Uploads/CTA1/')) {
                File::cleanDirectory('images/Uploads/CTA1/');
                $request->cta1_image->move('images/Uploads/CTA1/', $name);
                $ui->cta1_image = "";
                $ui->cta1_image = 'images\\Uploads\\CTA1\\' . $name;
            } else {
                $request->cta1_image->move('images/Uploads/CTA1/', $name);
                $ui->cta1_image = "";
                $ui->cta1_image = 'images\\Uploads\\CTA1\\' . $name;
            }
        }

        $ui->cta2_header = $request->cta2_header;
        $ui->cta2_desc = $request->cta2_desc;
        $ui->cta2_url = $request->cta2_url;

        if (isset($request->cta2_image)) {
            $name = $request->cta2_image->getClientOriginalName();
            if (file_exists('images/Uploads/CTA2/')) {
                File::cleanDirectory('images/Uploads/CTA2/');
                $request->cta2_image->move('images/Uploads/CTA2/', $name);
                $ui->cta2_image = "";
                $ui->cta2_image = 'images\\Uploads\\CTA2\\' . $name;
            } else {
                $request->cta2_image->move('images/Uploads/CTA2/', $name);
                $ui->cta2_image = "";
                $ui->cta2_image = 'images\\Uploads\\CTA2\\' . $name;
            }
        }

        $ui->save();
        return redirect()->back()->with('alert-success', 'Інформація оновлена успішно!');
    }

    public function Newsletter(Request $request)
    {

        if ($request->ajax()) {
            $newsletters = Newsletter::select('*');
            return Datatables::of($newsletters)
                ->addColumn('action', function ($users) {
                    $button = '
                        <form action="' . route('newsremove', $users->id) . '" method="POST" class="delform">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                    </form>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Back.Newsletter.newslettershow');
    }

    public function RSS()
    {
        return view('Back.Newsletter.rss');
    }

    public function RSSSend(Request $request)
    {
        $rssusers = Newsletter::get();

        foreach ($rssusers as $user) {
            Mail::to($user->email)->send(new \App\Mail\RSS($request->rss));
        }

        return redirect()->route('newsletter')->with('alert-success', 'Повідомлення успішно розіслано на всі адреси!');
    }

    public function NewsRemove($id)
    {
        $newsletter = Newsletter::find($id);
        $newsletter->delete();

        return redirect()->back()->with('alert-success', 'Email адреса успішно видалена з розсилки!');
    }
}
