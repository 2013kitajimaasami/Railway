<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // アバター画像の保存
        if ($request->validated('avatar')) {
            // 古いアバター削除用コード
            $user = auth()->user();
            if ($user->avatar !== 'user_default.jpg') {
                $oldavatar = 'avatar/' . $user->avatar;
                Storage::disk('public')->delete($oldavatar);
            }
            $name = request()->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His') . '_' . $name;
            request()->file('avatar')->storeAs('avatar', $avatar, 'public');
            $request->user()->avatar = $avatar;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // アバターとロールの削除を追加
        if($user->avatar !== 'user_default.jpg'){
            $oldavatar = 'avatar/'.$user->avatar;
            Storage::disk('public')->delete($oldavatar);
        }
        $user->roles()->detach();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    // 管理者用
    public function index()
    {
        $users = User::all();

        return view('profile.index', compact('users'));
    }
    
    public function adminedit(User $user) {
        // 管理者が profile.edit ファイルを開いた時は、$admin変数（フラグ）が受け渡されるようにする
        $admin = true;

        // 役割付与のためRoleのデータを$rolesに代入して、ビュー画面に受け渡す
        $roles = Role::all();

        return view('profile.edit', [
            'user' => $user,
            'admin' => $admin,
            'roles' => $roles,
        ]);
    }

    public function adminupdate(User $user, Request $request) {
        $inputs = $request->validate([
            'name' => ['string', 'max:255'],
            // ユーザー自身のアドレス変更 (isDirty('email')) は認証メールが送信されるが、管理者が変更した場合は送信されないようになっている
            // Rule::unique で、ユーザーのメールアドレスを重複バリデーションから除く
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user)],
            'avatar' => ['image', 'max:1024'],
        ]);

        // アバター画像の保存
        if (request()->hasFile('avatar')) {
            // 古いアバター削除用コード
            if ($user->avatar !== 'user_default.jpg') {
                $oldavatar = 'avatar/' . $user->avatar;
                Storage::disk('public')->delete($oldavatar);
            }
            $name = request()->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His') . '_' . $name;
            request()->file('avatar')->storeAs('avatar', $avatar, 'public');
            $user->avatar = $avatar;
        }

        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->save();

        return Redirect::route('profile.adminedit', compact('user'))->with('status', 'profile-updated');
    }

    public function admindestroy(User $user) {
        if ($user->avatar !== 'user_default.jpg') {
            $oldavatar = 'avatar/'.$user->avatar;
            Storage::disk('public')->delete($oldavatar);
        }

        // ユーザーの役割も忘れずに削除する
        $user->roles()->detach();
        $user->delete();

        return back()->with('message', 'ユーザーを削除しました');
    }
}
