<?php

namespace App\Http\Controllers;

use App\Models\Ui;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $topProducts = Product::all()->where('count', '>',0)->sortByDesc('sale_count')->take(6);
        $ui = Ui::first();

        return view('Front.index', [
                'topProducts' => $topProducts,
                'ui' => $ui
        ]);
    }

    public function Privacy(){
        return view('Front.privacy');
    }

    public function AboutUs(){
        return view('Front.aboutus');
    }

    public function Faq(){
        return view('Front.faq');
    }

    public function Payment(){
        return view('Front.payment');
    }

    public function Delivery(){
        return view('Front.delivery');
    }
}
