<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // Thực hiện JOIN các bảng và đổi ->get() thành ->paginate($limit) để sửa lỗi
        $list = DB::table('products')
            ->join('categories', 'products.cateid', '=', 'categories.cateid')
            ->leftJoin('brands', 'products.brandid', '=', 'brands.brandid')
            ->select(
                'products.id', // Khóa chính là id theo database của bạn
                'products.productname',
                'products.price',
                'products.pricediscount',
                'products.image',
                'products.status',
                'categories.catename as category_name', // Đã alias thành category_name
                'brands.brandname as brand_name'
            )
            ->orderBy('products.id', 'desc') // Đưa sản phẩm mới nhất lên đầu trang
            ->paginate($limit); // BẮT BUỘC dùng paginate thay vì get()

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy danh sách categories và brands truyền qua để làm select option khi thêm mới
        $categories = DB::table('categories')->where('status', 1)->get();
        $brands = DB::table('brands')->where('status', 1)->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'productname' => 'required|max:255',
            'cateid' => 'required',
            'brandid' => 'required',
            'price' => 'required|numeric',
        ]);

        // Thêm dữ liệu vào bảng bằng DB Table
        DB::table('products')->insert([
            'productname' => $request->productname,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->productname),
            'cateid' => $request->cateid,
            'brandid' => $request->brandid,
            'price' => $request->price,
            'pricediscount' => $request->pricediscount ?? 0,
            'status' => $request->status ?? 1,
            'created_at' => now(), // Viết bằng DB thuần phải tự thêm thời gian
            'updated_at' => now()
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
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
        // Không làm chức năng sửa theo yêu cầu
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Không làm chức năng sửa theo yêu cầu
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