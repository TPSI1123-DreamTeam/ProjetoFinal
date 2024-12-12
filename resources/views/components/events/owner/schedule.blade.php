<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div class="container-show-event">
    <div class="wrapper-show-event">
    <h1>Agenda - {{ $event->name }}</h1>

    <div class="linha-divisoria-event-manager"></div>

    <form id="formupdate" name="formupdate" method="POST" action="{{ url('/schedules/'.$event->id.'/update') }}"  class="show-event-form">

        @method('PATCH')
        @csrf

        <div class="btn">
            <button type="button" id="addschedule" class="supplier-add-event">Adicionar Campo</button>
        </div>

        <table id="table" class="table" style="margin: 2px">
            @foreach($event->schedules as $item)

                <td data-cell="nº">
                    {{ $loop->iteration }}
                </td>
                <td data-cell="order" style="width:5vh">
                    <label for="order"><h6 class="cost-tag">Ordem</h6></label>
                    <input type="text" class="form-control" name="input[{{ $item->id }}][order]"  id="input[{{  $item->id }}]['order']" value="{{ $item->order }}" min="0" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" min="0" >
                </td>
                <td data-cell="date" style="width:20vh">
                    <label for="date"><h6 class="cost-tag">Data</h6></label>
                    <input type="date" class="form-control" name="input[{{  $item->id }}][date]"  id="input[{{  $item->id }}]['date']" value="{{ $item->date }}" >
                </td>
                <td data-cell="time" style="width:10vh">
                    <label for="time"><h6 class="cost-tag">Hora</h6></label>
                    <input type="time" class="form-control" name="input[{{  $item->id }}][time]"  id="input[{{  $item->id }}]['time']" value="{{ date('H:i', strtotime($item->time))}}" >
                </td>
                <td data-cell="title">
                    <label for="inputAddress"><h6 class="title-tag">Título:</h6></label>
                    <input type="text" class="form-control" name="input[{{  $item->id }}][title]"  id="input[{{  $item->id }}]['title']" value="{{ $item->title }}" >
                </td>
                <td data-cell="descrição">
                    <label for="inputAddress"><h6 class="description-tag">Descrição:</h6></label>
                    <input type="text-area" class="form-control" name="input[{{  $item->id }}][description]"  id="input[{{  $item->id }}]['description']"  value="{{ $item->description }}" >
                </td>

                <input type="hidden" id="input[{{ $item->id }}][scheduleId]" name="input[{{ $item->id }}][scheduleId]"  value="{{$item->id}}" />

                <td data-cell="ações" class="remove-td"> 
                    <button type="button" id="delete-button" class="remove-btn delete-button" schedule="{{$item->id}}"  event="{{$event->id}}"  token="{{ csrf_token() }}">
                        <i class='bx bx-trash'></i>
                    </button>  
                </td>
            </tr>
        @endforeach

        @if(count($event->schedules)==0)
            <tr id="notification">
                <td data-cell="nº">
                    NAO EXISTEM REGISTOS
                </td>                
            </tr>
        @endif
        </table>

        <div class="add-supllier-btn">
                <button type="submit" class="update-supplier-event">Atualizar Agenda</button>
            <a href="{{ url('/events/owner/'.$event->id .'/edit') }}" class="go-back-btn-event">Voltar ao evento</a>
        </div>

    </form>
    </div>
</div>

@php
    $eventsJson     = json_encode($event->schedules);
    $eventsDataJson = json_encode($event->start_date);
    $eventsTimeJson = json_encode($event->start_time);
@endphp


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script>

$(document).ready(function () {

    const eventsData   = <?php echo $eventsJson; ?>;
    const totalEventos = eventsData.length;
    const eventStartDate = <?php echo $eventsDataJson; ?>;
    const eventStartTime = <?php echo $eventsTimeJson; ?>;

    let index = (totalEventos > 0) ? totalEventos : 1;

    $('#addschedule').on('click', function () {
        const notificationRow = document.getElementById('notification');
        if (notificationRow) {
            notificationRow.remove();
        }

        index++;
        const newRow = `
            <tr>
                <td data-cell="nº">
                    ${index}
                </td>
                <td data-cell="order" style="width:5vh">
                    <label for="order"><h6 class="cost-tag">Ordem</h6></label>
                    <input type="text" class="form-control" name="input[${index}][order]"  id="input[${index}]['order']" value="${index}" min="0" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" min="0" >
                </td>
                <td data-cell="date" style="width:20vh">
                    <label for="date"><h6 class="cost-tag">Data</h6></label>
                    <input type="date" class="form-control" name="input[${index}][date]"  id="input[${index}]['date']" value="${eventStartDate}" >
                </td>
                <td data-cell="time" style="width:10vh">
                    <label for="time"><h6 class="cost-tag">Hora</h6></label>
                    <input type="time" class="form-control" name="input[${index}][time]"  id="input[${index}]['time']" value="${eventStartTime.substr(0, 5)}" >
                </td>
                <td data-cell="title">
                    <label for="inputAddress"><h6 class="title-tag">Título:</h6></label>
                    <input type="text" class="form-control" name="input[${index}][title]"  id="input[${index}]['title']" value="" >
                </td>
                <td data-cell="descrição">
                    <label for="inputAddress"><h6 class="description-tag">Descrição:</h6></label>
                    <input type="text-area" class="form-control" name="input[${index}][description]"  id="input[${index}]['description']"  value="" >
                </td>

                <input type="hidden" id="input[${index}][scheduleId]" name="input[${index}][scheduleId]"  value="${index}"  />

                <td data-cell="ações" class="remove-td remove">
                    <button type="reset" id="delete-button" class="remove-btn delete-button" data-iteration="0">
                        <i class='bx bx-trash'></i>
                    </button>
                </td>
            </tr>
        `;

        $('#table').append(newRow);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    $('.delete-button').on('click', function(event) {
        event.preventDefault();
        let deleteId = $(this).attr('schedule');
        let eventId = $(this).attr('event');
        let token = $(this).attr('token');
        //console.log(deleteid)

        if (deleteId) {

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/schedules/' + eventId + '/delete';

            const input1 = document.createElement('input');
            input1.type = 'hidden';
            input1.name = '_method';
            input1.value = 'PATCH';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = token;
            form.appendChild(csrfToken);

            const input2   = document.createElement("input");
            input2.type  = "hidden";
            input2.id    = `deleteId`;
            input2.name  = `deleteId`;
            input2.value = deleteId;

            form.appendChild(input1);
            form.appendChild(input2);
            document.body.appendChild(form);
            form.submit();        
        }

    });
});

</script>
