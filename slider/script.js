document.addEventListener( 'DOMContentLoaded', function () {
  new Splide('#splide', {
    type: 'loop',
    perPage: 3,
    autoplay: true,
    arrows: false,
    interval: 2000,
    flickMaxPages: 6,
    updateOnMove: true,
    pagination: false,
    gap        : '1rem',
    throttle: 300,
    breakpoints:{
      400: {
        perPage: 1,
      },
      968: {
        perPage: 1,
      },
      1200: {
        perPage: 3,
      },
      1400: {
        perPage: 3,
      },
    },
  }).mount();
});