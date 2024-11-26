<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;
use App\Imports\ParticipantsImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ownerId = Auth::user()->id;

        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        $events = $query->get();

        return view('pages.participants.index', ['participants' => null, 'events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Participant $participant)
    {
        return view('pages.participants.create',['participant' => $participant]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParticipantRequest $request)
    {
       // $this->validate($request, [
         //   'name'  => 'required',
          //  'phone'  => 'required',
        //    'confirmation'  => 'required'
      //  ]);

        Participant::create($request->all());

        return redirect('participants')->with('status','Participante adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        return view('pages.participants.show', ['participant' => $participant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        return view('pages.participants.edit', ['participant' => $participant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        $participant->update($request->all());
        return redirect('participants')->with('status','Participante editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect('participants')->with('status','Participante removido com sucesso!');
    }

    public function eliminate(Participant $participant)
    {
        Participant::whereNotNull('id')->delete();
        return redirect('participants')->with('status','Todas os participantes foram Removidos!');
    }

    // EXCEL FUNCTIONS  //

    public function export(Request $request)
    {
        $url = $request->server('PATH_INFO'); // Encontra o número após a última barra
        if (preg_match('/\/(\d+)$/', $url, $matches)) {
            $number = (int) $matches[1];
            //echo $number;
        }


        $participants = Event::find($number);


       // dd($participants->users);
        return Excel::download(new ParticipantsExport($participants->users), 'participants.xlsx');
    }

    public function import(Request $request, $emailsArray)
    {
        $url = $request->server('PATH_INFO'); // Encontra o número após a última barra
        if (preg_match('/\/(\d+)$/', $url, $matches)) {
            $eventId = (int) $matches[1];
            //echo $number;
        }

        // Receber o arquivo Excel enviado
        $file = $request->file('file');

        // Usar o método toArray para ler o Excel e convertê-lo para um array
       // $data = Excel::toArray([], $file);

       $participantsExcel = Excel::toArray(new ParticipantsImport(), $file);
       // dd($emailsArray);
        dd($participantsExcel);

        $ownerId = Auth::user()->id;
        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        $events = $query->get();

        $participantsDb = Event::find($eventId);

        $users = [];
       // dd($users);
        $participantsD = [];
        $tempParticipants[0] = 'N';
        $tempParticipants[1] = 'Name';
        $tempParticipants[2] = 'Phone';
        $tempParticipants[3] = 'Email';
        $tempParticipants[4] = 'Confirmation';

        foreach ($participantsDb->users as $participant) {
            // Tentativa de iterar user a user que está no evento específico para
            // guardar num array
            $tempParticipants[1] = $participantsDb->pivot->name;
            $tempParticipants[2] = $participantsDb->pivot->$phone;
            $tempParticipants[3] = $participantsDb->pivot->$email;
            $tempParticipants[4] = $participantsDb->pivot->$confirmation;
            $users = $tempParticipants;
        }
       dd($users);
        $participants = [];


        foreach ($participantsExcel as $excelParticipant) {
            // Supondo que $excelParticipant seja um array associativo
            $excelEmail = $excelParticipant['email'];  // Acessa o email do Excel

            $foundMatch = false;  // Variável para verificar se encontrou uma correspondência

            foreach ($participantsDb as $dbParticipant) {
                // Supondo que $dbParticipant seja um objeto
                if ($excelEmail === $dbParticipant->email) {
                   // echo "Email encontrado: " . $excelEmail . "\n";
                    $foundMatch = true;
                    break;  // Sai do loop interno quando encontrar o email
                }
            }

            // Se não encontrar nenhuma correspondência no banco de dados
            if (!$foundMatch) {
               // echo "Email não encontrado no banco de dados: " . $excelEmail . "\n";

                // Adiciona o participante ao array $participants se o email for diferente
                // Podemos adicionar a linha completa do participante Excel
                $participants[] = $excelParticipant;  // Adiciona a linha ao array
            }
        }


        dd($participants);

        // if ($participants == null) {
        //     return ('Todos os participantes contidos no ficheiro já existem nesta lista de evento');
        // } else {
        //     return view('pages.participants.index', ['participants' => $participants, 'events' => $events]);
        // }


        return view('pages.participants.index', ['participants' => $participants, 'events' => $events]);
       // return redirect('participants')->with('success', 'All good!');
    }


    public function searchEvents(Request $request)
    {
        $ownerId = Auth::user()->id;
        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        $events = $query->get();

        $participants = Event::find($request->search);

        return view('pages.participants.index', ['participants' => $participants, 'events' => $events]);

    }

    public function editState(Request $request)
    {
        if ($request->confirmation == false) {

            $user = User::find($request->user);
            $event = Event::find($request->event);

            $pivot = $user->events()->where('event_id', $event->id)->first();

            if ($pivot) {
                // Alterna o valor do campo 'confirmed'
                $pivot->pivot->confirmation = 1;
                $pivot->pivot->save();  // Salva a alteração
            }

        } else if ($request->confirmation == true) {

            $user = User::find($request->user);
            $event = Event::find($request->event);

            $pivot = $user->events()->where('event_id', $event->id)->first();

            if ($pivot) {
                // Alterna o valor do campo 'confirmed'
                $pivot->pivot->confirmation = 0;
                $pivot->pivot->save();  // Salva a alteração
            }
        }

        return redirect()->to('/participants');
    }

    public function detachParticipant(Request $request)
    {
            $user = User::find($request->user);
            $event = Event::findOrFail($request->event);

            $pivot = $user->events()->where('event_id', $event->id)->first();

            // Remove o participante da relação
            if ($pivot) {
                $event->users()->detach($user);
            }
            
            return redirect()->to('/participants');

    }


}
