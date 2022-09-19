<?php
namespace App\Repositories;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use App\Repositories\TicketRepository;
use Illuminate\Validation\ValidationException;

class EloquentTicketRepository implements TicketRepository
{
    public function createTicket(TicketRequest $request): Ticket
    {
        $numbers = json_decode($request->numbers);
        sort($numbers);
        $numbers = json_encode($numbers);
        $ticket = Ticket::create(["name"=>$request->name,"numbers"=>$numbers]);
        $ticket->ticketCode = $ticket->id;
        $ticket->save();
        return $ticket;
    }
}