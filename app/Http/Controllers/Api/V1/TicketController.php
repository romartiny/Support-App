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
    public function showTicket(int $id)
    {
        if (!SupportTicket::find($id)) {
            return [
                'error' => "Ticket $id not found"
            ];
        } else {
            return new TicketResource(SupportTicket::find($id));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return TicketResource|string[]
     */
    public function updateTicket(Request $request, int $id)
    {
        if (!SupportTicket::find($id)) {
            return [
                'error' => "Ticket $id not found"
            ];
        } else {
            $question = $this->_supportTicket->getTicket($id)::find($id)->update($request->all());

            return new TicketResource($this->_supportTicket->getTicket($id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return TicketResource|string[]
     */
    public function deleteTicket(int $id)
    {
        if (!SupportTicket::find($id)) {
            return [
                'error' => "Ticket $id not found"
            ];
        } else {
            $question = $this->_supportTicket->getTicket($id);
            if (!$this->_messageTicket->deleteMessage($id)) {
                $question->delete();
            } else {
                $question->delete();
                $this->_messageTicket->deleteMessage($id);
            }
            return new TicketResource($question);
        }
    }

}
