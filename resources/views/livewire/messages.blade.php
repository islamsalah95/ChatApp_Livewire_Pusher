<div class="col-md-8 col-xl-6 chat">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    @if ($user)
        <div class="card">
            <div class="card-header msg_head">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <img src="{{ $user->avatar }}" class="rounded-circle user_img">
                        @if (isWithin5Minutes($user->last_seen))
                            <span class="online_icon"></span>
                        @else
                            <span class="online_icon offline"></span>
                        @endif
                    </div>
                    <div class="user_info">
                        <span>Chat with {{ $user->name }}</span>
                    </div>
                    <div class="video_cam">
                        <span><i class="fas fa-video"></i></span>
                        <span><i class="fas fa-phone"></i></span>
                    </div>
                </div>
                <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                <div class="action_menu">
                    <ul>
                        <li><i class="fas fa-user-circle"></i> View profile</li>
                        <li><i class="fas fa-users"></i> Add to close friends</li>
                        <li><i class="fas fa-plus"></i> Add to group</li>
                        <li><i class="fas fa-ban"></i> Block</li>
                    </ul>
                </div>
            </div>

            @if ($messages)
                <div class="card-body msg_card_body">
                    @foreach ($messages as $message)
                        @if ($message->sender_id == Auth::user()->id)
                            {{--  //me  --}}
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    <div>
                                        {{ $message->message }}
                                    </div>

                                    <div>
                                         {{ $message->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle user_img_msg">
                                </div>
                            </div>
                        @else
                            {{--  //friend  --}}
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{ $user->avatar }}" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer">
                                    <div>
                                        {{ $message->message }}
                                    </div>

                                    <div>
                                         {{ $message->created_at->diffForHumans() }}
                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            @endif



            <form wire:submit.prevent="submit">
                <div class="card-footer">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <textarea name="" class="form-control type_msg" placeholder="Type your message..." wire:model="message"></textarea>

                        <div class="input-group-append">

                            <span class="input-group-text send_btn"><button><i
                                        class="fas fa-location-arrow"></i></button></span>
                        </div>
                    </div>
                </div>

            </form>


        </div>


    @endif

</div>
