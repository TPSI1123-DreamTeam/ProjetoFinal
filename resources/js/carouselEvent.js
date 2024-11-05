document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.card-wrapper', {
        loop: true,
        spaceBetween: 20,
        slidesPerView: 5,
        centeredSlides: true,
        initialSlide: 3,

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 5
            },
        },

        on: {
            slideChange: function () {
                updateEventDetails(this.slides[this.activeIndex]);
            },
        }
    });

    function updateEventDetails(activeSlide) {
        const link = activeSlide.querySelector('.card-link'); // Pega o link do slide ativo
        const eventName = link.getAttribute('data-name');
        const eventDescription = link.getAttribute('data-description');
        const eventLocation = link.getAttribute('data-location');
        const eventStartDate = link.getAttribute('data-start-date');
        const eventAmount = link.getAttribute('data-amount');
        const eventAvailability = link.getAttribute('data-availability');

        // Atualiza a div event-details
        document.getElementById('event-title').textContent = eventName;
        document.getElementById('event-description').textContent = eventDescription;
        document.getElementById('event-location').textContent = eventLocation;
        document.getElementById('event-start-date').textContent = eventStartDate;
        document.getElementById('event-amount').textContent = eventAmount;
        document.getElementById('event-availability').textContent = eventAvailability;
    }

    // Chama a função uma vez para garantir que o primeiro slide tenha seus dados exibidos
    updateEventDetails(swiper.slides[swiper.activeIndex]);
});
