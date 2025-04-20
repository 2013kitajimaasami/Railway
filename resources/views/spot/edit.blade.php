<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スポットの編集
        </h2>
        <div class="back-btn">
            <a href="#" onclick="history.back()">
                <img src="{{asset('logo/6000.png')}}" style="max-height:40px;">
                <p>戻る</p>
            </a>
        </div>
        <x-validation-errors class="mb-4" :errors="$errors"/>
        <x-message :message="session('message')"/>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <form method="POST" action="{{ route('spot.update', $spot) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label for="title" class="font-semibold leading-none mt-4">スポット名</label>
                        <input type="text" name="title"
                            class="w-auto py-2 border border-gray-300 rounded-md" id="title" value="{{ old('title', $spot->title) }}">
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <label for="address" class="font-semibold leading-none mt-4">住所</label>
                    <input type="text" name="address"
                            class="w-auto py-2 border border-gray-300 rounded-md" id="address" value="{{ old('address', $spot->address) }}">
                </div>

                <div class="w-full flex flex-col">
                    <label for="line" class="font-semibold leading-none mt-4">路線名</label>
                    <input type="text" name="line"
                            class="w-auto py-2 border border-gray-300 rounded-md" id="line" value="{{ old('line', $spot->line) }}">
                </div>

                <div class="w-full flex flex-col">
                    <label for="toilet" class="font-semibold leading-none mt-4">トイレ情報</label>
                    <input type="text" name="toilet"
                            class="w-auto py-2 border border-gray-300 rounded-md" id="toilet" value="{{ old('toilet', $spot->toilet) }}">
                </div>
                
                <div class="w-full flex flex-col">
                    <label for="parking" class="font-semibold leading-none mt-4">駐車場情報</label>
                    <input type="text" name="parking"
                            class="w-auto py-2 border border-gray-300 rounded-md" id="parking" value="{{ old('parking', $spot->parking) }}">
                </div>

                <div class="w-full flex flex-col">
                    <label for="body" class="font-semibold leading-none mt-4">おすすめポイント</label>
                    <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{ old('body', $spot->body) }}</textarea>
                </div>

                <div class="w-full flex flex-col">
                    @if($spot->image)
                        <div>
                            (画像ファイル：{{$spot->image}})
                        </div>
                        <img src="{{ asset('storage/images/'.$spot->image)}}" class="mx-auto" style="height:300px;">
                    @endif
                    <label for="image" class="font-semibold leading-none mt-4">画像 (1MBまで)</label>
                    <div>
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <x-primary-button class="mt-4">
                    編集内容を送信する
                </x-primary-button>

            </form>
        </div>
    </div>
</x-app-layout>