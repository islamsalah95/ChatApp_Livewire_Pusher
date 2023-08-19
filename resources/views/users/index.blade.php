<x-app-layout>
    <div class="card-body contacts_body">
      @if (session()->has('message'))
      <div class="alert alert-success">
          {{ session('message') }}
      </div>
  @endif

  @if (count($NNotFriendUsers) !== 0)
  <ui class="contacts">
    @foreach ($NNotFriendUsers as $NNotFriendUser)
        <li class="active">
            <div class="d-flex bd-highlight" style="    display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;">
                <div class="img_cont">
                    <img src="{{ $NNotFriendUser->avatar }}" class="rounded-circle NNotFriendUser_img" style="    width: 60px;
                    height: 71px;">

                    @if (isWithin5Minutes($NNotFriendUser->last_seen))
                        <span class="online_icon"></span>
                    @else
                        <span class="online_icon offline"></span>
                    @endif

                </div>
                <div class="NNotFriendUser_info">
                    <span>{{ $NNotFriendUser->name }}</span>
                    <p>{{ $NNotFriendUser->last_seen }}</p>
                </div>

                <div>
                  <form action="{{ route('friendships.store', ['user' => $NNotFriendUser->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Add Friend</button>
                </form>
                </div>

                {{--  <div>
                <button class="btn btn-error">remove</button>
                </div>  --}}
            </div>

        </li>
    @endforeach

</ui>
  @else
  <h1 style="text-align: center;
  font-size: xxx-large;
}">No Users yet</h1>
  @endif



    </div>
</x-app-layout>
