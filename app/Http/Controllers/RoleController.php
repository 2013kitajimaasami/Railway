<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function attach(Request $request, User $user) {
        $roleId = request()->input('role');
        // ユーザーのroleに、$roleIdを紐づける
        $user->roles()->attach($roleId);
        return back();
    }

    public function detach(Request $request, User $user) {
        $roleId = request()->input('role');
        // ユーザーのroleから、$roleIdを削除する
        $user->roles()->detach($roleId);
        return back();
    }
}
