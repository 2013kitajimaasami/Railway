<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スポットの新規作成
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
            <form method="POST" action="{{ route('spot.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label for="title" class="font-semibold leading-none mt-4">スポット名</label>
                        <input type="text" name="title"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{ old('title') }}" placeholder="必須項目：名称やおおまかな場所名を入力してください。">
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <label for="address" class="font-semibold leading-none mt-4">住所</label>
                    <input type="text" name="address"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="address" value="{{ old('address') }}" placeholder="必須項目：わかる範囲まで入力してください。">
                </div>

                <div class="w-full flex flex-col">
                    <label for="line" class="font-semibold leading-none mt-4">路線名</label>
                    <input type="text" name="line"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="line" value="{{ old('line') }}" placeholder="例）山手線、小田急線、大阪環状線…など">
                </div>

                <div class="w-full flex flex-col">
                    <label for="toilet" class="font-semibold leading-none mt-4">トイレ情報</label>
                    <input type="text" name="toilet"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="toilet" value="{{ old('toilet') }}" placeholder="例）公園内に公共トイレ、ベビーキープ付きトイレ有…など">
                </div>
                
                <div class="w-full flex flex-col">
                    <label for="parking" class="font-semibold leading-none mt-4">駐車場情報</label>
                    <input type="text" name="parking"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="parking" value="{{ old('parking') }}" placeholder="例）公園内に無料駐車場有…など">
                </div>

                <div class="w-full flex flex-col">
                    <label for="body" class="font-semibold leading-none mt-4">おすすめポイント</label>
                    <textarea name="body" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10" placeholder="必須項目：スポットの雰囲気や観測できる車両などご記入ください。">{{ old('body') }}</textarea>
                </div>

                <div class="w-full flex flex-col">
                    <label for="image" class="font-semibold leading-none mt-4">画像 (1MBまで)</label>
                    <div>
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <x-primary-button class="mt-4">
                    送信する
                </x-primary-button>

            </form>
        </div>
    </div>
</x-app-layout>