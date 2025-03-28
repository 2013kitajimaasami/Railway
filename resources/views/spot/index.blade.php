<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            鉄道スポット一覧
        </h2>

        {{-- <x-message :message="session('message')" /> --}}

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ $user->name }}さん、こんにちは！
        @foreach ($spots as $spot)
            <div class="mx-4 sm:p-8">
                <div class="mt-4">
                    <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">
                            <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">{{ $spot->title }}</h1>
                            <hr class="w-full">
                            <p class="mt-4 text-gray-600 py-4">{{ $spot->body }}</p>
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p>{{ $spot->user->name }}・{{ $spot->created_at->format('Y年m月d日') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>