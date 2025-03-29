<x-guest-layout>
    <div class="h-screen pb-14 bg-right bg-cover">
        <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center bg-yellow-50">
            <!--左側-->
            <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
                <h1 class="my-4 text-3xl md:text-4xl text-green-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">小鉄のためのご近所鉄道スポット</h1>
                <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                    鉄道が大好きなお子さんを気軽に連れていける、鉄道が見えるスポットを共有しましょう
                </p>
            
                <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">
                    登録すると、スポットの投稿やコメントができます♪
                </p>
                <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in ">
                    @guest
                    <a href="{{ route('login') }}"><button class="btnsetgrey">ログイン</button></a>
                    <a href="{{ route('register') }}"><button class="btnsetred">ご登録はこちら</button></a>
                    @endguest
                </div>
            </div>
            {{-- 右側 --}}
            <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
                <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{asset('logo/toritetsu.png')}}">
            </div>
        </div>
        <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <div class="w-full text-sm text-center md:text-left fade-in border-2 p-4 text-red-800 leading-8 mb-8">
                <P>index表示させる？</p>
            </div>
            <!--フッタ-->
            <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
            </div>
        </div>
    </div>
</x-guest-layout>