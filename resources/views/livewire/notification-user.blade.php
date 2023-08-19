<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button wire:click="makeRead" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
            <i class="fas fa-bell"></i> <!-- Bell icon -->
            <span class="badge badge-pill badge-danger">{{ $notificationsCount }}</span>
        </button>
    </x-slot>
    @if (Auth::user()->unreadNotifications)
    <x-slot name="content">
        <x-dropdown-link :href="route('friendships.index')">
               @foreach ($notifications as $notification)
                @php
                $friendSender = \App\Models\User::findOrFail($notification->data['notification']['sender_id']);
                @endphp
                <div class="d-flex align-items-start">
                <img src="{{ $friendSender->avatar }}" alt="Profile Picture" class="mr-2 rounded-circle" width="40" height="40">
                <div>
                    <p>{{ $friendSender->name }} sent you a request</p>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </div>  
            </div>       
             @endforeach
        </x-dropdown-link>
    @endif

</x-slot>
</x-dropdown>

{{--  <span class="badge badge-pill badge-danger">{{ $notificationsCount }}</span>
 --}}

 
