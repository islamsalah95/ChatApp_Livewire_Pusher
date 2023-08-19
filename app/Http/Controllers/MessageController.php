<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;
use App\Models\Friend_ship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            
         
        return view('messages.index', ['friends' => $friends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        Message::create($request->all());

        return redirect()->route('messages.index')
            ->with('success', 'Message created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        return view('messages.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->all());

        return redirect()->route('messages.index')
            ->with('success', 'Message updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}

