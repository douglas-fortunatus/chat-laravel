<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <div class="w-full h-screen bg-white">
                <div class="flex h-full">
                    <div class="flex-1 bg-white w-full h-full">
                        <div class="main-body container m-auto w-11/12 h-full flex flex-col">
                            <div class="py-4 flex-2 flex flex-row bg-slate-200 mt-2">
                                <div class="flex-1">
                                    <span class="xl:hidden inline-block text-gray-700 hover:text-gray-900 align-bottom">
                                        <span class="block h-6 w-6 p-1 rounded-full hover:bg-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                        </span>
                                    </span>
                                    <span class="lg:hidden inline-block ml-8 text-gray-700 hover:text-gray-900 align-bottom">
                                        <span class="block h-6 w-6 p-1 rounded-full hover:bg-gray-400">
                                            <svg class="h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </span>
                                    </span>
                                </div>
                                <div class="flex-1 text-right">
                                    <span class="inline-block text-gray-700">
                                        Status: <span class="inline-block align-text-bottom w-4 h-4 bg-green-400 rounded-full border-2 border-white"></span> <b>Online</b>
                                        <span class="inline-block align-text-bottom">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4"><path d="M19 9l-7 7-7-7"></path></svg>
                                        </span>
                                    </span>

                                    <span class="inline-block ml-8 text-gray-700 hover:text-gray-900 align-bottom">
                                        <span class="block h-6 w-6 p-1 rounded-full hover:bg-gray-400">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="main flex-1 flex flex-col pt-4 bg-slate-100">
                                <div class="flex-1 flex h-full">
                                    <div class="sidebar hidden lg:flex w-1/3 flex-2 flex-col pr-6">
                                        <div class="search flex-2 pb-6 px-2">
                                            <input type="text" class="outline-none py-2 block w-full border-gray-400 bg-white" placeholder="Search">
                                        </div>

                                        <div class="flex-1 h-full overflow-auto px-2">

                                            @if ($users->count())
                                                @foreach ($users as $user)
                                                <a href="{{ route('message.conversation', $user->id) }}">
                                                    <div class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md
                                                    {{-- @if ($user->id == $friendInfo->id) border-l-4 border-red-500 @endif  --}}
                                                    ">
                                                        <div class="flex-2">
                                                            <div class="w-12 h-12 relative">
                                                                <div class="w-11 h-11 text-white rounded-full font-bold p-[10px] inline-block bg-blue-700">UR</div>
                                                                <span class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white user-status-icon user-icon-{{ $user->id }}"></span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 px-2">
                                                            <div class="truncate w-32"><span class="text-gray-800 font-bold">{{ $user->name }}</span></div>
                                                            <div><small class="text-gray-600">Yea, Sure!</small></div>
                                                        </div>
                                                        <div class="flex-2 text-right">
                                                            <div><small class="text-gray-500">15 April</small></div>
                                                            <div>
                                                                <small class="text-xs bg-red-500 text-white rounded-full h-6 w-6 leading-6 text-center inline-block">
                                                                    23
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                                @endforeach
                                            @endif
                                        </div>
                                    </div>


                                    <div class="chat-area flex-1 flex flex-col">
                                        @yield('conversation')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- jquary cdn --}}
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

        {{-- socket cdn --}}
        <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>

        <script>
            $(function(){
                let user_id = "{{ auth()->user()->id }}";
                let ip_address = '127.0.0.1';
                let socket_port = '3000';
                let socket = io(ip_address + ':' + socket_port);

                socket.emit('user_connected', user_id);

                socket.on('updateUserStatus', (data)=>{

                    let statusOffline = $('.user-status-icon');
                    statusOffline.removeClass('bg-green-500');
                    statusOffline.addClass('bg-gray-400');

                    $.each(data, function (key, val) {
                        if (val !== null && val !== 0) {
                            let statusOnline = $('.user-icon-'+key)
                            statusOnline.removeClass('bg-gray-400')
                            statusOnline.addClass('bg-green-500')
                        }
                    })
                });
            })
        </script>
    </body>
</html>
