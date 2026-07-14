<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // Đổi kết thúc từ ->get() thành ->paginate($limit) để xử lý dứt điểm lỗi currentPage
        $list = DB::table('users')
            ->select('id', 'fullname', 'username', 'email', 'gender', 'role', 'status')
            ->orderBy('username', 'asc')
            ->paginate($limit); // BẮT BUỘC dùng paginate

        return view('admin.users.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        DB::table('users')->insert([
            'username'   => $request->username,
            'fullname'   => $request->fullname,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'phone'      => $request->phone,
            'gender'     => $request->gender ?? 1,
            'role'       => $request->role ?? 0,
            'status'     => $request->status ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Thêm thành viên thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'Thành viên không tồn tại!');
        }
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = [
            'username'   => $request->username,
            'fullname'   => $request->fullname,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'gender'     => $request->gender ?? 1,
            'role'       => $request->role ?? 0,
            'status'     => $request->status ?? 1,
            'updated_at' => now(),
        ];

        // Cập nhật mật khẩu nếu người dùng có nhập mật khẩu mới
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành viên thành công!');
    }

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()
                ->route('admin.users.index')
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
        $list = User::onlyTrashed()
            ->orderBy('username')
            ->paginate($limit);

        return view('admin.users.trash', compact('list'));
    }

    public function restore(string $id)
    {
        try {
            User::onlyTrashed()->findOrFail($id)->restore();
            return redirect()
                ->route('admin.users.trash')
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
            User::onlyTrashed()->findOrFail($id)->forceDelete();
            return redirect()
                ->route('admin.users.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }
}