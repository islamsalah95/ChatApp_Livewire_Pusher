<div class="card-body contacts_body">
    <ui class="contacts">

        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        @foreach ($friends as $friend)
            <li class="active">
                <div class="d-flex bd-highlight" style="    align-items: center;
                justify-content: space-between;">
                    
                    
                    <div class="img_cont">
                        <a href="javascript:void(0);"
                            wire:click="$emit('chatMe', {{ json_encode(['friendId' => $friend->id, 'friendShipId' => $friend->friend_ships_id]) }})">
                            <img src="{{ $friend->avatar }}" class="rounded-circle user_img">
                        </a>

                        @if (isWithin5Minutes($friend->last_seen))
                            <span class="online_icon"></span>
                        @else
                            <span class="online_icon offline"></span>
                        @endif

                    </div>
                   
                    <div class="user_info">
                        <a href="javascript:void(0);"
                            wire:click="$emit('chatMe', {{ json_encode(['friendId' => $friend->id, 'friendShipId' => $friend->friend_ships_id]) }})">
                            <span>{{ $friend->name }}</span>
                        </a>
                        <p>{{ \Carbon\Carbon::parse($friend->last_seen)->diffForHumans() }}</p>
                    </div>

                    
                    <div>

                        <button class="btn btn-danger btn-sm rounded-circle" wire:click="Unfriend({{ $friend->id }})">
                            Unfriend
                        </button>
                    </div>


                </div>
            </li>
        @endforeach

    </ui>

    <div>

    </div>
</div>
