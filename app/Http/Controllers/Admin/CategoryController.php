<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;



class CategoryController extends Controller
{
    public function index($limit = 10)
    {
    
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
            'catename' => 'required|min:3|max:100|unique:categories,catename',
            'slug'     => 'nullable|string|min:5|max:150|unique:categories,slug|regex:/^[a-z0-9-]+$/',
            'status'   => 'required|in:0,1',
        ], [
            'catename.required' => 'Tên loại không được để trống.',
            'catename.min'      => 'Tên loại phải từ 3 ký tự trở lên.',
            'catename.max'      => 'Tên loại sản phẩm không được vượt quá 100 ký tự.',
            'catename.unique'   => 'Tên loại sản phẩm này đã tồn tại.',
            'slug.min'          => 'Đường dẫn (Slug) phải từ 5 ký tự trở lên.',
            'slug.max'          => 'Slug không được vượt quá 150 ký tự.',
            'slug.unique'       => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
            'slug.regex'        => 'Slug chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.required'   => 'Trạng thái không được để trống.',
            'status.in'         => 'Trạng thái không hợp lệ.',
        ]);

        try {
            Category::create([
                'catename'    => $request->catename,
                'slug'        => $request->slug ? Str::slug($request->slug) : Str::slug($request->catename),
                'status'      => $request->status ?? 1,
                'description' => $request->description,
            ]);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Thêm danh mục thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }


  
    public function edit(string $id)
   {
        $category = Category::find($id);

        if (!$category) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Danh mục không tồn tại!');
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
   {
        $request->validate([
            'catename' => 'required|min:3|max:100|unique:categories,catename,' . $id . ',cateid',
            'slug'     => 'nullable|string|min:5|max:150|
            unique:categories,slug,' . $id .
             ',cateid|regex:/^[a-z0-9-]+$/',
            'status'   => 'required|in:0,1',
        ], [
            'catename.required' => 'Tên loại không được để trống.',
            'catename.min'      => 'Tên loại phải từ 3 ký tự trở lên.',
            'catename.max'      => 'Tên loại sản phẩm không được vượt quá 100 ký tự.',
            'catename.unique'   => 'Tên loại sản phẩm này đã tồn tại.',
            'slug.min'          => 'Đường dẫn (Slug) phải từ 5 ký tự trở lên.',
            'slug.max'          => 'Slug không được vượt quá 150 ký tự.',
            'slug.unique'       => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
            'slug.regex'        => 'Slug chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.required'   => 'Trạng thái không được để trống.',
            'status.in'         => 'Trạng thái không hợp lệ.',
        ]);

        try {
            $category = Category::find($id);

            if (!$category) {
                return redirect()
                    ->route('admin.categories.index')
                    ->with('error', 'Danh mục không tồn tại');
            }

            $data = [
                'catename'    => $request->catename,
                'slug'        => $request->slug ? Str::slug($request->slug) : Str::slug($request->catename),
                'status'      => $request->status ?? 1,
                'description' => $request->description,
            ];

            $category->update($data);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Cập nhật danh mục thành công');
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
        DB::table('categories')->where('cateid', $id)->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}