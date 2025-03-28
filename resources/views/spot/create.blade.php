<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スポットの新規作成
        </h2>
        @if (@session('message'))
            {{ session('message') }}
        @endif
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <form method="POST" action="{{ route('spot.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label for="title" class="font-semibold leading-none mt-4">スポット名</label>
                        <input type="text" name="title"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title"
                            placeholder="Enter Title">
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <label for="body" class="font-semibold leading-none mt-4">おすすめポイント</label>
                    <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30"
                        rows="10"></textarea>
                </div>

                <div class="w-full flex flex-col">
                    <label for="address" class="font-semibold leading-none mt-4">住所</label>
                    <input type="text" name="address"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="address"
                            placeholder="Enter Title">
                </div>

                <div class="w-full flex flex-col">
                    <label for="line" class="font-semibold leading-none mt-4">路線名</label>
                    <input type="text" name="line"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="line"
                            placeholder="Enter Title">
                </div>

                <div class="w-full flex flex-col">
                    <label for="toilet" class="font-semibold leading-none mt-4">トイレ情報</label>
                    <input type="text" name="toilet"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="toilet"
                            placeholder="Enter Title">
                </div>
                
                <div class="w-full flex flex-col">
                    <label for="parking" class="font-semibold leading-none mt-4">駐車場情報</label>
                    <input type="text" name="parking"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="parking"
                            placeholder="Enter Title">
                </div>

                <div class="w-full flex flex-col">
                    <label for="image" class="font-semibold leading-none mt-4">画像 </label>
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