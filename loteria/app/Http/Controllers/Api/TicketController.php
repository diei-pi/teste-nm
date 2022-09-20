<?php
namespace App\Http\Controllers\Api;

use App\Events\TicketCreated as TicketCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;


class TicketController extends Controller
{
    public function __construct(private TicketRepository $repository)
    {
        
    }
    public function index(Request $request)
    {
        $id = base64_decode($request->ticketCode);
        $ticket = $this->repository->retriveTicket($id);
        if (!isset($ticket)){
            return [];
        }
        $result = [
            "name" => $ticket->name,
            "yourNumbers" => $ticket->numbers,
            "machineNumbers" => $ticket->machineNumbers,
            "winner" => boolval($ticket->winner),
            "message" => $ticket->message,
        ];
        return $result;
    }

    public function create(TicketRequest $request)
    {
        $ticket = $this->repository->createTicket($request);
        $ticketCreatedEvent = new TicketCreatedEvent($ticket);
        event($ticketCreatedEvent);
        return ["ticketCode" => base64_encode($ticket->id)];
    }
}
