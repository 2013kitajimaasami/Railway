<x-guest-layout>
	<section class="p-6 dark:bg-gray-100 dark:text-gray-800">
		<div class="container grid gap-6 mx-auto text-center lg:grid-cols-2 xl:grid-cols-5">
			<div class="w-full px-6 py-16 rounded-md sm:px-12 md:px-16 xl:col-span-2 dark:bg-gray-50">
				<h2 class="text-4xl font-extrabold dark:text-gray-900">小鉄のための<br>ご近所鉄道スポット</h2>
				<p class="my-8">
					<span class="font-medium dark:text-gray-900">鉄道が大好きなお子さん</span>を気軽に連れていける、鉄道が見えるスポットを共有しましょう！
				</p>
				<p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">
					登録すると、スポットの投稿やコメントができます♪
				</p>
				<div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in ">
					@guest
					<a href="{{ route('login') }}"><button class="btnsetgrey">ログイン</button></a>
					<form method="POST" action="{{ route('guestlogin') }}">
						@csrf
						<button class="btnsetgrey">ゲストログイン</button>
					</form>
					<a href="{{ route('register') }}"><button class="btnsetred">ご登録はこちら</button></a>
					@endguest
				</div>
			</div>
			<img src="{{asset('logo/toritetsu.png')}}" alt=""
				class="object-cover w-full rounded-md xl:col-span-3 dark:bg-gray-500">
		</div>
	</section>

	@if (!empty($spots) && count($spots) > 3)
	<section class="py-6 dark:bg-gray-100">
		<div class="container flex flex-col justify-center p-4 mx-auto">
			<div class="grid grid-cols-1 gap-4 lg:grid-cols-4 sm:grid-cols-2">
				@foreach($spots as $spot)
				<img class="object-cover w-full dark:bg-gray-500 aspect-square"
					src="{{ asset('storage/images/'.$spot->image) }}">
				@endforeach
			</div>
		</div>
	</section>
	@endif
	
</x-guest-layout>