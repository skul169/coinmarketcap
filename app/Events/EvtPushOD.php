<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;



class EvtPushOD extends Event implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
	//public $k;
	public $u;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //$this->k = $key ;
		$this->u = $data ;
		// Get message
       // $this->message = $message;
    }
    public function onQueue()
    {
        return 'broadcastqueue';
    }
    public function broadcastAs()
    {
        return 'EvtPushOD';
    }
    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['EvtPushOD'];
        
    }
}
