<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Thực hiện xóa tài khoản dựa trên ID
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa thành viên thành công!');
    }
}