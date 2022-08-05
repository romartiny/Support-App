<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource as MessageResource;
use App\Models\MessageTicket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MessageController extends Controller
{
    private MessageTicket $_messageTicket;

    public function __construct(MessageTicket $messageTicket)
    {
        $this->_messageTicket = $messageTicket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function showAllMessages(): AnonymousResourceCollection
    {
        return MessageResource::collection(MessageTicket::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return MessageResource|string[]
     */
    public function addTicketMessage(Request $request, int $ticketId)
    {
        if (!MessageTicket::find($ticketId)) {
            return [
                'error' => "Ticket $ticketId not found"
            ];
        } else {
            $request->validate([
                'support_tickets_id' => 'required',
                'user_name' => 'required',
                'user_message' => 'required'
            ]);

            return new MessageResource(MessageTicket::create($request->all()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return AnonymousResourceCollection
     */
    public function showTicketMessages(int $id): AnonymousResourceCollection
    {
        return MessageResource::collection(MessageTicket::all()->where('support_tickets_id', $id));
    }

    /**
     * Display the single resource.
     *
     * @param int $ticketId
     * @param int $messageId
     * @return AnonymousResourceCollection|string[]
     */
    public function showSingleMessage(int $ticketId, int $messageId)
    {
        if (!MessageTicket::find($messageId)) {
            return [
                'error' => "Message $messageId not found"
            ];
        } else {
            return MessageResource::collection($this->_messageTicket->getTicketMessages($ticketId, $messageId));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @param int $messageId
     * @return MessageResource|string[]
     */
    public function updateTicketMessage(Request $request, int $id, int $messageId)
    {
        if (!MessageTicket::find($messageId)) {
            return [
                'error' => "Message $messageId not found"
            ];
        } else {
            $this->_messageTicket->getTicketMessage($messageId)::find($messageId)->update($request->all());
            return new MessageResource($this->_messageTicket->getTicketMessage($messageId));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $ticketId
     * @param int $messageId
     * @return MessageResource|string[]
     */
    public function deleteTicketMessage(int $ticketId, int $messageId)
    {
        if (!MessageTicket::find($messageId)) {
            return [
                'error' => "Message $messageId not found"
            ];
        } else {
            $message = $this->_messageTicket->getTicketMessage($messageId);
            $this->_messageTicket->getTicketMessage($messageId)::find($messageId)->delete();
            return new MessageResource($message);
        }
    }
}
