<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\SupplierType;
use App\Exports\EventsbyownerExport;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


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
    public function eventsbyowner(Request $request)
    {
        $ownerId  = Auth::user()->id;
        $Category = Category::all();
        $events   = Event::where('owner_id', $ownerId)->orderBy('id', 'desc')->paginate(15);  
        $formFields = array();

        return view('pages.events.owner.index', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
    }

        /**
    * Display a listing of the resource.
    */
    public function searchEventsByOwner(Request $request){

        $ownerId  = Auth::user()->id;        
        $Category = Category::all();
        $events   = Event::where('owner_id', $ownerId);             
           
        if ($request->has('event_name') && $request->event_name!==null) {
            $events->where('name','like', '%'.$request->event_name.'%');
        }

        if ($request->has('participants1') && $request->participants1!==null && $request->participants2===null) {
            $events->where('number_of_participants','>=', intval($request->participants1) );
        }

        if ($request->has('participants2') && $request->participants2!==null && $request->participants1===null) {
            $events->where('number_of_participants','<=', intval($request->participants2) );
        }

        if ($request->participants2!==null && $request->participants1!==null) {
            $events->where('number_of_participants','>=', intval($request->participants1) );
            $events->where('number_of_participants','<=', intval($request->participants2) );
        }

        if ($request->has('category_id') && $request->category_id!==null) {
            $events->where('category_id', $request->category_id );
        } 
        
        if ($request->has('event_status') && $request->event_status!==null) {
            $events->where('event_status', $request->event_status );
        }
        
        if ($request->has('amount1') && $request->amount1!==null && $request->amount2===null) {
            $events->where('amount','>=', $request->amount1);
        }

        if ($request->has('amount2') && $request->amount2!==null && $request->amount1===null) {
            $events->where('amount','<=', $request->amount2);
        }

        if ($request->amount2!==null && $request->amount1!==null) {
            $events->where('amount','>=', number_format($request->amount1, 2,',') );
            $events->where('amount','<=', number_format($request->amount2, 2,',') );
        }


        if ($request->has('datepicker1') && $request->datepicker1!==null && $request->datepicker2===null) {
            $events->where('start_date', '>=',$request->datepicker1);
        }

        if ($request->has('datepicker2') && $request->datepicker2!==null && $request->datepicker1===null) {
            $events->where('start_date','<=', $request->datepicker2);
        }

        if ($request->datepicker2!==null && $request->datepicker1!==null) {
            $events->where('start_date','>=', $request->datepicker1 );
            $events->where('start_date','<=', $request->datepicker2 );
        }      

        $events->orderBy('id', 'desc');
        $events = $events->paginate(15);
  

        $formFields = array();
        $formFields['event_name']    = $request->event_name;
        $formFields['participants1'] = $request->participants1;
        $formFields['participants2'] = $request->participants2;
        $formFields['category_id']   = $request->category_id;
        $formFields['amount1']       = $request->amount1;
        $formFields['amount2']       = $request->amount2;
        $formFields['event_status']  = $request->event_status;
        $formFields['datepicker1']   = $request->datepicker1;
        $formFields['datepicker2']   = $request->datepicker2;


        return view('pages.events.owner.index', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
       // return redirect()->route('pages.events.owner.index');
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
        $Category    = Category::all();
        $formFields = array();

        return view('pages.events.manager.index', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);

    }


        /**
    * Display a listing of the resource.
    */
    public function searchEventsByManager(Request $request)
    {
        $manager_id  = Auth::user()->id;  
        
        if(Auth::user()->role_id == 2){       

            $Category    = Category::all();

            if ($request->has('pending') && $request->pending === 'pending') {
                $events      = Event::where('manager_id', 0); 
                $events->orderBy('id', 'desc');
                $events = $events->paginate(15);
                $formFields = array();
                return view('pages.events.manager.index', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
            }

            $events      = Event::where('manager_id', $manager_id);             
            
            if ($request->has('event_name') && $request->event_name!==null) {
                $events->where('name','like', '%'.$request->event_name.'%');
            }

            if ($request->has('participants1') && $request->participants1!==null && $request->participants2===null) {
                $events->where('number_of_participants','>=', intval($request->participants1) );
            }

            if ($request->has('participants2') && $request->participants2!==null && $request->participants1===null) {
                $events->where('number_of_participants','<=', intval($request->participants2) );
            }

            if ($request->participants2!==null && $request->participants1!==null) {
                $events->where('number_of_participants','>=', intval($request->participants1) );
                $events->where('number_of_participants','<=', intval($request->participants2) );
            }

            if ($request->has('category_id') && $request->category_id!==null) {
                $events->where('category_id', $request->category_id );
            } 
            
            if ($request->has('event_status') && $request->event_status!==null) {
                $events->where('event_status', $request->event_status );
            }
            
            if ($request->has('amount1') && $request->amount1!==null && $request->amount2===null) {
                $events->where('amount','>=', $request->amount1);
            }

            if ($request->has('amount2') && $request->amount2!==null && $request->amount1===null) {
                $events->where('amount','<=', $request->amount2);
            }

            if ($request->amount2!==null && $request->amount1!==null) {
                $events->where('amount','>=', number_format($request->amount1, 2,',') );
                $events->where('amount','<=', number_format($request->amount2, 2,',') );
            }


            if ($request->has('datepicker1') && $request->datepicker1!==null && $request->datepicker2===null) {
                $events->where('start_date', '>=',$request->datepicker1);
            }

            if ($request->has('datepicker2') && $request->datepicker2!==null && $request->datepicker1===null) {
                $events->where('start_date','<=', $request->datepicker2);
            }

            if ($request->datepicker2!==null && $request->datepicker1!==null) {
                $events->where('start_date','>=', $request->datepicker1 );
                $events->where('start_date','<=', $request->datepicker2 );
            }      

            $events->orderBy('id', 'desc');
            $events = $events->paginate(15);
    

            $formFields = array();
            $formFields['event_name']    = $request->event_name;
            $formFields['participants1'] = $request->participants1;
            $formFields['participants2'] = $request->participants2;
            $formFields['category_id']   = $request->category_id;
            $formFields['amount1']       = $request->amount1;
            $formFields['amount2']       = $request->amount2;
            $formFields['event_status']  = $request->event_status;
            $formFields['datepicker1']   = $request->datepicker1;
            $formFields['datepicker2']   = $request->datepicker2;


            return view('pages.events.manager.index', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
        }else{
            return redirect('/dashboard');
        }
    }


        /**
    * Display a listing of the resource.
    */
    public function eventsbyadmin()
    {   
        $AuthUser = Auth::user(); 

        if($AuthUser->role_id == 1 ){

            $events =  Event::paginate(15);
            $suppliers = Supplier::all();
            return view('pages.events.admin.index', ['events' => $events, 'suppliers' => $suppliers]);
        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }  
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
    public function store(StoreEventRequest $request)
    {      
        // Fields validations now will be returned from  StoreEventRequest  
        $owner_id = Auth::user()->id;

        $event = Event::create([
            'name'                   => $request->name,
            'description'            => $request->description,
            'localization'           => $request->localization,            
            'start_date'             => $request->start_date,
            'end_date'               => $request->end_date,
            'owner_id'               => $owner_id,
            'category_id'            => $request->category_id, 
            'type'                   => $request->type,
            'amount'                 => "0.00",
            'ticket_amount'          => "0.00",
            'start_time'             => $request->start_time,
            'end_time'               => $request->end_time,
            'number_of_participants' => $request->number_of_participants,
            'event_confirmation'     => false,
            'services_default_array' => json_encode($request->suppliers)
        ]);

        // check and store image
        if($request->has('image')){
            $file      = $request->file('image');
            $imageName = time().'.'.$request->image->extension();
            $path      = 'images/events/'.$event->id;

            $request->image->move(public_path($path), $imageName);

            // save image
            $update = Event::find($event->id);
            $update->image = $imageName;
            $update->save();      
        }

 

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

            $event        = Event::find($event->id);
            $category     = Category::find($event->category_id);
            $SupplierType = SupplierType::all();
            $suppliers    = Supplier::all();

            return view('pages.events.owner.show', ['event' => $event, 'category' => $category, 'suppliers' => $suppliers, 'SupplierType' => $SupplierType]);
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
            $category     = Category::find($event->category_id);
            $SupplierType = SupplierType::all();
            $suppliers    = Supplier::all();


            return view('pages.events.manager.show', ['event' => $event, 'category' => $category, 'suppliers' => $suppliers, 'SupplierType' => $SupplierType]);
        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }           
    }


            /**
     * Display the specified resource.
     */
    public function showbyadmin(Event $event)
    {
        $AuthUser = Auth::user(); 
        
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

            $SupplierType = SupplierType::all();
            $categories   = Category::all();
            $event        = Event::find($event->id);
            return view('pages.events.owner.edit', ['event' => $event, 'categories' => $categories, 'SupplierType' => $SupplierType]);
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
            $SupplierType = SupplierType::all();
            $categories   = Category::all();
            return view('pages.events.manager.edit', ['event' => $event, 'categories' => $categories, 'SupplierType' => $SupplierType]);
        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    { 

        //dd($event);

        // only can update: owner and manager
        $AuthUser = Auth::user();

        if($AuthUser->id === $event->manager_id || $AuthUser->id === $event->owner_id){

            $event                         = Event::find($event->id);
            $event->name                   = $request->name;
            $event->description            = $request->description;
            $event->localization           = $request->localization;
            $event->start_date             = $request->start_date;
            $event->end_date               = $request->end_date;
            $event->start_time             = $request->start_time;
            $event->end_time               = $request->end_time;
            $event->category_id            = $request->category_id;
            $event->type                   = $request->type;
            $event->number_of_participants = $request->number_of_participants;
            $event->services_default_array = json_encode($request->suppliers);
            $event->save(); 

            // check and store image
            if($request->has('image') && $request->file('image')){
                $file      = $request->file('image');
                $imageName = time().'.'.$request->image->extension();
                $path      = 'images/events/'.$event->id;

                $request->image->move(public_path($path), $imageName);
                // save image
                $update = Event::find($event->id);
                $update->image = $imageName;
                $update->save();    
            }

            // /events/owner/26/edit
            return redirect('/events/manager/'.$event->id.'/edit')->with('status','Item edited successfully!')->with('class', 'alert-success');
        }else{
            return redirect('/dashboard')->with('status','Something is not write!')->with('class', 'alert-danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {

       
    }

       /**
     * Remove the specified resource from storage.
     */
    public function deleteevent(Event $event)
    {
        $AuthUser = Auth::user(); 
        // user roles is owner and he is the event (to show) owner
        if($AuthUser->id === $event->manager_id || $AuthUser->id === $event->owner_id || ($AuthUser->role_id === 2 && $event->manager_id === null)){

            $event               = Event::find($event->id);
            $event->event_status = "cancelado";        
            $event->save(); 

            if($AuthUser->role_id === 3){
                return redirect('/events/owner/')->with('status','Item edited successfully!')->with('class', 'alert-success');
            }else{
                if($AuthUser->role_id === 2){
                    return redirect('/events/manager/')->with('status','Item edited successfully!')->with('class', 'alert-success');
                }
            }
        }   

        return redirect('/dashboard')->with('status','Something is not write!')->with('class', 'alert-danger');
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

        return view('pages.participants.participant-event-list', ['events' => $events]);
    }

    public function admin()
    {
        $AuthUser = Auth::user(); 
        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id === 1 ){
            $events = Event::all();
            return view('pages.events.admin', ['events' => $events]);
        }
    }


    public function exportbyowner() 
    {         
        $AuthUser = Auth::user(); 
        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id === 3 ){

            return (new EventsbyownerExport($AuthUser->id))->download('events.xlsx');
        }
       
    }

    public function updatestatus(Event $event){

        $AuthUser = Auth::user(); 
        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id === 2 ){

            $event               = Event::find($event->id);
            $event->event_status = "pendente";        
            $event->save(); 

            return redirect('/events/manager/')->with('status','Item edited successfully!')->with('class', 'alert-success');
        }   

        return redirect('/dashboard')->with('status','Something is not write!')->with('class', 'alert-danger');
    }

}
