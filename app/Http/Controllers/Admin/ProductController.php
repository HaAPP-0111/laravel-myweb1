<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
=======
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
<<<<<<< HEAD
    public function index($limit = 10)
    {
        // Thực hiện JOIN các bảng và đổi ->get() thành ->paginate($limit) để sửa lỗi
        $list = DB::table('products')
            ->join('categories', 'products.cateid', '=', 'categories.cateid')
            ->leftJoin('brands', 'products.brandid', '=', 'brands.brandid')
            ->select(
                'products.id', // Khóa chính là id theo database của bạn
                'products.productname',
=======
    public function index(Request $request)
    {
        $query = DB::table('products')
            ->join('categories', 'products.cateid', '=', 'categories.cateid')
            ->leftJoin('brands', 'products.brandid', '=', 'brands.brandid')
            ->select(
                'products.id',
                'products.productname',
                'products.slug',
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
                'products.price',
                'products.pricediscount',
                'products.image',
                'products.status',
<<<<<<< HEAD
                'categories.catename as category_name', // Đã alias thành category_name
                'brands.brandname as brand_name'
            )
            ->orderBy('products.id', 'desc') // Đưa sản phẩm mới nhất lên đầu trang
            ->paginate($limit); // BẮT BUỘC dùng paginate thay vì get()

        return view('admin.products.index', compact('list'));
=======
                'products.cateid',
                'categories.catename as category_name',
                'brands.brandname as brand_name'
            );

        $categoryName = null;
        if ($request->filled('cateid')) {
            $query->where('products.cateid', $request->query('cateid'));
            $category = DB::table('categories')->where('cateid', $request->query('cateid'))->first();
            $categoryName = $category?->catename;
        }

        $list = $query->orderBy('products.productname')->get();

        return view('admin.products.index', compact('list', 'categoryName'));
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        // Lấy danh sách categories và brands truyền qua để làm select option khi thêm mới
        $categories = DB::table('categories')->where('status', 1)->get();
        $brands = DB::table('brands')->where('status', 1)->get();

        return view('admin.products.create', compact('categories', 'brands'));
=======
        //
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
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
=======
        //
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
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
<<<<<<< HEAD
        // Không làm chức năng sửa theo yêu cầu
=======
        //
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
<<<<<<< HEAD
        // Không làm chức năng sửa theo yêu cầu
=======
        //
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
<<<<<<< HEAD
        // Xóa sản phẩm dựa theo khóa chính id
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function test1()
    {
        return redirect()->route('admin.home');
    }
    
=======
        //
    }
    //test 1
    public function test1()
    {
        return redirect()->route('admin.dashboard');
    }
    //test 2
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    public function test2()
    {
        return redirect('/admin/dashboard');
    }
}