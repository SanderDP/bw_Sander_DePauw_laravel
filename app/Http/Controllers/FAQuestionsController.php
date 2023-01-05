<?php

namespace App\Http\Controllers;

use App\Models\FAQCategories;
use App\Models\FAQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FAQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = FAQCategories::orderBy('name')->get();
        return view('FAQ.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can add new questions.');
        }
        return view('FAQ.questions.create', ['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can add new questions.');
        }

        $validated = $request->validate([
            'question' => 'required|min:5',
            'answer' => 'required|min:5',
            'category_id' => 'required',
        ]);

        $question = new FAQuestions;
        $question->question = $validated['question'];
        $question->answer = $validated['answer'];
        $question->f_a_q_categories_id = $validated['category_id'];
        $question->save();

        return redirect()->route('FAQ.index')->with('status', 'Question added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
