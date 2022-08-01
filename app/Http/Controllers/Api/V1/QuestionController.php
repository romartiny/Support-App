<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupportQuestionResource as SupportQuestionResource;
use App\Models\SupportAnswer;
use App\Models\SupportQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return SupportQuestionResource::collection(SupportQuestion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return SupportQuestionResource
     */
    public function store(Request $request): SupportQuestionResource
    {
        return new SupportQuestionResource(SupportQuestion::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SupportQuestionResource
     */
    public function show(int $id): SupportQuestionResource
    {
        return new SupportQuestionResource(SupportQuestion::with('answersList')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return SupportQuestionResource
     */
    public function update(Request $request, int $id): SupportQuestionResource
    {
        $question = SupportQuestion::find($id);
        $question->update($request->all());

        return new SupportQuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return SupportQuestionResource
     */
    public function destroy(int $id): SupportQuestionResource
    {
        $question = SupportQuestion::findOrFail($id);
        $answer = SupportAnswer::where('support_question_id', $id);
        if ($answer->delete() && $question->delete()) {
            return new SupportQuestionResource($question);
        }
    }
}
