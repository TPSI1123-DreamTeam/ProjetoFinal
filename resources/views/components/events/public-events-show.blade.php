<h3 class="title-event-category">Encontra o melhor&nbsp;<span id="event-category"></span>&nbsp;para ti!</h3>
<div class="container swiper">
    <div class="card-wrapper">
        <ul class="card-list swiper-wrapper">
            @foreach($events as $event)
                <li class="card-item swiper-slide">
                    <a href="#" class="card-link" 
                       eventId="{{$event->id}}" 
                       data-category="{{$event->category}}"
                       data-name="{{$event->name}}"
                       data-description="{{$event->description}}"
                       data-location="{{$event->localization}}"
                       data-start-date="{{$event->start_date}}"
                       data-amount="{{$event->amount}}"
                       data-availability="{{$event->availability}}"
                       data-image="{{ asset('images/' . $event->image) }}">
                       <img src="{{ asset('images/' . $event->image) }}" alt="Evento" class="card-image">
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="swiper-pagination"></div>
        <div class="swiper-slide-button swiper-button-prev"></div>
        <div class="swiper-slide-button swiper-button-next"></div>
    </div>
</div>

<div class="event-details" id="event-details">
    <div class="image">
        <img src="" alt="Evento" class="card-image" id="card-imageId">
    </div>
    <div class="info">
        <h2 id="event-title"></h2>
        <p class="description"><span id="event-description"></span></p>
            <div class="local-date">
                <div class="local">
                    <strong>Localização</strong>
                    <p><span id="event-location"></span></p> 
                </div>
                <div class="date">
                    <strong>Data</strong> 
                    <p><span id="event-start-date"></span></p>
                </div>
            </div>
        <p class="price"><span id="event-amount"></span>€ p/ pessoa</p>
        <div class="buy-button">
            <a href="#" id="stripe-btn" class="buy-now">Compra já!</a>
        </div>
    </div>
</div>
