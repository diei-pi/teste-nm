<?php
namespace App\Repositories;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;

interface TicketRepository
{
    public function createTicket(TicketRequest $request): Ticket;
    public function retriveTicket(int $id): Ticket;
}