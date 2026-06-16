<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

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
        try {
            // Thực hiện tạo bằng Eloquent Model
            Product::create([
                'productname'   => $request->productname,
                'slug'          => $request->slug ? Str::slug($request->slug) : Str::slug($request->productname),
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'detail'        => $request->detail ?? '', // Đồng bộ với thuộc tính trong Model Product của bạn
                'status'        => $request->status,
            ]);

            // Trường hợp thành công: Điều hướng về index kèm Session Flash 'success'
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');

        } catch (\Exception $e) {
            // Trường hợp lỗi: Quay về trang cũ, giữ lại dữ liệu đã nhập và kèm Session Flash 'error'
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
        // Thực hiện lấy sản phẩm theo id
        $product = Product::find($id);

        // Lấy danh sách loại sản phẩm, thương hiệu (chỉ lấy cột cần thiết)
        $categories = Category::select('cateid', 'catename')->get();
        
        // Lưu ý: Ở đây mình dùng 'brandid' thay vì 'id' như slide để khớp với database của bạn nhé
        $brands = Brand::select('brandid', 'brandname')->get(); 

        // Gởi dữ liệu sang View
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Kiểm tra loại sản phẩm theo đúng yêu cầu slide
            if (empty($request->cateid)) {
                return back()
                    ->withInput()
                    ->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            $product = Product::find($id);

            // Kiểm tra xem sản phẩm có tồn tại không
            if (!$product) {
                return redirect()
                    ->route('admin.products.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            // Thực hiện cập nhật sản phẩm bằng Eloquent ORM
            $product->update([
                'productname'   => $request->productname,
                'slug'          => $request->slug ? \Illuminate\Support\Str::slug($request->slug) : \Illuminate\Support\Str::slug($request->productname),
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'status'        => $request->status,
                'description'   => $request->description ?? '' // Đảm bảo thuộc tính này khớp với Model của bạn
            ]);

            // Chuyển về trang danh sách sau khi sửa thành công
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');

        } catch (\Exception $e) {
            // Bắt lỗi và trả về trang cũ kèm dữ liệu đã nhập
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