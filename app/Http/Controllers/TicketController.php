<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;
use App\Models\Ticket;
//use App\Http\Controllers\TicketController;



class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tickets=Ticket::all();
        return view('index',compact('tickets'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketFormRequest $request)
    {
        $slug=uniqid();
        $ticket=new Ticket(array(
            'title'=>$request->get('title'),
            'content'=>$request->get('content'),
            'slug'=>$slug
        ));
        $ticket->save();
        return redirect('/create')->with('status','Your ticket has been Cteate!. Its Unique id is '.$slug);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
             try {
            $ticket = Ticket::where('slug', $slug)->firstOrFail();
            return view('show', compact('ticket'));
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $ticket = Ticket::where('slug', $slug)->firstOrFail();
        return view('edit', compact('ticket'));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        try {
        // Find the ticket by slug
        $ticket = Ticket::where('slug', $slug)->firstOrFail();

        // Update ticket attributes
        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');
        $ticket->status = $request->has('status') ? 1 : 0;

        // Save the updated ticket
        $ticket->save();

        // Redirect to the show page with a success message
        return redirect('/show/' . $ticket->slug)->with('status', 'Ticket updated successfully');
    } catch (ModelNotFoundException $e) {
        // If the ticket is not found, return a 404 response
        return abort(404);
    }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {

    try {
        // Find the ticket by slug
        $ticket = Ticket::where('slug', $slug)->firstOrFail();

        // Delete the ticket
        $ticket->delete();

        // Redirect with a success message
        return redirect('/')->with('status', 'Ticket ' . $slug . ' has been deleted successfully.');
    } catch (ModelNotFoundException $e) {
        // If the ticket is not found, return a 404 response
        return abort(404);
    }


    
    }
}
