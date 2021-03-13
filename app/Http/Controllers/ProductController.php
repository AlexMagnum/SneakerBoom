<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product_Raiting;
use App\Models\Product_Size;
use App\Models\SC_Prod;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    public function showAll()
    {
        $products = Product::query()->select('*')->paginate(15);
        return view('Front.products', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $subcategory_name = null;
        $mayLikeProducts = null;
        $productSizes = null;
        $sizeArr[] = null;
        $productCount = null;

        $product = Product::all()->find($id);
        $productCount = Product::query()->select('count')->where('id', '=', $id)->first();

        $size_id = Product_Size::query()->select('size_id')->where('product_id', '=', $id)->distinct()->get();
        foreach ($size_id as $size) {
            $productSizes = Size::select('name')->orWhere('id', '=', $size->size_id)->get();
            foreach ($productSizes as $size) {
                $sizeArr[] = $size->name;
            }
        }
        $sizeArr = array_unique($sizeArr);
        $sizeArr = array_diff($sizeArr, array(''));

        $subcategory_id = SC_Prod::query()->select('subcategory_id')->where('product_id', '=', $id)->get();
        if (isset($subcategory_id)) {
            foreach ($subcategory_id as $sub) {
                $subcategory_name = Subcategory::query()->select('name')->where('id', '=', $sub->subcategory_id)->get();
                $sub->subcategory_id;
            }
            if (isset($subcategory_name)) {
                foreach ($subcategory_name as $name) {

                    $mayLikeProducts = Product::whereHas('subcategory', function ($query) use ($name) {
                        $query->where('name', '=', $name->name);
                    })->where('count', '>', 0)->where('id', '!=', $product->id)->orderBy('sale_count','desc')->limit(3)->get();
                }
            }
        }

        $productRaiting = Product_Raiting::where('product_id', $product->id)->get();
        $productMarks = null;
        if(count($productRaiting) > 0){
            foreach ($productRaiting as $raiting)
                $productMarks += $raiting->mark;
        }

        $mark = null;
        if( $productMarks != null){
            $mark = $productMarks / count($productRaiting);
        }

        $images = explode(PHP_EOL, $product->images);
        array_pop($images);

        return view('Front.single', [
            'product' => $product,
            'maylikeproduct' => $mayLikeProducts,
            'productsize' => $productSizes,
            'sizearr' => $sizeArr,
            'productCount' => $productCount,
            'raiting' => $mark,
            'images' => $images
        ]);
    }

    public function filter(ProductsFilterRequest $request)
    {
        $productsQuery = Product::query();

        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }

        if ($request->filled('discount')) {
            $productsQuery->where(function ($productsQuery) use ($request) {
                foreach ($request->discount as $discount) {
                    if ($discount == 1) {
                        $productsQuery->orWhere('discount', '<=', 10)->where('discount', '<>', 0);
                    }
                    if ($discount == 2) {
                        $productsQuery->orWhereBetween('discount', [10, 30]);
                    }
                    if ($discount == 3) {
                        $productsQuery->orWhereBetween('discount', [30, 50]);
                    }
                    if ($discount == 4) {
                        $productsQuery->orWhereBetween('discount', [50, 100])->where('discount', '<>', 100);
                    }
                }
            });
        }

        if ($request->filled('category')) {
            $productsQuery->where(function ($productsQuery) use ($request) {
                foreach ($request->category as $category) {
                    $productsQuery->orWhereHas('subcategory', function ($q) use ($category) {
                        return $q->where('category_id', '=', $category);
                    });
                }
            });
        }

        if ($request->filled('productsize')) {
            $productsQuery->where(function ($productsQuery) use ($request) {
                foreach ($request->productsize as $size) {
                    $productsQuery->orWhereHas('size', function ($q) use ($size) {
                        return $q->where('name', '=', $size);
                    });
                }
            });
        }

        if ($request->filled('subcategory')) {
            $productsQuery->where(function ($productsQuery) use ($request) {
                foreach ($request->input('subcategory') as $subcategory) {
                    $productsQuery->orWhereHas('subcategory', function ($q) use ($subcategory) {
                        return $q->where('name', '=', $subcategory);
                    });
                }
            });
        }

        if ($request->filled('manufacturer')) {
            $productsQuery->where(function ($productsQuery) use ($request) {
                foreach ($request->input('manufacturer') as $value) {
                    $productsQuery->orwhere('manufacturer', '=', $value);
                }
            });
        }

        if ($request->filled('productcolor')) {
            $productsQuery->where(function ($productsQuery) use ($request) {
                foreach ($request->input('productcolor') as $value) {
                    $productsQuery->orwhere('color', '=', $value);
                }
            });
        }

        if ($request->filled('sort')) {
            foreach ($request->input('sort') as $value)
                if ($value === 'Ціна за зростанням') {
                    $productsQuery->orderBy('price')->get();
                } else if ($value === 'Ціна за спаданням') {
                    $productsQuery->orderByDesc('price')->get();
                } else if ($value === 'За знижкою') {
                    $productsQuery->orderByDesc('discount')->get();
                } else if ($value === 'За популярністю') {
                    $productsQuery->orderByDesc('sale_count')->get();
                }
        }

        $products = $productsQuery->where('count','>', 0)->paginate(15)->withPath('?' . $request->getQueryString());

        return view('Front.products', [
            'products' => $products,
        ]);
    }

    public function ProductRaiting($id, Request $request)
    {
        $raiting = new Product_Raiting();

        $raiting->mark = $request->raiting[0];
        $raiting->product_id = $id;
        $raiting->user_id = Auth::user()->id;

        if (Product_Raiting::where('product_id', $id)->where('user_id', Auth::user()->id)->first())
            return redirect()->back()->with('alert-abort', 'Ви уже оцінили даний товар! Дякуємо Вам, нам також цікава Ваша думка стостовно інших товарів!');
        else {
            $raiting->save();
            return redirect()->back()->with('alert-success', 'Дякуємо за Вашу оцінку! Нам важлива Ваша думка про наші товари!');
        }

    }

}
