<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post; // SỬA LỖI 1: Bắt buộc phải import Model Post vào đây

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        $list = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.id', 
                'posts.title',
                'posts.slug',
                'posts.image',
                'posts.status',
                'posts.created_at',
                'users.fullname as author_name' 
            )
            ->orderBy('posts.created_at', 'desc')
            ->paginate($limit); 

        return view('admin.posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Post::create([
                'title'       => $request->title,
                'slug'        => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
                'description' => $request->description ?? '',
                'detail'      => $request->detail ?? '',
                'status'      => $request->status ?? 1,
                'user_id'     => auth()->id() ?? 1 // Tạm thời lấy ID user đăng nhập hoặc mặc định là 1 để tránh lỗi khóa ngoại
            ]);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Thêm bài viết thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()
                ->route('admin.posts.index')
                ->with('error', 'Bài viết không tồn tại!');
        }

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * SỬA LỖI 2: Bổ sung phương thức update() xử lý lưu dữ liệu sửa đổi bằng Eloquent ORM
     */
    public function update(Request $request, string $id)
    {
        try {
            // Tìm bài viết theo ID
            $post = Post::find($id);

            // Kiểm tra sự tồn tại của bài viết
            if (!$post) {
                return redirect()
                    ->route('admin.posts.index')
                    ->with('error', 'Bài viết không tồn tại');
            }

            // Tiến hành cập nhật bằng Eloquent ORM
            $post->update([
                'title'       => $request->title,
                'slug'        => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
                'description' => $request->description ?? '',
                'detail'      => $request->detail ?? '',
                'status'      => $request->status ?? 1,
            ]);

            // Trả về trang danh sách kèm thông báo thành công
            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Cập nhật bài viết thành công');

        } catch (\Exception $e) {
            // Trả về trang sửa kèm dữ liệu cũ và thông báo lỗi nếu thất bại
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
        DB::table('posts')->where('id', $id)->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công!');
    }
}