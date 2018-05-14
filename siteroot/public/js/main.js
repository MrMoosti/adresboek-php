$(document).ready(function() {

  $('.gebruikers-but').click(function(e) {

  });

  $('.menu').toggleClass('slide-down');

  $('#drop-down').on('click', function(e) {
    // Prevent link from jumping to the top of the page
    e.preventDefault();
    // If menu is already showing, slide it up. Otherwise, slide it down.

    $('.menu').toggleClass('slide-down');
  });

  // Optimalisation: Store the references outside the event handler:
  var $window = $(window);
  var $menu = $('.menu');

  function checkWidth() {
    var windowsize = $window.width();
    if (windowsize > 767) {
      var act = $menu.hasClass("slide-down");

      if (!act) {
        $('.menu').toggleClass('slide-down');
      }
    }
  }
  // Execute on load
  checkWidth();
  // Bind event listener
  $(window).resize(checkWidth);
});
