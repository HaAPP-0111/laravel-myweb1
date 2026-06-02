<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sử dụng Query Builder để lấy danh sách loại sản phẩm theo đúng tài liệu Lab 06
        $list = DB::table('categories')
            ->select('cateid', 'catename', 'slug', 'image', 'status')
            ->where('status', 1)
            ->orderBy('catename')
            ->get();

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
        DB::table('categories')->insert([
            'catename' => $request->catename,
            'slug' => $request->slug,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm loại sản phẩm thành công!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Thực hiện xóa loại sản phẩm dựa trên cột khóa chính cateid
        DB::table('categories')
            ->where('cateid', $id)
            ->delete();

        // Quay lại trang danh sách kèm thông báo flash session
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Xóa loại sản phẩm thành công!');
    }
}