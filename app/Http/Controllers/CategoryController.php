<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SC_Prod;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Query\Builder;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{
    public function categoryView($id)
    {
        if (Category::all()->find($id)) {
            $products = Product::whereHas('subcategory', function ($q) use ($id) {
                $q->where('category_id', '=', $id);
            })->paginate(15);
            $idCategory = $id;
        } else
            abort(404);
        return view('Front.products', [
            'products' => $products,
            'idCategory' => $idCategory
        ]);
    }

    public function subcategoryView($idc, $idsc)
    {
        if (Category::all()->find($idc) && Subcategory::all()->find($idsc)) {
            $products = Product::whereHas('subcategory', function ($q) use ($idc, $idsc) {
                $q->where('category_id', '=', $idc)->where('id', '=', $idsc);
            })->paginate(15);
            $idCategory = $idc;
            $nameSubcategory = Subcategory::all()->find($idsc);
        } else
            abort(404);
        return view('Front.products', [
            'products' => $products,
            'idCategory' => $idCategory,
            'nameSubcategory' => $nameSubcategory
        ]);
    }

}
