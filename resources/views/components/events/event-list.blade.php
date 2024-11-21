<div class="flex-1 p-8 overflow-y-auto">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 
 <div class="container-fluid">
     <div class="d-flex align-items-center">
         <p class="text-sm/6 font-semibold text-gray-900">Events List</p>
     </div>
 </div>
 <table class="min-w-full bg-white border">
     <thead>
         <tr class="bg-gray-100">
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">ID</th>
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Nome</th>
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Localização</th>
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Participantes</th>
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Categoria</th>
             <!-- <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Fornecedor</th> -->
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Data de Início</th>
             <!-- <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Hora de Início</th>
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Data de Fim</th>
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Hora de Fim</th> -->
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Tipo de Evento</th>
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Custo</th>
             <th class="border border-gray-300 px-4 py-2 text-left font-medium text-gray-700">Ações</th>
         </tr>
     </thead>
     <tbody>
         @foreach($events as $event)
         <tr class="odd:bg-white even:bg-gray-50">
             <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration  }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->name }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->localization }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ @count($event->users) }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->category->description }}</td>
             <!-- <td class="border border-gray-300 px-4 py-2"> @foreach($event->suppliers as $supplier) {{ $supplier->name.';' }} @endforeach </td> -->
             <td class="border border-gray-300 px-4 py-2">{{ date('Y-m-d', strtotime($event->start_date))}}</td>
             <!-- <td class="border border-gray-300 px-4 py-2">{{ date('H:i', strtotime($event->start_time))}}</td>
             <td class="border border-gray-300 px-4 py-2">{{ date('Y-m-d', strtotime($event->end_date)) }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ date('H:i', strtotime($event->end_time)) }}</td> -->
             <td class="border border-gray-300 px-4 py-2">{{ $event->type }}</td>
             <td class="border border-gray-300 px-4 py-2">{{ $event->amount }}</td>
             <td class="border border-gray-300 px-4 py-2"> 
                <div class="d-flex align-items-center">
                    <a href="{{url('events/' . $event->id)}}"             class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-Orange-600">Show</a>
                    <a href="{{url('events/' . $event->id) . '/edit'}}"   class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
                    <a href="{{url('events/' . $event->id) . '/delete'}}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Delete</a>
            
                    <!-- <form action="{{url('events/' . $event->id)}}" method="POST" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" title="Delete">Delete</button>
                    </form> -->
                </div>
            </td>
        </tr>
        @endforeach
     </tbody>
 </table>
</div>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />

<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 mt-3">
            <div class="mb-3">
                <h5 class="card-title">Event List<span class="text-muted fw-normal ms-2">               
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
            <div class="col-md-6 ">
                <div class="form-group">
                    <form action="/searchEvents" method="POST">
                        @csrf
                        <div class="input-group">
                            <select class="form-control" id="search" name="search">
                                <option selected>Escolha o evento para listar participantes...</option>
                                @foreach ($events as $event)
                                <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' :'' }}>{{ $event->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary" >Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>  