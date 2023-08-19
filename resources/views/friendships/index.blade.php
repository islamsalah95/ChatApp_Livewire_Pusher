<x-app-layout>
    <div class="card-body contacts_body">
      @if (session()->has('message'))
      <div class="alert alert-success">
          {{ session('message') }}
      </div>
  @endif
        <ui class="contacts">
            @if ($friendsRequests->isEmpty())
            <h1 style="text-align: center;
            font-size: xxx-large;
        }">No friend requests</h1>
            @endif
            @foreach ($friendsRequests as $friendsRequest)
                <li class="active">
                    <div class="d-flex bd-highlight" style="display: flex;
                    flex-direction: row;
                    justify-content: space-evenly;
                    align-items: center;">
                        <div class="img_cont">
                            <img src="{{ $friendsRequest->sender->avatar }}" style="    width: 60px;
                            height: 71px;" class="rounded-circle NNotFriendUser_img">

                            
                            @if (isWithin5Minutes($friendsRequest->sender->last_seen))
                                <span class="online_icon"></span>
                            @else
                                <span class="online_icon offline"></span>
                            @endif

                        </div>
                        <div class="NNotFriendUser_info">
                            <span>{{ $friendsRequest->sender->name }}</span>
                            <p>{{ $friendsRequest->sender->last_seen }}</p>
                        </div>

                        <div >
                            <button disabled  class="btn btn-danger">{{ $friendsRequest->status}}</button>
                        </div>

                        <div style="display: flex;
                        justify-content: space-between;
                        align-items: center;">
                          <form action="{{ route('friendships.update', ['friend_ship' => $friendsRequest->id]) }}" method="post">
                            @csrf
                            <button style="margin-right: 15px;" type="submit" class="btn btn-success">Add Friend</button>
                        </form>


                        <form action="{{ route('friendships.destroy', ['friend_ship' => $friendsRequest->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">remove</button>
                        </form>
                        </div>

                        {{--  <div>
                        <button class="btn btn-error">remove</button>
                        </div>  --}}
                    </div>

                </li>
            @endforeach

        </ui>

        <div>

        </div>
    </div>
</x-app-layout>
