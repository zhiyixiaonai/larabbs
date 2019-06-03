<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * 显示方法
     *
     * @param User $user 用户对象
     *
     * @return Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 编辑方法
     *
     * @param User $user 用户对象
     *
     * @return Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * 更新方法
     *
     * @param UserRequest $request 表单请求
     * @param User        $user    用户对象
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
