<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Friend_ship;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FriendRequest;
use App\Notifications\FriendRequests;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreFriend_shipRequest;
use App\Http\Requests\UpdateFriend_shipRequest;

class FriendShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
{
   $friendsRequests=Friend_ship::where('receiver_id' ,'=',Auth::user()->id)->where('status','pending')->get();
 
//    $friendsRequests= FriendRequest::collection($friendsRequests);

   return view('friendships.index', compact('friendsRequests'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show the create form
        return view('friendships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFriend_shipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
{
    $data=[
        'sender_id' => Auth::user()->id,
        'receiver_id' => $user->id,
    ];
    Friend_ship::create($data);

    $user->notify(new FriendRequests($data));

    return redirect()->back()->with('success', 'Friendship created successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friend_ship  $friend_ship
     * @return \Illuminate\Http\Response
     */
    public function show(Friend_ship $friend_ship)
    {
        // Show details of a specific friend ship
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friend_ship  $friend_ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend_ship $friend_ship)
    {
        // Show the edit form for a specific friend ship
        return view('friendships.edit', ['friendship' => $friend_ship]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFriend_shipRequest  $request
     * @param  \App\Models\Friend_ship  $friend_ship
     * @return \Illuminate\Http\Response
     */
    public function update(Friend_ship $friend_ship)
    {
        // Update the friend ship
        $friend_ship->update([
            'status' => 'accepted',
        ]);

        return redirect()->route('friendships.index')
            ->with('success', 'Friendship updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friend_ship  $friend_ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend_ship $friend_ship)
    {
        // Delete the friend ship
        $friend_ship->delete();

        return redirect()->back()->with('success', 'Friendship deleted successfully.');
    }




    

}
