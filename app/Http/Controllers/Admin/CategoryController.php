<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Cần thiết để dùng Str::slug
use App\Models\Category;


class CategoryController extends Controller
{
    public function index($limit = 10)
    {
        // $list = DB::table('categories')
        //     ->select('cateid', 'catename', 'slug', 'image', 'status')
        //     ->orderBy('cateid', 'desc') // Đổi sang desc để cái mới lên đầu
        //     ->get();

        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status')
            ->orderBy('catename')
            ->paginate($limit);

        return view('admin.categories.index', compact('list'));
    }

=======
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // ==== ORM Eloquent có xử lý phân trang và đếm sản phẩm theo danh mục
        $list = Category::withCount('products')
            ->orderBy('catename')
            ->paginate($limit);

        // Trả về giao diện index.blade.php kèm theo biến dữ liệu $list
        return view('admin.categories.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    public function create()
    {
        return view('admin.categories.create');
    }

<<<<<<< HEAD
    public function store(Request $request)
    {
        $request->validate([
            'catename' => 'required|max:150',
        ]);

        DB::table('categories')->insert([
            'catename'   => $request->catename,
            'slug'       => $request->slug ?? Str::slug($request->catename),
            'status'     => $request->status ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    // --- CÁC CHỨC NĂNG BỔ SUNG ---
=======
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'catename' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'status' => 'sometimes|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'catename' => $validated['catename'],
            'slug' => $validated['slug'],
            'status' => $validated['status'] ?? 1,
            'sort_order' => $validated['sort_order'] ?? 0,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm loại sản phẩm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('admin.categories.show', compact('category'));
    }
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
<<<<<<< HEAD
        // Lấy dữ liệu danh mục theo ID (cateid)
        $category = DB::table('categories')->where('cateid', $id)->first();

        // Nếu không tìm thấy thì báo lỗi 404
        if (!$category) {
            abort(404);
        }

=======
        // Lấy thông tin loại sản phẩm theo id
        $category = Category::findOrFail($id);

        // Trả về view edit cùng với dữ liệu category
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
<<<<<<< HEAD
        $request->validate([
            'catename' => 'required|max:150',
        ]);

        DB::table('categories')->where('cateid', $id)->update([
            'catename'   => $request->catename,
            'slug'       => $request->slug ?? Str::slug($request->catename),
            'status'     => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
=======
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'catename' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->cateid . ',cateid',
            'status' => 'required|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'catename' => $validated['catename'],
            'slug' => $validated['slug'],
            'status' => $validated['status'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật loại sản phẩm thành công!');
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
<<<<<<< HEAD
        DB::table('categories')->where('cateid', $id)->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
=======
        Category::destroy($id);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Xóa loại sản phẩm thành công!');
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }
}