@extends('layouts.main')
@section('content')
    <?php
    use App\Models\Category;
    use App\Models\Product;
    use App\Models\Size;
    use App\Models\Subcategory;

    $productCategory = Category::all()->sortBy('name');
    $viewProductsManufacturer = Product::select('manufacturer')->orderBy('manufacturer')->distinct()->get();
    $viewProductsColors = Product::select('color')->distinct()->orderBy('color')->get();
    $viewProductSizes = Size::select('name')->orderBy('name')->distinct()->get();
    $viewProductSubcategories = Subcategory::select('name')->orderBy('name')->distinct()->get();
    ?>
    <div class="products-gallery">
        <div class="container">
            <div class="col-md-9 grid-gallery">
                @if(count($products) > 0)
                    @foreach($products as $prod)
                        <div class="col-md-4 grid-stn simpleCart_shelfItem zeropad">
                            @if($prod->discount > 0 && $prod->discount < 100)
                                <div class="sale">
                                    <span class="sale_value">-{{$prod->discount}}%</span>
                                </div>
                            @endif
                            <div class="ih-item square effect3 bottom_to_top">
                                <div class="bottom-2-top">
                                    @if(explode(PHP_EOL, $prod->images)[0] == "")
                                        <div class="img"><img src="{{url('images/no image grid.jpg')}}" alt="/"
                                                              class="img-responsive gri-wid"></div>
                                    @else
                                        <div class="img"><img src="{{url(explode(PHP_EOL, $prod->images)[0])}}" alt="/"
                                                              class="img-responsive gri-wid"></div>
                                    @endif
                                    <div class="info">
                                        <div class="pull-left styl-hdn">
                                            <h3>{{$prod->manufacturer}} {{$prod->model}}</h3>
                                        </div>
                                        @if($prod->discount > 0 && $prod->discount < 100)
                                            <div class="pull-right styl-price">
                                                <p><span class="item_price discount_price">{{$prod->price_without_discount}} ₴</span>
                                                </p>
                                                <p><a href="{{url('product/'.$prod->id)}}" class="item_add"><span
                                                            class="glyphicon glyphicon-shopping-cart grid-cart scred"
                                                            aria-hidden="true"></span> <span
                                                            class="item_price item_price_discount">{{$prod->price}} ₴</span></a>
                                                </p>
                                            </div>
                                        @else
                                            <div class="pull-right styl-price">
                                                <p><a href="{{url('product/'.$prod->id)}}" class="item_add"><span
                                                            class="glyphicon glyphicon-shopping-cart grid-cart"
                                                            aria-hidden="true"></span> <span class=" item_price">{{$prod->price}} ₴</span></a>
                                                </p>
                                            </div>
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="quick-view">
                                <a href="{{url('product/'.$prod->id)}}"><img class="qview"
                                                                             src="{{url('images/view.png')}}"></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="search_info"><h3>Товарів не знайдено!</h3></div>
                @endif
                <div class="clearfix"></div>
                <div class="paginate"> {{ $products->links() }}</div>
            </div>
            <div class="col-md-3 grid-details">
                <div class="grid-addon">
                    <form class="filter" action="{{url('product/filter/')}}" method="get">
                        <input class="filter_search" type="submit" value="ЗАСТОСУВАТИ ФІЛЬТР">
                        <a class="filter_search" href="{{url('product/filter/')}}">ОЧИСТИТИ ФІЛЬТР</a>
                        <section class="sky-form">
                            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>СОРТУВАТИ ЗА</h4>
                            <div class="col col-4">
                                <select class="sortBy" name="sort[]">
                                    <option style="display:none"></option>
                                    <option
                                        @if(isset(request()->sort) && in_array("За популярністю", request()->sort)) selected @endif>
                                        За популярністю
                                    </option>
                                    <option
                                        @if(isset(request()->sort) && in_array("За знижкою", request()->sort)) selected @endif>
                                        За знижкою
                                    </option>
                                    <option
                                        @if(isset(request()->sort) && in_array("Ціна за зростанням", request()->sort)) selected @endif>
                                        Ціна за зростанням
                                    </option>
                                    <option
                                        @if(isset(request()->sort) && in_array("Ціна за спаданням", request()->sort)) selected @endif>
                                        Ціна за спаданням
                                    </option>
                                </select>
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>КАТЕГОРІЯ</h4>
                            <div class="row row1 scroll-pane">
                                <div class="col col-4">
                                    @if(isset($productCategory))
                                        @foreach($productCategory as $category)
                                            <label class="checkbox"><input type="checkbox" name="category[]"
                                                                           value="{{$category->id}}"
                                                                           @if(isset($idCategory) && $category->id == $idCategory) checked
                                                                           @endif
                                                                           @if(isset(request()->category) && in_array($category->id, request()->category)) checked @endif><i></i>{{$category->name}}
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>ПІДКАТЕГОРІЯ</h4>
                            <div class="row row1 scroll-pane">
                                <div class="col col-4">
                                    @if(isset($viewProductSubcategories))
                                        @foreach($viewProductSubcategories as $subcategory)
                                            <label class="checkbox"><input type="checkbox" name="subcategory[]"
                                                                           value="{{$subcategory->name}}"
                                                                           @if(isset($nameSubcategory) && $subcategory->name == $nameSubcategory->name) checked
                                                                           @endif
                                                                           @if(isset(request()->subcategory) && in_array($subcategory->name, request()->subcategory)) checked @endif><i></i>{{$subcategory->name}}
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>ЦІНА</h4>
                            <div class="col col-4">
                                <input name="price_from" type="text" placeholder="Від"
                                       value="{{request()->price_from}}">
                                <input name="price_to" style="margin-top: 10px" type="text" placeholder="До"
                                       value="{{request()->price_to}}">
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>ЗНИЖКА</h4>
                            <div class="row row1 scroll-pane">
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="discount[]" value="1"

                                                                   @if(isset(request()->discount) && in_array(1, request()->discount)) checked @endif><i></i>До
                                        10%</label>
                                    <label class="checkbox"><input type="checkbox" name="discount[]" value="2"
                                                                   @if(isset(request()->discount) && in_array(2, request()->discount)) checked @endif
                                        ><i></i>10% - 30%</label>
                                    <label class="checkbox"><input type="checkbox" name="discount[]" value="3"
                                                                   @if(isset(request()->discount) && in_array(3, request()->discount)) checked @endif
                                        ><i></i>30%
                                        - 50%</label>
                                    <label class="checkbox"><input type="checkbox" name="discount[]" value="4"
                                                                   @if(isset(request()->discount) && in_array(4, request()->discount)) checked @endif
                                        ><i></i>Більше
                                        50%</label>
                                </div>
                            </div>
                        </section>
                        <!---->
                        <section class="sky-form">
                            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>ВИРОБНИК</h4>
                            <div class="row row1 scroll-pane">
                                <div class="col col-4">
                                    @if(isset($viewProductsManufacturer))
                                        @foreach($viewProductsManufacturer as $product)
                                            <label class="checkbox"><input type="checkbox" name="manufacturer[]"
                                                                           value="{{$product->manufacturer}}"
                                                                           @if(isset(request()->manufacturer) && in_array($product->manufacturer, request()->manufacturer)) checked @endif
                                                ><i></i>{{$product->manufacturer}}</label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>РОЗМІР</h4>
                            <div class="row row1 scroll-pane">
                                <div class="col col-4">
                                    @if(isset($viewProductSizes))
                                        @foreach($viewProductSizes as $viewProductSize)
                                            <label class="checkbox"><input type="checkbox" name="productsize[]"
                                                                           value="{{$viewProductSize->name}}"
                                                                           @if(isset(request()->productsize) && in_array($viewProductSize->name, request()->productsize)) checked @endif
                                                ><i></i>{{$viewProductSize->name}}</label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>КОЛІР</h4>
                            <div class="row row1 scroll-pane">
                                <div class="col col-4">
                                    @if(isset($viewProductsColors))
                                        @foreach($viewProductsColors as $viewProductColor)
                                            <label class="checkbox"><input type="checkbox" name="productcolor[]"
                                                                           value="{{$viewProductColor->color}}"
                                                                           @if(isset(request()->productcolor) && in_array($viewProductColor->color, request()->productcolor)) checked @endif
                                                ><i></i>{{$viewProductColor->color}}</label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
