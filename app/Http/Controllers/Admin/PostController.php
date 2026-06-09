<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // Đã sửa từ innerJoin thành join để đúng chuẩn cú pháp Laravel
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
        $request->validate([
            'title' => 'required|max:255',
            'detail' => 'required'
        ]);

        DB::table('posts')->insert([
            'title' => $request->title,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'detail' => $request->detail,
            'status' => $request->status ?? 1,
            'user_id' => 1, // Tạm thời gán ID người dùng viết bài là 1
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Thêm bài viết thành công!');
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