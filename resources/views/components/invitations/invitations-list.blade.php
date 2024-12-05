


<h1>Lista de Convites</h1>

<div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
    <div class="col-md-6 ">
      <div class="form-group">
        <form action="/findEventInvitation" method="POST">
          @csrf
          <div class="input-group">
            <select class="form-control" id="search" name="search">
              <option selected>Escolha o evento para listar participantes...</option>
              @foreach ($events as $event)
              <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' :'' }}>{{ $event->name }}</option>
              @endforeach
              {{-- <input  id="selected-event-id" name="event_id" value="{{$event->id}}"/> --}}
            </select>
            <button type="submit" class="btn btn-primary" >Search</button>
          </div>
        </form>
      </div>
    </div>
</div>
<span>Id do evento: {{ $trueId }}</span>

    @if ( $invitation != null)

    <p>Convite:</p>
        <p> {{ $invitation->title }}</p>
        <img src="{{ $invitation->image }}">
    @else
        <p>Sem convite associado</p>
        <div>
            <form action="{{ url('invitations/' . $trueId .'/create') }}" method="GET">
                <button type="submit" class="btn btn-primary">
                    <input hidden name="event" value="{{ $trueId }}">
                    <p>Criar Convite</p>
                </button>
            </form>
    </div>
    @endif



@if ($invitation)
<div>
        <form action="{{ url('invitations/' . $invitation->id .'/submit') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" style="border-color: blue">
                <input hidden name="event" value="{{ $trueId }}">
                <p>Enviar Convite</p>
            </button>
        </form>

</div>
@endif

<style>
    body{

        .edit-btn {
        background-color: #EB5B38 !important;
    }

    .edit-btn:hover {
        background-color: #d04b2b !important;
        cursor: pointer;
    }

    .cancel-btn {
        background-color: #ff3300 !important;
    }

    .cancel-btn:hover {
        background-color: #be2c07 !important;
    }

      margin-top:20px;
      background-color:#eee;
    }
    .project-list-table {
        border-collapse: separate;
        border-spacing: 0 12px
    }

    .project-list-table tr {
        background-color: #fff
    }

    .table-nowrap td, .table-nowrap th {
        white-space: nowrap;
    }
    .table-borderless>:not(caption)>*>* {
        border-bottom-width: 0;
    }
    .table>:not(caption)>*>* {
        padding: 0.75rem 0.75rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    .avatar-sm {
        height: 2rem;
        width: 2rem;
    }
    .rounded-circle {
        border-radius: 50%!important;
    }
    .me-2 {
        margin-right: 0.5rem!important;
    }
    img, svg {
        vertical-align: middle;
    }

    a {
        color: #3b76e1;
        text-decoration: none;
    }

    .badge-soft-danger {
        color: #f56e6e !important;
        background-color: rgba(245,110,110,.1);
    }
    .badge-soft-success {
        color: #63ad6f !important;
        background-color: rgba(99,173,111,.1);
    }

    .badge-soft-primary {
        color: #3b76e1 !important;
        background-color: rgba(59,118,225,.1);
    }

    .badge-soft-info {
        color: #57c9eb !important;
        background-color: rgba(87,201,235,.1);
    }

    .avatar-title {
        align-items: center;
        background-color: #3b76e1;
        color: #fff;
        display: flex;
        font-weight: 500;
        height: 100%;
        justify-content: center;
        width: 100%;
    }
    .bg-soft-primary {
        background-color: rgba(59,118,225,.25)!important;
    }
    </style>

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'></script>

