<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Size;
use App\Models\SC_Prod;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use PhpParser\Builder;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::select('*');
            return Datatables::of($products)
                ->addColumn('action', function ($products) {
                    $button = '
                        <a href="' . route('goods.show', $products->id) . '" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="' . route('goods.edit', $products->id) . '" class="btn btn-info"><i class="fas fa-edit"></i></a>              
                    <form action="' . route('goods.delete', $products->id) . '" method="POST" class="delform">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                    </form>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Back.Goods.goodsshow');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        $subcategory = Subcategory::select('name')->distinct()->get();
        $size = Size::get();

        return view('Back.Goods.goodsadd', [
            'category' => $category,
            'subcategory' => $subcategory,
            'size' => $size
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductAddRequest $request)
    {

        $product = new Product();

        $category = Category::where('name', $request->category)->first();

        foreach ($request->subcategory as $sub) {
            $subcategory = new Subcategory();
            $subcategoryFind = Subcategory::where('category_id', $category->id)->where('name', $sub)->first();
            if ($subcategoryFind) {
                $subcategoryFind->category_id = $category->id;
                $subcategoryFind->name = $sub;
            } else {
                $subcategory->category_id = $category->id;
                $subcategory->name = $sub;
                $subcategory->save();
            }
        }

        $product->manufacturer = $request->manufacturer;
        $product->model = $request->model;
        $product->code = $request->code;

        if (isset($request->discount)) {
            if ($request->discount > 0 && $request->discount < 100) {
                $product->price = round($request->price - ($request->price * $request->discount / 100));
                $product->price_without_discount = $request->price;
                $product->discount = $request->discount;
            }
        } else
            $product->price = $request->price;

        $product->count = $request->count;
        $product->color = $request->color;
        $product->description = $request->description;
        $product->highlights = $request->highlights;

        $images[] = null;
        foreach ($request->images as $image) {
            $name = $image->getClientOriginalName();
            $image->move('images/Uploads/Product/' . $product->getNextId(), $name);
            $product->images .= 'images\\Uploads\\Product\\' . $product->getNextId() . '\\' . $name . PHP_EOL;
        }


        if ($request->slider == "on") {
            $product->slider = 1;
        } else {
            $request->slider = 0;
        }
        if (isset($request->slider_slog)) {
            $product->slider_slog = $request->slider_slog;
        }

        if (isset($request->poster)) {
            $name = $request->poster->getClientOriginalName();
            $request->poster->move('images/Uploads/Product/' . $product->getNextId() . '/Poster', $name);
            $product->poster = 'images\\Uploads\\Product\\' . $product->getNextId() . '\\Poster\\' . $name;
        }


        $product->save();

        foreach ($request->size as $size) {
            $productSize = new Product_Size();
            $size = Size::where('name', $size)->first();
            $productSize->product_id = $product->id;
            $productSize->size_id = $size->id;
            $productSize->save();
        }


        foreach ($request->subcategory as $sub) {
            $scProd = new SC_Prod();
            $subId = Subcategory::where('category_id', $category->id)->where('name', $sub)->first();
            $scProd->product_id = $product->id;
            $scProd->subcategory_id = $subId->id;
            $scProd->save();
        }

        return redirect()->route('goods.view')->with('alert-success', 'Товар успішно додано до бази даних!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        $subcategory = Subcategory::whereHas('product', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();
        $category = Category::where('id', $subcategory[0]->category_id)->first();

        $files = File::files('images/Uploads/Product/' . $id);

        $poster = null;
        if (isset($product->poster)) {
            if (File::exists('images/Uploads/Product/' . $id . '/Poster/'))
                $poster = File::files('images/Uploads/Product/' . $id . '/Poster/');
            else
                $poster = null;
        }
        return view('Back.Goods.goodsview', [
            'product' => $product,
            'productImages' => $files,
            'posterImage' => $poster,
            'subcategory' => $subcategory,
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $category = Category::get();
        $subcategory = Subcategory::select('name')->distinct()->get();
        $size = Size::get();

        $subcategoryId = Subcategory::whereHas('product', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();
        $sizeId = Size::whereHas('size', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        $files = File::files('images/Uploads/Product/' . $id);

        $categoryId = Category::where('id', $subcategoryId[0]->category_id)->first();

        $poster = null;
        if (isset($product->poster)) {
            if (File::exists('images/Uploads/Product/' . $id . '/Poster/'))
                $poster = File::files('images/Uploads/Product/' . $id . '/Poster/');
            else
                $poster = null;
        }

        return view('Back.Goods.goodsedit', [
            'product' => $product,
            'category' => $category,
            'subcategory' => $subcategory,
            'size' => $size,
            'subcategoryId' => $subcategoryId,
            'categoryId' => $categoryId,
            'sizeId' => $sizeId,
            'productImages' => $files,
            'posterImage' => $poster,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductAddRequest $request, $id)
    {
        $product = Product::find($id);

        $category = Category::where('name', $request->category)->first();


        foreach ($request->subcategory as $sub) {
            $subcategory = new Subcategory();
            $subcategoryFind = Subcategory::where('category_id', $category->id)->where('name', $sub)->first();

            if ($subcategoryFind) {
                $subcategoryFind->category_id = $category->id;
                $subcategoryFind->name = $sub;
            } else {
                $subcategory->category_id = $category->id;
                $subcategory->name = $sub;
                $subcategory->save();
            }
        }

        $product->manufacturer = $request->manufacturer;
        $product->model = $request->model;
        $product->code = $request->code;

        if (isset($request->discount)) {
            if ($request->discount > 0 && $request->discount < 100) {
                $product->price = round($request->price - ($request->price * $request->discount / 100));
                $product->price_without_discount = $request->price;
                $product->discount = $request->discount;
            }
        } else
            $product->price = $request->price;

        $product->count = $request->count;
        $product->color = $request->color;
        $product->description = $request->description;
        $product->highlights = $request->highlights;

        $images[] = null;

        if (isset($request->images)) {
            $files = File::files('images/Uploads/Product/' . $id);
            foreach ($files as $file) {
                File::delete($file->getPathname());
            }
            $product->images = "";
            foreach ($request->images as $image) {
                $name = $image->getClientOriginalName();
                $image->move('images/Uploads/Product/' . $id, $name);
                $product->images .= 'images\\Uploads\\Product\\' . $id . '\\' . $name . PHP_EOL;
            }
        }

        if ($request->slider == "on") {
            $product->slider = 1;
        } else {
            $product->slider = 0;
            $product->poster = "";
        }
        if (isset($request->slider_slog)) {
            $product->slider_slog = $request->slider_slog;
        }

        if (isset($request->poster)) {
            $name = $request->poster->getClientOriginalName();
            if (file_exists('images/Uploads/Product/' . $id . '/Poster')) {
                File::cleanDirectory('images/Uploads/Product/' . $id . '/Poster');
                $request->poster->move('images/Uploads/Product/' . $id . '/Poster', $name);
                $product->poster = "";
                $product->poster = 'images\\Uploads\\Product\\' . $id . '\\Poster\\' . $name;
            } else {
                $request->poster->move('images/Uploads/Product/' . $id . '/Poster', $name);
                $product->poster = "";
                $product->poster = 'images\\Uploads\\Product\\' . $id . '\\Poster\\' . $name;
            }
        }

        $product->save();

        Product_Size::where('product_id', $id)->delete();
        foreach ($request->size as $size) {
            $productSize = new Product_Size();
            $size = Size::where('name', $size)->first();
            $productSize->product_id = $product->id;
            $productSize->size_id = $size->id;
            $productSize->save();
        }

        SC_Prod::where('product_id', $id)->delete();
        foreach ($request->subcategory as $sub) {
            $scProd = new SC_Prod();
            $subId = Subcategory::where('category_id', $category->id)->where('name', $sub)->first();
            $scProd->product_id = $product->id;
            $scProd->subcategory_id = $subId->id;
            $scProd->save();
        }

        return redirect()->route('goods.view')->with('alert-success', 'Товар успішно оновлено у базі даних!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (file_exists(public_path('images/Uploads/Product/' . $id))) {
            File::deleteDirectory(public_path('images/Uploads/Product/' . $id));
        }

        $product->delete();

        return redirect()->route('goods.view')->with('alert-success', 'Товар успішно видалено з бази даних!');
    }
}
