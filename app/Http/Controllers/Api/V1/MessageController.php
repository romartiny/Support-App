<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource as MessageResource;
use App\Models\MessageTicket;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function showAllMessages(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return MessageResource::collection(MessageTicket::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MessageResource
     */
    public function store(Request $request)
    {
        return new MessageResource(MessageTicket::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function showTicketMessages(int $id)
    {
        return MessageResource::collection(MessageTicket::all()->where('support_tickets_id', $id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return MessageResource
     */
    public function show($num)
    {
        return new MessageResource(MessageTicket::findOrFail($num));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
