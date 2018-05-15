$(document).ready(function() {

  //Default open menu
  $('.menu').toggleClass('slide-down');

  /* SORTEREN */
  var $voornaam = $('.voornaam-sorteren');
  var $achternaam = $('.achternaam-sorteren');
  var $plaats = $('.plaats-sorteren');
  var $bedrijfsnaam = $('.bedrijfsnaam-sorteren');

  function defaultSorteer()
  {
    if(!$voornaam.hasClass("bold-sorteren")) {

      $voornaam.addClass("bold-sorteren");

      $achternaam.removeClass("bold-sorteren");
      $plaats.removeClass("bold-sorteren");
      $bedrijfsnaam.removeClass("bold-sorteren");
    }
  };

  defaultSorteer();

  $voornaam.on('click', function(e) {
    if(!$voornaam.hasClass("bold-sorteren")) {

      $voornaam.addClass("bold-sorteren");

      $achternaam.removeClass("bold-sorteren");
      $plaats.removeClass("bold-sorteren");
      $bedrijfsnaam.removeClass("bold-sorteren");
    }
  });

  $achternaam.on('click', function(e) {
    if(!$achternaam.hasClass("bold-sorteren")) {

      $achternaam.addClass("bold-sorteren");

      $voornaam.removeClass("bold-sorteren");
      $plaats.removeClass("bold-sorteren");
      $bedrijfsnaam.removeClass("bold-sorteren");
    }
  });

  $plaats.on('click', function(e) {
    if(!$plaats.hasClass("bold-sorteren")) {

      $plaats.addClass("bold-sorteren");

      $voornaam.removeClass("bold-sorteren");
      $achternaam.removeClass("bold-sorteren");
      $bedrijfsnaam.removeClass("bold-sorteren");
    }
  });

  $bedrijfsnaam.on('click', function(e) {
    if(!$bedrijfsnaam.hasClass("bold-sorteren")) {

      $bedrijfsnaam.addClass("bold-sorteren");

      $voornaam.removeClass("bold-sorteren");
      $achternaam.removeClass("bold-sorteren");
      $plaats.removeClass("bold-sorteren");
    }
  });

  /* FOR MENU */

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

  $('#drop-down').on('click', function(e) {
    // Prevent link from jumping to the top of the page
    e.preventDefault();
    // If menu is already showing, slide it up. Otherwise, slide it down.

    $('.menu').toggleClass('slide-down');
  });

});
