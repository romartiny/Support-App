<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource as TicketResource;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private SupportTicket $_supportTicket;

    public function __construct(SupportTicket $supportTicket)
    {
        $this->_supportTicket = $supportTicket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllTickets(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TicketResource::collection(SupportTicket::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return TicketResource
     */
    public function addNewTicket(Request $request): TicketResource
    {
        return new TicketResource(SupportTicket::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TicketResource
     */
    public function showTicket(int $id): TicketResource
    {
        return new TicketResource(SupportTicket::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return TicketResource
     */
    public function updateTicket(Request $request, int $id): TicketResource
    {
        $question = $this->_supportTicket->getTicket($id)::find($id)->update($request->all());

        return new TicketResource($this->_supportTicket->getTicket($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return TicketResource
     */
    public function deleteTicket(int $id): TicketResource
    {
        $question = $this->_supportTicket->getTicket($id);
        $question->delete();
//        if (!$this->_supportAnswer->getAnswer($id)->delete()) {
//            $question->delete();
//        } else {
//            $question->delete();
//            $this->_supportAnswer->getAnswer($id)->delete();
//        }
        return new TicketResource($question);
    }
}
