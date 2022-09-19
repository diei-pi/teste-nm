<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PrizeDrawMaker implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        // sleep(30);
        $randomNumbers = [];
        for ($i=0; $i<6;$i++) {
            $randomNumbers[] = rand(1,60);
        }
        sort($randomNumbers);
        $randomNumbers = json_encode($randomNumbers);
        $event->ticket->machineNumbers = $randomNumbers;
        if ($event->ticket->numbers == $randomNumbers) {
            $event->ticket->message = "you won!";
            $event->ticket->winner = true;
        } else {
            $event->ticket->message = "you lost!";
        }
        $event->ticket->save();
        
    }
}
