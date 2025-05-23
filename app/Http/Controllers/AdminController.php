<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // 'auth' と 'is_admin' ミドルウェアを適用
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    
    //管理者一覧を表示
    public function index(Request $request)
    {
        $admins = User::where('is_admin', true)->paginate(10);
        return view('admin.index', compact('admins'));
    }

    // 管理者作成フォーム
    public function create()
    {
        return view('admin.create');
    }

    // 管理者を新規作成
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['is_admin'] = true;

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.index')->with('success', '管理者が作成されました。');
    }

    // 管理者編集フォーム
    public function edit(User $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    // 管理者情報の更新
    public function update(Request $request, User $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        $admin->update($validated);

        return redirect()->route('admin.index')->with('success', '管理者情報が更新されました。');
    }

    // 管理者削除
    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')->with('success', '管理者が削除されました。');
    }
}
