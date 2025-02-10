<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="chat-container"
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-15 overflow-y-auto h-[calc(100vh-12rem)] scroll-smooth">
    
                <div class="w-full px-5 py-8 grow" id="message-list">

                    @forelse ($messages as $message)
                    @if ($message?->sender->id != $senderId)
                    <div class="grid pb-3">
                        <div class="flex gap-2.5">
                            <img src="https://pagedone.io/asset/uploads/1710412177.png" alt="Sender image"
                                class="w-10 h-11">
                            <div class="grid">
                                <h5 class="text-gray-900 text-sm font-semibold leading-snug pb-1">
                                    {{ $message->sender->name }} </h5>
                                <div class="w-max grid">
                                    <div
                                        class="px-3.5 py-2 bg-gray-100 rounded-3xl rounded-tl-none justify-start items-center gap-3 inline-flex">
                                        <h5 class="text-gray-900 text-sm font-normal leading-snug">
                                            {{ $message->message }}</h5>
                                    </div>
                                    <div class="justify-end items-center inline-flex mb-2.5">
                                        <h6 class="text-gray-500 text-xs font-normal leading-4 py-1">
                                            <strong>{{ $message->formatted_date }}</strong>
                                            {{ $message->created_at->format('h:i A') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex gap-2.5 justify-end pb-3">
                        <div class="">
                            <div class="grid mb-2">
                                <h5 class="text-right text-gray-900 text-sm font-semibold leading-snug pb-1">You</h5>
                                <div class="px-3 py-2 bg-indigo-600 rounded-3xl rounded-tr-none">
                                    <h2 class="text-white text-sm font-normal leading-snug">
                                        {{ $message->message }}
                                    </h2>
                                </div>
                                <div class="justify-start items-center inline-flex">
                                    <h3 class="text-gray-500 text-xs font-normal leading-4 py-1">
                                        <strong>{{ $message->formatted_date }}</strong>
                                        {{ $message->created_at->format('h:i A') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <img src="https://pagedone.io/asset/uploads/1704091591.png" alt="User image" class="w-10 h-11">
                    </div>
                @endif
                    @empty
                        <div>No Messages Yet </div>
                    @endforelse 
                   
                    
                </div>
            </div>
    
            <form wire:submit.prevent="sendMessage" class="w-full px-3 py-2 border-t border-gray-200 bg-white sticky bottom-0">
                <div class="w-full pl-3 pr-1 py-1 rounded-3xl border border-gray-200 items-center gap-2 flex justify-between">
                    <input autocomplete="off" type="text" wire:model="message" 
      
                    {{-- wire:keydown="userTyping" --}}
                        class="grow shrink basis-0 text-black text-xs font-medium rounded leading-4 focus:outline-none"
                        placeholder="Type here...">
                    <button type="submit" class="text-indigo-600">Send</button>
                </div>
            </form>
        </div>
    </div>

 
    
</div>

@script
<script>
    const container = document.getElementById('chat-container');
            // Scroll on initial load
            window.onload = () => {
         scrollToBottom();
     };
       // Listen for Livewire events
     function scrollToBottom() {
         if (container) {
             container.scrollTo(0, container.scrollHeight);
         }
     }

 </script>

@endscript
