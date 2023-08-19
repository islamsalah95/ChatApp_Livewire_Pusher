<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Friend_ship;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {$storeIds =[];
        $authUser = Auth::user()->id;
        $users = User::all();
        $friendships = Friend_ship::where(function (Builder $query) use ($authUser) {
            $query->where('sender_id', '=', $authUser)
                ->orWhere('receiver_id', '=', $authUser);
        })->get();

        foreach ($friendships as  $friendSip) {
            if ($friendSip->sender_id  !==  $authUser) {
                $storeIds[]=$friendSip->sender_id;
            } 
          else if ($friendSip->receiver_id   !==  $authUser ) {
                $storeIds[]=$friendSip->receiver_id;
            } 
            else {
               continue ;
            }
        }
        $storeIds[]=$authUser;

       $NNotFriendUsers= User::whereNotIn('id', $storeIds)->get();




        return view('users.index', compact('NNotFriendUsers'));
    }



}
