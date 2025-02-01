(function($) {

  "use strict";

  $(document).ready(function() {

    // Initialize Isotope
    initIsotope();

    // Initialize lightbox
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fitImagesInViewport': true
    });

    // Initialize swiper for testimonials
    var testimonialSwiper = new Swiper(".testimonial-swiper", {
      spaceBetween: 20,
      pagination: {
        el: ".testimonial-swiper-pagination",
        clickable: true
      },
      breakpoints: {
        0: {
          slidesPerView: 1
        },
        800: {
          slidesPerView: 3
        },
        1400: {
          slidesPerView: 3
        }
      }
    });

  }); // End of document ready

  // Function to initialize Isotope
  var initIsotope = function() {
    $('.grid').each(function() {
      var $buttonGroup = $( '.button-group' );
      var $checked = $buttonGroup.find('.is-checked');
      var filterValue = $checked.attr('data-filter');

      // Initialize Isotope with the selected filter
      var $grid = $(this).isotope({
        itemSelector: '.portfolio-item',
        filter: filterValue
      });

      // Bind filter button click event
      $('.button-group').on('click', 'a', function(e) {
        e.preventDefault();
        filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
      });

      // Update 'is-checked' class on buttons
      $('.button-group').on('click', 'a', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $(this).addClass('is-checked');
      });
    });
  }

})(jQuery);
