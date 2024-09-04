//splide
(function () {
  const target = '.archive-list > .splide';
  const options = {
    mediaQuery: 'min',
    fixedWidth: '18rem',
    gap: 16,
    type: 'loop',
    arrows: false,
    drag: 'free',
    flickPower: 300,
    pagination: false,
    autoScroll: {
      speed: 0.5,
      pauseOnHover: false,
      pauseOnFocus: false,
    },
    breakpoints: {
      768: {
        gap: 24,
        fixedWidth: '20rem',
      },
    },
  };
  const mySplide01 = new Splide(target, options);
  mySplide01.mount(window.splide.Extensions);
})();
