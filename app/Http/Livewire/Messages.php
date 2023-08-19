<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Events\SendMessage;
use Illuminate\Support\Facades\Auth;

class Messages extends Component
{ 
    public $userId;
    public $friendShipId;
    public $message;
    // protected $listeners = ['chatMe'];
    protected $rules = [
        'message' => 'required',
    ];


    protected $messages=[];


////////////////////////////////


public function getListeners()
{
    $authUserId=Auth::user()->id;
    return [
        "echo-private:chat.{$authUserId},SendMessage" => 'notifyNewOrder',
        'chatMe'
    ];
}

public function notifyNewOrder($event)
{
    array_unshift($this->messages,$event['message']);
    
   session()->flash('message', 'message come.');


}
////////////////////////////////////////

    public function chatMe($data)
    {

        $this->userId = $data['friendId'];
        $this->friendShipId = $data['friendShipId'];
    }

    public function submit()
    {
 
        $this->validate();
        $data=[
            'message' => $this->message,
            'sender_id' => Auth::user()->id,
            'friend_ship_id' => $this->friendShipId,
        ];
        Message::create($data);

        SendMessage::dispatch($data, $this->userId);


       
        session()->flash('message', 'message successfully updated.');


    }
    

    public function render()
    {
        $user= [];
        $user= [];


        
        if($this->userId){
            $user=User::findOrFail($this->userId);
            // Friend_ship::where()
        }


        if($this->friendShipId){
            $this->messages=Message::where('friend_ship_id',$this->friendShipId)->orderBy('created_at', 'desc')->get();
            
        }
        return view('livewire.messages',['user'=>$user,'messages'=>$this->messages]);
    }
}
