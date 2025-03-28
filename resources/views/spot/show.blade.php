<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スポットの詳細
        </h2>
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <div class="px-10 mt-4">

                <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <h1 class="text-lg text-gray-700 font-semibold">
                            {{ $spot->title }}
                        </h1>
                        <hr class="w-full">
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