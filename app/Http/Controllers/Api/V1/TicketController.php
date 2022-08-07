<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource as TicketResource;
use App\Models\MessageTicket;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketController extends Controller
{
    private SupportTicket $_supportTicket;
    private MessageTicket $_messageTicket;

    public function __construct(SupportTicket $supportTicket, MessageTicket $messageTicket)
    {
        $this->_supportTicket = $supportTicket;
        $this->_messageTicket = $messageTicket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function getAllTickets(): AnonymousResourceCollection
    {
        return TicketResource::collection(SupportTicket::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TicketResource
     */
    public function addNewTicket(Request $request): TicketResource
    {
        $request->validate([
            'title' => 'required',
            'question' => 'required',
            'status' => 'required',
        ]);

        return new TicketResource(SupportTicket::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TicketResource|string[]
     */
    public function showTicket(int $ticketId)
    {
        if (!SupportTicket::find($ticketId)) {
            return [
                'error' => "Ticket $ticketId not found"
            ];
        } else {
            return new TicketResource(SupportTicket::find($ticketId));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return TicketResource|string[]
     */
    public function updateTicket(Request $request, int $ticketId)
    {
        if (!SupportTicket::find($ticketId)) {
            return [
                'error' => "Ticket $ticketId not found"
            ];
        } else {
            $question = $this->_supportTicket->getTicket($ticketId)::find($ticketId)->update($request->all());

            return new TicketResource($this->_supportTicket->getTicket($ticketId));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return TicketResource|string[]
     */
    public function deleteTicket(int $ticketId)
    {
        if (!SupportTicket::find($ticketId)) {
            return [
                'error' => "Ticket $ticketId not found"
            ];
        } else {
            $question = $this->_supportTicket->getTicket($ticketId);
            if (!$this->_messageTicket->deleteMessage($ticketId)) {
                $question->delete();
            } else {
                $question->delete();
                $this->_messageTicket->deleteMessage($ticketId);
            }
            return new TicketResource($question);
        }
    }

}
