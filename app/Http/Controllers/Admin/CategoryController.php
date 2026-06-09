<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function create()
    {
        return view('admin.categories.create');
    }

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Lấy thông tin loại sản phẩm theo id
        $category = Category::findOrFail($id);

        // Trả về view edit cùng với dữ liệu category
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Xóa loại sản phẩm thành công!');
    }
}