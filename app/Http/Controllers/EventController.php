<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\SupplierType;
use App\Models\User;
use App\Exports\EventsbyownerExport;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventsbymanagerExport;
use App\Exports\EventsByParticipantExport;


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
        $events = $query->paginate(10);
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
        $events   = Event::where('owner_id', $ownerId)->orderBy('start_date', 'desc')->paginate(10);
        $formFields = array();

        return view('pages.events.owner.index', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
    }


    public function eventsbyownereport(){

        $owner = Auth::user();

        if($owner->role_id == 3){

            $Category   = Category::all();
            $events     = Event::where('owner_id', $owner->id)->orderBy('start_date', 'desc')->get();
            $formFields = array();

            return view('pages.events.owner.report', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
        }

        return redirect('/dashboard');
    }

    public function eventsbymanagereport(){

        $manager = Auth::user();

        if($manager->role_id == 2){

            $Category   = Category::all();
            $events     = Event::where('manager_id', $manager->id)->orderBy('start_date', 'desc')->get();
            $formFields = array();

            return view('pages.events.manager.report', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
        }
        return redirect('/dashboard');
    }


    public function eventsbyadminreport(){

        $admin = Auth::user();

        if($admin->role_id == 1){

            $Category   = Category::all();
            $events     = Event::orderBy('start_date', 'desc')->get();
            $formFields = array();

            return view('pages.events.admin.report', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
        }
        return redirect('/dashboard');
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

        $events->orderBy('start_date', 'desc');
        $events = $events->paginate(10);


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
    }

    /**
    * Display a listing of the events by manager_id
    */
    public function eventsbymanager()
    {
        $manager = Auth::user();

        if($manager->role_id == 2){

            $events     = Event::query()->where('manager_id',$manager->id)
                                ->where('event_status', '!=', 'pendente')
                                ->orderBy('start_date', 'desc')->paginate(10);

            $Category   = Category::orderBy('description', 'asc')->get();
            $formFields = array();

            return view('pages.events.manager.index', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
        }else{
            return redirect('/dashboard');
        }
    }


    /**
    * Display a listing of the events by manager_id
    */
    public function eventsaprrove()
    {
        $manager = Auth::user();

        if($manager->role_id == 2){

            $events     = Event::query()->where('manager_id',0)->orderBy('start_date', 'asc')->paginate(10);
            $Category   = Category::orderBy('description', 'asc')->get();
            $formFields = array();

            return view('pages.events.manager.eventstoapprove', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);
        }else{
            return redirect('/dashboard');
        }
    }

    /**
    * Display a listing of the events by manager_id with filters
    */
    public function searchEventsByManager(Request $request)
    {
        $manager = Auth::user();

        if($manager->role_id == 2){

            $events = Event::where('manager_id', $manager->id)
            ->when($request->has('event_name') && $request->event_name !== null, function ($query) use ($request) {
                return $query->where('name', 'like', '%'.$request->event_name.'%');
            })
            ->when($request->participants1 !== null && $request->participants2 === null, function ($query) use ($request) {
                return $query->where('number_of_participants', '>=', intval($request->participants1));
            })
            ->when($request->participants2 !== null && $request->participants1 === null, function ($query) use ($request) {
                return $query->where('number_of_participants', '<=', intval($request->participants2));
            })
            ->when($request->participants1 !== null && $request->participants2 !== null, function ($query) use ($request) {
                return $query->whereBetween('number_of_participants', [
                    intval($request->participants1),
                    intval($request->participants2)
                ]);
            })
            ->when($request->has('category_id') && $request->category_id!== null, function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            })
            ->when($request->has('event_status') && $request->event_status!== null, function ($query) use ($request) {
                return $query->where('event_status', $request->event_status);
            })
            ->when($request->amount1!== null && $request->amount2 === null, function ($query) use ($request) {
                return $query->where('amount', '>=', $request->amount1);
            })
            ->when($request->amount2 !== null && $request->amount1 === null, function ($query) use ($request) {
                return $query->where('amount', '<=', $request->amount2);
            })
            ->when($request->amount2!== null && $request->amount1!== null, function ($query) use ($request) {
                return $query->whereBetween('amount', [
                    number_format($request->amount1, 2, '.', ''),
                    number_format($request->amount2, 2, '.', '')
                ]);
            })
            ->when($request->has('datepicker1') && $request->datepicker1!== null && $request->datepicker2 === null, function ($query) use ($request) {
                return $query->where('start_date', '>=', $request->datepicker1);
            })
            ->when($request->has('datepicker2') && $request->datepicker2!== null && $request->datepicker1 === null, function ($query) use ($request) {
                return $query->where('start_date', '<=', $request->datepicker2);
            })
            ->when($request->datepicker2!== null && $request->datepicker1!== null, function ($query) use ($request) {
                return $query->whereBetween('start_date', [
                    $request->datepicker1,
                    $request->datepicker2
                ]);
            })
            ->where('event_status', '!=', 'pendente')
            ->orderBy('start_date', 'desc')
            ->paginate(10);

            $formFields                  = array();
            $formFields['event_name']    = $request->event_name;
            $formFields['participants1'] = $request->participants1;
            $formFields['participants2'] = $request->participants2;
            $formFields['category_id']   = $request->category_id;
            $formFields['amount1']       = $request->amount1;
            $formFields['amount2']       = $request->amount2;
            $formFields['event_status']  = $request->event_status;
            $formFields['datepicker1']   = $request->datepicker1;
            $formFields['datepicker2']   = $request->datepicker2;

            $Category = Category::orderBy('description', 'asc')->get();

            return view('pages.events.manager.index', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);

        }else{
            return redirect('/dashboard');
        }
    }


    /**
    * Display a listing of the events by manager_id with filters
    */
    public function searchEventsToApprove(Request $request)
    {
        $manager = Auth::user();

        if($manager->role_id == 2){

            $events = Event::where('manager_id', 0)
            ->when($request->has('event_name') && $request->event_name !== null, function ($query) use ($request) {
                return $query->where('name', 'like', '%'.$request->event_name.'%');
            })
            ->when($request->participants1 !== null && $request->participants2 === null, function ($query) use ($request) {
                return $query->where('number_of_participants', '>=', intval($request->participants1));
            })
            ->when($request->participants2 !== null && $request->participants1 === null, function ($query) use ($request) {
                return $query->where('number_of_participants', '<=', intval($request->participants2));
            })
            ->when($request->participants1 !== null && $request->participants2 !== null, function ($query) use ($request) {
                return $query->whereBetween('number_of_participants', [
                    intval($request->participants1),
                    intval($request->participants2)
                ]);
            })
            ->when($request->has('category_id') && $request->category_id!== null, function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            })
            ->when($request->has('event_status') && $request->event_status!== null, function ($query) use ($request) {
                return $query->where('event_status', $request->event_status);
            })
            ->when($request->amount1!== null && $request->amount2 === null, function ($query) use ($request) {
                return $query->where('amount', '>=', $request->amount1);
            })
            ->when($request->amount2 !== null && $request->amount1 === null, function ($query) use ($request) {
                return $query->where('amount', '<=', $request->amount2);
            })
            ->when($request->amount2!== null && $request->amount1!== null, function ($query) use ($request) {
                return $query->whereBetween('amount', [
                    number_format($request->amount1, 2, '.', ''),
                    number_format($request->amount2, 2, '.', '')
                ]);
            })
            ->when($request->has('datepicker1') && $request->datepicker1!== null && $request->datepicker2 === null, function ($query) use ($request) {
                return $query->where('start_date', '>=', $request->datepicker1);
            })
            ->when($request->has('datepicker2') && $request->datepicker2!== null && $request->datepicker1 === null, function ($query) use ($request) {
                return $query->where('start_date', '<=', $request->datepicker2);
            })
            ->when($request->datepicker2!== null && $request->datepicker1!== null, function ($query) use ($request) {
                return $query->whereBetween('start_date', [
                    $request->datepicker1,
                    $request->datepicker2
                ]);
            })
            ->where('event_status', '=', 'pendente')
            ->orderBy('start_date', 'desc')
            ->paginate(10);

            $formFields                  = array();
            $formFields['event_name']    = $request->event_name;
            $formFields['participants1'] = $request->participants1;
            $formFields['participants2'] = $request->participants2;
            $formFields['category_id']   = $request->category_id;
            $formFields['amount1']       = $request->amount1;
            $formFields['amount2']       = $request->amount2;
            $formFields['event_status']  = $request->event_status;
            $formFields['datepicker1']   = $request->datepicker1;
            $formFields['datepicker2']   = $request->datepicker2;

            $Category = Category::orderBy('description', 'asc')->get();

            return view('pages.events.manager.eventstoapprove', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields]);

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

            $events =  Event::paginate(10);
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



        return redirect('/dashboard')->with('success', 'Evento criado com sucesso!')->with('class', 'bg-green-500 text-white');
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
        $AuthUser = Auth::user();

        if($AuthUser->role_id == 2 &&  $AuthUser->id === $event->manager_id ){

            $event        = Event::find($event->id);
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
    public function update(Request $request, Event $event) //UpdateEventRequest
    {

       //dd($request);

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
            $event->ticket_amount          = $request->ticket_amount;

            if($AuthUser->id === $event->manager_id){
                $event->amount = $request->amount;
            }

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

            if($AuthUser->id === $event->manager_id){
                return redirect('/events/manager/'. $event->id.'/edit')->with('status','Evento editado com sucesso!')->with('class', 'alert-success');
            }else{
                return redirect('/events/owner/'. $event->id.'/edit')->with('status','Evento editado com sucesso!')->with('class', 'alert-success');
            }

        }else{
            return redirect('/dashboard')->with('status','Erro ao editar evento!')->with('class', 'alert-danger');
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
                return redirect('/events/owner/')->with('status','Evento cancelado com sucesso!')->with('class', 'alert-success');
            }else{
                if($AuthUser->role_id === 2){
                    return redirect('/events/manager/')->with('status','Evento cancelado com sucesso!')->with('class', 'alert-success');
                }
            }
        }

        return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-danger');
    }

    public function eventsbyparticipant()
    {
        $user   = auth()->user();
        $events = $user->events()->distinct()->get();
        $allEvents = $user->events()->distinct()->get();

        return view('pages.participants.participant-event-list', ['events' => $events, 'allEvents' => $allEvents]);
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

    public function exportbymanager(Request $request)
    {
        $AuthUser = Auth::user();

        if($AuthUser->role_id === 2 ){

            //$eventIdsString = "22,2,15,21,12,16,3,24,27,6";
            $eventIdsArray  = explode(',', $request->event_ids);
            $events = Event::whereIn('id', $eventIdsArray)->get();

            //:: HEADER
            $excelArray = array();
            $excelArray[0]["Nº"]                 = "Nº";
            $excelArray[0]["Nome"]               = "Nome";
            $excelArray[0]["Localização"]        = "Localização";
            $excelArray[0]["Data de Início"]     = "Data de Início";
            $excelArray[0]["Hora de Início"]     = "Hora de Início";
            $excelArray[0]["Data de Fim"]        = "Data de Início";
            $excelArray[0]["Hora de Fim"]        = "Hora de Fim";
            $excelArray[0]["Tipo de Evento"]     = "Tipo de Evento";
            $excelArray[0]["Custo do Evento"]    = "Custo do Evento";
            $excelArray[0]["Custo dos Serviços"] = "Custo dos Serviços";
            $excelArray[0]["Bilhete"]            = "Bilhete";
            $excelArray[0]["Proprietário"]       = "Proprietário";
            $excelArray[0]["Categoria"]          = "Categoria";
            $excelArray[0]["Nº participantes"]   = "Nº participantes";
            $excelArray[0]["Estado"]             = "Estado"  ;
            $excelArray[0]["Data da Criação"]    = "Data da Criação";

            $key = 1;
            foreach ($events as $event) {

                $owner    = User::find($event->owner_id);
                $category = Category::find($event->category_id);

                $excelArray[$key]["Nº"]                 = $event->id;
                $excelArray[$key]["Nome"]               = $event->name;
                $excelArray[$key]["Localização"]        = $event->localization;
                $excelArray[$key]["Data de Início"]     = $event->start_date;
                $excelArray[$key]["Hora de Início"]     = $event->start_time;
                $excelArray[$key]["Data de Fim"]        = $event->end_date;
                $excelArray[$key]["Hora de Fim"]        = $event->end_time;
                $excelArray[$key]["Tipo de Evento"]     = $event->type;
                $excelArray[$key]["Custo do Evento"]    = $event->amount;
                $excelArray[$key]["Custo dos Serviços"] = $event->services_amount;
                $excelArray[$key]["Bilhete"]            = $event->ticket_amount;
                $excelArray[$key]["owner_id"]           = $owner->name;
                $excelArray[$key]["category_id"]        = $category->description;
                $excelArray[$key]["Nº participantes"]   = $event->number_of_participants;
                $excelArray[$key]["Estado"]             = $event->event_status;
                $excelArray[$key]["Data da Criação"]    = date('Y-m-d', strtotime($event->created_at));

                $key++;
            }

            return Excel::download(new EventsbymanagerExport($excelArray), 'ManagerEventReport.xlsx');
        }
    }

    public function updatestatus(Event $event){

        $AuthUser = Auth::user();
        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id === 2 ){

            $event               = Event::find($event->id);
            $event->event_status = "pendente";
            $event->save();

            return redirect('/events/manager/')->with('status','Evento ativo com sucesso!')->with('class', 'alert-success');
        }

        return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-danger');
    }

    /**
     * Display the specified resource.
     */
    public function editsuppliers(Event $event)
    {
        $AuthUser = Auth::user();

        if($AuthUser->role_id == 2 &&  $AuthUser->id === $event->manager_id ){

            $event          = Event::find($event->id);
            $SupplierType   = SupplierType::all();
            $Suppliers      = Supplier::where('status', true)->with('supplierType')->orderBy('name', 'ASC')->get();
            $categories     = Category::all();
            $eventSuppliers = DB::table('event_supplier')->where('event_id',$event->id)->get();

            return view('pages.events.manager.supplier', ['event' => $event, 'categories' => $categories, 'SupplierType' => $SupplierType, 'Suppliers' => $Suppliers, 'eventSuppliers' => $eventSuppliers]);

        }else{
            return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-warning');
        }
    }


    public function updatesupplieronevent(Request $request, Event $event)
    {
        $AuthUser = Auth::user();

        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id == 2 && $AuthUser->id === $event->manager_id){

            $event = Event::find($event->id);

            foreach ($request->input as $key => $input) {

                $supplierId = intval($input['supplier']);
                $supplier   = Supplier::find($supplierId);

                if ($supplier) {

                    // check if the relationship already exists, just update the description and amount fields
                    $checkIfSupplierAlreadySync = DB::table('event_supplier')->where(['event_id' => $event->id,'supplier_id' => $supplier->id ])->exists();

                    if ($checkIfSupplierAlreadySync === false) {
                        // if not exists relatioship will be created
                        $supplier->events()->sync([
                            $event->id => [
                                'description' => $input['description'],
                                'amount'      => $input['amount'],
                            ]
                        ], false);
                    }else{
                        // if exists only will update input fields
                        DB::table('event_supplier')
                            ->where('event_id', $event->id)
                            ->where('supplier_id', $supplier->id)
                            ->update([
                                'description' => $input['description'],
                                'amount'      => $input['amount']
                        ]);
                    }
                }
            }

            Event::where('id', $event->id)
            ->update([
                'services_amount' => DB::table('event_supplier')
                    ->where('event_id', $event->id)
                    ->sum('amount')
            ]);



            return redirect('/events/manager/'. $event->id.'/supplier')->with('status','Evento ativo com sucesso!')->with('class', 'alert-success');
        }

        return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-danger');
    }


    public function deletesupplieronevent(Request $request, Event $event)
    {

        $AuthUser = Auth::user();
        // user roles is owner and he is the event (to show) owner

        if($AuthUser->role_id == 2 && $AuthUser->id === $event->manager_id){

            $event    = Event::find($event->id);
            $supplier = Supplier::find($request->delete_supplier_id);

            if ($event && $supplier) {

                $event->suppliers()->detach($supplier->id);

                Event::where('id', $event->id)
                ->update([
                    'services_amount' => DB::table('event_supplier')
                        ->where('event_id', $event->id)
                        ->sum('amount')
                ]);

                return redirect('/events/manager/'. $event->id.'/supplier')->with('status','Fornecedor removido com sucesso!')->with('class', 'alert-success');

            }
        }

        return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-danger');
    }



    public function eventtoaprrove(Event $event){

        $AuthUser = Auth::user();

        if($AuthUser->role_id == 2 &&  $event->manager_id == 0 ){

            $event = Event::find($event->id);
            $event->manager_id = $AuthUser->id;
            $event->event_status = 'ativo';
            $event->save();
            return redirect('/events/manager/approve')->with('status','Evento aceite com sucesso!')->with('class', 'alert-success');
        }

        return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-danger');
    }

    public function eventsFilter(Request $request)
    {
        $user   = auth()->user();
     //   $events = $user->events()->distinct()->get();
        $allEvents = $user->events()->distinct()->get();


        $name = $request->search;
        $startDate = $request->datepicker1;
        $endDate = $request->datepicker2;
       // dd($endDate);


        if (($startDate == null && $endDate == null) && $name == null)

            {
            $events = $user->events()->distinct()->get();
            return view('pages.participants.participant-event-list', ['events' => $events, 'allEvents' => $allEvents]);
            }

            elseif (($startDate == null && $endDate == null))
            {
                $events = $user->events()
                    ->distinct()
                    ->where('name', 'like', $name)
                    ->get();
             return view('pages.participants.participant-event-list', ['events' => $events, 'allEvents' => $allEvents]);
            }

           elseif (($startDate != null || $endDate != null) && $name != null) {

            if ($startDate == null) {
                $events = $user->events()
                ->distinct()
                ->where('name', 'like', $name)
                ->whereDate('end_date', '=', $endDate)
                ->get();
            } else {
                $events = $user->events()
                ->distinct()
                ->where('name', 'like', $name)
                ->whereDate('start_date', '=', $startDate)
                ->get();
            }
            return view('pages.participants.participant-event-list', ['events' => $events, 'allEvents' => $allEvents]);
           }
           elseif (($startDate != null || $endDate != null) && $name == null) {

            if ($startDate == null) {
                $events = $user->events()
                ->distinct()
                ->whereDate('end_date', '=', $endDate)
                ->get();
            } else {
                $events = $user->events()
                ->distinct()
                ->where('name', 'like', $name)
                ->whereDate('start_date', '=', $startDate)
                ->get();
            }
                return view('pages.participants.participant-event-list', ['events' => $events, 'allEvents' => $allEvents]);
           }

        // $user   = auth()->user();
        // $events = $user->events()->distinct()->get();

        // return view('pages.participants.participant-event-list', ['events' => $events]);
    }

    public function search(Request $request)
    {
        $query = Event::query();
    
        // Apenas eventos com data posterior ou igual à atual
        $query->where('start_date', '>=', now()->toDateString());
    
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }
    
        if ($request->filled('from_date')) {
            $query->where('start_date', '>=', $request->input('from_date'));
        }
    
        if ($request->filled('to_date')) {
            $query->where('start_date', '<=', $request->input('to_date'));
        }
    
        if ($request->filled('event_type') && $request->input('event_type') !== 'Todos') {
            $query->where('category_id', $request->input('event_type'));
        }
    
        if ($request->filled('availability')) {
            $availability = $request->input('availability');
            if ($availability === 'Disponível') {
                $query->where('number_of_participants', '<', 22);
            } elseif ($availability === 'Quase Esgotado') {
                $query->whereBetween('number_of_participants', [22, 49]);
            } elseif ($availability === 'Esgotado') {
                $query->where('number_of_participants', '>=', 50);
            }
        }
    
        $events = $query->get();
    
        if ($events->isEmpty()) {
            session()->flash('no_results', 'Não foram encontrados eventos para os parâmetros de pesquisa fornecidos.');
            $events = Event::where('type', 'publico')->where('start_date', '>=', now()->toDateString())->get();
        }
    
        return view('pages.events.public', compact('events'));
    }
    

    public function ExportByParticipant(Request $request)
    {
        $AuthUser = Auth::user();

        if($AuthUser->role_id === 4 ){

            //$eventIdsString = "22,2,15,21,12,16,3,24,27,6";
            $eventIdsArray  = explode(',', $request->event_ids);
            $events = Event::whereIn('id', $eventIdsArray)->get();

            //:: HEADER
            $excelArray = array();
            $excelArray[0]["Nº"]                 = "Nº";
            $excelArray[0]["Nome"]               = "Nome";
            $excelArray[0]["Data de Início"]     = "Data de Início";
            $excelArray[0]["Data de Fim"]        = "Data de Fim";
            $excelArray[0]["Bilhete"]            = "Bilhete";

            $key = 1;
            foreach ($events as $event) {

                $participant    = User::find($event->participant_id);

                $excelArray[$key]["Nº"]                 = $event->id;
                $excelArray[$key]["Nome"]               = $event->name;
                $excelArray[$key]["Data de Início"]     = $event->start_date;
                $excelArray[$key]["Data de Fim"]        = $event->end_date;
                $excelArray[$key]["Bilhete"]            = $event->ticket_amount;

                $key++;
            }

            return Excel::download(new EventsByParticipantExport($excelArray), 'ParticipantEventList.xlsx');
        }
    }

}
