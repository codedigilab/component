document.addEventListener( 'DOMContentLoaded', function () {
  new Splide('#splide', {
    perPage: 6,
    type: 'loop',
    autoplay: true,
    arrows: false,
    interval: 2000,
    updateOnMove: true,
    pagination: false,
    gap        : '0.5rem',
    throttle: 300,
    breakpoints: {
      640: {
        perPage: 2,
      },
      1000: {
        perPage: 3,
      },
      1200: {
        perPage: 4,
      },
      1400: {
        perPage: 6,
      },
      1600: {
        perPage: 6,
      },
    },
  }).mount();
});