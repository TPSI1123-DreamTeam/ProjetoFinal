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
        <p class="description">O Rock & Roll Festival é um evento cheio de energia que celebra a música rock com performances de bandas 
            icónicas e novos talentos. Com um palco imponente, luzes vibrantes e uma atmosfera elétrica, 
            é o local perfeito para fãs do rock aproveitarem concertos inesquecíveis, zonas de alimentação e merchandising exclusivo, 
            num ambiente que exala a verdadeira essência do rock & roll.</p> <!--  id="event-description" adicionar depois -->
            <div class="local-date">
                <div>
                    <strong>Localização</strong>
                    <p>Sagres Campo Pequeno<!-- <span id="event-location"></span> --></p> 
                </div>
                <div>
                    <strong>Data</strong> 
                    <p><span id="event-start-date"></span></p>
                </div>
            </div>
        <p class="price"><span id="event-amount"></span>€ p/ pessoa</p>
        <a class="buy-now">Compra já!</a>
    </div>
</div>
