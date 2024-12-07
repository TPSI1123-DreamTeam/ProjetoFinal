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
        $trueId = 0; // Colocação da variável $trueId para prevenir erros;

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

    public function import(Request $request, $eventId)
    {
        // Valida o ficheiro enviado
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,csv',
        // ]);
        $file = $request->file('file');

        //dd($eventId);
        // Obtém o evento
        $event = Event::findOrFail($eventId);

        // Importa os dados do Excel
        $rows = Excel::toArray([], $request->file('file'));

      // dd($rows);


        // Obtém os participantes existentes no evento
        $existingParticipants = $event->users->map(function ($user) {
            return [
                'nome' => strtolower(trim($user->name)),
                'telefone' => strtolower(trim($user->phone)),
                'email' => strtolower(trim($user->email)),
                'confirmação' => strtolower(trim($user->pivot->confirmation)),
            ];
        });

        $primeiroArray = collect($rows[0]);
        $arrayComparacao = collect($existingParticipants);

        // dd($arrayComparacao);

        // Verificar diferenças: users do primeiro array que não estão no segundo
        $diferencas = $primeiroArray->filter(function ($user) use ($arrayComparacao) {
            return !$arrayComparacao->contains(function ($compUser) use ($user) {
                return
                    strtolower($compUser['nome']) === strtolower($user[1]) &&
                    (string)$compUser['telefone'] === (string)$user[2] &&
                    strtolower($compUser['email']) === strtolower($user[3]) &&
                    $compUser['confirmação'] === ($user[4] === "Sim" ? "1" : "0");
            });
        });

        // Resultado final
       // dd($diferencas->values()->all());

        $diferencas->shift(); // Remove a primeira linha do array que neste caso contém os dados do header (Dados não necessários)

     //   dd($diferencas);

         $emailsDiferencas = $diferencas->pluck(3)->toArray(); // Posição 3 contém o email no $diferencas

    //    dd($emailsDiferencas);

       // Consultar na base de dados se os users contidos em $emailsDiferencas existem. Se existem, são adicionados
      //  ao array $usersExistentes já com as propriedades iguais ás da tabela nos quais os users estão contidos num evento
    //     $usersExistentes = User::whereIn('email', $emailsDiferencas)  // Filtrar pelos emails do $emailsDiferencas
    //     ->get(['name', 'phone', 'email']) // Obter os campos desejados
    //     ->map(function ($user)  {
    //     return [
    //         'name' => $user->name,
    //         'phone' => $user->phone,
    //         'email' => $user->email,
    //         'confirmation' => "Não",
    //     ];
    //          })
    // ->toArray();

        //    dd($usersExistentes);
      //  dd($usersExistentes);
   //  dd($diferencas);

    $defaultImg = 'public/images/noimage_default.jpg';

             // Adicionar os usuários ao evento
    foreach ($diferencas as $user) {
    // Buscar ou criar o usuário com base no email

   // dd($usersExistentes);
    $userModel = User::firstOrCreate(
        ['email' => $user[3]], // Condição de busca
        [                           // Preencher os campos caso o usuário não exista
            'name' => $user[1],
            'image' => $defaultImg, //  usado para testar na parte da imagem par não dar erro
            'phone' => strval($user[2]),
            'email' => $user[3],
            'password' => 'Teste123#',  // <--- Convém notificar new users disto
        ]
    );
  //  dd($userModel);
    // Associar o user ao evento (se ainda não estiver associado)
   // dd($userModel->id);
    $event->users()->syncWithoutDetaching([$userModel->id]);
    }

    return redirect()->to('/dashboard');

    }


    public function searchEvents(Request $request)
    {
        //dd($request);
        if ($request->search == "Escolha o evento para listar participantes...") {
            return redirect()->back();
        }
        $ownerId = Auth::user()->id;
        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        // dd($query);
        $events = $query->get();

        $participants = Event::find($request->search);
      //  dd($participants->id); -> ID do Evento - possivel passar para a view noutra variável
        $trueId = $participants->id;    // $trueId guarda o id do evento escolhido na pesquisa
        return view('pages.participants.index', ['participants' => $participants, 'events' => $events, 'trueId' => $trueId]);

    }

    public function editState(Request $request)
    {
        if ($request->confirmation == false) {

         //   dd($request);
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
      //  dd($pivot->pivot);
        return redirect()->to('/participants');
    }

    public function detachParticipant(Request $request)
    {
            $user = User::find($request->user);
            $event = Event::findOrFail($request->event);

        //dd($event->id);

            $pivot = $user->events()->where('event_id', $event->id)->first();

            // Remove o participante da relação
            if ($pivot) {
                $event->users()->detach($user);
            }

            return redirect()->to('/dashboard');

    }

    public function addParticipant(Request $request)
    {
        //dd($request);

      $name = $request->pName;
      $number = $request->phoneNumber;
      $email = $request->email;
      $trueId = $request->trueId;
     // dd($request);

        if (($name == null || $name == "") || ($number == null || $number == "") || ($email == null || $email == "")) {
        $ownerId = Auth::user()->id;
        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        // dd($query);
        $events = $query->get();
        $participants = Event::find($request->search);

        return view('pages.participants.index', ['participants' => $participants, 'events' => $events, 'trueId' => $trueId]);
        }
        else
        {
            $user = User::where('email', $email)->first();
            $events = Event::where('id', $trueId)->first();
           // dd($user);
            if ($user != null) {
                $isInEvent = $user->events()->where('event_id', $trueId)->exists(); // Verifica se o user pertence ao evento
                                                                                    // e dá return de true ou false
                // dd($isInEvent);
                if ($user != null && $isInEvent)
                {
                // User existe e pertence ao evento - Não adiciona
                $ownerId = Auth::user()->id;
                $query   = Event::query();
                $query->where('owner_id',$ownerId);
                // dd($query);
                $events = $query->get();
                $participants = Event::find($request->search);
                return view('pages.participants.index', ['participants' => $participants, 'events' => $events, 'trueId' => $trueId]);
                }
                elseif ($user != null && !$isInEvent)
                {
                // User existe e adiciona o user ao evento
                $event = Event::where('id', $trueId)->first();
                $event->users()->syncWithoutDetaching([$user->id]);

                $ownerId = Auth::user()->id;
                $query   = Event::query();
                $query->where('owner_id',$ownerId);
                // dd($query);
                $events = $query->get();
                $participants = Event::find($request->search);
                return view('pages.participants.index', ['participants' => $participants, 'events' => $events, 'trueId' => $trueId]);
                }
            }
            else
            {
                // User não existe. USer é criado e adicionado ao evento
                $defaultImg = 'public/images/noimage_default.jpg';
                $userModel = User::Create(
                    [                           // Preencher os campos caso o usuário não exista
                        'name' => $name,
                        'image' => $defaultImg, //  usado para testar na parte da imagem par não dar erro
                        'phone' => strval($number),
                        'email' => $email,
                        'password' => 'Teste123#',  // <--- Convém notificar new users disto
                    ]
                );
              //  dd($userModel);
                // Associar o user ao evento
               $event = Event::where('id', $trueId)->first();
               $event->users()->syncWithoutDetaching([$userModel->id]);

               $ownerId = Auth::user()->id;
                $query   = Event::query();
                $query->where('owner_id',$ownerId);
                // dd($query);
                $events = $query->get();
                $participants = Event::find($request->search);
                return view('pages.participants.index', ['participants' => $participants, 'events' => $events, 'trueId' => $trueId]);
            }
        }

    }
}
