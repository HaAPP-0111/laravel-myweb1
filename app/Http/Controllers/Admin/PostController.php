<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
=======
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
<<<<<<< HEAD
    public function index($limit = 10)
    {
        // Đã sửa từ innerJoin thành join để đúng chuẩn cú pháp Laravel
        $list = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.id', 
=======
    public function index()
    {
        $list = DB::table('posts')
            ->leftJoin('users', 'posts.userid', '=', 'users.id')
            ->select(
                'posts.id',
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
                'posts.title',
                'posts.slug',
                'posts.image',
                'posts.status',
                'posts.created_at',
<<<<<<< HEAD
                'users.fullname as author_name' 
            )
            ->orderBy('posts.created_at', 'desc')
            ->paginate($limit); 
=======
                'users.name as user_name'
            )
            ->orderByDesc('posts.created_at')
            ->get();
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

        return view('admin.posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        return view('admin.posts.create');
=======
        //
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
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
=======
        //
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
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
<<<<<<< HEAD
        DB::table('posts')->where('id', $id)->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công!');
    }
}
=======
        //
    }
}
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
