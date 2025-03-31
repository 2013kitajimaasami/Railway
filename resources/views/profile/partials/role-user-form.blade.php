<div class="mt-5">
    <h4 class="text-lg font-medium text-gray-900">役割付与・削除（アドミンユーザーにのみ表示）</h4>
    <table class="text-left w-full border-collapse mt-8">
        <tr class="bg-green-600 text-center">
            <th>役割</th>
            <th>付与</th>
            <th>削除</th>
        </tr>
        @foreach ($roles as $role)
        <tr class="bg-white text-center">
            <td class="p-3">
                {{ $role->name }}
            </td>
            <td class="p-3">

                <form method="post" action="{{ route('role.attach', $user) }}">
                    @csrf
                    @method('patch')
                    {{-- hiddenで、画面にinputタグを表示させずにデータをコントローラーに受け渡す --}}
                    <input type="hidden" name="role" value="{{ $role->id }}">
                    {{-- もしユーザーが$roleを持っていれば、ボタンの背景をグレーにし、disabled（無効）とする --}}
                    <button class="btnroleattach @if($user->roles->contains($role))
                        bg-gray-300
                        @endif
                        "
                        @if($user->roles->contains($role))
                        disabled
                        @endif>
                        役割付与
                    </button>
                </form>
            </td>
            <td class="p-3">
                <form method="post" action="{{ route('role.detach', $user) }}">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="role" value="{{ $role->id }}">
                    {{-- もしユーザーが$roleを持っていなければ、ボタンの背景をグレーにし、disabled（無効）とする --}}
                    <button class="btnroledetach @if(!$user->roles->contains($role))
                        bg-gray-300
                        @endif
                        "
                        @if(!$user->roles->contains($role))
                        disabled
                        @endif>
                        役割削除
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>