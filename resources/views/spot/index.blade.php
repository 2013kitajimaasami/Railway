<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            鉄道スポット一覧
        </h2>
        <x-validation-errors class="mb-4" :errors="$errors" />
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="mt-4">{{ $user->name }}さん、こんにちは！</p>
        {{-- スポットの一覧表示 --}}
        @foreach ($spots as $spot)
        <div class="mx-4 sm:p-8">
            <div class="mt-4">
                <div
                    class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <div class="flex">
                            <div class="rounded-full w-12 h-12">
                                {{-- アバター表示 --}}
                                <img src="{{ asset('storage/avatar/'.($spot->user->avatar ?? 'user_default.jpg')) }}">
                            </div>
                            <h1
                                class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-4">
                                <a href="{{ route('spot.show', $spot) }}">{{ $spot->title }}</a>
                            </h1>
                        </div>

                        <hr class="w-full">
                        <p class="mt-4 text-gray-600 py-4">
                            <a href="{{ route('spot.show', $spot) }}">{{ Str::limit($spot->body, 100, '...') }}</a>
                        </p>
                        <div class="text-sm font-semibold flex flex-row-reverse">
                            <p>{{ $spot->user->name ?? '削除されたユーザー' }}・{{ $spot->created_at->format('Y年m月d日') }}</p>
                        </div>

                        {{-- コメントバッジ --}}
                        <hr class="w-full mb-2">
                        @if ($spot->comments->count())
                        <span class="badge">
                            コメント{{ $spot->comments->count() }}件
                        </span>
                        @else
                        <span>
                            コメントはまだありません。
                        </span>
                        @endif
                        <a href="{{ route('spot.show', $spot) }}" style="color: white;">
                            <x-primary-button class="float-right">コメントする</x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{ $spots->links() }}
    </div>
</x-app-layout>