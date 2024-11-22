<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\SupplierType;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ownerId = Auth::user()->id;
        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        $events = $query->paginate(15);
        $suppliers = Supplier::all();

        return view('pages.events.index', ['events' => $events, 'suppliers' => $suppliers]);
    }


    /**
    * Display a listing of the resource.
    */
    public function eventsbyowner()
    {
        $ownerId = Auth::user()->id;
        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        $events = $query->paginate(15);
        $suppliers = Supplier::all();

        return view('pages.events.owner.index', ['events' => $events, 'suppliers' => $suppliers]);
    }

        /**
    * Display a listing of the resource.
    */
    public function eventsbymanager()
    {
        $manager_id = Auth::user()->id;
        $query   = Event::query();
        $query->where('manager_id',$manager_id);
        $events = $query->paginate(15);
        $suppliers = Supplier::all();

        return view('pages.events.manager.index', ['events' => $events, 'suppliers' => $suppliers]);
    }


        /**
    * Display a listing of the resource.
    */
    public function eventsbyadmin()
    {    
        $events =  Event::paginate(15);
        $suppliers = Supplier::all();
        return view('pages.events.admin.index', ['events' => $events, 'suppliers' => $suppliers]);
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

        $SupplierType = SupplierType::all();
        $suppliers    = Supplier::all();
        $category     = Category::find($categoryId);
        $categories   = Category::all();
        
        return view('pages.events.'.$form, ['category' => $category, 'suppliers' => $suppliers, 'categories'=> $categories, 'SupplierType' => $SupplierType]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
               
        $validated = $request->validate([
            'name'                   => 'required|string|max:255',
            'description'            => 'required|string|max:255',
            'localization'           => 'required|string|max:255',            
            'start_date'             => 'date|after:now',
            'end_date'               => 'date|after:now',
            'owner_id'               => 'integer',
            'category_id'            => 'integer',
            'type'                   => 'string|max:255',
            'amount'                 => 'between:0,999999.99',
            'ticket_amount'           => 'between:0,999999.99',
            'start_time'             => 'date_format:H:i',
            'end_time'               => 'date_format:H:i|after:start_time',
            'number_of_participants' => 'nullable|integer',           
            'event_confirmation'     => 'nullable|boolean',
            'suppliers'              => 'nullable',
        ]);

        $event = Event::create([
            'name'                   => $request->name,
            'description'            => $request->description,
            'localization'           => $request->localization,            
            'start_date'             => $request->start_date,
            'end_date'               => $request->end_date,
            'owner_id'               => $request->owner_id,
            'category_id'            => $request->category_id, 
            'type'                   => $request->type,
            'amount'                 => $request->amount,
            'ticket_amount'          => $request->ticket_amount,
            'start_time'             => $request->start_time,
            'end_time'               => $request->end_time,
            'number_of_participants' => $request->number_of_participants,
            'event_confirmation'     => $request->event_confirmation,
            'services_default_array' => json_encode($request->suppliers)
        ]);


        if($request->has('image')){
            $file      = $request->file('image');
            $imageName = time().'.'.$request->image->extension();
            $path      = 'images/events/'.$event->id;

            $request->image->move(public_path($path), $imageName);
        }

        $update = Event::find($event->id);
        $update->image = $imageName;
        $update->save();       

        return redirect('/dashboard')->with('status','Item created successfully!')->with('class', 'alert-success');
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('pages.events.show', ['event' => $event]);
    }

    /**
     * Display the specified resource.
     */
    public function showbyowner(Event $event)
    {
        $AuthUser = Auth::user(); // (role_id == 3) => owner

        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id == 3 &&  $AuthUser->id === $event->owner_id ){
            $event = Event::find($event->id);
            return view('pages.events.owner.show', ['event' => $event]);
        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }
    }

            /**
     * Display the specified resource.
     */
    public function showbymanager(Event $event)
    {
        $AuthUser = Auth::user(); // (role_id == 3) => owner

        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id == 2 &&  $AuthUser->id === $event->manager_id ){
            $event = Event::find($event->id);
            return view('pages.events.manager.show', ['event' => $event]);
        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }
    }


            /**
     * Display the specified resource.
     */
    public function showbyadmin(Event $event)
    {
        $AuthUser = Auth::user(); // (role_id == 3) => owner

        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id == 1){
            $event = Event::find($event->id);
            return view('pages.events.admin.show', ['event' => $event]);
        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('pages.events.edit', ['event' => $event]);
    }

     /**
     * Display the specified resource.
     */
    public function editbyowner(Event $event)
    {
        $AuthUser = Auth::user(); // (role_id == 3) => owner

        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id == 3 &&  $AuthUser->id === $event->owner_id ){
            $event = Event::find($event->id);
            return view('pages.events.owner.edit', ['event' => $event]);
        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }
    }

            /**
     * Display the specified resource.
     */
    public function editbymanager(Event $event)
    {
        $AuthUser = Auth::user(); // (role_id == 3) => owner

        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id == 2 &&  $AuthUser->id === $event->manager_id ){
            $event = Event::find($event->id);
            return view('pages.events.manager.edit', ['event' => $event]);
        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {

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

    public function eventsbyparticipant()
    {
        $user = auth()->user();

        $events = $user->events()->distinct()->get();

        return view('pages.events.participant', ['events' => $events]);
    }

    public function admin()
    {
        $events = Event::all();
        return view('pages.events.admin', ['events' => $events]);
    }


}
