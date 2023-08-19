<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FriendRequests;

class NotificationUser extends Component
{
   public $notifications=[];
   public $notificationsCount=0;


   public function getListeners()
{
    $authUserId=Auth::user()->id;
    return [
        "echo-private:request.{$authUserId},FriendRequests" => 'notifyNewMessage',
    ];
}

public function notifyNewMessage($event)
{

    $this->notificationsCount ++;
    $this->notifications=Auth::user()->unreadNotifications;

}

public function Like()
{

    $this->notificationsCount ++ ;
    // $this->notifications=Auth::user()->unreadNotifications;

}

    public function makeRead()
    {
 
        Auth::user()->unreadNotifications->markAsRead();

    }


    public function render()
    {

        $this->notifications=Auth::user()->unreadNotifications;
        $this->notificationsCount=Auth::user()->unreadNotifications->count();

        return view('livewire.notification-user');
    }
}
