<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'avatar' => ['image', 'max:1024'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // userテーブルのデータ
        $attr = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        // リクエスト内容にavatarがあれば、avatarの保存処理を追加
        if (request()->hasFile('avatar')) {
            $name = request()->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His'). '_' . $name;
            // storeAsメソッドでアップロードされたアバターのファイルを保存する
            // storeAs(保存先フォルダ, ファイル名, ディスク名)
            request()->file('avatar')->storeAs('avatar', $avatar, 'public');
            // User::createするための$user配列に avatarファイル名を追加する
            $attr['avatar'] = $avatar;
        }

        $user = User::create($attr);

        event(new Registered($user));

        // 新規登録時に自動的に役割(2:user)を付与する
        // attachメソッドで新たに紐づけの登録を行うことができる(逆はdetach)
        $user->roles()->attach(2);

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
