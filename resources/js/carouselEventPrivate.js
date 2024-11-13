document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.card-wrapper-private', {
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
            1300: {
                slidesPerView: 5,
            },
            800: {
                slidesPerView: 3,
            },
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
        const link = activeSlide.querySelector('.card-link-private');
        const eventId = link.getAttribute('eventId');
        //const eventCategory = link.getAttribute('data-category');
        const eventName = link.getAttribute('data-name');
        const eventDescription = link.getAttribute('data-description');
        const eventImage = link.getAttribute('data-image');

        //document.getElementById('event-category').textContent = eventCategory;
        document.getElementById('event-title-private').textContent = eventName;
        document.getElementById('event-description-private').textContent = eventDescription;
        const image = document.getElementById('card-imageId');
        const url = eventImage;
        image.setAttribute('src', url);
    }

    updateEventDetails(swiper.slides[swiper.activeIndex]);
});
