<div class="container swiper">
    <div class="card-wrapper">
        <ul class="card-list swiper-wrapper">
            @foreach($events as $event)
                <li class="card-item swiper-slide">
                    <a href="#" class="card-link" 
                       eventId="{{$event->id}}" 
                       data-name="{{$event->name}}"
                       data-description="{{$event->description}}"
                       data-location="{{$event->location}}"
                       data-start-date="{{$event->start_date}}"
                       data-amount="{{$event->amount}}"
                       data-availability="{{$event->availability}}">                       
                        <img src="{{ asset('images/'.$event->image ) }}" alt="Evento" class="card-image">
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="swiper-pagination"></div>
        <div class="swiper-slide-button swiper-button-prev"></div>
        <div class="swiper-slide-button swiper-button-next"></div>
    </div>
</div>

<div id="event-details">
    <h2 id="event-title"></h2>
    <p id="event-description"></p>
    <p><strong>Localização:</strong> <span id="event-location"></span></p>
    <p><strong>Data:</strong> <span id="event-start-date"></span></p>
    <p><strong>Preço:</strong> <span id="event-amount"></span></p>
    <p><strong>Disponibilidade:</strong> <span id="event-availability"></span></p>
</div>
