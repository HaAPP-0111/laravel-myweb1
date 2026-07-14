<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10) // Bổ sung tham số mặc định $limit để không bị lỗi Undefined variable
    {
        $list = Brand::select('brandid', 'brandname', 'slug', 'image', 'status')
            ->orderBy('brandid', 'desc') // Đưa thương hiệu mới tạo lên trên đầu danh sách
            ->paginate($limit);

        return view('admin.brands.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try {
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->brandname)
                          . '-' . time()
                          . '.' . $file->extension();
                $file->storeAs('brands', $fileName, 'public');
            }

            Brand::create([
                'brandname'   => $request->brandname,
                'slug'        => $request->slug ? Str::slug($request->slug) : Str::slug($request->brandname),
                'status'      => $request->status ?? 1,
                'description' => $request->description,
                'image'       => $fileName,
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Thêm thương hiệu thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Thêm thương hiệu thất bại: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Thường không dùng trong trang quản trị nội bộ, để trống
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // THAY ĐỔI: Sử dụng where() tìm theo brandid thay vì find() tìm theo id mặc định
        $brand = Brand::where('brandid', $id)->first();

        if (!$brand) {
            return redirect()
                ->route('admin.brands.index')
                ->with('error', 'Thương hiệu không tồn tại!');
        }

        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        try {
            $brand = Brand::where('brandid', $id)->first();

            if (!$brand) {
                return redirect()
                    ->route('admin.brands.index')
                    ->with('error', 'Thương hiệu không tồn tại');
            }

            $fileName = $brand->image;
            if ($request->hasFile('img')) {
                if ($fileName) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('brands/' . $fileName);
                }
                $file = $request->file('img');
                $fileName = Str::slug($request->brandname)
                          . '-' . time()
                          . '.' . $file->extension();
                $file->storeAs('brands', $fileName, 'public');
            }

            $brand->update([
                'brandname'   => $request->brandname,
                'slug'        => $request->slug ? Str::slug($request->slug) : Str::slug($request->brandname),
                'status'      => $request->status ?? 1,
                'description' => $request->description,
                'image'       => $fileName,
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Cập nhật thương hiệu thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Cập nhật thương hiệu thất bại: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $brand = Brand::where('brandid', $id)->firstOrFail();
            $brand->delete();
            return redirect()
                ->route('admin.brands.index')
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
        $list = Brand::onlyTrashed()
            ->orderBy('brandname')
            ->paginate($limit);

        return view('admin.brands.trash', compact('list'));
    }

    public function restore(string $id)
    {
        try {
            Brand::onlyTrashed()->where('brandid', $id)->firstOrFail()->restore();
            return redirect()
                ->route('admin.brands.trash')
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
            $brand = Brand::onlyTrashed()->where('brandid', $id)->firstOrFail();
            if ($brand->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('brands/' . $brand->image);
            }
            $brand->forceDelete();
            return redirect()
                ->route('admin.brands.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }
}