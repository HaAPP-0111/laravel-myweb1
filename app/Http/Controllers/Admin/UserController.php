<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        // $request->validate([
        //     'username' => 'required|max:255|unique:users,username',
        //     'fullname' => 'required|max:255',
        //     'email'    => 'required|email|unique:users,email',
        //     'password' => 'required|min:6',
        //     'phone'    => 'required',
        // ]);

        DB::table('users')->insert([
            'username'   => $request->username,
            'fullname'   => $request->fullname,
            'email'      => $request->email,
            'password'   => md5($request->password),
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Thực hiện xóa tài khoản dựa trên ID
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa thành viên thành công!');
    }
}