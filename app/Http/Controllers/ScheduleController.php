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