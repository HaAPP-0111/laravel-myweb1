<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
       
        $list = DB::table('products')
            ->join('categories', 'products.cateid', 'categories.cateid')
            ->leftJoin('brands', 'products.brandid', '=', 'brands.brandid')
            ->select(
                'products.id',
                'products.productname',
                'products.price',
                'products.pricediscount',
                'products.image',
                'products.status',
                'categories.catename as category_name', 
                'brands.brandname as brand_name'
            )
            ->orderBy('products.id', 'desc') 
            ->paginate($limit); 

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::select('cateid', 'catename')
        ->orderBy('catename')
        ->get();

    $brands = Brand::select('brandid', 'brandname')
        ->orderBy('brandname')
        ->get();

    return view('admin.products.create', compact('categories', 'brands'));
}

    /**
     * Store a newly created resource in storage.
     */
 public function store(ProductRequest $request)
{
    try {
        Product::create([
            'productname'   => $request->productname,
            'slug'          => $request->slug ? Str::slug($request->slug) : Str::slug($request->productname),
            'cateid'        => $request->cateid,
            'brandid'       => $request->brandid,
            'price'         => $request->price,
            'pricediscount' => $request->pricediscount ?? 0,
            'description'   => $request->description,
            'status'        => $request->status ?? 1,
            'image'         => $request->image,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Thêm sản phẩm thành công!');
    } catch (\Exception $e) {
        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Sản phẩm không tồn tại');
        }

        $categories = Category::select('cateid', 'catename')
            ->orderBy('catename')
            ->get();

        $brands = Brand::select('brandid', 'brandname')
            ->orderBy('brandname')
            ->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(ProductRequest $request, string $id)
{
    try {
        if (empty($request->cateid)) {
            return back()
                ->withInput()
                ->with('error', 'Vui lòng chọn loại sản phẩm');
        }

        $product = Product::find($id);

        if (!$product) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Sản phẩm không tồn tại');
        }

        $data = [
            'productname'   => $request->productname,
            'slug'          => $request->slug ? Str::slug($request->slug) : Str::slug($request->productname),
            'cateid'        => $request->cateid,
            'brandid'       => $request->brandid,
            'price'         => $request->price,
            'pricediscount' => $request->pricediscount ?? 0,
            'status'        => $request->status ?? 1,
            'description'   => $request->description,
            'image'         => $request->image,
        ];

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Cập nhật sản phẩm thành công');
    } catch (\Exception $e) {
        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Xóa sản phẩm dựa theo khóa chính id
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function test1()
    {
        return redirect()->route('admin.home');
    }
    
    public function test2()
    {
        return redirect('/admin/dashboard');
    }
}