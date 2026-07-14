<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Validation\Rule;

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
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename',
                'slug' => [
                    'required',
                    'min:5',
                    'max:150',
                    'unique:categories,slug',
                    'regex:/^[a-z0-9-]+$/'
                ],
                'status' => 'required|in:0,1',
                'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute phải từ :min ký tự trở lên.',
                'max' => ':attribute không vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in' => ':attribute không hợp lệ.',
                'img.image' => ':attribute phải là hình ảnh.',
                'img.mimes' => ':attribute chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
                'img.max' => ':attribute không được vượt quá 200 KB.',
            ],
            [
                'catename' => 'Tên loại',
                'slug' => 'Đường dẫn (Slug)',
                'status' => 'Trạng thái',
                'img' => 'Hình ảnh',
            ]
        );

        try {
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->catename)
                          . '-' . time()
                          . '.' . $file->extension();
                $file->storeAs('categories', $fileName, 'public');
            }

            Category::create([
                'catename'    => $request->catename,
                'slug'        => $request->slug ? Str::slug($request->slug) : Str::slug($request->catename),
                'status'      => $request->status ?? 1,
                'description' => $request->description,
                'image'       => $fileName,
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
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename,' . $id . ',cateid',
                'slug' => [
                    'required',
                    'min:5',
                    'max:150',
                    'regex:/^[a-z0-9-]+$/',
                    Rule::unique('categories', 'slug')->ignore($id, 'cateid'),
                ],
                'status' => 'required|in:0,1',
                'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute phải từ :min ký tự trở lên.',
                'max' => ':attribute không vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in' => ':attribute không hợp lệ.',
                'img.image' => ':attribute phải là hình ảnh.',
                'img.mimes' => ':attribute chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
                'img.max' => ':attribute không được vượt quá 200 KB.',
            ],
            [
                'catename' => 'Tên loại',
                'slug' => 'Đường dẫn (Slug)',
                'status' => 'Trạng thái',
                'img' => 'Hình ảnh',
            ]
        );

        try {
            $category = Category::find($id);

            if (!$category) {
                return redirect()
                    ->route('admin.categories.index')
                    ->with('error', 'Danh mục không tồn tại');
            }

            $fileName = $category->image;
            if ($request->hasFile('img')) {
                if ($fileName) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('categories/' . $fileName);
                }
                $file = $request->file('img');
                $fileName = Str::slug($request->catename)
                          . '-' . time()
                          . '.' . $file->extension();
                $file->storeAs('categories', $fileName, 'public');
            }

            $data = [
                'catename'    => $request->catename,
                'slug'        => $request->slug ? Str::slug($request->slug) : Str::slug($request->catename),
                'status'      => $request->status ?? 1,
                'description' => $request->description,
                'image'       => $fileName,
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
     * Remove the specified resource from storage (Xóa mềm).
     */
    public function destroy(string $id)
    {
        try {
            Category::findOrFail($id)->delete();
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Xóa thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    // Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
    public function trash()
    {
        $limit = 10;
        $list = Category::onlyTrashed()
            ->orderBy('catename')
            ->paginate($limit);

        return view('admin.categories.trash', compact('list'));
    }

    // Khôi phục
    public function restore(string $id)
    {
        try {
            Category::onlyTrashed()->findOrFail($id)->restore();
            return redirect()
                ->route('admin.categories.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    // Xóa vĩnh viễn
    public function forceDelete(string $id)
    {
        try {
            $category = Category::onlyTrashed()->findOrFail($id);
            if ($category->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('categories/' . $category->image);
            }
            $category->forceDelete();
            return redirect()
                ->route('admin.categories.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }
}