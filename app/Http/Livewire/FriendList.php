<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Friend_ship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class FriendList extends Component
{

    public function Unfriend(User $user)
    {  
    $auth = Auth::user();
    
    Friend_ship::where(function ($query) use ($user, $auth) {
        $query->where('sender_id', $user->id)
              ->where('receiver_id', $auth->id);
    })
    ->orWhere(function ($query) use ($user, $auth) {
        $query->where('receiver_id', $user->id)
              ->where('sender_id', $auth->id);
    })
    ->delete();

        return redirect()->back()->with('success', 'Friendship deleted successfully.');
    }


    public function render()
    {

        
        $user = Auth::user()->id;

        $friends=[];
    
        $friendships = Friend_ship::where('status', '=', 'accepted')
            ->where(function (Builder $query) use ($user) { 
                $query->where('sender_id', '=', $user)
                      ->orWhere('receiver_id', '=', $user);
            })
            ->get();
    
            foreach ($friendships as $friendship) {
               if ($friendship->sender_id !== $user) {
                $me=User::findOrFail($friendship->sender_id);
                $me->friend_ships_id=$friendship->id;
                $friends[]=$me;
               }
    
               if ($friendship->receiver_id !== $user) {
                $me=User::findOrFail($friendship->receiver_id);
                $me->friend_ships_id=$friendship->id;
                $friends[]=$me;
               }
            }
            
         
        return view('livewire.friend-list', ['friends' => $friends]);
    }
}
