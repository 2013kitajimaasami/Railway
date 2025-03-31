<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スポットの詳細
        </h2>
        <x-validation-errors class="mb-4" :errors="$errors" />
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <div class="px-10 mt-4">
                <div
                    class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <div class="flex">
                            <div class="rounded-full w-12 h-12">
                                {{-- アバター表示 --}}
                                <img src="{{ asset('storage/avatar/'.($spot->user->avatar ?? 'user_default.jpg' ))}}">
                            </div>
                            <h1 class="text-lg text-gray-700 font-semibold float-left pt-4">
                                {{ $spot->title }}
                            </h1>
                        </div>


                        <hr class="w-full">
                        <div class="flex justify-end mt-4">
                            {{-- 投稿者のみ編集ボタンを表示 --}}
                            @can('update', $spot)
                            <a href="{{route('spot.edit', $spot)}}">
                                <x-primary-button class="bg-teal-700 float-right">編集</x-primary-button>
                            </a>
                            @endcan
                            {{-- 投稿者と管理者のみ削除ボタンを表示 --}}
                            @can('delete', $spot)
                            <form method="post" action="{{ route('spot.destroy', $spot) }}">
                                @csrf
                                @method('delete')
                                <x-primary-button class="bg-red-700 float-right ml-4"
                                    onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                            </form>
                            @endcan
                        </div>

                        <div>
                            <p class="text-gray-600 py-4 whitespace-pre-line">住所：{{ $spot->address }}</p>
                            @if ($spot->line)
                            <p class="text-gray-600 py-4 whitespace-pre-line">路線名：{{ $spot->line }}</p>
                            @endif
                            @if ($spot->toilet)
                            <p class="text-gray-600 py-4 whitespace-pre-line">トイレ情報：{{ $spot->toilet }}</p>
                            @endif
                            @if ($spot->parking)
                            <p class="text-gray-600 py-4 whitespace-pre-line">駐車場情報：{{ $spot->parking }}</p>
                            @endif
                            <p class="mt-2 text-gray-600 py-4">おすすめポイント</p>
                            <p class="text-gray-600 py-4 whitespace-pre-line">{{ $spot->body }}</p>
                            @if($spot->image)
                            <img src="{{ asset('storage/images/'.$spot->image) }}" class="mx-auto"
                                style="height:300px;">
                            @endif
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p> {{ $spot->user->nam ?? '削除されたユーザー' }} • {{ $spot->created_at->format('Y年m月d日') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- コメントの作成と表示 --}}
                    <div class="mt-4 mb-12">
                        <form method="post" action="{{route('comment.store')}}">
                            @csrf
                            <input type="hidden" name='spot_id' value="{{ $spot->id }}">
                            <textarea name="body"
                                class="bg-white w-full  rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500"
                                id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{ old('body') }}</textarea>
                            <x-primary-button class="float-right mr-4 mb-12">コメントする</x-primary-button>
                        </form>
                    </div>
                    @foreach ($spot->comments as $comment)
                    <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg mt-8 whitespace-pre-line">
                        {{$comment->body}}
                        <div class="text-sm font-semibold flex flex-row-reverse">
                            <p class="float-left pt-4"> {{ $comment->user->name ?? '削除されたユーザー' }} •
                                {{$comment->created_at->diffForHumans()}}</p>
                            {{-- アバター追加 --}}
                            <span class="rounded-full w-12 h-12">
                                <img src="{{ asset('storage/avatar/'.($comment->user->avatar ?? 'user_default.jpg')) }}">
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>