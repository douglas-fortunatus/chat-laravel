@extends('layouts.app')

@section('conversation')

    {{-- conversation header --}}
    <div class="flex-3">
        {{-- <h2 class="text-xl py-1 mb-8 border-b-2 border-gray-200"> <b>{{ $friendInfo->name }}</b></h2> --}}
    </div>
    {{-- !conversation header --}}

    {{-- messages --}}
    <div class="messages flex-1 overflow-auto">

        <div class="message mb-4 flex">
            <div class="flex-2">
                <div class="w-12 h-12 relative">
                    <div class="w-11 h-11 text-white rounded-full font-bold p-[10px] inline-block bg-blue-700">UR</div>
                    {{-- <span class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span> --}}
                </div>
            </div>
            <div class="flex-1 px-2">
                <div class="inline-block bg-gray-300 rounded-full p-2 px-6 text-gray-700">
                    <span>Hey there. We would like to invite you over to our office for a visit. How about it?</span>
                </div>
                <div class="pl-4"><small class="text-gray-500">15 April</small></div>
            </div>
        </div>

        {{-- <div class="message mb-4 flex">
            <div class="flex-2">
                <div class="w-12 h-12 relative">
                    <div class="w-11 h-11 text-white rounded-full font-bold p-[10px] inline-block bg-blue-700">UR</div>
                </div>
            </div>
            <div class="flex-1 px-2">
                <div class="inline-block bg-gray-300 rounded-full p-2 px-6 text-gray-700">
                    <span>All travel expenses are covered by us of course :D</span>
                </div>
                <div class="pl-4"><small class="text-gray-500">15 April</small></div>
            </div>
        </div> --}}

        {{-- you --}}
        <div class="message me mb-4 flex text-right">
            <div class="flex-1 px-2">
                <div class="inline-block bg-blue-600 rounded-full p-2 px-6 text-white">
                    <span>It's like a dream come true</span>
                </div>
                <div class="pr-4"><small class="text-gray-500">15 April</small></div>
            </div>
        </div>

        {{-- <div class="message me mb-4 flex text-right">
            <div class="flex-1 px-2">
                <div class="inline-block bg-blue-600 rounded-full p-2 px-6 text-white">
                    <span>I accept. Thank you very much.</span>
                </div>
                <div class="pr-4"><small class="text-gray-500">15 April</small></div>
            </div>
        </div> --}}
        {{--  --}}

        {{-- <div class="message mb-4 flex">
            <div class="flex-2">
                <div class="w-12 h-12 relative">
                    <div class="w-11 h-11 text-white rounded-full font-bold p-[10px] inline-block bg-blue-700">UR</div>
                    <span class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                </div>
            </div>
            <div class="flex-1 px-2">
                <div class="inline-block bg-gray-300 rounded-full p-2 px-6 text-gray-700">
                    <span>You are welome. We will stay in touch.</span>
                </div>
                <div class="pl-4"><small class="text-gray-500">15 April</small></div>
            </div>
        </div> --}}
    </div>
    {{-- !end messages --}}

    {{-- Sending messages --}}
    <form action="" id="sendForm">
        <input type="hidden" name="receiver_id" value="{{ $friendInfo->id }}">
        <div class="flex-2 pt-4 pb-10">
            <div class="write bg-white shadow flex rounded-lg">
                <div class="flex-3 flex content-center items-center text-center p-4 pr-0">
                    <span class="block text-center text-gray-400 hover:text-gray-800">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" class="h-6 w-6"><path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                </div>
                <div class="flex-1">
                    <textarea name="message" class="w-full block outline-none py-4 px-4 bg-transparent" id="messageInput" rows="1" placeholder="Type a message..." autofocus></textarea>
                </div>
                <div class="flex-2 w-32 p-2 flex content-center items-center">
                    <div class="flex-1 text-center">
                        <span class="text-gray-400 hover:text-gray-800">
                            <span class="inline-block align-text-bottom">
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            </span>
                        </span>
                    </div>
                    <div class="flex-1">
                        <button class="bg-blue-400 w-10 h-10 rounded-full inline-block">
                            <span class="inline-block align-text-bottom">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4 text-white"><path d="M5 13l4 4L19 7"></path></svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- !send message --}}
@endsection

@push('footer-script')
    <script>
        $(function(){

            let messageInput = $('#messageInput');

            let user_id = "{{ auth()->user()->id }}";
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);
            let friendId = "{{ $friendInfo->id }}";

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

            messageInput.keypress(function (e) {
                let message = messageInput.val();

                if(e.which === 13 && !e.shiftKey){
                    messageInput.val('');
                    sendMessage(message);
                }
            });

            function sendMessage(message) {
                let friendId = "{{ $friendInfo->id }}";

                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: "{{ route('message.send') }}",
                    type: "POST",
                    // data: $(this).serialize(),
                    data : {
                        message : message,
                        receiver_id : friendId
                    },
                    success: function (response) {
                        // Basic initialization
                        console.log(response);

                        if(response.success) {

                        }
                    }
                });
            }

            function appendMessages() {
                let name = "{{ $myInfo->name }}";

                let smsDump = '';
            }


            socket.on("private-channel:App\\Events\\PrivateMessageEvent", (message)=>{ console.log('new message'); });
        });
    </script>






{{-- <script type="text/javascript">
    $("#sendForm").submit(function(e) {

        e.preventDefault();

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{ route('message.send') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                // Basic initialization
                console.log(response);

                if(response.success) {

                }
            }
        });
    });
</script> --}}

    <script type="text/javascript">
        $(function () {
            console.log('Messages');

            let id =  "{{ $friendInfo->id }}";

            let url = '{{ route("sms.fetch", ':id') }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    console.log(data)

                    var dataArray = [];

                    data.forEach((resp) => {
                        console.log(resp);
                    })

                    // data.each(function(item, key) {
                    //     // var object = {
                    //     //     id: item.id,
                    //     //     name: item.name,
                    //     // };

                    //     // dataArray.push(object);
                    // });



                    // console.log(JSON.parse(response) );

                    let messages = $('.message').html('');


                    // for (let index = 0; index < array.length; index++) {
                    //     const element = array[index];

                    // }

                    // console.log(response[0]);

                    // for (const key in response) {
                    //     if (response.hasOwnProperty(key)) {
                    //         console.log(`${key}: ${response[key]}`);
                    //     }
                    // }


                }
            });

        });



        // $("#sendForm").submit(function(e) {

        //     e.preventDefault();

        //     $.ajax({
        //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        //         url: "{{ route('message.send') }}",
        //         type: "POST",
        //         data: $(this).serialize(),
        //         success: function (response) {
        //             // Basic initialization
        //             console.log(response);

        //             if(response.success) {

        //             }
        //         }
        //     });
        // });
    </script>
@endpush
