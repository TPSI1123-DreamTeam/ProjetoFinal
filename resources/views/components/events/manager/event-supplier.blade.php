<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container-show-event">
    <div class="wrapper-show-event">
    <h1>{{ $event->name }}</h1>

    <div class="linha-divisoria-event-manager"></div>

        <form  method="POST" action="{{ url('/events/manager/'.$event->id .'/updatesupplier') }}" enctype="multipart/form-data" class="show-event-form">
            @method('PATCH')
            @csrf

            @php
                function imageExists($imagePath)
                {
                    return file_exists(public_path($imagePath));
                }

                $imagePath = 'images/' . $event->image;
                $imageSrc = imageExists($imagePath) ? $imagePath : 'images/noimage_default.jpg';
            @endphp

            <div class="show-event-image">
                <img src="{{ asset($imageSrc) }}" alt="Imagem do Evento">
            </div>

            <div class="client-options-header">
                <h2>Opções base do cliente</h2>
            </div>

            <div class="checkbox-group">
                @php
                    $servicesArray = json_decode($event->services_default_array, true);
                @endphp 
                    @foreach($SupplierType as $type)
                    <div class="suppliers-input">
                        <tr>   
                            <input type="checkbox" id="suppliers[]" name="suppliers[]" value="{{$type->id}}" disabled                            
                                @if(!empty($servicesArray) && in_array($type->id, $servicesArray))
                                    checked
                                @endif
                            > {{  $type->name }}         
                        </tr>
                    </div>
                    @endforeach       
            </div>

            <div class="form-row">            
                <div class="form-group">
                    <label for="number_of_participants">Custo do Evento</label>
                    <input type="text" class="form-control" name="amount"  id="amount" value="{{ $event->amount }}" min="30" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" min="0" disabled >
                </div>
                
                <div class="form-group">
                    <label for="services_amount">Custo dos Serviços</label>
                    <input type="text" class="form-control" name="services_amount"  id="services_amount" value="{{ number_format($event->services_amount, 2, ',', '.') }}"  disabled>
                </div>

                                
                <div class="form-group">
                    <label for="services_amount">Margem (Estimado)</label>
                    <input type="text" class="form-control"  value="{{ number_format($event->amount - $event->services_amount, 2, ',', '.') }}"  disabled>
                </div>

                <div class="form-group">
                    <label for="ticket_amount">Custo do Bihete (Quando Aplicável)</label>
                    <input type="text" class="form-control" name="ticket_amount"  id="ticket_amount" value="{{ number_format($event->ticket_amount, 2, ',', '.') }}" min="30" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" min="0" disabled>
                </div>
            </div>
            <div>
                <button type="button" id="addsupplier" class="supplier-add-event">Adicionar Fornecedor</button>
            </div>
            <table id="table" class="table" style="margin: 2px">
            @foreach($eventSuppliers as $supplier)
                <tr> 
                    <td data-cell="nº">
                        {{ $loop->iteration }}
                    </td>
                    <td data-cell="fornecedor" style="width:40vh">       
                        <label for="inputGroupSelect01"><h6 class="supplier-tag">Fornecedor:</h6></label>
                        <select id="input[{{ $loop->index }}]['supplier']" name="input[{{ $loop->index }}][supplier]" class="form-control supplier_list supplier{{$loop->iteration}}" data-iteration="{{ $loop->index }}">
                            <option>Selecione o Fornecedor a associar:</option>
                            @foreach ($Suppliers as $item)     
                            <option value="{{ $item->id }}"  @if( $item->id === $supplier->supplier_id ) selected @endif > {{ $item->name }} - ({{ $item->supplierType->name }})</option>
                            @endforeach
                        </select>      
                    </td>
                    <td data-cell="descrição">   
                        <label for="inputAddress"><h6 class="description-tag">Descrição do Serviço:</h6></label>
                        <input type="text-area" class="form-control" name="input[{{ $loop->index }}][description]"  id="input[{{ $loop->index }}]['description']"  value="{{ $supplier->description }}"  >
                    </td>
                    <td data-cell="custo" style="width:25vh">                   
                        <label for="amount"><h6 class="cost-tag">Custo do Serviço:</h6></label>
                        <input type="text" class="form-control" name="input[{{ $loop->index }}][amount]"  id="input[{{ $loop->index }}]['amount']" value="{{ $supplier->amount }}" placeholder="0.00€" min="30" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" min="0" >                    
                    </td>
                    <td data-cell="ações" class="remove-td">                
                        <form id="formdelete{{ $loop->index }}" action="{{url('/events/manager/'. $event->id.'/deletesupplieronevent/')}}" method="POST">
                            @csrf
                            @method('PATCH')     
                            <button type="button" id="delete-button" class="remove-btn" data-iteration="{{ $loop->index }}">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>  
            @endforeach   

            @if(count($eventSuppliers)==0)
                <tr> 
                    <td data-cell="nº">
                        1
                    </td>
                    <td data-cell="fornecedor" style="width:40vh">       
                        <label class="" for="inputGroupSelect01"><h6 class="supplier-tag">Fornecedor:</h6></label>
                        <select id="input[0]['supplier']" name="input[0][supplier]" class="form-control supplier_list supplier0" data-iteration="0">
                            <option>Selecione o Fornecedor a associar:</option>
                            @foreach ($Suppliers as $item)     
                            <option value="{{ $item->id }}"> {{ $item->name }} - ({{ $item->supplierType->name }})</option>
                            @endforeach
                        </select>      
                    </td>
                    <td data-cell="descrição">   
                        <label for="inputAddress"><h6 class="description-tag">Descrição do Serviço:</h6></label>
                        <input type="text-area" class="form-control" name="input[0][description]"  id="input[0]['description']"  value=""  >
                    </td>
                    <td data-cell="custo" style="width:25vh">                   
                        <label for="amount"><h6 class="cost-tag">Custo do Serviço:</h6></label>
                        <input type="text" class="form-control" name="input[0][amount]"  id="input[0]['amount']" value="" placeholder="0.00€" min="30" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" min="0" >                    
                    </td>
                    <td data-cell="ações" class="remove-td">                
                        <form id="formdelete0" action="{{url('/events/manager/'. $event->id.'/deletesupplieronevent/')}}" method="POST">
                            @csrf
                            @method('PATCH')     
                            <button type="button" id="delete-button" class="remove-btn" data-iteration="0">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>  
            @endif
            </table> 
            <div class="add-supllier-btn"> 
                <button type="submit" class="update-supplier-event">Atualizar Evento</button> 
                <a href="/events/manager" class="go-back-btn-event">Voltar a lista de eventos</a> 
            </div>
        </form>
    </div>
</div>


<script>

    $(document).ready(function () {

    let index = 0; 

    @if(count($eventSuppliers)>0)
    index =  {{ count($eventSuppliers) }};
    index--;
    @endif
 
    $('#addsupplier').on('click', function () {
        index++;
        const newRow = `
            <tr>
                <td data-cell="nº">
                    ${index+1}
                </td>
                <td data-cell="fornecedor" style="width:40vh">       
                    <label class="" for="inputGroupSelect${index}"><h6 class="supplier-tag">Fornecedor:</h6></label>
                    <select id="input[${index}]['supplier']" name="input[${index}][supplier]" class="form-control supplier_list supplier[${index}]">
                        <option>Selecione o Fornecedor a associar:</option>
                        @foreach ($Suppliers as $item)     
                        <option value="{{ $item->id }}"> {{ $item->name }} - ({{ $item->supplierType->name }})</option>
                        @endforeach
                    </select>      
                </td>
                <td data-cell="descrição">   
                    <label for="input[${index}][description]"><h6 class="description-tag">Descrição do Serviço:</h6></label>
                    <input type="text-area" class="form-control" name="input[${index}][description]"  id="input[${index}]['description']"  value="">
                </td>
                <td data-cell="custo" style="width:25vh">                   
                    <label for="input[${index}][amount]"><h6 class="cost-tag">Custo do Serviço:</h6></label>
                    <input type="text" class="form-control" name="input[${index}][amount]"  id="input[${index}]['amount']" value="" placeholder="0.00€" 
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" step="0.01" min="0">                    
                </td>
                <td data-cell="ações" class="remove-td">                
                    <form id="formdelete${index}" action="{{url('/events/manager/'. $event->id.'/deletesupplieronevent/')}}" method="POST">
                        @csrf
                        @method('PATCH')     
                        <button type="button" id="delete-button" class="remove-btn" data-iteration="${index}">
                            <i class='bx bx-trash'></i>
                        </button>
                    </form>
                </td>
            </tr>
        `;
     
        $('#table').append(newRow);
    });
});

    document.addEventListener('DOMContentLoaded', function () {
        const supplierSelects = document.querySelectorAll('.supplier_list');

        supplierSelects.forEach(select => {
            select.addEventListener('change', function () {
                updateSupplierOptions();
            });
        });

        function updateSupplierOptions() {
            // Obtenha todos os valores atualmente selecionados
            const selectedSuppliers = Array.from(supplierSelects)
                .map(select => select.value)
                .filter(value => value !== ""); // Filtre valores não selecionados

            // Atualize as opções disponíveis em cada select
            supplierSelects.forEach(select => {
                const options = select.querySelectorAll('option');

                options.forEach(option => {
                    // Habilite todas as opções primeiro
                    option.disabled = false;

                    // Desabilite se o valor da opção já estiver selecionado em outro select
                    if (selectedSuppliers.includes(option.value) && select.value !== option.value) {
                        option.disabled = true;
                    }
                });
            });
        }

        // Inicialize as opções ao carregar a página
        updateSupplierOptions();    
    });



    $(document).ready(function() {
        // Delegando o evento 'change' a um elemento pai comum (ex: o form)
        $('form').on('change', '.supplier_list', function() {
            var selectedValue = $(this).val(); // Obtém o valor selecionado

            // Verifica se há outros selects com o mesmo valor selecionado
            var otherSelected = $('.supplier_list').not(this).filter(function() {
                return $(this).val() === selectedValue;
            });

            if (otherSelected.length > 0) {
                alert('Este fornecedor já foi selecionado, selecione outra opção!');
                $(this).val(''); // Limpa o valor do select atual
            }
        });
    });



    $('.delete-button').on('click', function() {

        let iteration     = $(this).attr('data-iteration');
        let selectElement = document.querySelector(`#input\\[${iteration}\\]\\[\\'supplier\\'\\]`);

        if (selectElement) {

            let selectedValue = selectElement.value;

            let form = document.querySelector(`#formdelete${iteration}`);

            if (form) {
                // Crie o elemento input
                let input   = document.createElement("input");
                input.type  = "hidden";
                input.id    = `delete_supplier_id`;
                input.name  = `delete_supplier_id`;
                input.value = selectedValue;

                form.appendChild(input);                
            }               
            form.submit();   
        }     
    });

</script>