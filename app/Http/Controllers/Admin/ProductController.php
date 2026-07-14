<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

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
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                          . '-' . time()
                          . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }

            $product = Product::create([
                'productname'   => $request->productname,
                'slug'          => $request->slug ? Str::slug($request->slug) : Str::slug($request->productname),
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'description'   => $request->description,
                'status'        => $request->status ?? 1,
                'image'         => $fileName,
            ]);

            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time();
                foreach ($request->file('imgs') as $file) {
                    $subFileName = $product->id
                                 . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $subFileName, 'public');
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $subFileName,
                    ]);
                    $i++;
                }
            }

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Thêm sản phẩm thất bại: ' . $e->getMessage());
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
        $product = Product::with('images')->find($id);

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
            $product = Product::find($id);

            if (!$product) {
                return redirect()
                    ->route('admin.products.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            $fileName = $product->image;
            if ($request->hasFile('img')) {
                if ($fileName) {
                    Storage::disk('public')->delete('products/' . $fileName);
                }
                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                          . '-' . time()
                          . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }

            $product->update([
                'productname'   => $request->productname,
                'slug'          => $request->slug ? Str::slug($request->slug) : Str::slug($request->productname),
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'status'        => $request->status ?? 1,
                'description'   => $request->description,
                'image'         => $fileName,
            ]);

            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time();
                foreach ($request->file('imgs') as $file) {
                    $subFileName = $product->id
                                 . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $subFileName, 'public');
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $subFileName,
                    ]);
                    $i++;
                }
            }

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Cập nhật sản phẩm thất bại: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Xóa thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    public function trash()
    {
        $limit = 10;
        $list = Product::onlyTrashed()
            ->orderBy('productname')
            ->paginate($limit);

        return view('admin.products.trash', compact('list'));
    }

    public function restore(string $id)
    {
        try {
            Product::onlyTrashed()->findOrFail($id)->restore();
            return redirect()
                ->route('admin.products.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    public function forceDelete(string $id)
    {
        try {
            $product = Product::onlyTrashed()->with('images')->findOrFail($id);
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }
            foreach ($product->images as $subImg) {
                Storage::disk('public')->delete('products/' . $subImg->image);
            }
            $product->forceDelete();
            return redirect()
                ->route('admin.products.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    /**
     * Delete a single sub-image via AJAX.
     */
    public function deleteImage(string $id)
    {
        try {
            $image = ProductImage::findOrFail($id);
            Storage::disk('public')->delete('products/' . $image->image);
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Xóa hình ảnh phụ thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 500);
        }
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