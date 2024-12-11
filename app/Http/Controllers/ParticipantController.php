<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Exports\ParticipantsExport;
use App\Imports\ParticipantsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;

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
        $trueId = 0;

        return view('pages.participants.index', ['participants' => null, 'events' => $events, 'trueId' => $trueId]);
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
        return redirect('participants')->with('status','Todos os participantes foram Removidos!');
    }

    public function export(Request $request)
    {
        $url = $request->server('PATH_INFO'); dd($request);
        if (preg_match('/\/(\d+)$/', $url, $matches)) {
            $number = (int) $matches[1];            
        }

        $participants = Event::find($number);

        return Excel::download(new ParticipantsExport($participants->users), 'participants.xlsx');
    }

    public function import(Request $request, $eventId)
    {  
        $file  = $request->file('file');
        $event = Event::findOrFail($eventId);

        // Importa os dados do Excel
        $rows = Excel::toArray([], $request->file('file'));
 
        // Obtém os participantes existentes no evento
        $existingParticipants = $event->users->map(function ($user) {
            return [
                'nome'        => strtolower(trim($user->name)),
                'telefone'    => strtolower(trim($user->phone)),
                'email'       => strtolower(trim($user->email)),
                'confirmação' => strtolower(trim($user->pivot->confirmation)),
            ];
        });

        $primeiroArray   = collect($rows[0]);
        $arrayComparacao = collect($existingParticipants);

        // Verificar diferenças: users do primeiro array que não estão no segundo
        $diferencas = $primeiroArray->filter(function ($user) use ($arrayComparacao) {
            return !$arrayComparacao->contains(function ($compUser) use ($user) {
                return
                    strtolower($compUser['nome'])  === strtolower($user[1]) &&
                    (string)$compUser['telefone']  === (string)$user[2] &&
                    strtolower($compUser['email']) === strtolower($user[3]) &&
                    $compUser['confirmação']       === ($user[4] === "Sim" ? "1" : "0");
            });
        });

        $diferencas->shift(); 
        // Remove a primeira linha do array que neste caso contém os dados do header (Dados não necessários)

         $emailsDiferencas = $diferencas->pluck(3)->toArray(); 
         // Posição 3 contém o email no $diferencas
   
        $defaultImg = 'public/images/noimage_default.jpg';

        // Adicionar os usuários ao evento
        foreach ($diferencas as $user) {


            $userModel = User::firstOrCreate(
                ['email' => $user[3]], // Condição de busca
                [                           // Preencher os campos caso o usuário não exista
                    'name'     => $user[1],
                    'image'    => $defaultImg, //  usado para testar na parte da imagem par não dar erro
                    'phone'    => strval($user[2]),
                    'email'    => $user[3],
                    'password' => 'Teste123#',  // <--- Convém notificar new users disto
                ]
            );
  
            $event->users()->syncWithoutDetaching([$userModel->id]);
        }

        $statusMessage = 'Importação concluída com sucesso!';

        return redirect()->to('/participants')->with('status', $statusMessage);
    }


    public function searchEvents(Request $request)
    {
        if ($request->search == "Escolha o evento para listar participantes...") {
            return redirect()->to('/participants')->with('error','Selecione uma opção válida');
        }

        $ownerId = Auth::user()->id;
        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        $events  = $query->get();

        $participants = Event::find($request->search);
        $trueId = $participants->id;    
        // $trueId guarda o id do evento escolhido na pesquisa
        return view('pages.participants.index', ['participants' => $participants, 'events' => $events, 'trueId' => $trueId]);

    }

    public function editState(Request $request)
    {
        if ($request->confirmation == false) {

            $user  = User::find($request->user);
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
        return redirect()->to('/participants')->with('status','Estado do participante alterado com sucesso!');
    }

    public function detachParticipant(Request $request)
    {
            $user  = User::find($request->user);
            $event = Event::findOrFail($request->event);
            $pivot = $user->events()->where('event_id', $event->id)->first();

            // Remove o participante da relação
            if ($pivot) {
                $event->users()->detach($user);
            }

            return redirect()->to('/participants')->with('status','Participante removido com sucesso!');

    }

    public function addParticipant(Request $request)
    {
        $name   = $request->pName;
        $number = $request->phoneNumber;
        $email  = $request->email;
        $trueId = $request->trueId;

        if (empty($name) || empty($number) || empty($email)) {
            return redirect()->route('participants.index', ['event_id' => $trueId])
                             ->with('error', 'Preencha todos os campos obrigatórios!');
        }

        $user = User::where('email', $email)->first();
        $event = Event::where('id', $trueId)->first();

        if ($user) {
            $isInEvent = $user->events()->where('event_id', $trueId)->exists();
            if ($isInEvent) {
                return redirect()->route('participants.index', ['event_id' => $trueId])
                                 ->with('error', 'Participante já associado ao evento!');
            } else {
                $event->users()->syncWithoutDetaching([$user->id]);
                return redirect()->route('participants.index', ['event_id' => $trueId])
                                 ->with('status', 'Participante já registado adicionado ao evento!');
            }
        } else {
            
            $defaultImg = 'public/images/noimage_default.jpg';
            $userModel  = User::create([
                'name'     => $name,
                'image'    => $defaultImg,
                'phone'    => strval($number),
                'email'    => $email,
                'password' => bcrypt('Teste123#'), 
            ]);

            $event->users()->syncWithoutDetaching([$userModel->id]);
            return redirect()->route('participants.index', ['event_id' => $trueId])
                             ->with('warning', 'Participante registado e associado ao evento! Forneça a senha "Teste123#" ao participante para que possa aceder à sua conta.');
        }
    }
}
