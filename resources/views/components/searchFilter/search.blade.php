<form action="{{ route('events.search') }}" method="GET" class="search-bar" id="searchForm">
    <!-- Barra de Pesquisa -->
    <div class="search-input">
        <input type="text" name="search" placeholder="Pesquise por algo" value="{{ request('search') }}">
        <button type="submit"><span class="bx bx-search-alt-2"></span></button>
    </div>

    <!-- Filtro por Data -->
    <div class="event-date-filter">
        <label class="filter-label-title">Filtrar por data:</label>
        <div class="filter-section">
        <div class="from-date">
            <label class="filter-label">De:</label>
            <input type="date" name="from_date" class="date-input" value="{{ request('from_date') }}" min="{{ now()->toDateString() }}">
        </div>
            <div class="to-date">
                <label class="filter-label">Até:</label>
                <input type="date" name="to_date" class="date-input" value="{{ request('to_date') }}" min="{{ now()->toDateString() }}">
            </div>
        </div>
    </div>

    <!-- Tipo de Evento -->
    <div class="event-type-filter">
        <label class="filter-label-event">Tipo de Evento:</label>
        <div class="filter-section event-type">
            <label class="radio-label">
                <input type="radio" name="event_type" value="1" {{ request('event_type') == '1' ? 'checked' : '' }}> Concertos
            </label>
            <label class="radio-label">
                <input type="radio" name="event_type" value="5" {{ request('event_type') == '5' ? 'checked' : '' }}> Festivais
            </label>
            <label class="radio-label">
                <input type="radio" name="event_type" value="4" {{ request('event_type') == '4' ? 'checked' : '' }}> Teatro
            </label>
            <label class="radio-label">
                <input type="radio" name="event_type" value="3" {{ request('event_type') == '3' ? 'checked' : '' }}> Workshops
            </label>
            <label class="radio-label">
                <input type="radio" name="event_type" value="Todos" {{ request('event_type') == '' ? 'checked' : '' }}> Todos
            </label>
        </div>
    </div>
    </form>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchForm = document.getElementById('searchForm');
        const inputs = searchForm.querySelectorAll('input, select'); 
        let debounceTimeout;

        inputs.forEach(input => {
        input.addEventListener('input', () => {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                searchForm.submit();
            }, 500); // 500ms
        });
    });
    });
</script>