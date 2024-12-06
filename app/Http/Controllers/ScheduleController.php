<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        return view('pages.events.owner.schedule', ['event' => $event] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        // $owner_id = Auth::user()->id;

        // $event = Event::create([
        //     'name'                   => $request->name,
        //     'description'            => $request->description,
        //     'localization'           => $request->localization,            
        //     'start_date'             => $request->start_date,
        //     'end_date'               => $request->end_date,
        //     'owner_id'               => $owner_id,
        //     'category_id'            => $request->category_id, 
        //     'type'                   => $request->type,
        //     'amount'                 => "0.00",
        //     'ticket_amount'          => "0.00",
        //     'start_time'             => $request->start_time,
        //     'end_time'               => $request->end_time,
        //     'number_of_participants' => $request->number_of_participants,
        //     'event_confirmation'     => false,
        //     'services_default_array' => json_encode($request->suppliers)
        // ]);

        // // check and store image
        // if($request->has('image')){
        //     $file      = $request->file('image');
        //     $imageName = time().'.'.$request->image->extension();
        //     $path      = 'images/events/'.$event->id;

        //     $request->image->move(public_path($path), $imageName);

        //     // save image
        //     $update = Event::find($event->id);
        //     $update->image = $imageName;
        //     $update->save();      
        // }

 

        return redirect('/dashboard')->with('success', 'Evento criado com sucesso!')->with('class', 'bg-green-500 text-white');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $AuthUser = Auth::user(); 

        // user roles is owner and he is the event (to show) owner
        if($AuthUser->role_id == 3 && $AuthUser->id === $event->owner_id){                

            foreach ($request->input as $key => $input) {

                $scheduleId    = intval($input['scheduleId']);
                $checkschedule = DB::table('event_schedule')->where(['event_id' => $event->id, 'schedule_id' => $scheduleId])->exists();                

                if (is_null($checkschedule) || false === $checkschedule) {

                    $schedule = Schedule::create([
                        'order'      => $input['order'],
                        'date'       => $input['date'],
                        'time'       => $input['time'],
                        'title'      => $input['title'],
                        'description' => $input['description']
                    ]);
                
                    $events = Event::find($event->id);
                    $events->schedules()->attach($schedule);        
                       
                }else{

                    DB::table('schedules')
                            ->where('id', $scheduleId)                           
                            ->update([
                                'order'       => $input['order'],
                                'date'        => $input['date'],
                                'time'        => $input['time'],
                                'title'       => $input['title'],
                                'description' => $input['description']
                        ]);               
                }
            }    
                    
            return redirect('/schedules/'.$event->id)->with('status','Agenda atualizada com sucesso!')->with('class', 'alert-success');
        }   

        return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-danger');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, Event $event)
    {
        $AuthUser = Auth::user(); 
        // user roles is owner and he is the event (to show) owner

        if($AuthUser->role_id == 3 && $AuthUser->id === $event->owner_id){ 

            $event    = Event::find($event->id);
            $Schedule = Schedule::find($request->deleteId);  

            if ($event && $Schedule) { 
                $event->schedules()->detach($Schedule);                 
                return redirect('/schedules/'.$event->id)->with('status','Agenda atualizada com sucesso!')->with('class', 'alert-success');

            }
        }

        return redirect('/dashboard')->with('status','Desculpe, algo correl mal!')->with('class', 'alert-danger');
    }
}
