(function ($, $document, undefined) {
  "use strict";

  /*--- $VARIABLES ---*/
  var $modules,
      $weeks,
      $days,
      $events;

  /*--- DELEGATE ---*/
  $document
    .on('change', '#modules input', function (e) {
      e.preventDefault();

      // Show/hide modules.
      calculate_modules();

      // Hide days and weeks without visible events.
      calculate_hidden();
    })
    .on('change', '#hide-past', function (e) {
      e.preventDefault();

      // Hide days and weeks without visible events.
      calculate_hidden();

      // Store value of checkbox.
      if (Modernizr.localstorage) {
        localStorage.setItem('hide-past', $(this).prop('checked'));
      }
    });


  /*--- FUNCTIONS ---*/
  function init_filters() {
    // Check for localStorage support.
    if (Modernizr.localstorage) {
      var hide_past = localStorage.getItem('hide-past') === 'true';

      // Restore state of hide past checkbox.
      $('#hide-past').prop('checked', hide_past);
    }
  }

  function calculate_modules() {
    var selectors = [],
        ids       = [];

    // Get checked modules and save as array of classes.
    $modules.find('input:checked').each(function (index, element) {
      selectors.push('.' + $(element).attr('class'));
      ids.push($(element).attr('id'));
    });

    // Save ids to localStorage.
    if (Modernizr.localstorage) {
      localStorage.setItem('modules', JSON.stringify(ids));
    }

    // Assume all events hidden and then show requested ones.
    $events.hide()
      .filter(selectors.join(', ')).show();
  }

  function calculate_hidden() {
    // Assume everything visible.
    $days.show();
    $weeks.show();

    // Hide past days if option is checked.
    if ($('#hide-past').prop('checked') === true) {
      $days.filter('.past').hide();
    } else {
      $days.show();
    }

    // Go through all days and check for visible events.
    $days.filter(function(){
      return $(this).find('.event:visible').length == 0;
    }).hide();

    // Go through all weeks and check for visible days.
    $weeks.filter(function(){
      return $(this).find('.day:visible').length == 0;
    }).hide();
  }


  /*--- DOM READY ---*/
  $document.ready(function () {
    $modules = $('#modules');

    // Check if current page is course page.
    if ($modules.length > 0) {
      $weeks = $('.week');
      $days = $('.day');
      $events = $('.event');

      init_filters();
      calculate_modules();
      calculate_hidden();
    }
  });
})(jQuery, jQuery(document));