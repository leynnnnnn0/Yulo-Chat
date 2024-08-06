<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"
             x-data="{
                newMessages: [],
                authId: {{ Auth::id() }},
                activeUsers: []
             }"
             x-init="
                // Active users
                    Echo.join('room')
                    .here(users => {
                         activeUsers = users
                    })
                    .joining(user => {
                        const isExisting = activeUsers.some(obj => obj.name === user.name);
                        if(!isExisting){
                            activeUsers.push(user);
                        }
                    })
                    .leaving(user => {
                        activeUsers = activeUsers.filter(u => u.id !== user.id)
                    })

                const channel = Echo.private('chat')

                channel.listenForWhisper('send', (event) => {
                    newMessages.push(event);
                    console.log(newMessages);
                })
                const sendMessage = document.getElementById('sendMessage');
                sendMessage.addEventListener('keydown', (e) => {

                     if (e.key === 'Enter') {
                        e.preventDefault();
                        channel.whisper('send', {
                            user_id: {{ Auth::id() }},
                            message: sendMessage.value,
                        })
                        newMessages.push({
                            user_id: {{ Auth::id() }},
                            message: sendMessage.value,
                        });
                        sendMessage.value = '';
                    }
                })
             ">
            <div class="bg-primary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex bg-white/5 h-[700px] text-gray-900 w-full">
                    {{-- Left Section--}}
                    <section class="space-y-5 p-5 h-full w-96 bg-black/30">
                        {{--About User--}}
                        <div class="flex items-center gap-3">
                            <x-profile/>
                            <x-header>{{ Auth::user()->name }}</x-header>
                        </div>
                        {{--Search Bar--}}
                        <div class="flex items-center gap-3">
                            <input type="text" class="h-10 rounded-full bg-white/5 border-none w-full" placeholder="search">
                        </div>
                        {{--Online--}}
                        <div class="h-auto space-y-4">
                            <x-sub-heading>Active Users</x-sub-heading>
                            {{-- Chats --}}
                            <div class="h-auto">
                                <template x-for="user in activeUsers">
                                    <template x-if="user.id != authId">
                                        <x-user-chat><span x-text="user.name"></span></x-user-chat>
                                    </template>
                                </template>
                            </div>
                        </div>
                    </section>
                    {{-- Right Section--}}
                    <section class="flex flex-col flex-1 p-5">
                        {{-- First Section--}}
                        <div class="flex items-center gap-3 border-b border-white/10 p-2">
                            <section>
                                <x-profile/>
                            </section>
                            <section class="flex flex-col flex-1">
                                <x-header>{{ $chatMate->name }}</x-header>
                                <x-span>Active Now</x-span>
                            </section>
                            <section class="flex items-center gap-2">
                                <x-rounded-action icon="fa-regular fa-star"/>
                                <x-rounded-action icon="fa-regular fa-user"/>
                            </section>
                        </div>
                        {{-- Second Section--}}
                        <div class="space-y-4 flex-1 py-5 overflow-y-auto">
                            @foreach($messages as $message)
                                @if($message->user_id !== Auth::id())
                                    <x-left-chat>{{ $message->message }}</x-left-chat>
                                @else
                                    <x-right-chat>{{ $message->message }}</x-right-chat>
                                @endif
                            @endforeach
                                <template x-for="message in newMessages">
                                    <div>
                                        <template x-if="message.user_id == authId">
                                            <x-right-chat><span x-text="message.message"></span></x-right-chat>
                                        </template>
                                        <template x-if="message.user_id != authId">
                                            <x-left-chat><span x-text="message.message"></span></x-left-chat>
                                        </template>
                                    </div>
                                </template>

                        </div>
                        {{-- Third Section--}}
                        <form id="messageForm" class="h-auto">
                            <input id="sendMessage" name="message" type="text" class="h-14 rounded-lg text-white bg-white/5 w-full border-none" placeholder="Type a message">
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
