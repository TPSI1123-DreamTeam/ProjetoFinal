<div class="container-private swiper">
    <div class="card-wrapper-private">
        <ul class="card-list-private swiper-wrapper">
        @foreach($events as $event)
                <li class="card-item-private swiper-slide">
                    <a href="#" class="card-link-private" 
                       eventId="{{$event->id}}" 
                       data-category="{{$event->category->description}}"
                       data-name="{{$event->name}}"
                       data-description="{{$event->description}}"
                       data-image="{{ asset('images/' . $event->image) }}">
                       <img src="{{ asset('images/' . $event->image) }}" alt="Evento" class="card-image-private">
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="swiper-pagination"></div>
        <div class="swiper-slide-button-private swiper-button-prev"></div>
        <div class="swiper-slide-button-private swiper-button-next"></div>
    </div>
</div>

<div class="event-details-private" id="event-details-private">
    <div class="image-private">
        <img src="" alt="Evento" class="card-image-private" id="card-imageId">
    </div>
    <div class="info">
        <h2 id="event-title-private"></h2>
        <p class="description-private"><span id="event-description-private"></span></p>
    </div>
</div>
<div class="reserve-button">
            <a href="#" class="reserve-now">Reserva Já!</a>
    </div>
@vite('resources/js/carouselEventPrivate.js')
