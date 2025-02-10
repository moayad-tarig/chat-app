<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container mx-auto p-8">
                    <h1 class="text-2xl font-bold mb-4">List of Users</h1>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left w-12">#</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left w-32">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($users as $user)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $loop->index + 1 }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a class="relative" wire:navigate href="{{ route('messages.index', $user->id) }}"
                                                class="text-green-600 hover:underline flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6 me-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                                </svg>

                                                {{-- Display unread message count --}}
                                                <span id="unread-count-{{ $user->id }}"
                                                    class="{{ $user->unread_messages_count > 0 ? 'absolute top-0 right-11 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full' : '' }}">
                                                    {{ $user->unread_messages_count > 0 ? $user->unread_messages_count : null }}
                                                </span>
                                            </a>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 text-center text-red-600"
                                            colspan="4">No Users Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="module">
    window.Echo.private('unread-message-channel.{{ auth()->user()->id }}')
        .listen('UnreadMessageEvent', (event) => {
            console.log(event);
            
            // Update unread message count in real-time
            const unreadCountElement = document.getElementById(`unread-count-${event.senderId}`);
            if (unreadCountElement) {
                event.unreadMessageCount == 0 ? unreadCountElement.classList = '' : unreadCountElement.classList =
                    'absolute top-0 right-11 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full';
                unreadCountElement.textContent = event.unreadMessageCount > 0 ? event.unreadMessageCount : '';
            }
            if (event.unreadCount > 0) {
                const audio = new Audio('{{ asset('sounds/notification.mp3') }}');
                audio.play();
            }
        });
</script>




{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            created at
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $user->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <span id="user-{{ $user->id }}"
                                                    class="px-2 py-1 font-semibold 
                                                    {{ $user->unread_messages_count > 0 ? 'absolute top-0 right-11 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full' : '' }}
                                                    leading-5  rounded-full">

                                                </span>
                                                <a href="{{ route('messages.index', $user->id) }}"
                                                    class="font-large text-blue-600 dark:text-blue-500 hover:underline "
                                                    wire:navigate>Message</a>
                                            </td>
                                        </tr>
                                        <span id="unread-count-{{ $user->id }}"
                                            class="{{ $user->unread_messages_count > 0 ? 'absolute top-0 right-11 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full' : '' }}">
                                            {{ $user->unread_messages_count > 0 ? $user->unread_messages_count : null }}
                                        </span>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

    <script type="Module">
        window.Echo.private('unread-message-channel.{{ auth()->user()->id }}').listen('UnreadMessageEvent', (e) => {
                    const span = document.getElementById('user-' + e.senderId);
                    console.log(e);
                    
                         span.textContent = e.unreadMessageCount > 0 ? e.unreadMessageCount : ''; 
            });
            </script>

</x-app-layout> --}}
