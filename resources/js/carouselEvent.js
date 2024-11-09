document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.card-wrapper', {
        loop: true,
        spaceBetween: 20,
        slidesPerView: 5, // padrão para telas grandes
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
            // Para telas com largura acima de 1300px
            1300: {
                slidesPerView: 5,
            },
            // Para telas com largura abaixo de 1300px e acima de 800px
            800: {
                slidesPerView: 3,
            },
            // Para telas com largura abaixo de 800px
            0: {
                slidesPerView: 1,
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
        const eventId = link.getAttribute('eventId');
        const eventCategory = link.getAttribute('data-category');
        const eventName = link.getAttribute('data-name');
        const eventDescription = link.getAttribute('data-description');
        const eventLocation = link.getAttribute('data-location');
        const eventStartDate = link.getAttribute('data-start-date');
        const eventAmount = link.getAttribute('data-amount');
        const eventImage = link.getAttribute('data-image');
        const myArray = eventImage.split("/images");
        let word = myArray[1];

        // Atualiza a div event-details
        document.getElementById('event-category').textContent = eventCategory;
        document.getElementById('event-title').textContent = eventName;
        document.getElementById('event-description').textContent = eventDescription;
        document.getElementById('event-location').textContent = eventLocation;
        document.getElementById('event-start-date').textContent = eventStartDate;
        document.getElementById('event-amount').textContent = eventAmount;
        const image = document.getElementById('card-imageId');
        const url = 'images' + word;
        image.setAttribute('src', url);
        const stripeBtn = document.getElementById('stripe-btn');
        const stripeUrl = '/checkout/' + eventId;
        stripeBtn.setAttribute('href', stripeUrl)
    }

    // Chama a função uma vez para garantir que o primeiro slide tenha seus dados exibidos
    updateEventDetails(swiper.slides[swiper.activeIndex]);
});
