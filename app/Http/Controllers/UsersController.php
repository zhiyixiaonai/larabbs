<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    /**
     * 提供身份验证（Auth）中间件来过滤未登录用户
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

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
        // 用于快速授权一个指定的行为
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * 更新方法
     *
     * @param UserRequest        $request  表单请求
     * @param User               $user     用户对象
     * @param ImageUploadHandler $uploader 图片上传核心工具类
     */
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        // 用于快速授权一个指定的行为
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);

        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
