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
                <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">
                            <a href="{{route('spot.show', $spot)}}">{{ $spot->title }}</a>
                        </h1>
                        <hr class="w-full">
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{route('spot.edit', $spot)}}">
                            <x-primary-button class="bg-teal-700 float-right">編集</x-primary-button>
                        </a>
                        <form method="post" action="{{route('spot.destroy', $spot)}}">
                            @csrf
                            @method('delete')
                            <x-primary-button class="bg-red-700 float-right ml-4"
                                onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                        </form>
                    </div>

                    <div>
                        <p class="text-gray-600 py-4 whitespace-pre-line">住所：{{$spot->address}}</p>
                        @if ($spot->line)
                        <p class="text-gray-600 py-4 whitespace-pre-line">路線名：{{$spot->line}}</p>
                        @endif
                        @if ($spot->toilet)
                        <p class="text-gray-600 py-4 whitespace-pre-line">トイレ情報：{{$spot->toilet}}</p>
                        @endif
                        @if ($spot->parking)
                        <p class="text-gray-600 py-4 whitespace-pre-line">駐車場情報：{{$spot->parking}}</p>
                        @endif
                        <p class="mt-2 text-gray-600 py-4">おすすめポイント</p>
                        <p class="text-gray-600 py-4 whitespace-pre-line">{{$spot->body}}</p>
                        @if($spot->image)
                        <img src="{{ asset('storage/images/'.$spot->image)}}" class="mx-auto" style="height:300px;">
                        @endif
                        <div class="text-sm font-semibold flex flex-row-reverse">
                            <p> {{ $spot->user->name }} • {{$spot->created_at->format('Y年m月d日')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>