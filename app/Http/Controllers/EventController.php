<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\Supplier;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('pages.events.index', ['events' => $events]);
    }

    /**
     * Display a listing of the resource.
     */
    public function public()
    {
        $events = Event::where('type', 'publico')->get();
        return view('pages.events.public', ['events' => $events]);
    }


       /**
     * Display a listing of the resource.
     */
    public function private()
    {
        $events = Event::where('type', 'privado')->get();
        return view('pages.events.private', ['events' => $events]);
    }

 

      /**
     * Display a listing of the resource.
     */
    public function publicDetail(Event $event)
    {
        $event = Event::find($event->id);
        return view('pages.events.public-detail', ['event' => $event]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event, $categoryId)
    { 
        //$categories = Category::find($categoryId);
        $category   = Category::find($categoryId);
        //$title      = $category->description;

        switch ($categoryId) {
            case '1':
                $form = "create";          
                break;
            case '2':
                $form = "create";        
                break;
            case '3':
                $form = "create";   
                break;
            case '4':
                $form = "create";          
                break;
            case '5':
                $form = "create";         
                break;
            case '6':
                $form = "create";              
                break;
            case '7':
                $form = "create";              
                break;
            
            default:
                $form = "create";              
                break;
        }

        //$cat = Category::where('id',$category);
        //dd($category->description);


        
        return view('pages.events.'.$form, ['category' => $category]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        //dd($request);
        $validated = $request->validated(); 
        //dd($request->owner_id);

        Event::create($validated);
        return redirect('events')->with('status','Item edited successfully!')->with('class', 'alert-success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }


    public function createprivate(Request $request)
    {
        dd($request);
        //$validated = $request->validated(); 
        //dd($request->owner_id);


        //Event::create($validated);
        //return redirect('event/private')->with('status','Item edited successfully!')->with('class', 'alert-success');

    }
}
