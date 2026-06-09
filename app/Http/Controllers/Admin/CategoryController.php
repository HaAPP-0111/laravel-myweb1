<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function create()
    {
        return view('admin.categories.create');
    }

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Lấy dữ liệu danh mục theo ID (cateid)
        $category = DB::table('categories')->where('cateid', $id)->first();

        // Nếu không tìm thấy thì báo lỗi 404
        if (!$category) {
            abort(404);
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('categories')->where('cateid', $id)->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}