<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex bg-white/5 h-[700px] text-gray-900 w-full">
                    {{-- Left Section--}}
                    <section class="space-y-5 p-5 h-full w-96 bg-black/30">
                        {{--About User--}}
                        <div class="flex items-center gap-3">
                            <x-profile/>
                            <x-header>John Doe</x-header>
                        </div>
                        {{--Search Bar--}}
                        <div class="flex items-center gap-3">
                            <input type="text" class="h-10 rounded-full bg-white/5 border-none w-full" placeholder="search">
                        </div>
                        {{--Online--}}
                        <div class="h-auto space-y-4">
                            <x-sub-heading>All Users</x-sub-heading>
                            {{-- Chats --}}
                            <div class="h-auto">
                                <x-user-chat/>
                                <x-user-chat/>
                                <x-user-chat/>
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
                                <x-header>Jashreil Alm</x-header>
                                <x-span>Active Now</x-span>
                            </section>
                            <section class="flex items-center gap-2">
                                <x-rounded-action icon="fa-regular fa-star"/>
                                <x-rounded-action icon="fa-regular fa-user"/>
                            </section>
                        </div>
                        {{-- Second Section--}}
                        <div class="space-y-4 flex-1 py-5">
                            <x-right-chat/>
                            <x-left-chat/>
                            <x-right-chat/>
                            <x-left-chat/>

                        </div>
                        {{-- Third Section--}}
                        <div class="h-auto">
                            <input type="text" class="h-14 rounded-lg bg-white/5 w-full border-none" placeholder="Type a message">
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
