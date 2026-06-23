<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Support\Str;
use App\Models\Post; 

class PostController extends Controller
{
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

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(PostRequest $request)
    {
        try {
            Post::create([
                'title'   => $request->title,
                'slug'    => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
                'content' => $request->content ?? '',
                'image'   => $request->image,
                'status'  => $request->status ?? 1,
                'user_id' => auth()->id() ?? 1
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

    public function update(PostRequest $request, string $id)
    {
        try {
            $post = Post::find($id);

            if (!$post) {
                return redirect()
                    ->route('admin.posts.index')
                    ->with('error', 'Bài viết không tồn tại');
            }

            $data = [
                'title'   => $request->title,
                'slug'    => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
                'content' => $request->content ?? '',
                'status'  => $request->status ?? 1,
                'image'   => $request->image,
            ];

            $post->update($data);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Cập nhật bài viết thành công');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            if ($post->image && file_exists(public_path('uploads/posts/' . $post->image))) {
                unlink(public_path('uploads/posts/' . $post->image));
            }
            $post->delete();
        }
        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công!');
    }
}