<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
=======
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
<<<<<<< HEAD
    public function index($limit = 10)
    {
        // Đổi kết thúc từ ->get() thành ->paginate($limit) để xử lý dứt điểm lỗi currentPage
        $list = DB::table('users')
            ->select('id', 'fullname', 'username', 'email', 'gender', 'role', 'status')
            ->orderBy('username', 'asc')
            ->paginate($limit); // BẮT BUỘC dùng paginate
=======
    public function index()
    {
        $list = DB::table('users')
            ->select('id', 'name', 'email', 'image')
            ->orderBy('name')
            ->get();
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474

        return view('admin.users.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        return view('admin.users.create');
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
        // Thực hiện xóa tài khoản dựa trên ID
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa thành viên thành công!');
    }
}
=======
        //
    }
}
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
