<?php

namespace App\Http\Controllers;

use App\Models\ContactForms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactFormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user() == null)
            return redirect()->route('contact.create');
        else if (Auth::user()->is_admin){
            $contactforms = ContactForms::oldest()->get();
            return view('contact.admin', compact('contactforms'));
        }
        else
            return redirect()->route('contact.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5',
            'mail' => 'required',
            'message' => 'required|min:5',
        ]);

        $contactform = new ContactForms();
        $contactform->name = $validated['name'];
        $contactform->mail = $validated['mail'];
        $contactform->message = $validated['message'];
        $contactform->save();

        return redirect()->route('index')->with('status', 'Contact form submitted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = ContactForms::findOrFail($id);

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can delete posts.');
        }

        $form->delete();

        return redirect()->route('contact.index')->with('status', 'Form deleted');
    }
}
